<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use App\Models\ContactUs;
use App\Models\MonthlyFeePayment;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentAdmissionInquiry;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $countStudent=Student::count();
        $countTeachers = Teacher::count();
        $countContactUs = ContactUs::count();
        $countAdmissionInquiry = StudentAdmissionInquiry::count();
        $totalRevenue=AdmissionPayment::sum('sub_total')+MonthlyFeePayment::sum('sub_total');
        $totalClasses=SchoolClass::count();
        return view('dashboard',compact('countStudent', 'countTeachers', 'countContactUs', 
        'countAdmissionInquiry',
            'totalRevenue',
            'totalClasses'));
    }
}