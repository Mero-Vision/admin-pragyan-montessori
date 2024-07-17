<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class MonthlyFeeAllocationController extends Controller
{
    protected $students;

    public function __construct(Student $students)
    {
        $this->students=$students;
    }
    public function index(){

        $students = $this->students->join('school_classes', 'school_classes.id', '=', 'students.class_id')
            ->select('students.*', 'school_classes.class_name')->get();

        $classes=SchoolClass::latest()->get();
            
        return view('accounts.monthly_fee_allocation.monthly_fee_allocation',compact('students','classes'));
    }
}