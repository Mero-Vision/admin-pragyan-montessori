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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index(){

        return view('student.student');
    }

    public function show($id){
        
        $student=Student::find($id);
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

    public function store(StudentCreateRequest $request)
    {
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
                    'admission_id' => Str::uuid(),
                    'roll_number'=>$request->roll_number
                   
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