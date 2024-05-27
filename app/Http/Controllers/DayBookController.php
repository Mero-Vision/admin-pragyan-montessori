<?php

namespace App\Http\Controllers;

use App\Models\DayBook;
use Illuminate\Http\Request;

class DayBookController extends Controller
{
    public function accountStatement(){
        $from = request()->query('start_date');
        $to = request()->query('end_date');

       
        if (empty($from)) {
            $from = now()->toDateString(); 
        }

        if (empty($to)) {
            $to = now()->toDateString(); 
        }

        $daybooks = DayBook::whereBetween('date', [$from, $to])
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
}