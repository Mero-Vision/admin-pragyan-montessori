<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmissionParticularCreateRequest;
use App\Models\AdmissionParticular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionParticularController extends Controller
{
    public function index(){

        $admissionParticulars=AdmissionParticular::get();
        return view('accounts.admission.admission_particular.admission_particular',compact('admissionParticulars'));
    }

    public function store(AdmissionParticularCreateRequest $request)
    {

        try {

            $admissionParticulars = DB::transaction(function () use ($request) {
                $admissionParticulars = AdmissionParticular::create([
                    'particulars' => $request->particular_name,
                    'amount' => $request->amount,
                    'user' => auth()->user()->name,
                    'order_number'=>$request->order_number
                ]);
                return $admissionParticulars;
            });
            if ($admissionParticulars) {
                return back()->with('success', 'Particular created successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $admissionParticulars = AdmissionParticular::find($id);

        try {

            $admissionParticulars = DB::transaction(function () use ($admissionParticulars) {

                $admissionParticulars->delete();
              
                return $admissionParticulars;
            });
            if ($admissionParticulars) {
                return back()->with('success', 'Admission particular data deleted successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}