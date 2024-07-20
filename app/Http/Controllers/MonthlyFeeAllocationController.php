<?php

namespace App\Http\Controllers;

use App\Models\DayBook;
use App\Models\MonthlyFeePayment;
use App\Models\MonthlyFeePaymentDetail;
use App\Models\MonthlyFeesParticular;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentDueAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pratiksh\Nepalidate\Facades\NepaliDate;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class MonthlyFeeAllocationController extends Controller
{
    protected $students;

    public function __construct(Student $students)
    {
        $this->students = $students;
    }
    public function index()
    {

        $students = $this->students->join('school_classes', 'school_classes.id', '=', 'students.class_id')
            ->select('students.*', 'school_classes.class_name')->where('students.payment_status', 'paid')->get();


        $studentsWithPendingPayments = [];

        foreach ($students as $student) {
            $hasPendingPayment = MonthlyFeePayment::where('student_id', $student->id)
                ->where('payment_status', 'pending')
                ->exists();

            if ($hasPendingPayment) {
                $studentsWithPendingPayments[] = $student;
            }
        }

        $classes = SchoolClass::latest()->get();
        $monthlyParticulars = MonthlyFeesParticular::orderBy('order_number')->get();

        return view('accounts.monthly_fee_allocation.monthly_fee_allocation', compact('students', 'classes', 'monthlyParticulars', 'studentsWithPendingPayments'));
    }

    public function selectPaymentMonth($id)
    {
        $student = Student::find($id);

        $monthlyFeesPayment = MonthlyFeePayment::where('student_id', $id)->where('payment_status', 'pending')->get();

        return view('accounts.monthly_fee_allocation.select_payment_month', compact('monthlyFeesPayment'));
    }

    public function assignMonthlyFees($id)
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

        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        $paymentMonths = MonthlyFeePayment::where('student_id', $student->id)
            ->where('session_year', $bsYear)->pluck('month')->where('payment_status', '!=', 'pending')->toArray();

        $studentDueAmount = StudentDueAmount::find($id);

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


        return view('accounts.monthly_fee_allocation.assign_monthly_fees', compact(
            'class',
            'student',
            'englishDate',
            'monthlyParticulars',
            'paymentOptions',
            'monthlyPaymentHistories',
            'paymentMonths',
            'nepaliMonthMap',
            'studentDueAmount'
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
            // 'payment_option_id' => ['required'],
            // 'monthly_fees' => ['required', 'numeric'],
            'particulars.*' => 'required|array',
            'particulars.*.particular_name' => 'nullable|string',
            'particulars.*.particular_amount' => 'nullable|numeric',
        ]);

        $date = Carbon::today();
        $currentNepaliDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();
        // dd($currentNepaliDate);

        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        // $student=Student::find($request->student_id);


        try {
            $monthlyPayment = DB::transaction(function () use ($request, $nepaliMonth, $currentNepaliDate, $validatedData, $bsYear) {

                $monthlyPayment = MonthlyFeePayment::create([
                    'session_year' => $bsYear,
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
                    'payment_option_id' => $request->payment_option_id,
                    'note' => $request->note,
                    'sub_total' => $request->sub_total,
                    'discount_amount' => $request->discount_amount,
                    'paid_amount' => $request->paid_amount,
                    'return_amount' => $request->return_amount,
                    'net_total' => $request->net_total,
                    'due_amount' => $request->due_amount,
                    'month' => $nepaliMonth,
                    'year' => Carbon::now()->year,
                    'nepali_payment_date' => $currentNepaliDate,
                    'payment_date' => Carbon::today(),
                    'late_fine_amount' => $request->fine_amount,
                    'payment_status' => "pending"
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

            sweetalert()->addSuccess('Monthly Fee Assigned Successfully!');
            return redirect('admin/accounts/monthly-fee-allocation');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function payAssignmentMonthlyFees(Request $request)
    {
        $monthlyFeesPayment = MonthlyFeePayment::where('id', $request->fee_payment_id)->where('payment_status', 'pending')->first();
        $student = Student::find($monthlyFeesPayment->student_id);
        if (!$student) {
            return back()->with('error', 'Student Detail Not Found!');
        }
        $class = SchoolClass::find($student->class_id);
        $date = Carbon::today();
        $englishDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $monthlyParticulars = MonthlyFeesParticular::orderBy('order_number')->where('class_id', $student->class_id)->get();

        $paymentOptions = PaymentOption::get();


        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        $paymentMonths = MonthlyFeePayment::where('student_id', $student->id)
            ->where('session_year', $bsYear)->pluck('month')->toArray();

        $studentDueAmount = StudentDueAmount::where('student_id', $monthlyFeesPayment->student_id)->first();


        $monthlyFeesPaymentDetails = MonthlyFeePaymentDetail::where('monthly_fee_payment_id', $monthlyFeesPayment->id)->get();



        return view('accounts.monthly_fee_allocation.pay_assign_monthly_fees', compact(
            'class',
            'student',
            'englishDate',
            'monthlyParticulars',
            'paymentOptions',
            'paymentMonths',
            'studentDueAmount',
            'monthlyFeesPayment',
            'monthlyFeesPaymentDetails'
        ));
    }


    public function payMonthlyAssignFees(Request $request, $id)
    {


        $existingPayment = MonthlyFeePayment::where('id', $id)
            ->where('month', $request->nepali_month)
            ->where('payment_status', 'paid')
            ->exists();

        if ($existingPayment) {
            return back()->with('error', 'Payment for this month has already been completed.');
        }

        $validatedData = $request->validate([
            'payment_option_id' => ['required'],
            'paid_amount' => ['required', 'numeric'],
            'particulars.*' => 'required|array',
            'particulars.*.particular_name' => 'nullable|string',
            'particulars.*.particular_amount' => 'nullable|numeric',
        ]);


        $date = Carbon::today();
        $currentNepaliDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();
        // dd($currentNepaliDate);

        $currentYear = Carbon::today();
        $bsDate = NepaliCalendar::AD2BS($currentYear);
        $bsYear = explode('-', $bsDate)[0];

        $monthlyFeesPayment = MonthlyFeePayment::where('id', $id)->where('payment_status', 'pending')->first();

        $monthlyFeesPaymentDetails = MonthlyFeePaymentDetail::where('monthly_fee_payment_id', $monthlyFeesPayment->id)->get();

        try {
            DB::transaction(function () use ($request, $currentNepaliDate, $validatedData, $bsYear, $monthlyFeesPayment, $monthlyFeesPaymentDetails) {

                $monthlyFeesPayment->update([
                    'session_year' => $bsYear,
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
                    'month' => $request->nepali_month,
                    'year' => Carbon::now()->year,
                    'nepali_payment_date' => $currentNepaliDate,
                    'payment_date' => Carbon::today(),
                    'late_fine_amount' => $request->fine_amount,
                    'payment_status' => "paid"
                ]);

                if ($request->paid_amount < $request->net_total) {

                    $existingDueAmount = StudentDueAmount::where('student_id', $request->student_id)->value('due_amount');
                    $newDueAmount = $existingDueAmount + ($request->net_total - $request->paid_amount);
                    StudentDueAmount::updateOrCreate(
                        ['student_id' => $request->student_id],
                        ['due_amount' => $newDueAmount]
                    );
                }

                $student = Student::find($request->student_id);

                Daybook::create([
                    'user_id' => auth()->user()->id,
                    'date' => Carbon::today(),
                    'particular' => $student->name . ' Monthly Fee',
                    'expense' => null,
                    'income' => $request->paid_amount,
                ]);

                foreach ($validatedData['particulars'] as $particularsData) {
                    $monthlyFeesPaymentDetail = MonthlyFeePaymentDetail::where('monthly_fee_payment_id', $monthlyFeesPayment->id)
                        ->where('particulars', $particularsData['particular_name'])
                        ->first();
                    if ($monthlyFeesPaymentDetail) {
                        $monthlyFeesPaymentDetail->amount = $particularsData['particular_amount'];
                    } else {
                        $monthlyFeesPaymentDetail = new MonthlyFeePaymentDetail();
                        $monthlyFeesPaymentDetail->monthly_fee_payment_id = $monthlyFeesPayment->id;
                        $monthlyFeesPaymentDetail->particulars = $particularsData['particular_name'];
                        $monthlyFeesPaymentDetail->amount = $particularsData['particular_amount'];
                    }
                    $monthlyFeesPaymentDetail->save();
                }
            });
            sweetalert()->addSuccess('Monthly Fee Paid Successfully!');
            return redirect('admin/accounts/monthly-fee-allocation');
            // return redirect('admin/accounts/monthly-fee-allocation')->with('success', 'Monthly Fee Paid Successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}