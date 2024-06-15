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

    public function create()
    {
        return view('bank_book.bank_account.create_bank_account');
    }

    public function store(BankAccountCreateRequest $request)
    {
        try {
            $bankAccount = DB::transaction(function () use ($request) {
                $bankAccount = BankAccount::create([
                    'user' => auth()->user()->name,
                    'bank_name' => $request->bank_name,
                    'account_name' => $request->account_holder_name,
                    'account_number'=>$request->account_number,
                    'account_type'=>$request->account_type,
                    'balance'=>$request->current_balance
                ]);
                return $bankAccount;
            });
            if($bankAccount){
                sweetalert()->addSuccess('Bank Account Created Successfully!');
                return redirect('admin/bank-book');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('bank-details.create')->with('success', 'Bank details submitted successfully.');
    }
}