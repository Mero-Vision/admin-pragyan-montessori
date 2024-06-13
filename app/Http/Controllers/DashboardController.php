<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use App\Models\ContactUs;
use App\Models\MonthlyFeePayment;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentAdmissionInquiry;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class DashboardController extends Controller
{
    public function index(){
        $countStudent=Student::where('payment_status', 'paid')->count();
        $countTeachers = Teacher::count();
        $countContactUs = ContactUs::count();
        $countAdmissionInquiry = StudentAdmissionInquiry::count();
        $totalRevenue=AdmissionPayment::sum('sub_total')+MonthlyFeePayment::sum('sub_total');
        $totalClasses=SchoolClass::count();



        function getNepaliMonth($date)
        {
            $nepaliDate = explode('-', $date);
            return intval($nepaliDate[1]); // Returns the month part
        }

        $students = Student::where('payment_status', 'paid')->get();
        $monthlyStudentCount = $students->groupBy(function ($student) {
            return getNepaliMonth($student->admission_date);
        })->map(function ($group) {
            return $group->count();
        })->toArray();
        $months = range(1, 12);
        $monthlyStudentCount = array_replace(array_fill_keys($months, 0), $monthlyStudentCount);
        $monthlyStudentCount = array_values($monthlyStudentCount);



        $payments = MonthlyFeePayment::all();
        $monthlyPaymentCount = $payments->groupBy(function ($payment) {
            $adDate = Carbon::parse($payment->payment_date); 
            $bsDate= NepaliCalendar::AD2BS($adDate);
            return getNepaliMonth($bsDate);
        })->map(function ($group) {
            return $group->sum('paid_amount');
        })->toArray();
        $months = range(1, 12);
        $monthlyPaymentCount = array_replace(array_fill_keys($months, 0), $monthlyPaymentCount);
        $monthlyPaymentCount = array_values($monthlyPaymentCount);
        
        return view('dashboard',compact('countStudent', 'countTeachers', 'countContactUs', 
        'countAdmissionInquiry',
            'totalRevenue',
            'totalClasses',
            'students',
            'monthlyStudentCount',
            'monthlyPaymentCount'));
    }
}