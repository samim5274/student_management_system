<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function announcementView()
    {
        $announcement = Announcement::orderBy('id', 'desc')->get();
        $user = Auth::user();
        return view('backend.announcement.announcementView', compact('announcement', 'user'));
    }

    public function createAnnouncement(Request $request)
    {
        $announcement = new Announcement();

        $announcement->title = $request->get('txtTitle', '');
        $announcement->description = $request->get('txtDiscription', '');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo')[0];
            $extention = $file->getClientOriginalExtension();
            $filename = 'announce-' . time() . '.' . $extention;
            $location = '/img/uploads/';
            $file->move(public_path($location), $filename);
            $announcement->image = $filename;
        } else {
            $announcement->image = NULL;
        }

        $announcement->save();
        // $this->sendMail(); it's call send mail function
        return redirect()->back()->with('success', 'Announcement created successfully.');
    }

    public function announcSpecific(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        return view('backend.announcement.announcementSpecific', compact('announcement'));
    }

    public function announcementEdit(Request $request, $id)
    {
        $data = Announcement::find($id);
        return view('backend.announcement.announcementEdit', compact('data'));
    }

    public function announcementDelete($id)
    {
        $data = Announcement::find($id);
        if ($data->image) {
            $path = public_path('/img/uploads/' . $data->image);

            logger("Trying to delete: " . $path);

            if (file_exists($path)) {
                unlink($path);
            } else {
                logger("File not found: " . $path);
            }
        }
        $data->delete();
        return redirect()->back()->with('success', 'Announcement deleted successfully.');
    }

    public function announcementUpdate(Request $request, $id)
    {
        $request->validate([
            'txtTitle' => 'required|string|max:255',
            'txtDiscription' => 'required|string',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = Announcement::find($id);
        $data->title = $request->get('txtTitle', '');
        $data->description = $request->get('txtDiscription','');
        
        if ($request->hasFile('photo')) {
            if ($data->image) {
                $path = public_path('/img/uploads/' . $data->image);

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
                $filename = 'announce-' . time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $data->image = $filename;
            }
        } else {
            $data->image = $data->image;
        }
        $data->save();
        return redirect()->route('announcement-view')->with('success', 'Announcement updated successfully.');
    }

    public function sendMail()
    {
        $data = Auth::guard('admin')->user();

        $mailAddress = [
            'swiftoverseastravels@gmail.com',
            'swiftoverseas0@gmail.com',
            'xyz.abdullah.m@gmail.com',
        ];
        Mail::to($mailAddress)->send(new TestMail($data->name));
    
        return 'Email has been sent!';
    }
}
