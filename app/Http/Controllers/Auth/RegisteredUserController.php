<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\SmsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'region' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:customer,worker'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $otp = rand(1000, 9999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'region' => $request->region,
            'district' => $request->district,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'otp_code' => $otp,
        ]);

        event(new Registered($user));

        Auth::login($user);
        
        // Send OTP via SMS
        try {
            $smsService = new SmsService();
            $message = "Your KaziLink verification code is: $otp";
            $smsService->sendSms($user->phone, $message);
            
            session()->flash('success', "A 4-digit verification code has been sent to your phone number ($user->phone).");
        } catch (\Exception $e) {
            // Log error or fallback
            session()->flash('success', "Welcome! (Simulation) Your code is: $otp");
        }

        return redirect(route('verification.notice'));
    }
}
