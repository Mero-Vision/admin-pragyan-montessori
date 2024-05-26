<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\Admission;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentDueAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdmissionController extends Controller
{
    public function index(){
        $classes = SchoolClass::latest()->get();
        
        return view('accounts.admission.create_admission',compact('classes'));
    }

    public function listAdmission(){

        $admissionLists=Student::latest()->get();

        return view('accounts.admission.admission_list',compact('admissionLists'));
    }

    public function store(StudentCreateRequest $request)
    {
        $latestStudent = Student::where('class_id',$request->class)->latest()->first();
        $lastAdj = $latestStudent ? (int)$latestStudent->roll_number : 0; // Assume admission_id is numeric
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
                    'monthly_payment_amount'=>$request->monthly_payment_amount,
                    'roll_number' => $adjNumber,
                    'admission_id' => Str::uuid(),
                    'guardian_name'=>$request->guardian_name,
                    'guardian_occupation' => $request->guardian_occupation,
                    'previous_school' => $request->previous_school,
                    'blood_group' => $request->blood_group,
                    'disease_if_any' => $request->disease_if_any,
                    'admission_date' => $request->admission_date

                ]);

                if($request->profile_image){
                    $student->addMedia($request->profile_image)->toMediaCollection('student_profile_image');
                }

               

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