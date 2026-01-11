<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    /**
     * Show the OTP verification form.
     */
    public function show()
    {
        return view('auth.verify-otp');
    }

    /**
     * Verify the OTP code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:4',
        ]);

        $user = Auth::user();

        if ($request->otp_code == $user->otp_code) {
            $user->phone_verified_at = now();
            $user->otp_code = null; // Clear OTP after successful verification
            $user->save();

            return redirect()->route('dashboard')->with('status', 'Phone number verified successfully!');
        }

        return back()->withErrors(['otp_code' => 'The provided code is incorrect.']);
    }

    /**
     * Resend the OTP code.
     */
    public function resend()
    {
        $user = Auth::user();
        $code = rand(1000, 9999);
        $user->otp_code = $code;
        $user->save();

        // In a real app, send SMS here.
        // For demo, we flash it.
        session()->flash('success', "New code sent! (Simulation: Your code is $code)");

        return back();
    }
}
