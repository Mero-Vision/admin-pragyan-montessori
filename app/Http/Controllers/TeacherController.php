<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherCreateRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
      
        return view('teacher.teacher');
       
    }

    public function teacherData(){
        $teachers=Teacher::latest()->get();

        return response()->json(['data'=>$teachers]);
    }

    public function show($id)
    {

        $teacher = Teacher::find($id);
        return view('teacher.view_teacher', compact('teacher'));
    }

    public function edit($id)
    {

        $teacher = Teacher::find($id);
        return view('teacher.edit_teacher', compact('teacher'));
    }

    public function update(Request $request,$id){
        $teacher = Teacher::findOrFail($id);

        try {

            $teacher = DB::transaction(function () use ($request, $teacher) {

                $teacher->update([
                    'teacher_name' => $request->teacher_name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'mobile_no' => $request->mobile_no,
                    'address' => $request->address,
                    'joining_date' => $request->joining_date,
                    'education_qualification' => $request->education_qualification,
                    'position' => $request->position
                ]);


                return $teacher;
            });
            if ($teacher) {
                return back()->with('success', 'Teacher data updated successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create(){
        return view('teacher.add_teacher');
    }

    public function store(TeacherCreateRequest $request)
    {

        try {

            $teacher = DB::transaction(function () use ($request) {

                $teacher = Teacher::create([
                    'teacher_name' => $request->teacher_name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'mobile_no' => $request->mobile_no,
                    'address' => $request->address,
                    'joining_date' => $request->joining_date,
                    'education_qualification' => $request->education_qualification,
                    'position' => $request->position
                ]);

               
                return $teacher;
            });
            if ($teacher) {
                return back()->with('success', 'Teacher data saved successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}