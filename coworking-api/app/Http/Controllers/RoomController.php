<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Traits\ApiResponse;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with('spaces')->get();
        //use App\Http\Resources\PostResource
        return $this->success(RoomResource::collection($rooms));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request) {
        $room = Room::create($request->validated());
        return response()->json($room, 201);
      }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $result = Room::find($id);
        if($result) {
            $result->load(['spaces']);
            return $this->success(new RoomResource($result), "Todo bem, prosigue");
        } else {
            return $this->error("Todo mal, asi no", 404, ['id' => 'No se encontro el recurso con el id']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
