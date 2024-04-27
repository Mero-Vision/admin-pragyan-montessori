<?php

namespace App\Livewire;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditSchoolClass extends Component
{
    public $teachers;
    public $class_id = '';
    protected array $rules = [];

    // #[Validate('required|max:30|unique:school_classes,class_name')]
    public $class_name = '';

    public function mount()
    {
        $this->rules = $this->rules();
    }
    
    public function rules()
    {
         return [
            'class_name' => 'required|unique:school_classes,class_name,' . $this->class_id
         ];
    }

    public function save()
    {
       
        $class=SchoolClass::find($this->class_id);
        
        $class->update([
            'class_name' => $this->class_name,
            'class_teacher_id' => $this->class_teacher
        ]);
        sweetalert()->addSuccess('Class Has Been Created Successfully!');
        return $this->redirect('school-classes');
    }
   

   



    #[Validate('required| unique:school_classes,class_teacher_id')]
    public $class_teacher = '';

    
    
    public function render()
    {
        $this->teachers = Teacher::latest()->get();
        return view('livewire.edit-school-class');
    }
}