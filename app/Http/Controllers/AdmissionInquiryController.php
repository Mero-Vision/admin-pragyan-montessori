<?php

namespace App\Http\Controllers;

use App\Models\AdmissionInquiry;
use App\Models\StudentAdmissionInquiry;
use Illuminate\Http\Request;

class AdmissionInquiryController extends Controller
{
    public function index(){
        return view('admission_inquiry.admission_inquiry');
    }

    public function admissionInquiryData()
    {
        $admissionInquiry = StudentAdmissionInquiry::
            latest()
            ->get();

        return response()->json(['data' => $admissionInquiry]);
    }
}