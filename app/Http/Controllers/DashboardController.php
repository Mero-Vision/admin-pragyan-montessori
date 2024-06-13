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

class DashboardController extends Controller
{
    public function index(){
        $countStudent=Student::count();
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

        $students = Student::all();

        // Group students by Nepali month and count them
        $monthlyStudentCount = $students->groupBy(function ($student) {
            return getNepaliMonth($student->admission_date);
        })->map(function ($group) {
            return $group->count();
        })->toArray();

        // Ensure all months from Baisakh (1) to Chaitra (12) are present in the array, even if they have a count of 0
        $months = range(1, 12);
        $monthlyStudentCount = array_replace(array_fill_keys($months, 0), $monthlyStudentCount);

        // Pass the counts as values for months Baisakh (1) to Chaitra (12)
        $monthlyStudentCount = array_values($monthlyStudentCount);
        
        return view('dashboard',compact('countStudent', 'countTeachers', 'countContactUs', 
        'countAdmissionInquiry',
            'totalRevenue',
            'totalClasses',
            'students',
            'monthlyStudentCount'));
    }
}