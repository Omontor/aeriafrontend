<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorldRequest;
use App\Http\Requests\UpdateWorldRequest;
use App\Http\Resources\Admin\WorldResource;
use App\Models\World;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorldApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('world_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorldResource(World::with(['game'])->get());
    }

    public function store(StoreWorldRequest $request)
    {
        $world = World::create($request->all());

        return (new WorldResource($world))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(World $world)
    {
        abort_if(Gate::denies('world_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorldResource($world->load(['game']));
    }

    public function update(UpdateWorldRequest $request, World $world)
    {
        $world->update($request->all());

        return (new WorldResource($world))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(World $world)
    {
        abort_if(Gate::denies('world_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
