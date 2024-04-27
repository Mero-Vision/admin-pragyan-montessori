<?php

namespace App\Livewire;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class CreateSchoolClass extends Component
{
    public $teachers;

    #[Validate('required|max:30|unique:school_classes,class_name')]
    public $class_name = '';

   

    #[Validate('required| unique:school_classes,class_teacher_id')]
    public $class_teacher = '';

   
    public function save()
    {
        $this->validate();

        $latestClassCode = SchoolClass::latest()->first();
        $lastAdj = $latestClassCode ? (int)Str::after($latestClassCode->class_code, '-') : 0;
        $adjNumber = $lastAdj + 1;

        SchoolClass::create([
            'class_name' => $this->class_name,
            'class_teacher_id' => $this->class_teacher,
            'class_code' => 'CR - '.$adjNumber,
        ]);
        sweetalert()->addSuccess('Class Has Been Created Successfully!');
        return $this->redirect('school-classes');
    }
    
    public function render()
    {
        $this->teachers = Teacher::latest()->get();
        return view('livewire.create-school-class');
    }
}