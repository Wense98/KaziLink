<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Location;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\WorkerProfile;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $view = $request->get('view', 'overview');

        $data = [
            'stats' => [
                'total_workers' => WorkerProfile::count(),
                'pending_verifications' => WorkerProfile::where('status', 'pending')->count(),
                'verified_pros' => WorkerProfile::where('status', 'verified')->count(),
                'total_users' => User::count(),
                'active_subscriptions' => Subscription::where('status', 'active')->count(),
                'total_revenue' => Subscription::where('status', 'active')->sum('amount'),
            ],
            'currentView' => $view,
            'chartData' => [
                'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                'users' => [12, 19, 13, 15, 22, 30, 45],
                'revenue' => [50000, 75000, 60000, 90000, 120000, 150000, 200000],
            ]
        ];

        switch ($view) {
            case 'workers':
                $data['workers'] = WorkerProfile::with('user', 'category')->latest()->paginate(10);
                break;
            case 'users':
                $data['users'] = User::latest()->paginate(10);
                break;
            case 'payments':
                $data['subscriptions'] = Subscription::with('user')->latest()->paginate(10);
                break;
            case 'data':
                $data['locations'] = Location::all();
                $data['categories'] = ServiceCategory::all();
                break;
            case 'logs':
                $data['logs'] = AuditLog::with('user')->latest()->paginate(20);
                break;
            case 'roles':
                $data['admins'] = User::where('role', 'admin')->latest()->paginate(10);
                break;
            case 'reports':
                // Placeholder for reports - could fetch complaints/tickets here
                $data['reports'] = collect([]); 
                break;
            case 'settings':
                // Settings might be stored in a config table or settings model
                $data['settings'] = [
                    'subscription_price_monthly' => 10000,
                    'subscription_price_annual' => 100000,
                    'maintenance_mode' => false,
                ];
                break;
            default:
                $data['recentWorkers'] = WorkerProfile::with('user', 'category')->latest()->take(5)->get();
                $data['recentLogs'] = AuditLog::with('user')->latest()->take(5)->get();
        }

        return view('admin.dashboard', $data);
    }

    public function verify(Request $request, WorkerProfile $worker): RedirectResponse
    {
        $request->validate(['status' => 'required|in:verified,rejected,pending']);
        
        $oldStatus = $worker->status;
        $worker->update(['status' => $request->status]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Worker Verification: {$worker->user->name}",
            'model' => 'WorkerProfile',
            'model_id' => $worker->id,
            'changes' => ['from' => $oldStatus, 'to' => $request->status],
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', "Worker status updated to {$request->status}");
    }

    public function toggleUserStatus(User $user): RedirectResponse
    {
        $user->update(['is_active' => !$user->is_active]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "User Toggle Status: {$user->name}",
            'model' => 'User',
            'model_id' => $user->id,
            'changes' => ['is_active' => $user->is_active],
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', "User status updated successfully.");
    }

    public function confirmPayment(Subscription $subscription): RedirectResponse
    {
        $subscription->update(['status' => 'active']);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Manual Payment Confirmation: Sub #{$subscription->id}",
            'model' => 'Subscription',
            'model_id' => $subscription->id,
            'changes' => ['status' => 'active'],
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', "Payment confirmed and subscription activated.");
    }

    public function storeLocation(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'type' => 'required|in:region,district,ward,street',
        ]);

        $location = Location::create([
            'name' => $request->name,
            'type' => $request->type,
            'parent_id' => $request->parent_id,
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Created Location: {$location->name} ({$location->type})",
            'model' => 'Location',
            'model_id' => $location->id,
            'changes' => $location->toArray(),
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', "Location '{$location->name}' created successfully.");
    }

    public function destroyLocation(Location $location): RedirectResponse
    {
        $name = $location->name;
        $location->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Deleted Location: {$name}",
            'model' => 'Location',
            'model_id' => $location->id,
            'changes' => null,
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', "Location '{$name}' deleted.");
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        $category = ServiceCategory::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon ?: 'briefcase',
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Created Category: {$category->name}",
            'model' => 'ServiceCategory',
            'model_id' => $category->id,
            'changes' => $category->toArray(),
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', "Category '{$category->name}' created successfully.");
    }

    public function destroyCategory(ServiceCategory $category): RedirectResponse
    {
        $name = $category->name;
        $category->delete();

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Deleted Category: {$name}",
            'model' => 'ServiceCategory',
            'model_id' => $category->id,
            'changes' => null,
            'ip_address' => request()->ip()
        ]);

        return back()->with('success', "Category '{$name}' deleted.");
    }
    public function updateSettings(Request $request): RedirectResponse
    {
        // In a real app, validates and saves to DB/Config
        // For now, we simulate the action and log it
        
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => "Updated System Settings",
            'model' => 'System',
            'model_id' => 0,
            'changes' => $request->except(['_token']),
            'ip_address' => $request->ip()
        ]);

        return back()->with('success', "System configuration updated successfully.");
    }
}
