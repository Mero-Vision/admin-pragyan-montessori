<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(){

        return view('student.student');
    }

    public function create()
    {
        $classes=SchoolClass::latest()->get();
        return view('student.add_students',compact('classes'));
    }
    

    public function studentData()
    {
        $students = Student::latest()->get();

        return response()->json(['data' => $students]);
    }

    public function store(StudentCreateRequest $request)
    {
        $latestStudent = Student::latest()->first();
        $lastAdj = $latestStudent ? (int)Str::after($latestStudent->admission_id, '-') : 0;
        $adjNumber = $lastAdj + 1;

        $latestStudent = Student::latest()->first();
        $lastAdj = $latestStudent ? (int)Str::after($latestStudent->admission_id, '-') : 0;
        $adjNumber = $lastAdj + 1;
        try {

            $student = DB::transaction(function () use ($request, $adjNumber) {

                $student = Student::create([
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'mobile_no' => $request->mobile_no,
                    'address' => $request->address,
                    'address' => $request->address,
                    'class_id' => $request->class,
                    'admission_id' => 'PRG - ' . $adjNumber,
                   
                ]);

                return $student;
            });
            if ($student) {
                return back()->with('success', 'Student data saved successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}