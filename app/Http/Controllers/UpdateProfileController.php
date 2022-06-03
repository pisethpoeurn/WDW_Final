<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class UpdateProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editProfile(User $user)
    {
        $user = Auth::user();
        $orders = Order::all();
        return view('auth.editprofile')->with(compact('user', 'orders'));
    }

    public function updateProfile(User $user)
    {
        if (Auth::user()->email == request('email')) {
            $this->validate(request(), [
                'name' => 'required',
                //  'email' => 'required|email|unique:users',
            ]);
            $user->name = request('name');
            // $user->email = request('email');
            $user->save();
            return back()->withSuccess('Password change successfully.');
        } else {
            $this->validate(request(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                //'password' => 'required|min:6|confirmed'
            ]);

            $user->name = request('name');
            $user->email = request('email');
            //$user->password = bcrypt(request('password'));

            $user->save();
            return back()->withSuccess('Password change successfully.');
        }
    }
}
