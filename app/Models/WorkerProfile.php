<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_category_id',
        'location_id',
        'bio',
        'experience_years',
        'hourly_rate',
        'is_verified',
        'verification_documents',
        'district',
        'ward',
        'street',
        'id_document',
        'status',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'verification_documents' => 'array',
        'hourly_rate' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function averageRating()
    {
        return $this->user->reviewsReceived()->avg('rating') ?: 0;
    }

    public function reviewsCount()
    {
        return $this->user->reviewsReceived()->count();
    }

    /**
     * Scope a query to only include verified and active workers.
     */
    public function scopeVerifiedAndActive($query)
    {
        return $query->where('is_verified', true)
                     ->whereHas('user.subscriptions', function ($q) {
                         $q->where('status', 'active')
                           ->where('ends_at', '>', now());
                     });
    }

    /**
     * Check if the worker has an active subscription.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->user->subscriptions()
                    ->where('status', 'active')
                    ->where('ends_at', '>', now())
                    ->exists();
    }
}
