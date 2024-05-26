<?php

namespace App\Livewire;

use App\Models\StudentDueAmount;
use Livewire\Component;

class DueAmountLiveWire extends Component
{
    public $studentDueAmount;
    public $studentId;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
    }
    
    public function render()
    {
        $this->studentDueAmount = StudentDueAmount::where('student_id', $this->studentId)->first();
        return view('livewire.due-amount-live-wire');
    }
}