<?php

namespace App\Http\Controllers;

use App\Mail\UserVerificationMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function users()
    {
        $users = User::withTrashed()->where('role','admin')->latest()->get();
        $roles = UserRole::get();
        return view('user.users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = UserRole::get();
        return view('user.add_user', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required']
        ]);

        try {

            $user = DB::transaction(function () use ($request) {

                $user = User::create([
                    'name' => $request->name,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'password' => Hash::make('4546567'),
                    'address' => $request->address,
                    'mobile_no' => $request->mobile_no,
                    'role' => $request->role,
                ]);

                $token = Str::random(60);

                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                Mail::to($request->email)->send(new UserVerificationMail($user, $token));


                return $user;
            });
            if ($user) {
                return back()->with('success', 'User verification email send successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }



    public function resentVerificationMail($id)
    {

        $user=User::find($id);
       
        try {

            $user = DB::transaction(function () use ($user) {

               

                $token = Str::random(60);

                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => now(),
                ]);

                Mail::to($user->email)->send(new UserVerificationMail($user, $token));


                return $user;
            });
            if ($user) {
                return back()->with('success', 'User verification email send successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if ($id == auth()->user()->id) {
            return back()->with('error', 'You cannot disable your own account!');
        }

        try {

            $user = DB::transaction(function () use ($user) {

                $user->delete();

                return $user;
            });
            if ($user) {
                return back()->with('success', 'User status updated successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function restore($id)
    {
        $user =
            User::withTrashed()->findOrFail($id);

        try {

            $user = DB::transaction(function () use ($user) {

                $user->restore();

                return $user;
            });
            if ($user) {
                return back()->with('success', 'User status updated successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function setPasswordIndex()
    {
        return view('complete_registration');
    }


    public function setNewUserPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string','max:100'],

        ]);
        $token = $request->token;

        if (!$token) {
            sweetalert()->addWarning('Invalid Token!');
        }

        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            sweetalert()->addWarning('Token Not Found!');
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            sweetalert()->addWarning('User Not Found!');
        }

        try {
            DB::transaction(function () use ($user, $request, $token) {
                $user->password = Hash::make($request->input('password'));
                $user->email_verified_at = now();
                $user->save();
                PasswordReset::where('token', $token)->delete();
            });
            sweetalert()->addSuccess('Password Set Successfully!');
            return redirect('/');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}