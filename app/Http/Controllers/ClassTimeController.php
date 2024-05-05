<?php

namespace App\Http\Controllers;

use App\Models\ClassTime;
use Illuminate\Http\Request;

class ClassTimeController extends Controller
{
    public function index(){
        return view('class_time.class_time');
    }

    public function classTimeData()
    {
        $classTime = ClassTime::latest()->get();

        return response()->json(['data' => $classTime]);
    }

    public function create()
    {

        return view('class_time.add_class_time');
    }
}