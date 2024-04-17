<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $contacts=ContactUs::latest()->paginate(8);
        return view('contact_us.view_contact_us',compact('contacts'));
    }
}