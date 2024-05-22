<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthlyFeesParticularCreateRequest;
use App\Models\MonthlyFeePayment;
use App\Models\MonthlyFeesParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonthlyFeesParticularController extends Controller
{
    public function index()
    {

        $monthlyFeesParticulars = MonthlyFeesParticular::get();
        return view('accounts.monthly_fees.monthly_fees_particular.monthly_fees_particular', compact('monthlyFeesParticulars'));
    }

    public function edit($id)
    {

        $monthlyFeesParticulars = MonthlyFeesParticular::find($id);
        return view('accounts.monthly_fees.monthly_fees_particular.edit_monthly_fees_particular', compact('monthlyFeesParticulars'));
    }

    public function update(MonthlyFeesParticularCreateRequest $request, $id)
    {

        $MonthlyFeesParticulars = MonthlyFeesParticular::find($id);
        if (!$MonthlyFeesParticulars) {
            return back()->with('error', 'Admission Particular ID Not Found!');
        }

        $existingOrderNumber = MonthlyFeesParticular::where('order_number', $request->order_number)->where('id',$id)->first();
        if ($existingOrderNumber) {
            $existingOrderNumber->update([
                'order_number' => null
            ]);
        }
        try {
            $MonthlyFeesParticulars = DB::transaction(function () use ($MonthlyFeesParticulars, $request) {
                $MonthlyFeesParticulars->update([
                    'particulars' => $request->particular_name,
                    'amount' => $request->amount,
                    'user' => auth()->user()->name,
                    'order_number' => $request->order_number
                ]);
                return $MonthlyFeesParticulars;
            });
            if ($MonthlyFeesParticulars) {
                return redirect('admin/accounts/monthly-fees-particulars')->with('success', 'Particular Data Updated Successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage(), 500);
        }
    }

    public function store(MonthlyFeesParticularCreateRequest $request)
    {

        $existingOrderNumber = MonthlyFeesParticular::where('order_number', $request->order_number)->first();
        if ($existingOrderNumber) {
            $existingOrderNumber->update([
                'order_number' => null
            ]);
        }

        try {

            $MonthlyFeesParticulars = DB::transaction(function () use ($request) {
                $MonthlyFeesParticulars = MonthlyFeesParticular::create([
                    'particulars' => $request->particular_name,
                    'amount' => $request->amount,
                    'user' => auth()->user()->name,
                    'order_number' => $request->order_number
                ]);
                return $MonthlyFeesParticulars;
            });
            if ($MonthlyFeesParticulars) {
                return back()->with('success', 'Monthly Fees Invoice Particular created successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $MonthlyFeesParticulars = MonthlyFeesParticular::find($id);

        try {

            $MonthlyFeesParticulars = DB::transaction(function () use ($MonthlyFeesParticulars) {

                $MonthlyFeesParticulars->delete();

                return $MonthlyFeesParticulars;
            });
            if ($MonthlyFeesParticulars) {
                return back()->with('success', 'Admission particular data deleted successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}