<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentView()
    {
        $departments = Department::all();
        $user = Auth::user();
        $data = Admin::with('department')->where('role', 1)->get();
        // dd($data);
        return view('backend.student.studentView', compact('departments', 'user', 'data'));
    }

    public function studentCreate(Request $request)
    {
        $data = new Admin();
        $data->name = $request->has('name') ? $request->get('name') : '';
        $data->email = $request->has('email') ? $request->get('email') : '';
        $data->phone = $request->has('phone') ? $request->get('phone') : '';
        $data->address = $request->has('address') ? $request->get('address') : '';
        $data->dob = date('Y-m-d');
        $data->departmentId = $request->has('departmentId') ? $request->get('departmentId') : '';
        $data->password = $request->has('txtPassword') ? Hash::make($request->get('txtPassword')) : '';
        $data->role = 1; // 2 for student
        
        $data->status = $request->has('status') ? $request->get('status') : '';

        if ($request->hasFile('photo')) 
        {
            $files = $request->file('photo');
            $imagelocation = array();
            $i = 0;
            foreach($files as $file)
            {
                $extention = $file->getClientOriginalExtension();
                $filename = 'std-'. time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $data->photo = $filename;
            }
        } 
        else 
        {
            $data->photo = '';
        }

        $data->save();
        return redirect()->back()->with('success', 'New student added successfully');
    }
}
