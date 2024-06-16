<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AdmissionInquiryController;
use App\Http\Controllers\AdmissionInvoiceController;
use App\Http\Controllers\AdmissionParticularController;
use App\Http\Controllers\AdmissionPaymentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankBookController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassTimeController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\CmsTeacherController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DayBookController;
use App\Http\Controllers\LatePaymentFineController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonthlyFeesParticularController;
use App\Http\Controllers\MonthlyFeesPaymentController;
use App\Http\Controllers\PaymentOptionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserController;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('/complete_registration', [UserController::class, 'setPasswordIndex']);
Route::post('/complete_registration', [UserController::class, 'setNewUserPassword']);

Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::get('users', [UserController::class, 'users']);
    Route::get('users/delete/{id}', [UserController::class, 'destroy']);
    Route::get('users/restore/{id}', [UserController::class, 'restore']);
    Route::get('users/create-account', [UserController::class, 'create']);
    Route::post('users/create-account', [UserController::class, 'store']);
    Route::get('users/resend-verification/{id}', [UserController::class, 'resentVerificationMail']);

    Route::get('cms/contact-us', [ContactUsController::class, 'index']);
    Route::get('cms/admission-inquiry', [AdmissionInquiryController::class, 'index']);
    Route::get('cms/admission-inquiry/data', [AdmissionInquiryController::class, 'admissionInquiryData']);
    Route::get('cms/announcements', [AnnouncementController::class, 'index']);
    Route::get('cms/announcements/data', [AnnouncementController::class, 'announcementData']);
    Route::get('cms/announcements/create', [AnnouncementController::class, 'create']);
    Route::post('cms/announcements/create', [AnnouncementController::class, 'store']);
    Route::get('cms/announcements/delete/{id}', [AnnouncementController::class, 'destroy']);
    Route::get('cms/announcements/show/{id}', [AnnouncementController::class, 'show']);
    Route::get('cms/teachers', [CmsTeacherController::class, 'index']);
    Route::get('cms/teachers/add', [CmsTeacherController::class, 'create']);
    Route::post('cms/teachers/add', [CmsTeacherController::class, 'store']);
    Route::get('cms/teachers/delete/{id}', [CmsTeacherController::class, 'destroy']);
    Route::get('cms/blogs', [BlogController::class, 'index']);
    Route::get('cms/blogs/create', [BlogController::class, 'create']);
    Route::post('cms/blogs/create', [BlogController::class, 'store']);
    Route::get('cms/blogs/delete/{id}', [BlogController::class, 'destroy']);

    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('teachers/view/{id}', [TeacherController::class, 'show']);
    Route::get('teachers/add', [TeacherController::class, 'create']);
    Route::get('teachers/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('teachers/edit/{id}', [TeacherController::class, 'update']);
    Route::post('teachers/add', [TeacherController::class, 'store']);
    Route::get('teachers/data', [TeacherController::class, 'teacherData']);

    Route::get('school-classes', [ClassController::class, 'index']);
    Route::get('school-classes/data/{id}', [ClassController::class, 'getClassData']);
    Route::get('school-classes/data', [ClassController::class, 'classData']);
    Route::get('school-classes/add', [ClassController::class, 'create']);
    Route::get('school-classes/delete/{id}', [ClassController::class, 'destroy']);
    Route::get('school-classes/students/{class_id}', [ClassController::class, 'getClassStudentData']);
    Route::get('school-classes/class-time', [ClassTimeController::class, 'index']);
    Route::post('school-classes/class-time', [ClassTimeController::class, 'store']);
    Route::get('school-classes/class-time/data', [ClassTimeController::class, 'classTimeData']);
    Route::get('school-classes/class-time/create', [ClassTimeController::class, 'create']);
    Route::get('school-classes/class-time-table/create', [ClassTimeTableController::class, 'index']);
    Route::post('school-classes/class-time-table/create', [ClassTimeTableController::class, 'store']);
    Route::get('school-classes/class-time-table/view/{id}', [ClassTimeTableController::class, 'show']);


    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/add', [AdmissionController::class, 'index']);
    // Route::post('students/add', [StudentController::class, 'store']);
    Route::get('students/view/{id}', [StudentController::class, 'show']);
    Route::get('students/data', [StudentController::class, 'studentData']);

    Route::get('settings/general-settings', [SettingController::class, 'general_setting']);
    Route::get('settings/social-links-settings', [SettingController::class, 'social_link_setting']);
    Route::post('settings/site-settings', [SiteSettingController::class, 'store']);

    Route::get('accounts/admission', [AdmissionController::class, 'listAdmission']);
    Route::get('accounts/admission/create',[AdmissionController::class,'index']);
    Route::post('accounts/admission/create', [AdmissionController::class, 'store']);
    Route::get('accounts/admission/admission-invoice/create/{id}', [AdmissionInvoiceController::class, 'index']);

    Route::post('accounts/admission/admission-payment', [AdmissionPaymentController::class, 'store']);
    Route::get('accounts/admission/print-invoice/{id}', [AdmissionInvoiceController::class, 'printAdmissionInvoice']);

    Route::get('accounts/admission/admission-particulars', [AdmissionParticularController::class, 'index']);
    Route::post('accounts/admission/admission-particulars', [AdmissionParticularController::class, 'store']);
    Route::get('accounts/admission/admission-particulars/edit/{id}', [AdmissionParticularController::class, 'edit']);
    Route::post('accounts/admission/admission-particulars/update/{id}', [AdmissionParticularController::class, 'update']);
    Route::get('accounts/admission/admission-particulars/delete/{id}', [AdmissionParticularController::class, 'destroy']);


    Route::get('accounts/settings/payment-options', [PaymentOptionController::class, 'index']);
    Route::get('accounts/settings/payment-options/delete/{slug}', [PaymentOptionController::class, 'destroy']);
    Route::get('accounts/settings/late-payment-fine', [LatePaymentFineController::class, 'index']);
    Route::get('accounts/settings/late-payment-fine/data', [LatePaymentFineController::class, 'latePaymentFineData']);
    Route::get('accounts/settings/late-payment-fine/edit/{id}', [LatePaymentFineController::class, 'getLatePaymentFineById']);
    Route::post('accounts/settings/late-payment-fine/update', [LatePaymentFineController::class, 'update']);


    Route::get('accounts/monthly-fees-particulars', [MonthlyFeesParticularController::class, 'index']);
    Route::post('accounts/monthly-fees-particulars', [MonthlyFeesParticularController::class, 'store']);
    Route::get('accounts/monthly-fees-particulars/edit/{id}', [MonthlyFeesParticularController::class, 'edit']);
    Route::post('accounts/monthly-fees-particulars/update/{id}', [MonthlyFeesParticularController::class, 'update']);
    Route::get('accounts/monthly-fees-particulars/delete/{id}', [MonthlyFeesParticularController::class, 'destroy']);
    
    Route::get('accounts/student-monthly-fees-payments', [MonthlyFeesPaymentController::class, 'index']);
    Route::post('accounts/student-monthly-fees-payments', [MonthlyFeesPaymentController::class, 'store']);
    Route::get('accounts/student-monthly-fees-payments/{id}', [MonthlyFeesPaymentController::class, 'studentMonthlyFeesPaymentIndex']);
    Route::get('accounts/student-monthly-fees-payments/print/{slug}', [MonthlyFeesPaymentController::class, 'printMonthlyFeesPayment']);


    Route::get('tools/calendar', [ToolsController::class, 'calendarIndex']);
    Route::get('tools/nepali-date-converter', [ToolsController::class, 'nepaliDateConverter']);

    Route::get('day-book/account-statement', [DayBookController::class, 'accountStatement']);
    Route::get('day-book/add-income', [DayBookController::class, 'addIncomeIndex']);
    Route::post('day-book/add-income', [DayBookController::class, 'incomeStore']);
    Route::get('day-book/add-expense', [DayBookController::class, 'addExpenseIndex']);
    Route::post('day-book/add-expense', [DayBookController::class, 'expenseStore']);


    Route::get('reports', [ReportController::class, 'index']);
    Route::get('reports/sales-report/admission-payment', [SalesReportController::class, 'admissionPaymentReport']);


    Route::get('bank-book', [BankBookController::class, 'index']);
    Route::get('bank-book/create-bank-account', [BankAccountController::class, 'create']);
    Route::post('bank-book/create-bank-account', [BankAccountController::class, 'store']);
    Route::get('bank-book/{slug}/deposit', [BankAccountController::class, 'depositIndex']);
    Route::post('bank-book/{slug}/deposit', [BankAccountController::class, 'depositStore']);
    Route::get('bank-book/{slug}/withdraw', [BankAccountController::class, 'withdrawIndex']);
    Route::post('bank-book/{slug}/withdraw', [BankAccountController::class, 'withdrawStore']);
    Route::get('bank-book/{slug}/statements', [BankAccountController::class, 'statementIndex']);

    
    
});