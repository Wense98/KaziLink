<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\ServiceCategory;
use App\Models\WorkerProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerSearchController extends Controller
{
    /**
     * Display a listing of workers.
     */
    public function index(Request $request): View
    {
        $query = WorkerProfile::with(['user', 'category', 'location']);

        // Join with subscriptions to prioritize premium workers
        $query->leftJoin('subscriptions', function($join) {
            $join->on('worker_profiles.user_id', '=', 'subscriptions.user_id')
                ->where('subscriptions.status', '=', 'active');
        })
        ->select('worker_profiles.*')
        ->orderByRaw("CASE WHEN subscriptions.plan_type = 'premium' THEN 0 ELSE 1 END")
        ->orderBy('worker_profiles.created_at', 'desc');

        // Only verified workers?
        $query->where('is_verified', true);

        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location_id', $request->location);
        }

        // Enforce STRICT visibility rules: Verified AND Active Subscription
        $workers = WorkerProfile::with(['user', 'category', 'location'])
            ->verifiedAndActive()
            ->when($request->filled('category'), function ($q) use ($request) {
                return $q->where('service_category_id', $request->category);
            })
            ->when($request->filled('location'), function ($q) use ($request) {
                return $q->where('location_id', $request->location);
            })
            ->when(Auth::check() && Auth::user()->district, function ($q) {
                // Smart Location Matching: Boost workers in same district/region
                $userDistrict = Auth::user()->district;
                $userRegion = Auth::user()->region;
                
                $q->orderByRaw("CASE 
                    WHEN worker_profiles.district = ? THEN 0 
                    WHEN worker_profiles.id IN (SELECT id FROM users WHERE region = ?) THEN 1
                    ELSE 2 
                END", [$userDistrict, $userRegion]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = ServiceCategory::all();
        $locations = Location::where('type', 'region')->get();

        return view('search.index', compact('workers', 'categories', 'locations'));
    }
}
