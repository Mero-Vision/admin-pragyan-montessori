<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Component;

class EditSchoolClass extends Component
{
    public $teachers;
    
    public function render()
    {
        $this->teachers = Teacher::latest()->get();
        return view('livewire.edit-school-class');
    }
}