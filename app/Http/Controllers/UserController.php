<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(){
        return view('user.profile');
    }

    public function users(){
        $users=User::latest()->get();
        $roles=UserRole::get();
        return view('user.users',compact('users','roles'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if($id==auth()->user()->id){
            return back()->with('error','You cannot disable your own account!');
        }

        try {

            $user = DB::transaction(function () use ($user) {

                $user->delete();

                return $user;
            });
            if ($user) {
                return back()->with('success', 'User data deleted successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}