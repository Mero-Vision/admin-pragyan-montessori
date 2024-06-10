<?php

namespace App\Http\Controllers;

use App\Models\AdmissionParticular;
use App\Models\DayBook;
use App\Models\MonthlyFeePayment;
use App\Models\MonthlyFeePaymentDetail;
use App\Models\MonthlyFeesParticular;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentCreditPayment;
use App\Models\StudentDueAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pratiksh\Nepalidate\Facades\NepaliDate;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class MonthlyFeesPaymentController extends Controller
{
    public function index()
    {


        $students = Student::join('school_classes', 'school_classes.id', '=', 'students.class_id')
            ->select('students.*', 'school_classes.class_name')->get();

        return view('accounts.monthly_fees.student_monthly_fees', compact('students'));
    }

    public function studentMonthlyFeesPaymentIndex($id)
    {

        $student = Student::find($id);
        if (!$student) {
            return back()->with('error', 'Student Detail Not Found!');
        }
        $class = SchoolClass::find($student->class_id);
        $date = Carbon::today();
        $englishDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $monthlyParticulars = MonthlyFeesParticular::orderBy('order_number')->where('class_id', $student->class_id)->get();

        $paymentOptions = PaymentOption::get();
        $monthlyPaymentHistories = MonthlyFeePayment::where('student_id', $student->id)->latest()->limit(4)->get();

        $paymentMonths = MonthlyFeePayment::where('student_id', $student->id)->pluck('month')->toArray();

        $nepaliMonthMap = [
            1 => 'Baishakh',
            2 => 'Jestha',
            3 => 'Ashadh',
            4 => 'Shrawan',
            5 => 'Bhadra',
            6 => 'Ashwin',
            7 => 'Kartik',
            8 => 'Mangsir',
            9 => 'Poush',
            10 => 'Magh',
            11 => 'Falgun',
            12 => 'Chaitra'
        ];
        // dd($paymentMonths);

        return view('accounts.monthly_fees.student_monthly_fees_payment', compact(
            'class',
            'student',
            'englishDate',
            'monthlyParticulars',
            'paymentOptions',
            'monthlyPaymentHistories',
            'paymentMonths',
            'nepaliMonthMap'
        ));
    }

    public function store(Request $request)
    {
        // Convert the current date to Nepali date
        // $date = NepaliCalendar::AD2BS(date('Y-m-d'), [
        //     'lang' => 'np',
        //     'return_type' => 'array'
        // ]);
        // $currentNepaliMonth = $date['MM'];

        $nepaliMonthMap = [
            1 => 'Baishakh',
            2 => 'Jestha',
            3 => 'Ashadh',
            4 => 'Shrawan',
            5 => 'Bhadra',
            6 => 'Ashwin',
            7 => 'Kartik',
            8 => 'Mangsir',
            9 => 'Poush',
            10 => 'Magh',
            11 => 'Falgun',
            12 => 'Chaitra'
        ];



        $nepaliMonth = $nepaliMonthMap[$request->nepali_month];



        $existingPayment = MonthlyFeePayment::where('student_id', $request->student_id)
            ->where('month', $nepaliMonth)
            ->exists();

        if ($existingPayment) {
            return back()->with('error', 'Payment for this month has already been completed.');
        }

        $validatedData = $request->validate([
            'payment_option_id' => ['required'],
            'monthly_fees' => ['required', 'numeric'],
            'paid_amount' => ['required', 'numeric'],
            'particulars.*' => 'required|array',
            'particulars.*.particular_name' => 'nullable|string',
            'particulars.*.particular_amount' => 'nullable|numeric',
        ]);


        $date = Carbon::today();
        $currentNepaliDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();
        // dd($currentNepaliDate);

        try {
            $monthlyPayment = DB::transaction(function () use ($request, $nepaliMonth, $currentNepaliDate, $validatedData) {

                $monthlyPayment = MonthlyFeePayment::create([
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
                    'payment_option_id' => $request->payment_option_id,
                    'note' => $request->note,
                    'sub_total' => $request->sub_total,
                    'discount_amount' => $request->discount_amount,
                    'paid_amount' => $request->paid_amount,
                    'return_amount' => $request->return_amount,
                    'net_total' => $request->net_total,
                    'credit_amount' => $request->credit_amount,
                    'month' => $nepaliMonth,
                    'year' => Carbon::now()->year,
                    'nepali_payment_date' => $currentNepaliDate,
                    'payment_date' => Carbon::today(),
                ]);

                if ($request->paid_amount < $request->net_total) {
                   
                    $existingDueAmount = StudentDueAmount::where('student_id', $request->student_id)->value('due_amount');
                    $newDueAmount = $existingDueAmount + ($request->net_total - $request->paid_amount);
                    StudentDueAmount::updateOrCreate(
                        ['student_id' => $request->student_id],
                        ['due_amount' => $newDueAmount]
                    );
                }

                
                Daybook::create([
                    'user_id' => auth()->user()->id,
                    'date' => Carbon::today(),
                    'particular' => 'Monthly Fee Submission for ' . $currentNepaliDate . ' of Student ID ' . $request->student_id,
                    'expense' => null, 
                    'income' => $request->paid_amount,
                ]);

                $monthlyPayment->monthlyFeePaymentDetail()->create([
                    'monthly_fee_payment_id' => $monthlyPayment->id,
                    'particulars' => "Monthly Fees",
                    'amount' => $request->monthly_fees,
                ]);

                foreach ($validatedData['particulars'] as $particularsData) {
                    $admissionPaymentDetail = new MonthlyFeePaymentDetail();
                    $admissionPaymentDetail->monthly_fee_payment_id = $monthlyPayment->id;
                    $admissionPaymentDetail->particulars = $particularsData['particular_name'];
                    $admissionPaymentDetail->amount = $particularsData['particular_amount'];
                    $admissionPaymentDetail->save();
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }



        return back()->with('success', 'Monthly fee paid successfully.');
    }
}