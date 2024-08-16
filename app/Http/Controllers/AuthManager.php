<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    //
    function login(){
        return view('login');
    }

    function registration(){
        return view('registration');
    }


    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')
                             ->withErrors(['email' => 'The email address does not exist.'])
                             ->withInput();
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('login')
                             ->withErrors(['password' => 'The password is incorrect.'])
                             ->withInput();
        }

        return redirect()->intended('success');
    }


    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'check' => 'nullable'
        ]);


        $data = $request->only(['name', 'email', 'check']);
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if(!$user){
            return redirect(route('registration'))->with('error', 'Registration credentials are not valid');
        }

        return redirect(route('success'))->with('success', 'registration was successful');

    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'))->with('success', 'you are now logged out');
    }
}
