<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Space;
use App\Models\Amenity_room;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "rooms";

    protected $fillable = [
        'space_id',
        'name',
        'capacity',
        'type',
        'is_active'
    ];

    public function spaces() {
        return $this->belongsToMany(Space::class)->withTimestamps();
    }

    public function amenities() {
        return $this->belongsToMany(Amenity::class)->using(Amenity_room::class)->withTimestamps();
    }
}
