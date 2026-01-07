<?php

namespace App\Http\Controllers;

use App\Models\JobRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobRequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'worker') {
            $requests = JobRequest::with('client')->where('worker_id', $user->id)->latest()->get();
        } else {
            $requests = JobRequest::with('worker')->where('client_id', $user->id)->latest()->get();
        }

        return view('job-requests.index', compact('requests'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'details' => 'required|string|min:10',
            'budget' => 'nullable|numeric|min:0'
        ]);

        JobRequest::create([
            'client_id' => Auth::id(),
            'worker_id' => $user->id,
            'details' => $request->details,
            'budget' => $request->budget,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('status', 'request-sent');
    }

    public function update(Request $request, JobRequest $jobRequest)
    {
        $this->authorize('update', $jobRequest);

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed,cancelled'
        ]);

        $jobRequest->update([
            'status' => $request->status
        ]);

        return back()->with('status', 'request-updated');
    }
}
