<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpaceRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\SpaceResource;
use App\Models\Room;
use App\Traits\ApiResponse;
use App\Models\Space;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Space::query();

        // filtros dinámicos
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }
        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->query('address') . '%');
        }

        // paginación (default 10)
        $perPage = $request->query('per_page', 10);
        $spaces = $query->paginate($perPage);

        return $this->success(SpaceResource::collection($spaces));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpaceRequest $request)
    {
        $data = $request->validated();

        $newPost = Space::create($data);

        return $this->success(new SpaceResource($newPost), 'Post creado correctamente', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpaceRequest $request, Space $space)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        //
    }
}
