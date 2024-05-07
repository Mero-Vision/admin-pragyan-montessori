<?php

use App\Http\Controllers\AdmissionInquiryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassTimeController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::group(['middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('profile', [UserController::class, 'profile']);

    Route::get('cms/contact-us', [ContactUsController::class, 'index']);
    Route::get('cms/admission-inquiry', [AdmissionInquiryController::class, 'index']);
    Route::get('cms/admission-inquiry/data', [AdmissionInquiryController::class, 'admissionInquiryData']);
    Route::get('cms/announcements', [AnnouncementController::class, 'index']);
    Route::get('cms/announcements/data', [AnnouncementController::class, 'announcementData']);
    Route::get('cms/announcements/create', [AnnouncementController::class, 'create']);
    Route::post('cms/announcements/create', [AnnouncementController::class, 'store']);
    Route::get('cms/announcements/delete/{id}', [AnnouncementController::class, 'destroy']);
    Route::get('cms/announcements/show/{id}', [AnnouncementController::class, 'show']);

    Route::get('teachers', [TeacherController::class, 'index']);
    Route::get('teachers/view/{id}', [TeacherController::class, 'show']);
    Route::get('teachers/add', [TeacherController::class, 'create']);
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
    Route::get('students/add', [StudentController::class, 'create']);
    Route::post('students/add', [StudentController::class, 'store']);
    Route::get('students/data', [StudentController::class, 'studentData']);

    Route::get('settings/general-settings', [SettingController::class, 'general_setting']);
    Route::get('settings/social-links-settings', [SettingController::class, 'social_link_setting']);
    Route::post('settings/site-settings', [SiteSettingController::class, 'store']);
});