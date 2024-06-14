<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function admissionPaymentReport(){

        $start_date = request()->query('start_date', now()->startOfDay()->toDateString());
        $end_date = request()->query('end_date', now()->endOfDay()->toDateString());

        $admissionPayments = AdmissionPayment::join('students', 'students.id', '=', 'admission_payments.student_id')->
        join('school_classes', 'school_classes.id', '=', 'admission_payments.class_id')
            ->select('admission_payments.*', 'students.name', 'school_classes.class_name')
            ->whereBetween('admission_payments.created_at', [
            Carbon::parse($start_date)->startOfDay(),
            Carbon::parse($end_date)->endOfDay()
        ])
            ->get();
        
        return view('reports.sales_report.admission_payment_report',compact('admissionPayments'));
    }
}