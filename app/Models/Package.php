<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'category',
        'image',
        'description',
        'price',
        'down_payment',
        'features',
        'items_included',
        'item_images',
        'duration',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'items_included' => 'array',
        'item_images' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    public function getFormattedDownPaymentAttribute()
    {
        return 'Rp ' . number_format((float) $this->down_payment, 0, ',', '.');
    }
}
