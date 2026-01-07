<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\ServiceCategory;
use App\Models\WorkerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkerProfileController extends Controller
{
    /**
     * Show the form for creating a new worker profile.
     */
    public function create(): View
    {
        $categories = ServiceCategory::all();
        $locations = Location::where('type', 'region')->get(); // Assuming we only select top-level locations for now

        return view('worker.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created worker profile in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'service_category_id' => 'nullable|exists:service_categories,id',
            'custom_category' => 'nullable|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'bio' => 'required|string|max:1000',
            'experience_years' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'id_document' => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
        ]);

        $profile = new WorkerProfile($validated);
        $profile->user_id = Auth::id();
        $profile->status = 'pending';

        // Handle Custom Category
        if (!$request->service_category_id && $request->custom_category) {
            $category = ServiceCategory::firstOrCreate(['name' => $request->custom_category]);
            $profile->service_category_id = $category->id;
        }

        // Handle ID Document Upload
        if ($request->hasFile('id_document')) {
            $path = $request->file('id_document')->store('id_documents', 'public');
            $profile->id_document = $path;
        }

        $profile->save();

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            Auth::user()->update(['avatar' => $path]);
        }

        // Create 1-week free trial subscription
        \App\Models\Subscription::create([
            'user_id' => Auth::id(),
            'plan_type' => 'trial',
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => now()->addWeek(),
            'amount' => 0,
            'payment_method' => 'Trial',
        ]);

        // Update user role to worker
        $user = Auth::user();
        $user->role = 'worker';
        $user->save();

        return redirect()->route('dashboard')->with('status', 'worker-profile-created');
    }

    public function show(WorkerProfile $worker): View
    {
        $worker->load(['user', 'category', 'location', 'user.reviewsReceived.user']);
        return view('worker.show', compact('worker'));
    }

    /**
     * Show the form for editing the worker profile.
     */
    public function edit(): View
    {
        $worker = Auth::user()->workerProfile;
        $categories = ServiceCategory::all();
        $locations = Location::where('type', 'region')->get();

        return view('worker.edit', compact('worker', 'categories', 'locations'));
    }

    /**
     * Update the worker profile in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $worker = Auth::user()->workerProfile;

        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'location_id' => 'required|exists:locations,id',
            'bio' => 'required|string|max:1000',
            'experience_years' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
        ]);

        $worker->update($validated);

        return redirect()->route('dashboard')->with('status', 'worker-profile-updated');
    }
}
