<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use App\Models\AdmissionPaymentDetail;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionPaymentController extends Controller
{
    public function store(Request $request){

        $validatedData = $request->validate([
            'payment_option_id'=>['required'],
            'particulars.*' => 'required|array',
            'particulars.*.particular_name' => 'nullable|string',
            'particulars.*.particular_amount' => 'nullable|numeric',
        ]);

        $student=Student::find($request->student_id);
       
        
        try {

            $admissionPayment = DB::transaction(function () use ($request, $validatedData,$student) {
                $admissionPayment = AdmissionPayment::create([
                    'user' => auth()->user()->name,
                    'student_id'=>$request->student_id,
                    'class_id'=>$request->class_id,
                    'enrollment_date'=>Carbon::today(),
                    'billing_status'=>'paid',
                    'payment_option_id'=>$request->payment_option_id,
                    'note'=>$request->note,
                    'sub_total'=>$request->sub_total,
                    'discount_amount'=>$request->discount_amount,
                    'net_total'=>$request->net_total
                ]);

                foreach ($validatedData['particulars'] as $particularsData) {

                
                    $admissionPaymentDetail = new AdmissionPaymentDetail();
                    $admissionPaymentDetail->admission_payment_id = $admissionPayment->id;
                    $admissionPaymentDetail->particulars = $particularsData['particular_name'];
                    $admissionPaymentDetail->amount = $particularsData['particular_amount'];
                    $admissionPaymentDetail->save();
                }

                $student->update([
                    'payment_status' => 'paid'
                ]);

                return $admissionPayment;
            });
            if ($admissionPayment) {
                return redirect('admin/accounts/admission')->with('success', 'Admission payment done successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}