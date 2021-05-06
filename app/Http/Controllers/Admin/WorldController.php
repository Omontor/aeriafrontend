<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorldRequest;
use App\Http\Requests\StoreWorldRequest;
use App\Http\Requests\UpdateWorldRequest;
use App\Models\Game;
use App\Models\World;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorldController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('world_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worlds = World::with(['game'])->get();

        $games = Game::get();

        return view('admin.worlds.index', compact('worlds', 'games'));
    }

    public function create()
    {
        abort_if(Gate::denies('world_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $games = Game::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.worlds.create', compact('games'));
    }

    public function store(StoreWorldRequest $request)
    {
        $world = World::create($request->all());

        return redirect()->route('admin.worlds.index');
    }

    public function edit(World $world)
    {
        abort_if(Gate::denies('world_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $games = Game::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $world->load('game');

        return view('admin.worlds.edit', compact('games', 'world'));
    }

    public function update(UpdateWorldRequest $request, World $world)
    {
        $world->update($request->all());

        return redirect()->route('admin.worlds.index');
    }

    public function show(World $world)
    {
        abort_if(Gate::denies('world_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world->load('game');

        return view('admin.worlds.show', compact('world'));
    }

    public function destroy(World $world)
    {
        abort_if(Gate::denies('world_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorldRequest $request)
    {
        World::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
