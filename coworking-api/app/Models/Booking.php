<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Member;
use App\Models\Room;
use App\Models\Payment;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "bookings";

    protected $fillable = [
        'member_id',
        'room_id',
        'start_at',
        'end_at',
        'status',
        'purpose'
    ];

    public function members() {
        return $this->belongsTo(Member::class);
    }

    public function rooms() {
        return $this->hasMany(Room::class);
    }

    public function payments() {
        return $this->belongsTo(Payment::class);
    }
}
