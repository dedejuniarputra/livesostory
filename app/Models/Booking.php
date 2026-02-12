<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'package_id',
        'booking_date',
        'booking_time',
        'location',
        'notes',
        'status',
        'payment_proof',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="px-2 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-400">Pending</span>',
            'completed' => '<span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-400">Completed</span>',
            default => '<span class="px-2 py-1 text-xs rounded-full bg-gray-500/20 text-gray-400">Unknown</span>',
        };
    }
}
