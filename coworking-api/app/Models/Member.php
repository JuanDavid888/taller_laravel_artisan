<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Plan;

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
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function plans() {
        return $this->belongsToMany(Plan::class)->withTimestamps();
    }
}
