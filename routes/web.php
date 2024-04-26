<?php

use App\Http\Controllers\AdmissionInquiryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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


    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('profile', [UserController::class, 'profile']);

    Route::get('cms/contact-us', [ContactUsController::class, 'index']);
    Route::get('cms/admission-inquiry', [AdmissionInquiryController::class, 'index']);
    Route::get('cms/admission-inquiry/data', [AdmissionInquiryController::class, 'admissionInquiryData']);
    Route::get('cms/announcements', [AnnouncementController::class, 'index']);
    Route::get('cms/announcements/data', [AnnouncementController::class, 'announcementData']);
    Route::get('cms/announcements/create', [AnnouncementController::class, 'create']);
    Route::post('cms/announcements/create', [AnnouncementController::class, 'store']);
});