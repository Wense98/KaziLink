<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscription plans.
     */
    public function index(): View
    {
        // Simply one plan as per user request: 5,000/= per month.
        $features = ['Verified Badge', 'Visible to Clients', 'Unlimited Job Requests'];
        
        $plans = [
            [
                'name' => 'Monthly Standard',
                'id' => 'monthly',
                'price' => 5000,
                'description' => 'Required to be visible to clients.',
                'features' => $features,
            ],
        ];

        $currentSubscription = Auth::user()->subscriptions()->where('status', 'active')->first();

        return view('subscriptions.index', compact('plans', 'currentSubscription'));
    }

    /**
     * Show the checkout page for a selected plan.
     */
    public function checkout(Request $request): View
    {
        $planId = $request->query('plan');
        $price = $planId === 'annual' ? 23000 : 2000;
        $planName = $planId === 'annual' ? 'Annual Plan' : 'Monthly Plan';

        return view('subscriptions.checkout', compact('planId', 'price', 'planName'));
    }

    /**
     * Process the subscription payment (Simplified).
     */
    /**
     * Process the subscription payment via Flutterwave.
     */
    public function store(Request $request, \App\Services\FlutterwaveService $paymentService): RedirectResponse
    {
        $validated = $request->validate([
            'plan_type' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $txRef = 'SUB-' . uniqid() . '-' . time();
        $user = Auth::user();

        // Metadata for callback
        $meta = [
            'type' => 'subscription',
            'plan_type' => $validated['plan_type'],
            'user_id' => $user->id,
            'consumer_name' => $user->name,
        ];

        $payment = $paymentService->initiatePayment(
            $validated['amount'],
            'TZS',
            $user->email,
            $txRef,
            route('subscriptions.callback'),
            $meta
        );

        if ($payment && isset($payment['data']['link'])) {
            return redirect($payment['data']['link']);
        }

        return back()->with('error', 'Could not initiate payment. Please try again.');
    }

    /**
     * Handle Flutterwave Callback
     */
    public function callback(Request $request, \App\Services\FlutterwaveService $paymentService)
    {
        $status = $request->query('status');
        $txRef = $request->query('tx_ref');
        $transactionId = $request->query('transaction_id');

        if ($status !== 'successful' || !$transactionId) {
            return redirect()->route('subscriptions.index')->with('error', 'Payment failed or cancelled.');
        }

        $verified = $paymentService->verifyTransaction($transactionId);

        if ($verified && $verified['status'] === 'success' && $verified['data']['status'] === 'successful') {
            $meta = $verified['data']['meta'];
            $planType = $meta['plan_type'] ?? 'monthly'; // Fallback
            $amount = $verified['data']['amount'];

            // Cancel existing
            Auth::user()->subscriptions()->where('status', 'active')->update(['status' => 'cancelled']);

            // Create new
            Subscription::create([
                'user_id' => Auth::id(),
                'plan_type' => $planType,
                'status' => 'active',
                'starts_at' => now(),
                'ends_at' => $planType === 'annual' ? now()->addYear() : now()->addMonth(),
                'amount' => $amount,
                'payment_method' => 'flutterwave',
            ]);

            // Auto-verify worker
            if (Auth::user()->workerProfile) {
                Auth::user()->workerProfile->update(['is_verified' => true]);
            }

            return redirect()->route('dashboard')->with('status', 'subscription-activated');
        }

        return redirect()->route('subscriptions.index')->with('error', 'Payment verification failed.');
    }
}
