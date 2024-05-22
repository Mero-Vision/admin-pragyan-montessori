<?php

namespace App\Http\Controllers;

use App\Models\AdmissionParticular;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pratiksh\Nepalidate\Facades\NepaliDate;

class MonthlyFeesPaymentController extends Controller
{
    public function index(){

        $students = Student::latest()->get();
        
        return view('accounts.monthly_fees.student_monthly_fees',compact('students'));
    }

    public function studentMonthlyFeesPaymentIndex($id){

        $student = Student::find($id);
        if (!$student) {
            return back()->with('error', 'Student Detail Not Found!');
        }
        $class = SchoolClass::find($student->class_id);
        $date = Carbon::today();
        $englishDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $admissionParticulars = AdmissionParticular::orderBy('order_number')->get();

        $paymentOptions = PaymentOption::get();
        
        return view('accounts.monthly_fees.student_monthly_fees_payment', compact('class', 'student', 'englishDate', 'admissionParticulars', 'paymentOptions'));
    }
}