<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;

class TeacherController extends Controller
{
    public function teacherView()
    {
        $data = Admin::with('department')->where('role', 2)->get();
        $departments = Department::all();
        return view('backend.teacher.teacher', compact('data', 'departments'));
    }

    public function teacherCreate(Request $request)
    {
        $data = new Admin();
        $data->name = $request->has('name') ? $request->get('name') : '';
        $data->email = $request->has('email') ? $request->get('email') : '';
        $data->phone = $request->has('phone') ? $request->get('phone') : '';
        $data->address = $request->has('address') ? $request->get('address') : '';
        $data->dob = date('Y-m-d');
        $data->departmentId = $request->has('departmentId') ? $request->get('departmentId') : '';
        $data->password = $request->has('txtPassword') ? Hash::make($request->get('txtPassword')) : '';
        $data->role = 2; // 2 for teacher

        $data->status = $request->has('status') ? $request->get('status') : '';

        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            $imagelocation = array();
            $i = 0;
            foreach ($files as $file) {
                $extention = $file->getClientOriginalExtension();
                $filename = 'tech-' . time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $data->photo = $filename;
            }
        } else {
            $data->photo = '';
        }

        $data->save();
        return redirect()->back()->with('success', 'Teacher added successfully');
    }
}
