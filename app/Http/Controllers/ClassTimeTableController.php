<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassTimeTableCreateRequest;
use App\Models\ClassTime;
use App\Models\ClassTimeTable;
use App\Models\ClassTimeTableDay;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassTimeTableController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::latest()->get();
        $days = ClassTimeTableDay::get();
        $classTimes = ClassTime::get();

        return view('class.create_class_timetable', compact('classes', 'days', 'classTimes'));
    }

    public function store(ClassTimeTableCreateRequest $request)
    {
        $validatedData = $request->validate([

            'class_times.*' => 'required|array',
        ]);

        $existingClassTimeTable=ClassTimeTable::where('class_id',$request->class)->where('class_time_day',$request->day)->exists();
        if($existingClassTimeTable){
            return back()->with('error', 'A timetable for this class and day already exists.');

        }


        foreach ($validatedData['class_times'] as $classTimeData) {
           
            $subject = $classTimeData['subject'];

            $classTimeTable = new ClassTimeTable();
            $classTimeTable->class_id = $request->class;
            $classTimeTable->start_time = $classTimeData['start_time'];
            $classTimeTable->end_time = $classTimeData['end_time'];
            $classTimeTable->class_time_day = $request->day;
            $classTimeTable->subject = $subject;
            $classTimeTable->save();
        }

        return redirect()->back()->with('success', 'Class Time Table Added Successfully!');
    }
}