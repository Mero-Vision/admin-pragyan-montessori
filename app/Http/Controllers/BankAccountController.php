<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAccountCreateRequest;
use App\Models\BankAccount;
use App\Models\BankBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class BankAccountController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('bank_book.bank_account.create_bank_account');
    }

    public function store(BankAccountCreateRequest $request)
    {
        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        try {
            $bankAccount = DB::transaction(function () use ($request, $bsYear) {
                $bankAccount = BankAccount::create([
                    'session_year' => $bsYear,
                    'user' => auth()->user()->name,
                    'bank_name' => $request->bank_name,
                    'account_name' => $request->account_holder_name,
                    'account_number' => $request->account_number,
                    'account_type' => $request->account_type,
                    'balance' => $request->current_balance
                ]);
                return $bankAccount;
            });
            if ($bankAccount) {
                sweetalert()->addSuccess('Bank Account Created Successfully!');
                return redirect('admin/bank-book');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function depositIndex($slug)
    {
        $bankAccount = BankAccount::where('slug', $slug)->first();
        return view('bank_book.bank_account.deposit', compact('bankAccount'));
    }

    public function depositStore(Request $request, $slug)
    {
        $request->validate([
            'deposit_amount' => ['required', 'numeric'],
            'transaction_date' => ['required']
        ]);

        $currentYear = Carbon::today();
        $bsYear = explode('-', NepaliCalendar::AD2BS($currentYear))[0];

        $bankAccount = BankAccount::where('slug', $slug)->firstOrFail();

        try {
            DB::transaction(function () use ($request, $bsYear, $bankAccount) {
                $newBalance = $bankAccount->balance + $request->deposit_amount;

                BankBook::create([
                    'session_year' => $bsYear,
                    'user' => auth()->user()->name,
                    'bank_account_id' => $bankAccount->id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Deposit",
                    'amount' => $request->deposit_amount,
                    'balance' => $newBalance
                ]);

                $bankAccount->update(['balance' => $newBalance]);
            });

            if ($bankAccount) {
                sweetalert()->addSuccess('Amount Has Been Deposited Successfully!');
                return redirect('admin/bank-book');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function withdrawIndex($slug)
    {
        $bankAccount = BankAccount::where('slug', $slug)->first();
        return view('bank_book.bank_account.withdraw', compact('bankAccount'));
    }

    public function withdrawStore(Request $request, $slug)
    {
        $request->validate([
            'withdraw_amount' => ['required', 'numeric'],
            'transaction_date' => ['required']
        ]);

        $currentYear = Carbon::today();
        $bsYear = explode('-', NepaliCalendar::AD2BS($currentYear))[0];

        $bankAccount = BankAccount::where('slug', $slug)->firstOrFail();

        try {
            DB::transaction(function () use ($request, $bsYear, $bankAccount) {
                $newBalance = $bankAccount->balance - $request->withdraw_amount;

                BankBook::create([
                    'session_year' => $bsYear,
                    'user' => auth()->user()->name,
                    'bank_account_id' => $bankAccount->id,
                    'transaction_date' => $request->transaction_date,
                    'transaction_type' => "Withdraw",
                    'amount' => $request->withdraw_amount,
                    'balance' => $newBalance
                ]);

                $bankAccount->update(['balance' => $newBalance]);
            });

            if ($bankAccount) {
                sweetalert()->addSuccess('Amount Has Been Withdrawed Successfully!');
                return redirect('admin/bank-book');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function statementIndex($slug)
    {
        $bankAccount = BankAccount::where('slug', $slug)->first();
        $start_date = request()->query('start_date');
        $end_date = request()->query('end_date');
        
        $bankBooks=BankBook::where('bank_account_id',$bankAccount->id) ->whereBetween('transaction_date', [$start_date, $end_date])->get();

     

    
        $netBalance = 0;
        foreach ($bankBooks as $book) {
            if ($book->transaction_type == 'Withdraw') {
                $netBalance -= $book->amount;
            } else {
                $netBalance += $book->amount;
            }
            $book->net_balance = $netBalance;
        }
        return view('bank_book.bank_account.statement', compact('bankAccount', 'bankBooks'));
    }
}