<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
class AdminLoginController extends Controller
{

    public function __construct(){
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }


    public function showLoginForm()
    {
      return view('auth.admin-login');
    }


    public function login(Request  $request){
    // validate the form data
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required|min:6',
     ]);
 //$credentials = $request->only('email', 'password');
      //Attempt to log the user in
      //$credentials=[
        //'email' => $request->email,
        //'/password' => $request->password,
     // ];
 if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
 // if successful, then redirect to their intended location
 return redirect()->intended(route('admin.dashboard'));
 }
     // if(Auth::guard('admin')->attempt($credentials))
      //{
        //if successful, then redirect('to intended location');
        //return redirect()->intended(route('admin.dashboard'));
     // }
else{
      //if unsuccessful, then redirect('to the login with the form data');
      return redirect()->back()->withInput($request->only('email','remember'));

}

    }     
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

    
}


