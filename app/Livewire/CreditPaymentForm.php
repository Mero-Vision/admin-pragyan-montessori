<?php

namespace App\Livewire;

use App\Models\PaymentOption;
use App\Models\StudentCreditPayment;
use App\Models\StudentDueAmount;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class CreditPaymentForm extends Component
{
    public $paymentOptions;
    public $creditPayment;
    public $studentId;
    public $dueAmount;

    public $due_amount;

    #[Validate('required')]
    public $payment_option_id = '';

    #[Validate('required| numeric')]
    public $paid_amount = '';

    
    public function mount($studentId)
    {
        $this->studentId = $studentId;
    }

    public function save()
    {
        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];
        
        $this->validate();

        $dueAmount = StudentDueAmount::where('student_id', $this->studentId)->sum('due_amount');

        if ($dueAmount == 0) {
            session()->flash('message', 'No due amount to pay.');
            return;
        }

        if ($this->paid_amount>$dueAmount) {
            session()->flash('message', 'The payment amount cannot exceed the due amount.');
            return;
        }

        StudentCreditPayment::create([
            'session_year' => $bsYear,
            'student_id' => $this->studentId,
            'payment_option_id' => $this->payment_option_id,
            'user'=>auth()->user()->name,
            'credit_amount' => $this->paid_amount,
        ]);

        
        StudentDueAmount::updateOrCreate([
            'student_id' => $this->studentId,
        ], ['due_amount'=>$dueAmount-$this->paid_amount]);
        
        sweetalert()->addSuccess('Credit Payment Has Been Done Successfully!');
        $this->redirect('/admin/students/view/' . $this->studentId);
    }
    
    
    public function render()
    {
       $this->paymentOptions = PaymentOption::get();
        $this->creditPayment = StudentCreditPayment::where('student_id', $this->studentId)->sum('credit_amount');
        $this->dueAmount = StudentDueAmount::where('student_id', $this->studentId)->sum('due_amount');
        return view('livewire.credit-payment-form');
    }

   
}