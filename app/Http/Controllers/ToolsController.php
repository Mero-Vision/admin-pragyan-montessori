<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function calendarIndex(){
       return view('tools.calendar');
    }

    public function nepaliDateConverter()
    {
        return view('tools.nepali_date_converter');
    }
}