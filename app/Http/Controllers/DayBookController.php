<?php

namespace App\Http\Controllers;

use App\Models\DayBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayBookController extends Controller
{
    public function accountStatement(){
        $start_date = request()->query('start_date');
        $end_date = request()->query('end_date');
       
        if (empty($start_date)) {
            $start_date = now()->toDateString(); 
        }
        if (empty($end_date)) {
            $end_date = now()->toDateString();
        }

        $daybooks = DayBook::whereBetween('date',[$start_date,$end_date])
            ->orderBy('date')
            ->orderBy('id')
            ->get();

        $balance = 0;
        $daybooks = $daybooks->map(function ($entry) use (&$balance) {
            $balance += ($entry->income ?? 0) - ($entry->expense ?? 0);
            $entry->net_balance = $balance;
            return $entry;
        });
        
        return view('day_book.account_statement',compact('daybooks'));
    }

    public function addIncomeIndex()
    {

        return view('day_book.add_income');
    }

    public function incomeStore(Request $request)
    {

        $request->validate([
            'date' => ['required'],
            'description' => ['required', 'max:255'],
            'income_amount' => ['required', 'numeric']
        ]);
        try {
            $dayBook = DB::transaction(function () use ($request) {
                $dayBook = Daybook::create([
                    'user_id' => auth()->user()->id,
                    'date' => $request->date,
                    'particular' => $request->description,
                    'expense' => null,
                    'income' => $request->income_amount,
                ]);
                return $dayBook;
            });
            if ($dayBook) {
                return back()->with('success', 'Income Has Been Added Successfully To The Daybook');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    

    

    public function addExpenseIndex(){
        
        return view('day_book.add_expense');
    }

    public function expenseStore(Request $request){

        $request->validate([
            'date'=>['required'],
            'description'=>['required','max:255'],
            'expense_amount'=>['required','numeric']
        ]);
        try{
            $dayBook=DB::transaction(function()use($request){
                $dayBook=Daybook::create([
                    'user_id' => auth()->user()->id,
                    'date' => $request->date,
                    'particular' => $request->description,
                    'expense' => $request->expense_amount,
                    'income' => null,
                ]);
                return $dayBook;
            });
            if($dayBook){
                return back()->with('success','Expense Has Been Added Successfully To The Daybook');
            }
            
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage());
            
        }
    }
}