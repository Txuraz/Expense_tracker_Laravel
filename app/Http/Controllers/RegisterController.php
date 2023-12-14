<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Mail\VerifyEmailMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


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

        $user = User::create($data);

        $token  = Str::random(32);

        $user->verificationToken()->create([
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new VerifyEmailMail($user, $token));
       return redirect()->back()->with('message', 'Successfully Registered');
    }


}
