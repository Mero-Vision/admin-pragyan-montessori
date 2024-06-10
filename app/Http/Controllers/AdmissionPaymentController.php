<?php

namespace App\Http\Controllers;

use App\Models\AdmissionPayment;
use App\Models\AdmissionPaymentDetail;
use App\Models\DayBook;
use App\Models\Student;
use App\Models\StudentDueAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pratiksh\Nepalidate\Facades\NepaliDate;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class AdmissionPaymentController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'payment_option_id' => ['required'],
            'particulars.*' => 'required|array',
            'particulars.*.particular_name' => 'nullable|string',
            'particulars.*.particular_amount' => 'nullable|numeric',
        ]);

        $student = Student::find($request->student_id);
        $currentNepaliDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();
        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];
        

        try {

            $admissionPayment = DB::transaction(function () use ($request, $validatedData, $student, $currentNepaliDate, $bsYear) {


                $admissionPayment = AdmissionPayment::create([
                    'session_year'=> $bsYear,
                    'user' => auth()->user()->name,
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
                    'enrollment_date' => Carbon::today(),
                    'billing_status' => 'paid',
                    'payment_option_id' => $request->payment_option_id,
                    'note' => $request->note,
                    'sub_total' => $request->sub_total,
                    'discount_amount' => $request->discount_amount,
                    'net_total' => $request->net_total,
                    'paid_amount' => $request->paid_amount,
                    'return_amount' => $request->return_amount,
                    'credit_amount' => $request->credit_amount,
                ]);

                if ($request->paid_amount < $request->net_total) {

                    $existingDueAmount = StudentDueAmount::where('student_id', $request->student_id)->value('due_amount');
                    $newDueAmount = $existingDueAmount + $request->credit_amount;
                    StudentDueAmount::updateOrCreate(
                        ['student_id' => $request->student_id],
                        ['due_amount' => $newDueAmount]
                    );
                }

                DayBook::create([
                    'user_id' => auth()->user()->id,
                    'date' => Carbon::today(),
                    'particular' => 'Admission Fee for ' . $currentNepaliDate . ' of Student ID ' . $request->student_id,
                    'expense' => null,
                    'income' => $request->paid_amount,
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