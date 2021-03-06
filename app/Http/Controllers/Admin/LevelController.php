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
use GuzzleHttp\Client;
use Log;
class LevelController extends Controller
{


    public function index()
    {


        $this->levelSync();
        $levels = Level::all();
        return view('admin.levels.index', compact('levels'));
       
    }

    public function view ($value) {


        $this->levelSync();
        $world = World::where('remote_id', $value)->first();
        $levels = $world->levels;
        return view('admin.levels.index', compact('levels'));
       
    }



    public function create()
    {
        abort_if(Gate::denies('level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worlds = World::all();

        return view('admin.levels.create', compact('worlds'));
    }

    public function store(StoreLevelRequest $request)
    {
       


    $client = new Client([
                'base_uri' => env('REMOTE_URL'),
                'timeout'  => 2.0,
                'verify' => false

            ]);

    try {
        
    $response = $client->request('POST', '/api/Level/Create', 
        ['json' => 
            [
            'name' => $request->name,
            'WorldId' => $request->world_id, 
            'NameInBuild' => $request->name_in_build 
            ]

         ]);
    return redirect::to(url('/admin/worlds/'.$request->game))->with('success', 'Level Created Successfully');

    } 

    catch (Exception $e) {
        
         return redirect::to(url('/admin/worlds/'.$request->game))->with('error', $e);

    }


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


    public function levelSync(){

        $client = new Client([
        'base_uri' => env('REMOTE_URL'),
        'timeout'  => 2.0,
        'verify' => false

        ]);
        $worlds = World::all();
        foreach ($worlds as $key => $value) {
   
        $response = $client->request('GET', '/api/level/GetAllLevelsPerWorld/'.$value->remote_id);
        $remotelevels = json_decode($response->getBody()->getContents());
        if ($remotelevels != null) {
            //if there are records in the database we go through them one by one to clone in local db
                foreach ($remotelevels as $key => $value) {
                $newlevel = Level::firstOrNew(['remote_id' => $value->id]);
                if ( $newlevel->exists) {
                    Log::info("Skipping existing level");
                }
                else{
                Log::info("Creating level ".$value->name);
                    $newlevel->remote_id = $value->id;
                    $newlevel->name = $value->name;
                    $newlevel->name_in_build = $value->nameInBuild;
                    $newlevel->world_id = $value->worldId;
                    $newlevel->save();
                    }
                }
            }
        }   

         Log::info("Levels Synced Successfully");     

    }
}
