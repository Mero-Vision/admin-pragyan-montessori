<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }

    public function users()
    {
        $users = User::withTrashed()->latest()->get();
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
}