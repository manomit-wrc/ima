<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct() {

    }
    public function index() {
      if(Auth::guard('admin')->check()) {

            return redirect('/admin/dashboard');
        }

        return view('admin.login');
    }
    public function checkLogin(Request $request) {
    	$this->validate($request,[
    			'email' => 'required|email',
    			'password' => 'required'
    		],[
    			'email.required' => 'Please Enter Email ID',
    			'email.email' => 'Please Enter Valid Email ID',
    			'password.required' => 'Please Enter Password'
    		]);

    	if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
            //echo "hiiiii"; die;
    		return redirect('/admin/dashboard');
            //return view('admin.dashboard');
    	}
    	else {
    		$request->session()->flash("login-status", "Email ID Or Password Didn't Matched");
            //echo "hello"; die;
    		return view('admin.login');
    	}

    }
    //Admin Logout
      public function logout() {
      Auth::guard('admin')->logout();
      return redirect('/admin');

    }

}
