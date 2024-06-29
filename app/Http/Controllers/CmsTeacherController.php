<?php

namespace App\Http\Controllers;

use App\Models\CmsTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsTeacherController extends Controller
{
    public function index()
    {
        $teachers=CmsTeacher::with('media')->orderBy('created_at')->get();
        return view('cms_teacher.cms_teacher',compact('teachers'));
    }

    public function create()
    {
        return view('cms_teacher.add_cms_teacher');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'string'],
            'designation' => ['required', 'max:200', 'string'],
            'mobile_no'=>['nullable','numeric'],
            'teacher_image'=>['required','image', 'max:2048']
        ]);

        try {

            $teacher = DB::transaction(function () use ($request) {

                $teacher = CmsTeacher::create([
                    'name' => $request->name,
                    'phone_no' => $request->mobile_no,
                    'designation' => $request->designation,
                ]);

                if ($request->teacher_image) {
                    $teacher->addMedia($request->teacher_image)->toMediaCollection('cms_teacher');
                }

                return $teacher;
            });
            if ($teacher) {
                return back()->with('success', 'Teacher data published successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $teacher = CmsTeacher::find($id);

        try{

            $teacher=DB::transaction(function()use($teacher){

                $teacher->delete();
                $teacher->clearMediaCollection('cms_teacher');
                return $teacher;
                
            });
            if($teacher){
                return back()->with('success','Teacher data deleted successfully!');
            }
            
            
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage());
            
        }

       
    }
}