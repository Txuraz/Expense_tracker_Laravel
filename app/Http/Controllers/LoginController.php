<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewEntryFormRequest;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {

            if(Auth::user()->user_type == 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            elseif(Auth::user()->user_type == 'regular')
            {
                if (Auth::user()->is_email_verified){
                    return redirect()->intended('/dashboard');
                }
                return redirect()->back()->with('message', 'Email is not verified');
            }

            return redirect()->back()->withErrors([
            'email' => 'Incorrect email or password'
        ]);
        }

        return redirect()->back()->withErrors([
            'email' => 'Incorrect email or password'
        ]);
    }

    public function logoutUser()
    {
        Auth::logout();

        return redirect('/login')->with('message', 'Successfully logged out');
    }
}
