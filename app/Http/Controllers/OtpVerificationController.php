<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        try {
            Mail::raw("Your new KaziLink verification code is: $code", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('New Verification Code - KaziLink');
            });
            session()->flash('success', "A new 4-digit code has been sent to your email.");
        } catch (\Exception $e) {
            session()->flash('success', "New code sent! (Simulation: Your code is $code)");
        }

        return back();
    }
}
