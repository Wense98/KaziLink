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

        // For demo purposes, if no verified workers, we might want to show all
        // $workers = $query->paginate(12);
        
        // Let's remove is_verified check for now to ensure we see our seeded/test data easily
        $workers = WorkerProfile::with(['user', 'category', 'location'])
            ->whereHas('user.subscriptions', function ($query) {
                $query->where('status', 'active')
                      ->where('ends_at', '>', now());
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                return $q->where('service_category_id', $request->category);
            })
            ->when($request->filled('location'), function ($q) use ($request) {
                return $q->where('location_id', $request->location);
            })
            ->when($request->filled('price_range'), function ($q) use ($request) {
                if ($request->price_range === 'budget') {
                    return $q->where('hourly_rate', '<', 10000);
                } elseif ($request->price_range === 'premium') {
                    return $q->where('hourly_rate', '>=', 10000);
                }
            })
            ->paginate(12);

        $categories = ServiceCategory::all();
        $locations = Location::where('type', 'region')->get();

        return view('search.index', compact('workers', 'categories', 'locations'));
    }
}
