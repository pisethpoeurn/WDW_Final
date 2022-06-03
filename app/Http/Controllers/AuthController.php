<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Product;
use Hash;


class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $products = Product::all();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember') ? true : false;
        // config/session.php set 'expire_on_close' => true,
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            return view('admin/index')->with(compact('user', 'products'))->withSuccess('You have Successfully loggedin');
        }
        return redirect("login")->withErrors('You have entered invalid credentials!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function postRegistration(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|confirmed|min:6',
    //         'password_confirmation' => 'required|min:6',
    //         'phone' => 'required',
    //         'address' => 'required',
    //     ]);

    //     // $data = $request->all();
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->passowrd = $request->passowrd;
    //     $user->phone = $request->phone;
    //     $user->address = $request->address;
    //     $user->user_type = 'normal';
    //     $user->save();
    //     dd($user);
    //     if($request->fails()){
    //         return redirect('/register');
    //     }else{
    //     return redirect("/")->withSuccess('You have successfully registered!');
    //     }

    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('auth.profile')->with('user',$user);
        }
        return redirect("login")->withErrors('You do not have access!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect('/')->withSuccess('You have successfully loged out!');
    }
}
