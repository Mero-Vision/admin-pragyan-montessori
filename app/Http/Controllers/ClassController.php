<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
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


    public function getClassStudentData($class_id)
    {
        $classStudents = Student::where('class_id', $class_id)->
        where('payment_status', 'paid')->get();
        $class=SchoolClass::find($class_id);
        $classTeacher=Teacher::find($class->class_teacher_id);
        $totalStudents = Student::where('class_id', $class_id)->
        where('payment_status', 'paid')->count();
      

        return view('class.student_class',compact('classStudents', 'class', 'classTeacher', 'totalStudents'));
    }

   
    




    

    public function destroy($id)
    {
        $class = SchoolClass::find($id);
        $existingStudentWithClass=Student::where('class_id',$class->id)->exists();
        if($existingStudentWithClass){
            return response()->json(['status' => 'error', 'message' => 'Unable to delete: This class is currently associated with a student.'], 400);
        }

        if ($class) {
            $class->delete();
           
            return response()->json(['status' => 'success', 'message' => 'Class deleted successfully.']);
          
        } else {
            return response()->json(['status' => 'error', 'message' => 'Class Not Found!']);
        }
    }
}