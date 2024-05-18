<?php

namespace App\Http\Controllers;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Models\AdmissionParticular;
use App\Models\AdmissionPayment;
use App\Models\AdmissionPaymentDetail;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pratiksh\Nepalidate\Facades\NepaliDate;

class AdmissionInvoiceController extends Controller
{
    public function index($id){

        $student=Student::find($id);
        if(!$student){
            return back()->with('error','Student Detail Not Found!');
        }
        $class=SchoolClass::find($student->class_id);
        $date=Carbon::today();
        $englishDate= NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $admissionParticulars=AdmissionParticular::orderBy('order_number')->get();

        $paymentOptions=PaymentOption::get();

        return view('accounts.admission.admission_invoice',compact('class','student', 'englishDate', 'admissionParticulars', 'paymentOptions'));
    }

    public function printAdmissionInvoice($id){

        $admission=AdmissionPayment::where('student_id',$id)->latest()->first();
        $student=Student::find($id);
        $paymentOption=PaymentOption::find($admission->payment_option_id);
        $admissionPaymentDetails=AdmissionPaymentDetail::where('admission_payment_id',$admission->id)->get();
        
        return view('accounts.admission.print_admission_invoice',compact('admission', 'student', 'paymentOption', 'admissionPaymentDetails'));
    }
}