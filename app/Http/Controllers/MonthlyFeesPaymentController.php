<?php

namespace App\Http\Controllers;

use App\Models\AdmissionParticular;
use App\Models\MonthlyFeePayment;
use App\Models\MonthlyFeesParticular;
use App\Models\PaymentOption;
use App\Models\SchoolClass;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pratiksh\Nepalidate\Facades\NepaliDate;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class MonthlyFeesPaymentController extends Controller
{
    public function index(){

        
        $students = Student::join('school_classes', 'school_classes.id', '=', 'students.class_id')
        ->select('students.*', 'school_classes.class_name')->get();
        
        return view('accounts.monthly_fees.student_monthly_fees',compact('students'));
    }

    public function studentMonthlyFeesPaymentIndex($id){

        $student = Student::find($id);
        if (!$student) {
            return back()->with('error', 'Student Detail Not Found!');
        }
        $class = SchoolClass::find($student->class_id);
        $date = Carbon::today();
        $englishDate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedBSDate();

        $monthlyParticulars = MonthlyFeesParticular::orderBy('order_number')->where('class_id',$student->class_id)->get();

        $paymentOptions = PaymentOption::get();
        $monthlyPaymentHistories=MonthlyFeePayment::where('student_id',$student->id)->limit(5)->get();
        
        return view('accounts.monthly_fees.student_monthly_fees_payment', compact('class', 'student', 
        'englishDate', 'monthlyParticulars', 'paymentOptions',
            'monthlyPaymentHistories'));
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
            'Baishakh' => 1,
            'Jestha' => 2,
            'Ashadh' => 3,
            'Shrawan' => 4,
            'Bhadra' => 5,
            'Ashwin' => 6,
            'Kartik' => 7,
            'Mangsir' => 8,
            'Poush' => 9,
            'Magh' => 10,
            'Falgun' => 11,
            'Chaitra' => 12
        ];

        $nepaliMonth = $nepaliMonthMap[$request->nepali_month];

        // Check if the class already has the particular name for the current Nepali month
        $existingClass = MonthlyFeesParticular::where('class_id', $request->class)
            ->where('particulars', $request->particular_name)
            ->where('month', $nepaliMonth)
            ->exists();

        if ($existingClass) {
            return back()->with('error', 'This class already has this particular name for the current Nepali month.');
        }

        // Proceed to store the fees information
        $monthlyFee = new MonthlyFees();
        $monthlyFee->class_id = $request->class;
        $monthlyFee->particulars = $request->particular_name;
        $monthlyFee->amount = $request->amount;
        $monthlyFee->month = $currentNepaliMonth;
        $monthlyFee->save();

        return back()->with('success', 'Monthly fee added successfully.');
    }
}