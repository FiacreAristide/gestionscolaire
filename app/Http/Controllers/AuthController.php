<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()

    {
        //dd(Hash::make(123456));

        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
            return redirect('admin/dashboard');
            }

            else if(Auth::user()->user_type == 2)
            {
             return redirect('teacher/dashboard');               
            }

            else if(Auth::user()->user_type == 3)
            {
             return redirect('student/dashboard');               
            }

            else if(Auth::user()->user_type == 4)
            {
             return redirect('parent/dashboard');               
            }                              
        }
        return view('auth.login');
    }

    public function authlogin(Request $request)

    {

        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password], true))
        {

            if(Auth::user()->user_type == 1)
            {
            return redirect('admin/dashboard');
            }

            else if(Auth::user()->user_type == 2)
            {
             return redirect('teacher/dashboard');               
            }

            else if(Auth::user()->user_type == 3)
            {
             return redirect('student/dashboard');               
            }

            else if(Auth::user()->user_type == 4)
            {
             return redirect('parent/dashboard');               
            }                                
        }
        else
        {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }


    public function forgotpassword()
    {
       return view('auth.forgot'); 
    }

    public function postforgotpassword(Request $request)
    {
        $user= User::getEmailSingle($request->email);
    
    if(!empty($user))
    {
        $user->remember_token = Str::random(30);
        $user->save();

        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        return redirect()->back()->width('success',"Please check your email and check your password");
    }
    else
    {
        return redirect()->back()->with('error', 'Email introuvables');
    }
}


    public function reset($token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {

            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function postreset($token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(''))->with('success', "Mot de passe réinitialisé avec succès");
        }
        else
        {
            return redirect()->back()->width('success',"Les mots de passe ne sont pas identiques");
        }
    }
}
