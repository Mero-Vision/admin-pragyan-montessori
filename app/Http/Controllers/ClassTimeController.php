<?php

namespace App\Http\Controllers;

use App\Models\ClassTime;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        $request->validate([
            'start_time'=>['required'],
            'end_time'=>['required']
        ]);

        $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('h:i A');
        $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A');
        try {

            $student = DB::transaction(function () use ($request, $end_time, $start_time) {

                $student = ClassTime::create([
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                   
                ]);

                return $student;
            });
            if ($student) {
                return back()->with('success', 'Class Time created successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}