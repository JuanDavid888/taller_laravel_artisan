<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amenity_room extends Model
{
    /** @use HasFactory<\Database\Factories\AmenityRoomFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "amenity_room";

    protected $fillable = ['amenity_id', 'room_id'];
}
