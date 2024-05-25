<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFeePayment extends BaseModel
{
    use HasFactory;

    public function monthlyFeePaymentDetail(){
        return $this->hasMany(monthlyFeePaymentDetail::class);
    }
}