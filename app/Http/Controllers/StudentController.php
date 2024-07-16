<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\AdmissionPayment;
use App\Models\AdmissionPaymentDetail;
use App\Models\MonthlyFeePayment;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentDueAmount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class StudentController extends Controller
{
    protected $students;

    public function __construct(Student $students)
    {
        $this->students=$students;
    }
    public function index(){

        return view('student.student');
    }

    public function show($id){
        
        $student=Student::with('media')->find($id);
        if(!$student){
            return back()->with('error','Student Detail Not Found!');
        }

        
        $class=SchoolClass::find($student->class_id);
        $admission = AdmissionPayment::where('student_id', $id)->latest()->first();
        $paymentOption = PaymentOption::find($admission->payment_option_id);
        $admissionPaymentDetails = AdmissionPaymentDetail::where('admission_payment_id', $admission->id)->get();
        $monthlyFeePayments=MonthlyFeePayment::where('student_id',$student->id)->get();
        $studentDueAmount=StudentDueAmount::find($student->id);
        $paymentOptions = PaymentOption::get();

        return view('student.view_student',compact('student', 'class', 'admission', 'paymentOption',
         'admissionPaymentDetails', 'monthlyFeePayments', 'studentDueAmount',
            'paymentOptions'));
    }

    public function create()
    {
        $classes=SchoolClass::latest()->get();
        return view('student.add_students',compact('classes'));
    }
    

    public function studentData()
    {
        $students = Student::where('payment_status','paid')->latest()->get();

        return response()->json(['data' => $students]);
    }

    public function edit($id){

        $student=$this->students->find($id);
        if(!$student){
            return back()->with('error','Student ID Not Found');
        }
        return view('student.edit_students',compact('student'));
    }


    public function update(Request $request,$id)
    {
       
        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        $student = $this->students->find($id);
        if (!$student) {
            return back()->with('error', 'Student ID Not Found');
        }

        try {

            $student = DB::transaction(function () use ($request, $student, $bsYear) {

                $student->update([
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'mobile_no' => $request->mobile_no,
                    'address' => $request->address,
                    'monthly_payment_amount' => $request->monthly_payment_amount,
                    'roll_number' => $request->rollnumber,
                    'guardian_name' => $request->guardian_name,
                    'guardian_occupation' => $request->guardian_occupation,
                    'previous_school' => $request->previous_school,
                    'blood_group' => $request->blood_group,
                    'disease_if_any' => $request->disease_if_any,
                ]);

                if ($request->profile_image) {
                    $student->addMedia($request->profile_image)->toMediaCollection('student_profile_image');
                }

                $user=User::where('student_id',$student->id)->first();
                if($user){
                    $user->update([
                        'name' => $request->name,
                        'dob' => $request->dob,
                        'email' => $request->email,
                        'gender' => $request->gender,
                        'address' => $request->address,
                        'mobile_no' => $request->mobile_no,
                    ]);
                }
                return $student;
            });
            if ($student) {
                return back()->with('success', 'Student Data Updated Successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

   
}