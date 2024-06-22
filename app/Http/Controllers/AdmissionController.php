<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Mail\UserVerificationMail;
use App\Models\Admission;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentDueAmount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

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

        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        try {

            $student = DB::transaction(function () use ($request, $adjNumber, $bsYear) {

                $student = Student::create([
                    'session_year' => $bsYear,
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'mobile_no' => $request->mobile_no,
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

                $user = User::create([
                    'student_id'=>$student->id,
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => Hash::make('4546567'),
                    'address' => $request->address,
                    'mobile_no' => $request->mobile_no,
                    'role' => 'student',
                ]);

                $token = Str::random(60);

                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                Mail::to($request->email)->send(new UserVerificationMail($user, $token));

               

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