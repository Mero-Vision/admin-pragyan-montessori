<?php

namespace App\Http\Controllers;

use App\Models\ClassTime;
use App\Models\ClassTimeTableDay;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassTimeTableController extends Controller
{
    public function index(){
        $classes=SchoolClass::latest()->get();
        $days=ClassTimeTableDay::get();
        $classTimes=ClassTime::get();
       
        return view('class.create_class_timetable', compact('classes', 'days', 'classTimes'));
    }
}