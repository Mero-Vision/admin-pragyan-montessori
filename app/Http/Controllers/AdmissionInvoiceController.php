<?php

namespace App\Http\Controllers;

use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
use App\Models\AdmissionParticular;
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
        $date=Carbon::today();
        $englishDate= NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $admissionParticulars=AdmissionParticular::orderBy('order_number')->get();

        return view('accounts.admission.admission_invoice',compact('student', 'englishDate', 'admissionParticulars'));
    }
}