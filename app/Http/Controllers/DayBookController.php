<?php

namespace App\Http\Controllers;

use App\Models\DayBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayBookController extends Controller
{
    public function accountStatement(){
        $date = request()->query('date');
       
        if (empty($date)) {
            $date = now()->toDateString(); 
        }

        $daybooks = DayBook::whereDate('date',$date)
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