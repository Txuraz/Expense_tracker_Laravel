<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function registerUser(RegisterFormRequest $request){
        $data  = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        User::create($data);
        return redirect()->back()->with('message', 'Successfully Registered');
    }


}
