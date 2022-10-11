<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\MatchOldPassword;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function change(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        if($request->old_password == $request->password){
            return redirect()->back()->with('error', 'Please change from old password');
        }

        try{
            User::find(Auth::id())->update(['password'=> Hash::make($request->password), 'remember_token'=>null]);
            return redirect()->intended(RouteServiceProvider::HOME);
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
