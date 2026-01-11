<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    protected $fillable = [
        'client_id',
        'worker_id',
        'status',
        'details',
        'details',
        'budget',
        'agreed_price',
        'commission_fee',
        'payment_status',
        'work_status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    public function review()
    {
        // Assuming one review per job request for simplicity
        // Ideally Review model should have job_request_id, but current schema uses user_id/worker_id
        // We can do a sophisticated check or just add job_request_id to reviews table.
        // For now, let's keep it simple: Client can review Worker *generally*.
        // But to link it to THIS job, we might need a flag.
        // Let's check if we can add job_request_id to Review table quickly?
        // Actually, the user requirement is just "Leave a review".
        // Let's check if the client has reviewed this worker *recently* or just show the button.
        // Better: Add job_request_id to reviews table for precision.
        return $this->hasOne(Review::class);
    }
}
