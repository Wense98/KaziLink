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
        $features = ['Search Visibility', 'Direct Work Requests', 'Reviews & Ratings', 'Profile Identity Page'];
        
        $plans = [
            [
                'name' => 'Monthly Plan',
                'id' => 'monthly',
                'price' => 2000,
                'description' => 'Perfect for testing the waters and staying active.',
                'features' => $features,
            ],
            [
                'name' => 'Annual Plan',
                'id' => 'annual',
                'price' => 23000,
                'description' => 'Commit to your growth and save 1,000 TZS per year.',
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plan_type' => 'required|string',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // Cancel existing active subscriptions
        Auth::user()->subscriptions()->where('status', 'active')->update(['status' => 'cancelled']);

        // Create new subscription
        Subscription::create([
            'user_id' => Auth::id(),
            'plan_type' => $validated['plan_type'],
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => $validated['plan_type'] === 'annual' ? now()->addYear() : now()->addMonth(),
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
        ]);

        // If paid plan, auto-verify the worker profile for demo purposes
        if (in_array($validated['plan_type'], ['monthly', 'annual']) && Auth::user()->workerProfile) {
            Auth::user()->workerProfile->update(['is_verified' => true]);
        }

        return redirect()->route('dashboard')->with('status', 'subscription-activated');
    }
}
