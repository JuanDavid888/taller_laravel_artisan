<?php

namespace App\Http\Requests;

use App\Models\Booking;
use App\Rules\NoOverlapRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeBooking = $this->route('booking');
        $bookingId = $routeBooking instanceof Booking ? $routeBooking->id : null;
    
        return [
            'member_id' => ['nullable', 'exists:members,id'],
            'room_id'   => ['nullable', 'exists:rooms,id'],
    
            'start_at' => [
                'required',
                'date',
                'after_or_equal:' . now()->format('Y-m-d H:i:s'),
                new NoOverlapRule(),  // Regla para evitar solapamientos
            ],
    
            'end_at' => [
                'required',
                'date',
                'after:start_at',
            ],
            
            'status' => ['nullable', 'in:pending,confirmed,cancelled'],
            'purpose' => ['nullable', 'string'],
        ];
    }
}