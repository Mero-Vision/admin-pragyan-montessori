<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $teachers = Teacher::latest()->get();
        return view('class.class', compact('teachers'));
    }

    public function classData(){
        $classes=SchoolClass::join('teachers', 'teachers.id','=', 'school_classes.class_teacher_id')
        ->select('school_classes.id',
            'school_classes.class_name',
            'school_classes.class_code',
            'teachers.teacher_name'
        )->get();

        return response()->json(['data'=>$classes]);
    }

    public function create(){
        $teachers = Teacher::latest()->get();
        return view('class.add_class',compact('teachers'));
    }

    public function getClassData($id)
    {
        $class = SchoolClass::find($id);

        return response()->json($class);
    }

    public function destroy($id)
    {
        $class = SchoolClass::find($id);

        if ($class) {
            $class->delete();
           
            return response()->json(['status' => 'success', 'message' => 'Employee deleted successfully.']);
          
        } else {
            return response()->json(['status' => 'error', 'message' => 'Employee Not Found!']);
        }
    }
}