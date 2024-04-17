<?php

use App\Http\Controllers\AdmissionInquiryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::get('admin/dashboard',[DashboardController::class,'index']);

Route::get('admin/cms/contact-us',[ContactUsController::class,'index']);
Route::get('admin/cms/admission-inquiry', [AdmissionInquiryController::class, 'index']);
Route::get('admin/cms/admission-inquiry/data', [AdmissionInquiryController::class, 'admissionInquiryData']);