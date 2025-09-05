<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Booking;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "payments";

    protected $fillable = [
        'booking_id',
        'method',
        'amount',
        'status'
    ];

    public function bookings() {
        return $this->belongsToMany(Booking::class)->withTimestamps();
    }
}
