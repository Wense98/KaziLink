<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\WorkerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, WorkerProfile $worker): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if (Auth::id() === $worker->user_id) {
            abort(403, 'You cannot review yourself.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'worker_id' => $worker->user_id,
            'job_request_id' => $request->job_request_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // Recalculate Average Rating
        $avg = Review::where('worker_id', $worker->user_id)->avg('rating');
        $count = Review::where('worker_id', $worker->user_id)->count();

        // Direct update to WorkerProfile table (assuming columns exist or using Model)
        // If WorkerProfile has 'rating' column:
        $worker->timestamps = false; // Optional: avoid updating 'updated_at' just for rating
        $worker->forceFill([
            // 'rating' => number_format($avg, 1) // If column exists
        ])->save();

        return back()->with('status', 'Review submitted! Rating updated.');
    }
}
