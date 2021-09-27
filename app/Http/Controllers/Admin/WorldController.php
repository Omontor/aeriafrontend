<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorldRequest;
use App\Http\Requests\StoreWorldRequest;
use App\Http\Requests\UpdateWorldRequest;
use App\Models\Game;
use App\Models\World;
use App\Models\Level;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Redirect;
use Log;

class WorldController extends Controller
{


    public function index(){

        $this->worldSync();
        $worlds= World::all();
        return view('admin.worlds.index', compact('worlds'));
    }

public function view($value)
    {
        $this->worldSync();
        $worlds = World::where('game_id', $value)->get();
        return view('admin.worlds.index', compact('worlds'));
    }


    public function create()
    {

             $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());

        return view('admin.worlds.create', compact('games'));
    }




    public function store(Request $request)
    {



    $client = new Client([
                'base_uri' => env('REMOTE_URL'),
                'timeout'  => 2.0,
                'verify' => false

            ]);


    try {
        
    $response = $client->request('POST', '/api/World/Create', 
        ['json' => 
            [
            'name' => $request->name,
            'GameId' => $request->game 
            ]

         ]);
    return redirect::to(url('/admin/worlds/'.$request->game))->with('success', 'World Created Successfully');

    } 

    catch (Exception $e) {
        
         return redirect::to(url('/admin/worlds/'.$request->game))->with('error', $e);

    }


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



        $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/'.$world);
        $game = json_decode($response->getBody()->getContents());


        abort_if(Gate::denies('world_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world->load('game');

        return view('admin.worlds.show', compact('world', 'game'));
    }




    public function destroy(World $world)
    {
        abort_if(Gate::denies('world_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $world->delete();

        return back();
    }


public function worldSync(){

        Log::info("Worlds Synced Start"); 
        $client = new Client([
        'base_uri' => env('REMOTE_URL'),
        'timeout'  => 2.0,
        'verify' => false

        ]);
        $games = Game::all();

        foreach ($games as $key => $value) {
   
        $response = $client->request('GET', '/api/World/GetAllWorldPerGame/'.$value->remote_id);
        $remoteworlds = json_decode($response->getBody()->getContents());
        if ($remoteworlds != null) {

            //if there are records in the database we go through them one by one to clone in local db
                foreach ($remoteworlds as $key => $value2) {
                $newworld = World::firstOrNew(['remote_id' => $value2->id]);
                if ( $newworld->exists) {
                    Log::info("Skipping existing world");
                }
                else{
                Log::info("Creating world ".$value2->name);
                     $newworld->remote_id = $value2->id;
                    $newworld->name = $value2->name;
                    $newworld->game_id = $value->remote_id;
                    $newworld->save();
                    }
                }
            }
        }              
  Log::info("Worlds Synced Successfully"); 
        $this->levelSync();
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
