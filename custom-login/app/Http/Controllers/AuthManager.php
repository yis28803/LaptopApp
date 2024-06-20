<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function register(){
        return view('register');
    }

    function loginPost(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials))
        {
            return redirect()->intended(route('home'));
        }
        else{
            return redirect(route('login'))->with("error","invalid email or password");
        }
    }

    function registerPost(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required'
        ]);

        $data['name']= $request ->name;
        $data['email']= $request->email;
        $data['password']=Hash::make($request->password);
        $user = User::create($data);    
        
        if(!$user){
            return redirect(route('regiser'))->with("error","invalid information, try again");
        }
        $emailService = new EmailService();
        $emailService->sendWelcomeMail($user);
        return redirect(route('login'))->with("success","Register success, Login to access the app");
    }
    

    

    function logout(Request $request){
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        Auth::logout(); 
        return redirect(route('login')); 
    }
    
}
