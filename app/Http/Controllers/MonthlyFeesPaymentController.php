<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class MonthlyFeesPaymentController extends Controller
{
    public function index(){

        $students = Student::latest()->get();
        
        return view('accounts.monthly_fees.student_monthly_fees',compact('students'));
    }
}