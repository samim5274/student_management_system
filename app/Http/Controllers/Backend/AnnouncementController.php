<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $announcement->title = $request->has('txtTitle') ? $request->get('txtTitle') : '';
        $announcement->description = $request->has('txtDiscription') ? $request->get('txtDiscription') : '';

        if ($request->hasFile('photo')) 
        {
            $files = $request->file('photo');
            $imagelocation = array();
            $i = 0;
            foreach($files as $file)
            {
                $extention = $file->getClientOriginalExtension();
                $filename = 'announce-'. time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $announcement->image = $filename;
            }
        } 
        else 
        {
            $announcement->image = '';
        }

        $announcement->save();

        return redirect()->back()->with('success', 'Announcement created successfully.');
    }

    public function announcementSpecific(Request $request, $id)
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
        if ($data->image) 
        {
            $path = public_path('/img/uploads/' . $data->image);
        
            // Debug to see the full path
            logger("Trying to delete: " . $path); // or use dd($path);
        
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
        $data = Announcement::find($id);
        $data->title = $request->has('txtTitle') ? $request->get('txtTitle') : '';
        $data->description = $request->has('txtDiscription') ? $request->get('txtDiscription') : '';

        if ($request->hasFile('photo')) 
        {
            if ($data->image) 
            {
                $path = public_path('/img/uploads/' . $data->image);
            
                // Debug to see the full path
                logger("Trying to delete: " . $path); // or use dd($path);
            
                if (file_exists($path)) {
                    unlink($path);
                } else {
                    logger("File not found: " . $path);
                }
            }

            $files = $request->file('photo');
            $imagelocation = array();
            $i = 0;
            foreach($files as $file)
            {
                $extention = $file->getClientOriginalExtension();
                $filename = 'announce-'. time() . ++$i . '.' . $extention;
                $location = '/img/uploads/';
                $file->move(public_path($location), $filename);
                $imagelocation[] = $location . $filename;
                $data->image = $filename;
            }
        } 
        else 
        {
            $data->image = $data->image;
        }
        $data->update();
        return redirect()->back()->with('success', 'Announcement updated successfully.');
    }
    
}
