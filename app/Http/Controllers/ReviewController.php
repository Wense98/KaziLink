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

        // Prevent workers from reviewing themselves
        if (Auth::id() === $worker->user_id) {
            return back()->with('error', 'You cannot review yourself.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'worker_id' => $worker->user_id, // Review model uses worker_id which refers to User ID
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('status', 'review-submitted');
    }
}
