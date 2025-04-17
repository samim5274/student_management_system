<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function signinView()
    {
        return view('admin.signin');
    }

    public function createUser(Request $request)
    {
        $data = new Admin();

        $email = $request->has('txtEmail') ? $request->get('txtEmail') : '';
        $password = $request->has('txtPassword') ? $request->get('txtPassword') : '';
        $name = $request->has('txtName') ? $request->get('txtName') : '';
        $role = $request->has('cbxRole') ? $request->get('cbxRole') : '';
        if ($email == '' || $password == '' || $name == '') {
            return redirect()->back()->with('error', 'Please fill all fields');
        }
        if (strlen($password) < 6) {
            return redirect()->back()->with('error', 'Password must be at least 6 characters');
        }
        $findEmail = Admin::where('email', $email)->first();
        if ($findEmail) {
            return redirect()->back()->with('error', 'Email already exists');
        }
        $data->name = $name;
        $data->email = $email;
        $data->password = Hash::make($password);
        $data->photo = NULL;
        $data->phone = '123456789';
        $data->address = 'Dhaka';
        $data->dob = date('Y-m-d');
        $data->departmentId = 1;
        $data->status = 1;
        $data->role = $role;
        $data->save();
        return redirect()->back()->with('success', 'User created successfully');
    }

    public function loginView()
    {
        return view('admin.login');
    }

    public function userLogin(Request $request)
    {
        $creadentials = [
            'email' => $request->input('txtEmail'),
            'password' => $request->input('txtPassword'),
            'role' => $request->input('cbxRole'),
        ];
        if (Auth::guard('admin')->attempt($creadentials)) {
            $userId = Auth::guard('admin')->user()->id;
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid user mail or password');
        }
    }

    public function dashboard()
    {
        return view('welcome');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login-view');
    }

    public function passView($id)
    {
        $data = Auth::guard('admin')->user()->id;
        $users = Admin::with('department')->where('id', $data)->get();
        return view('admin.passView', compact('users'));
    }

    public function passwordUpdate(Request $request, $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if (Hash::check($request->input('txtOldPassword'), $admin->password)) {
            $admin->password = Hash::make($request->input('txtNewPassword'));
            $admin->update();
            return redirect()->back()->with('success', 'Your password is changed.');
        } else {
            return redirect()->back()->with('error', 'Invalid password. Please try again. Thank you!');
        }
    }

    public function profileView()
    {
        $data = Auth::guard('admin')->user()->id;
        $users = Admin::with('department')->where('id', $data)->get();
        $departments = Department::all();
        return view('admin.profileView', compact('users', 'departments'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $data = Admin::find($id);
        $data->name = $request->has('name') ? $request->get('name') : '';
        $data->phone = $request->has('phone') ? $request->get('phone') : '';
        $data->address = $request->has('address') ? $request->get('address') : '';
        $data->dob = $request->has('dob') ? $request->get('dob') : '';;
        $data->departmentId = $request->has('departmentId') ? $request->get('departmentId') : '';
        $data->status = $request->has('status') ? $request->get('status') : '';

        if ($data->role == 1) {
            $imgname = 'std-';
        } elseif ($data->role == 2) {
            $imgname = 'tech-';
        } else {
            $imgname = 'head-';
        }
        
        if ($request->hasFile('photo')) {
            if ($data->photo) {
                $path = public_path('/img/uploads/' . $data->photo);

                logger("Trying to delete: " . $path);

                if (file_exists($path)) {
                    unlink($path);
                } else {
                    logger("File not found: " . $path);
                }
            }

            $files = $request->file('photo');
            $imagelocation = array();
            $i = 0;
            foreach ($files as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = $imgname . time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $data->photo = $filename;
            }
        } else {
            $data->photo = $data->photo;
        }

        $data->update();

        return redirect()->back()->with('success', 'User data updated successfully.');
    }
}
