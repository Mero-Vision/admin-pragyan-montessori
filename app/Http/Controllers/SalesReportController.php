<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use App\Models\StudentCreditPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class SalesReportController extends Controller
{
    public function admissionPaymentReport()
    {

        $start_date = request()->query('start_date', now()->startOfDay()->toDateString());
        $end_date = request()->query('end_date', now()->endOfDay()->toDateString());

        $admissionPayments = AdmissionPayment::join('students', 'students.id', '=', 'admission_payments.student_id')->join('school_classes', 'school_classes.id', '=', 'admission_payments.class_id')
            ->select('admission_payments.*', 'students.name', 'school_classes.class_name')
            ->whereBetween('admission_payments.created_at', [
                Carbon::parse($start_date)->startOfDay(),
                Carbon::parse($end_date)->endOfDay()
            ])
            ->get();

        return view('reports.sales_report.admission_payment_report', compact('admissionPayments'));
    }

    public function monthlyFeesPaymentReport(Request $request)
    {
        // Fetch query parameters
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        // If either start_date or end_date is not provided, return empty data
        if (!$start_date || !$end_date) {
            $studentCreditPayments = collect(); // Return an empty collection
            return view('reports.sales_report.monthly_fees_payment_report', compact('studentCreditPayments'));
        }

        // Get the current date in AD and convert it to BS
        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        // Initialize the query
        $studentCreditPaymentsQuery = StudentCreditPayment::join('students', 'students.id', '=', 'student_credit_payments.student_id')
        ->join('payment_options', 'payment_options.id', '=', 'student_credit_payments.payment_option_id')
        ->select('student_credit_payments.*', 'students.name', 'payment_options.payment_name')
        ->where('student_credit_payments.session_year', $bsYear);

        // Apply the date filter
        $studentCreditPaymentsQuery->whereBetween('student_credit_payments.created_at', [
            Carbon::parse($start_date)->startOfDay(),
            Carbon::parse($end_date)->endOfDay()
        ]);

        // Execute the query and get the results
        $studentCreditPayments = $studentCreditPaymentsQuery->get();

        return view('reports.sales_report.monthly_fees_payment_report', compact('studentCreditPayments'));
    }
}