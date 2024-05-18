<?php

namespace App\Livewire;

use App\Models\PaymentOption;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class PaymentModeForm extends Component
{

   

    #[Validate('required|max:30|unique:payment_options,payment_name')]
    public $payment_option = '';


    public function save()
    {
        $this->validate();

        PaymentOption::create([
            'payment_name' => $this->payment_option,
            'user'=>auth()->user()->name
        ]);
        sweetalert()->addSuccess('Payment Mode Created Successfully!');
        return $this->redirect('payment-options');
    }

    
    public function render()
    {
        return view('livewire.payment-mode-form');
    }
}