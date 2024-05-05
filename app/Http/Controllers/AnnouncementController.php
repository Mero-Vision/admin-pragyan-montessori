<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequestRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(){
        return view('announcements.announcement');
    }

    public function create(){
        return view('announcements.create_announcement');
    }

    public function show($id)
    {
        $announcement = Announcement::find($id);
        return view('announcements.view_announcement',compact('announcement'));
    }

    public function store(AnnouncementRequestRequest $request){
        

        try{
            
            $announcement=DB::transaction(function()use($request){
                $announcement=Announcement::create([
                    'title'=>$request->title,
                    'content'=>$request->content,
                    'author'=>auth()->user()->name,
                ]);
                return $announcement;
            });
            if($announcement){
                return back()->with('success','Announcement created successfully!');
            }
            
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function announcementData(){
        $announcements=Announcement::latest()->get();
        return response()->json(['data'=> $announcements]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if ($announcement) {
            $announcement->delete();

            return response()->json(['status' => 'success', 'message' => 'Announcement deleted successfully.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Announcement Not Found!']);
        }
    }
}