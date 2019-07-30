<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showAdminLoginForm(){
        return view('auth.adminLogin');
    }

    public function adminLogin(Request $request){

        $errors = new MessageBag; // initiate MessageBag
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],   $request->has('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }
        $errors = new MessageBag([
            'details' => ['Email and/or password entered are incorrect.']
        ]);
        return back()->withErrors($errors, 'login')->withInput(Input::except('password'));
    }

}