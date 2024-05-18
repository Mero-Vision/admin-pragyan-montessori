<?php

namespace App\Http\Controllers;

use App\Models\PaymentOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentOptionController extends Controller
{
    public function index(){
        $paymentOptions=PaymentOption::latest()->get();
        return view('accounts.settings.payment_options',compact('paymentOptions'));
    }

    public function destroy($slug)
    {
        $paymentOptions = PaymentOption::where('slug',$slug)->first();

        try {

            $paymentOptions = DB::transaction(function () use ($paymentOptions) {

                $paymentOptions->delete();

                return $paymentOptions;
            });
            if ($paymentOptions) {
                return back()->with('success', 'Payment option deleted successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}