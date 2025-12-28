<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDeletionRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_type',
        'reason',
        'status',
        'admin_notes',
        'processed_at'
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    /**
     * Get the status badge color
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'rejected' => 'danger',
        ];

        return $colors[$this->status] ?? 'secondary';
    }
}
