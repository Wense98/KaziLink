<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $data = ['user' => $user];

        if ($user->role === 'worker' && $user->workerProfile) {
            $worker = $user->workerProfile;

            // Rating Distribution (Pie Chart)
            $reviews = $user->reviewsReceived;
            $ratingDistribution = [
                '5' => $reviews->where('rating', 5)->count(),
                '4' => $reviews->where('rating', 4)->count(),
                '3' => $reviews->where('rating', 3)->count(),
                '2' => $reviews->where('rating', 2)->count(),
                '1' => $reviews->where('rating', 1)->count(),
            ];

            // Monthly Activity (Simulated for MVP - Line Chart)
            // In a real app, this would be `ProfileView::where...`
            $activityLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $profileViews = [12, 19, 15, 25, 22, 30, 45]; // Simulated
            
            // Interaction Count (Reviews per day - Real Data Mockup)
            // Grouping reviews by day is complex for a simple MVP chart without DB adjustments,
            // so we'll use a placeholder or simulated trend for now.
            $interactions = [2, 4, 1, 5, 3, 6, 8];

            $data['charts'] = [
                'ratings' => [
                    'labels' => array_keys($ratingDistribution),
                    'data' => array_values($ratingDistribution),
                ],
                'activity' => [
                    'labels' => $activityLabels,
                    'views' => $profileViews,
                    'interactions' => $interactions,
                ]
            ];
        }

        return view('dashboard', $data);
    }
}
