<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ChangePasswordLivewire extends Component
{
    #[Validate('required')]
    public $old_password;

    #[Validate('required|min:8')]
    public $new_password;

    #[Validate('required|same:new_password')]
    public $confirm_password;

    public function save()
    {
        $this->validate();

       
        if (!Hash::check($this->old_password, Auth::user()->password)) {

            sweetalert()->addWarning('The old password is incorrect!');
            return redirect('admin/profile');
        }
        
        Auth::user()->update(['password' => Hash::make($this->new_password)]);
        
        sweetalert()->addSuccess('Password changed successfully!');
        return redirect('/');
      
    }
    
    public function render()
    {
        return view('livewire.change-password-livewire');
    }
}