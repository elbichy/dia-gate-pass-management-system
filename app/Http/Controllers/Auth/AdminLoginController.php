<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

class AdminLoginController extends Controller
{

    // MY CONSTRUCTOR
    public function __construct()
    {
        $this->middleware('guest:admin');
    }





    // SHOW ADMIN  FORM
    public function showAdminLoginForm(){
        return view('auth.adminLogin');
    }




    // PROCESS ADMIN 
    public function admin(Request $request){

        $errors = new MessageBag; // initiate MessageBag
        
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password],   $request->has('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }
        $errors = new MessageBag([
            'details' => ['These credentials do not match our records.']
        ]);
        return back()->withErrors($errors, 'login')->withInput(Input::except('password'));

        
    }

}