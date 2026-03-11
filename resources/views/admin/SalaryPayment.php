<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_member_id',
        'start_date',
        'end_date',
        'payment_date',
        'job_description',
        'total_amount',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'payment_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
