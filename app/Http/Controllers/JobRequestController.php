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

    public function update(Request $request, JobRequest $jobRequest, \App\Services\FlutterwaveService $paymentService)
    {
        // $this->authorize('update', $jobRequest); 

        $request->validate([
            'status' => 'nullable|in:accepted,rejected,completed,cancelled',
            'action' => 'nullable|in:quote,pay,start_work,finish_work,confirm_work',
            'agreed_price' => 'nullable|numeric|min:0'
        ]);

        // Worker Acception / Quoting
        if ($request->action === 'quote' && Auth::id() === $jobRequest->worker_id) {
            $jobRequest->update([
                'status' => 'accepted',
                'agreed_price' => $request->agreed_price,
                'commission_fee' => $request->agreed_price * 0.10
            ]);
            return back()->with('status', 'Price quoted. Waiting for client payment.');
        }

        // Client Paying to Escrow (Flutterwave)
        if ($request->action === 'pay' && Auth::id() === $jobRequest->client_id) {
            $txRef = 'JOB-' . $jobRequest->id . '-' . uniqid();
            $user = Auth::user();
            
            $meta = [
                'type' => 'job_escrow',
                'job_request_id' => $jobRequest->id,
                'user_id' => $user->id,
                'consumer_name' => $user->name,
            ];

            $payment = $paymentService->initiatePayment(
                $jobRequest->agreed_price,
                'TZS',
                $user->email,
                $txRef,
                route('job-requests.callback'),
                $meta
            );

            if ($payment && isset($payment['data']['link'])) {
                return redirect($payment['data']['link']);
            }

            return back()->with('error', 'Could not initiate payment. Please try again.');
        }

        // Job Workflow
        if ($request->action === 'start_work' && Auth::id() === $jobRequest->worker_id) {
            $jobRequest->update(['work_status' => 'in_progress']);
            return back()->with('status', 'Work started.');
        }

        if ($request->action === 'finish_work' && Auth::id() === $jobRequest->worker_id) {
            $jobRequest->update(['work_status' => 'completed']);
            return back()->with('status', 'Work marked as complete.');
        }

        if ($request->action === 'confirm_work' && Auth::id() === $jobRequest->client_id) {
            $jobRequest->update([
                'payment_status' => 'released',
                'status' => 'completed'
            ]);
            return back()->with('status', 'Funds released to worker. Job closed!');
        }

        if ($request->filled('status')) {
            $jobRequest->update(['status' => $request->status]);
        }

        return back()->with('status', 'updated');
    }

    /**
     * Handle Flutterwave Callback for Job Escrow
     */
    public function callback(Request $request, \App\Services\FlutterwaveService $paymentService)
    {
        $status = $request->query('status');
        $transactionId = $request->query('transaction_id');

        if ($status !== 'successful' || !$transactionId) {
            return redirect()->route('job-requests.index')->with('error', 'Payment failed or cancelled.');
        }

        $verified = $paymentService->verifyTransaction($transactionId);

        if ($verified && $verified['status'] === 'success' && $verified['data']['status'] === 'successful') {
            $meta = $verified['data']['meta'];
            $jobRequestId = $meta['job_request_id'];

            $jobRequest = JobRequest::find($jobRequestId);

            if ($jobRequest && $jobRequest->payment_status === 'pending') {
                $jobRequest->update([
                    'payment_status' => 'in_escrow',
                    'work_status' => 'pending' // Ready to start
                ]);
                return redirect()->route('job-requests.index')->with('status', 'Funds secured in Escrow! Worker can now start.');
            }
        }

        return redirect()->route('job-requests.index')->with('error', 'Payment verification failed.');
    }
}
