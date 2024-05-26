<?php

namespace App\Livewire;

use App\Models\PaymentOption;
use App\Models\StudentCreditPayment;
use App\Models\StudentDueAmount;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

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
        $this->validate();

        $dueAmount = StudentDueAmount::where('student_id', $this->studentId)->sum('due_amount');

        if ($dueAmount == 0) {
            session()->flash('message', 'No due amount to pay.');
            return;
        }

        StudentCreditPayment::create([
            'student_id' => $this->studentId,
            'payment_option_id' => $this->payment_option_id,
            'user'=>auth()->user()->name,
            'paid_amount' => $this->paid_amount,
        ]);
        $studentDueAmount=StudentDueAmount::where('student_id', $this->studentId)->find();
        if($studentDueAmount){
            $studentDueAmount->update([
                'due_amount'=>$dueAmount-$this->paid_amount
            ]);
        }
        sweetalert()->addSuccess('Class Has Been Created Successfully!');
        return $this->redirect('students');
    }
    
    
    public function render()
    {
       $this->paymentOptions = PaymentOption::get();
        $this->creditPayment = StudentCreditPayment::where('student_id', $this->studentId)->sum('paid_amount');
        $this->dueAmount = StudentDueAmount::where('student_id', $this->studentId)->sum('due_amount');
        return view('livewire.credit-payment-form');
    }

   
}