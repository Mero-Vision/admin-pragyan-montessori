<?php

namespace App\Http\Controllers;

use App\Models\MonthlyFeePayment;
use App\Models\MonthlyFeesParticular;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            ->select('students.*', 'school_classes.class_name')->get();

        $classes = SchoolClass::latest()->get();

        $monthlyParticulars = MonthlyFeesParticular::orderBy('order_number')->get();

        return view('accounts.monthly_fee_allocation.monthly_fee_allocation', compact('students', 'classes', 'monthlyParticulars'));
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
            ->where('session_year', $bsYear)->pluck('month')->toArray();

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
            'nepaliMonthMap'
        ));
    }
}
