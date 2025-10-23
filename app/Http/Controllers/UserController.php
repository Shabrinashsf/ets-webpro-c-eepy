<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('login');
    }

    public function signup(){
        return view('register');
    }

    public function logincheck(Request $request){
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credential)){
            $user = Auth::user();

            if($user->role=='admin'){
                return redirect()->route('admin')->with('success', 'Welcome back, ' . $user->name . '!');
            } else if($user->role=='user'){
                return redirect()->route('home')->with('success', 'Welcome back, ' . $user->name . '!');
            }
        }
        
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ]);
    }

    public function registercheck(Request $request){
        $validation = $request->validate([
            'name'=>'required',
            'telp_number'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $user = User::Create($validation);
        Auth::login($user);

        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::user(); 
        return view('dashboard-user', [
            'active' => 'profile',
            'user' => $user
        ]);
    }

    public function adminDashboard()
    {
        $user = Auth::user(); 
        return view('dashboard-admin', [
            'active' => 'users', 
            'user' => $user
        ]);
    }

    public function manageRooms()
    {
        $user = Auth::user(); 
        return view('dashboard-admin', [
            'active' => 'rooms', 
            'user' => $user
        ]);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telp_number' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'telp_number' => $request->telp_number,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
