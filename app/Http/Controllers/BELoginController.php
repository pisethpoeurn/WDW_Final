<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Hash;


class BELoginController extends Controller
{
    public function index()
    {
        return view('admin.loginform');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false;
        // config/session.php set 'expire_on_close' => true,
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->user_type == 'admin') {
                return redirect()->intended('/admin')->withSuccess('You have Successfully loggedin');
            } else {
                return redirect()->intended('/normal')->withSuccess('You have Successfully loggedin');
            }
        }
        return redirect("be-login")->withErrors('You have entered invalid credentials!');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('/')->withSuccess('You have successfully loged out!');
    }

    // register
    public function registerform(){
        return view('normal.register');
    }
    public function register(Request $request) {
        $validate = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6',
                    'password_con' => 'required|same:password',
                    'phone' => 'required',
                    'address' => 'required',
                ]);
        
                // $data = $request->all();
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->phone = $request->phone;
                $user->address = $request->address;
                $user->user_type = 'normal';
                $user->save();
             
                return redirect("/")->withSuccess('You have successfully registered!');
                
        
    }
}
