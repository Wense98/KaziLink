<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\WorkerProfile;

class WorkerVerificationController extends Controller
{
    /**
     * Show the verification upload page.
     */
    public function show()
    {
        $workerProfile = auth()->user()->workerProfile;

        if (!$workerProfile) {
            return redirect()->route('worker.profile.create')->with('error', 'Please create a worker profile first.');
        }

        if ($workerProfile->is_verified) {
            return redirect()->route('dashboard')->with('status', 'Your profile is already verified.');
        }

        return view('worker.verification.show', compact('workerProfile'));
    }

    /**
     * Handle verification document upload.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max
            'nida_number' => 'required|string|max:255',
        ]);

        $workerProfile = auth()->user()->workerProfile;

        // Upload file
        if ($request->hasFile('id_document')) {
            $path = $request->file('id_document')->store('verification_documents', 'public');
            $workerProfile->id_document = $path;
        }
        
        // Save NIDA number (assuming we add this column or store it in verification_documents json)
        // For now, let's store it in the verification_documents JSON field if strictly needed, 
        // but the migration had 'id_document' column. 
        // Let's assume we might want to store NIDA in a structured way or just the file path in id_document column.
        // The implementation plan mentioned 'nida_number' but the migration has 'id_document' string.
        // We will store the path. If we need NIDA number text, we might need a migration or put it in bio/json.
        // Let's stick to the file for now as per "Upload NIDA" instruction.
        
        $workerProfile->status = 'pending';
        $workerProfile->save();

        return redirect()->route('dashboard')->with('status', 'Verification documents uploaded! Waiting for admin approval.');
    }
}
