<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Admin;
use Auth;

class TaskController extends Controller
{
    public function taskView()
    {
        $data = Task::with('teacher')->get();
        return view('backend.task.taskView', compact('data'));
    }

    public function taskCreate(Request $request)
    {
        $data = new Task();
        $data->title = $request->has('txtTitle') ? $request->get('txtTitle') : '';
        $data->description = $request->has('txtDiscription') ? $request->get('txtDiscription') : '';
        $data->date = date('Y-m-d');
        $data->status = 0; // 0 for pending,1 for submited, 2 for complete, 3 for rejected
        $data->teacherId = Auth::guard('admin')->user()->id;
        $data->stdId = NULL;
        $data->feedback = NULL;
        $data->save();
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    public function tastDelete(Request $request, $id)
    {
        $data = Task::find($id);
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Task deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Task not found!');
        }
    }

    public function taskEdit(Request $request, $id)
    {
        $data = Task::find($id);
        return view('backend.task.taskEdit', compact('data'));
    }

    public function taskUpdate(Request $request, $id)
    {
        $data = Task::find($id);
        if ($data) {
            $data->title = $request->has('txtTitle') ? $request->get('txtTitle') : '';
            $data->description = $request->has('txtDiscription') ? $request->get('txtDiscription') : '';
            $data->date = date('Y-m-d');
            $data->status = 0; // 0 for pending,1 for submited, 2 for complete, 3 for rejected
            $data->teacherId = Auth::guard('admin')->user()->id;
            $data->stdId = NULL;
            $data->feedback = NULL;
            $data->update();
            return redirect()->back()->with('success', 'Task updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Task not found!');
        }
    }

    public function taskSubmition(Request $request, $id)
    {
        $data = Task::find($id);
        return view('backend.task.taskSubmition', compact('data'));
    }

    public function tastSubmitUpdated(Request $request, $id)
    {
        $data = Task::find($id);
        if ($data) {
            $data->stdId = Auth::guard('admin')->user()->id;
            $data->feedback = $request->has('txtFeedback') ? $request->get('txtFeedback') : '';
            $data->status = 1; // 0 for pending,1 for submited, 2 for complete, 3 for rejected
            $data->update();
            return redirect()->back()->with('success', 'Task submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'Task not found!'); 
        }
    }    

    public function taskApprovedView()
    {
        $data = Task::whereBetween('status', [1,3])->get(); // 0 for pending,1 for submited, 2 for complete, 3 for rejected
        return view('backend.task.taskApprovedView', compact('data'));
    }

    public function taskFeedbackView(Request $request, $id)
    {
        $data = Task::find($id);
        return view('backend.task.taskFeedbackView', compact('data'));
    }

    public function taskApprove(Request $request, $id)
    {
        $data = Task::find($id);
        if ($data) {
            $data->status = 2; // 0 for pending,1 for submited, 2 for complete, 3 for rejected
            $data->update();
            return redirect()->back()->with('success', 'Task approved successfully!');
        } else {
            return redirect()->back()->with('error', 'Task not found!');
        }
    }
    public function taskReject(Request $request, $id)
    {
        $data = Task::find($id);
        if ($data) {
            $data->status = 3; // 0 for pending,1 for submited, 2 for complete, 3 for rejected
            $data->update();
            return redirect()->back()->with('success', 'Task rejected successfully!');
        } else {
            return redirect()->back()->with('error', 'Task not found!');
        }
    }
}
