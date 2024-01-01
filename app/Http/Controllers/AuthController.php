<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail; 
use App\Mail\OtpMail;
use App\Models\Role;

class AuthController extends Controller
{

    public function register_view()
    {
        $roles = Role::all();
        return view('register', compact('roles'));
    }
    
    public function registered(Request $request)
    {

        $credentials = $request-> validate([

        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',

    
    ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $defaultRole = Role::where('name', 'user')->first();
        $user->roles()->attach($defaultRole);


        return redirect()->route('loginform')->with('success', 'User Registered successfully.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function user_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',        
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

          // Generate OTP
          $otp = rand(100000, 999999);

          // Store the hashed OTP in the user table
          $user->update(['two_factor_code' => Hash::make($otp)]);
            
         // Send OTP via email
         Mail::to($user->email)->send(new OtpMail($otp));
            
          // Redirect to OTP verification page
         return redirect('/verify')->with('success', 'Enter OPT to login');
            
        }

        return redirect('/login-form')->with('error', 'Invalid credentials. Please try again.');
    }


}
