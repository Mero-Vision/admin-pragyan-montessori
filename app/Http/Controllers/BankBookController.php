<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountCreateRequest;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankBookController extends Controller
{
    public function index()
    {
        $bankAccounts = BankAccount::get();
        return view('bank_book.bank_book', compact('bankAccounts'));
    }

   
}