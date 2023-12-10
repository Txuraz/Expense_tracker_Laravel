<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {

            if(Auth::user()->user_type == 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            elseif(Auth::user()->user_type == 'regular')
            {
                return redirect()->intended('/dashboard');
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
