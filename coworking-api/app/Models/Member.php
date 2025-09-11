<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Plan;
use App\Models\Booking;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "members";

    protected $fillable = [
        'user_id',
        'plan_id',
        'company',
        'joined_at'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function plans() {
        return $this->belongsTo(Plan::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
