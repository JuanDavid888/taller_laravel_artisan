<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Amenity_room;

class Amenity extends Model
{
    /** @use HasFactory<\Database\Factories\AmenityFactory> */
    use HasFactory, SoftDeletes;

    protected $table = "amenities";

    protected $fillable = ['name'];

    public function spaces() {
        return $this->belongsToMany(Room::class)->using(Amenity_room::class)->withTimestamps();
    }
}
