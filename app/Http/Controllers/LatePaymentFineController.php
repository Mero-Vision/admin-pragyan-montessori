<?php

namespace App\Http\Controllers;

use App\Models\LatePaymentFine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LatePaymentFineController extends Controller
{
    public function index(){
       
        return view('accounts.settings.payment_fine_percentage');
    }

    public function latePaymentFineData()
    {
        $latePaymentFine = LatePaymentFine::get();

        return response()->json(['data'=> $latePaymentFine]);
    }

    public function getLatePaymentFineById($id)
    {
        $latePaymentFine = LatePaymentFine::find($id);

        return response()->json($latePaymentFine);
    }

    public function update(Request $request){

        $request->validate([
            'penalty_interest_rate'=>['required','numeric']
        ]);

        if ($request->penalty_interest_rate <= 0) {
            return back()->with('error', 'The Penalty Interest Rate must be greater than zero');
        }


        $lateFine=LatePaymentFine::find($request->id);
        if(!$lateFine){
            return back()->with('error','Late Payment Fine ID Not Found!');
        }
        try{
            $lateFine=DB::transaction(function()use($lateFine,$request){
                $lateFine->update([
                    'fine_percent'=>$request->penalty_interest_rate,
                    'user'=>auth()->user()->name
                ]);
                return $lateFine;
            });
            if($lateFine){
                return back()->with('success','Penalty Interest Rate Updated Successfully!');
            }
            
        }
        catch(\Exception $e){
            return back()->with('error',$e->getMessage());
        }
        
    }
}