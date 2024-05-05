<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
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
        return view('dashboard',compact('countStudent', 'countTeachers', 'countContactUs', 'countAdmissionInquiry'));
    }
}