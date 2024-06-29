<?php

namespace App\Http\Controllers;

use App\Models\ActivityModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect('admin/dashboard');
        } else {
            return view('login'); 
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']

        ]);

        $credential = $request->only('email', 'password');
        try {
            if (Auth::attempt($credential)) {
                $user = Auth::user();
                Session::put('user_id', $user->id);
                if (in_array($user->role, ['admin', 'principal'])) {
                    ActivityModel::create([
                        'deviceModel' => $request->input('deviceModel'),
                        'osInfo' => $request->input('osInfo'),
                        'location' => $request->input('location'),
                        'date' => $request->input('date'),
                        'user' => Auth()->user()->name,
                        'user_id' => Auth()->user()->id,

                    ]);

                    $data = [
                        'model' => $request['deviceModel'],
                        'osinfo' => $request['osInfo'],
                        'location' => $request['location'],
                        'date' => $request['date'],
                        'name' => Auth()->user()->name,
                    ];
                    $email = Auth()->user()->email;

                    Mail::send('mail/loginalert', $data, function ($message) use ($email, $data) {
                        $message->to($email);
                        $message->subject("Login Alert");
                    });

                    sweetalert()->addSuccess('Welcome ' . $user->name);
                    return redirect('admin/dashboard');
                } else {
                    sweetalert()->addWarning('Invalid email or password.');

                    return back();
                }
            } else {
                sweetalert()->addWarning('Invalid email or password.');

                return back();
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            auth()->logout();

            sweetalert()->addSuccess('Logout Successfully!');
            return redirect('/');
        } else {
            sweetalert()->addWarning('User is not authenticated!');
            return redirect('/');
        }
    }
}