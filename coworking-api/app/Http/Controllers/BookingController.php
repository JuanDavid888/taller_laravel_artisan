<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Traits\ApiResponse;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;

class BookingController extends Controller
{
    use ApiResponse;
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['room.spaces', 'members']);
    
        // filtros dinámicos
        if ($request->has('status')) {
            $query->where('status', $request->query('status'));
        }
        if ($request->has('member_id')) {
            $query->where('member_id', $request->query('member_id'));
        }
        if ($request->has('room_id')) {
            $query->where('room_id', $request->query('room_id'));
        }
    
        // paginación (default 10)
        $perPage = $request->query('per_page', 15);
        $bookings = $query->paginate($perPage);

        // Verificar si no hay resultados
        if ($bookings->isEmpty()) {
            return response()->json([
                'message' => 'No hay elementos que coincidan con los filtros proporcionados.',
            ], 404);
        }
    
        return $this->success(BookingResource::collection($bookings));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request) {
        // TODO: validar no-solapamiento aquí o con Rule custom
        $booking = Booking::create($request->validated());
        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        // Obtiene los datos validados
        $data = $request->validated();

        // Actualiza la reserva con los nuevos datos
        $booking->update($data);

        // Carga relaciones necesarias
        $booking->load(['members', 'room']);

        // Retorna una respuesta exitosa con los datos actualizados
        return response()->json([
            'message' => 'Reserva actualizada con éxito.',
            'booking' => $booking,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return $this->success(null, 'Booking soft deleted successfully.');
    }
    
    public function restore(string $id)
    {
        $booking = Booking::withTrashed()->find($id);
    
        if (!$booking) {
            return $this->error("Booking not found", 404, ['id' => 'No resource found with the given id']);
        }
    
        $booking->restore();
        return $this->success(new BookingResource($booking), 'Booking restored successfully.');
    }
    
    public function forceDelete(string $id)
    {
        $booking = Booking::withTrashed()->find($id);
    
        if (!$booking) {
            return $this->error("Booking not found", 404, ['id' => 'No resource found with the given id']);
        }
    
        $booking->forceDelete();
        return $this->success(null, 'Booking permanently deleted.');
    }
    
}
