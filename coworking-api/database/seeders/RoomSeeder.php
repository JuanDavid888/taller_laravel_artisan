<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Space;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los spaces existentes (o crear algunos si no hay)
        $spaces = Space::all();

        // Si no hay spaces, crea algunos (por ejemplo 5)
        if ($spaces->isEmpty()) {
            $spaces = Space::factory()->count(5)->create();
        }

        // Crear 5 rooms
        Room::factory()
            ->count(5)
            ->create()
            ->each(function ($room) use ($spaces) {
                // Asignar un space_id aleatorio a cada room
                $room->space_id = $spaces->random()->id;
                $room->save();
            });
    }
}
