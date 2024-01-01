<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function showVerificationForm()
    {
        return view('verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Using Hash::check to compare the hashed OTP
        if (Hash::check($request->two_factor_code, $user->two_factor_code)) {
            $user->update(['otp_verified' => true]);

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }
}
