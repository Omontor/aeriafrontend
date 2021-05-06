<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLevelRequest;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\Level;
use App\Models\World;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $levels = Level::with(['world'])->get();

        $worlds = World::get();

        return view('admin.levels.index', compact('levels', 'worlds'));
    }

    public function create()
    {
        abort_if(Gate::denies('level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worlds = World::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.levels.create', compact('worlds'));
    }

    public function store(StoreLevelRequest $request)
    {
        $level = Level::create($request->all());

        return redirect()->route('admin.levels.index');
    }

    public function edit(Level $level)
    {
        abort_if(Gate::denies('level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worlds = World::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $level->load('world');

        return view('admin.levels.edit', compact('worlds', 'level'));
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->all());

        return redirect()->route('admin.levels.index');
    }

    public function show(Level $level)
    {
        abort_if(Gate::denies('level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->load('world');

        return view('admin.levels.show', compact('level'));
    }

    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->delete();

        return back();
    }

    public function massDestroy(MassDestroyLevelRequest $request)
    {
        Level::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
