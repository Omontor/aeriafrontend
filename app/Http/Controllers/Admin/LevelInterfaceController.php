<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelInterface;
use App\Models\World;
use GuzzleHttp\Client;
use Log;

class LevelInterfaceController extends Controller
{
   public function index(){

     $this->interfacesSync();
    $interfaces = LevelInterface::all();      
    return view('admin.interfaces.index', compact('interfaces'));
   }


    public function view ($value) {


        $this->interfacesSync();
        $world = World::where('remote_id', $value)->first();
        $interfaces = $world->levelinterfaces;
        return view('admin.interfaces.index', compact('interfaces'));
       
    }

  public function create()
    {

    
    $worlds = World::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    return view('admin.interfaces.create', compact('worlds'));
    }

    public function store(Request $request)
    {
       


    $client = new Client([
                'base_uri' => env('REMOTE_URL'),
                'timeout'  => 2.0,
                'verify' => false

            ]);

    try {
        
    $response = $client->request('POST', '/api/AeriaLevelInterfaces/Create', 
        ['json' => 
            [
            'Name' => $request->name,
            'WorldId' => $request->world_id, 
            'OriginalId' => $request->original_id 
            ]

         ]);
     $world = World::where('remote_id', $request->world_id)->first();
     $interfaces = $world->levelinterfaces;
        return view('admin.interfaces.index', compact('interfaces'))->with('success', 'Level Interface Created Succesfully');

    } 

    catch (Exception $e) {
        
         return redirect::to(url('/admin/worlds/'.$request->game))->with('error', $e);

    }


    }
    public function interfacesSync(){

        $client = new Client([
        'base_uri' => env('REMOTE_URL'),
        'timeout'  => 2.0,
        'verify' => false

        ]);
        $worlds = World::all();
        foreach ($worlds as $key => $value2) {
   
        $response = $client->request('GET', '/api/AeriaLevelInterfaces/GetAllPerWorld/'.$value2->remote_id);
        $remoteinterfaces = json_decode($response->getBody()->getContents());
        if ($remoteinterfaces != null) {

          
            //if there are records in the database we go through them one by one to clone in local db
                foreach ($remoteinterfaces as $key => $value) {
                $newlevelinterface = LevelInterface::firstOrNew(['remote_id' => $value->id]);
                if ( $newlevelinterface->exists) {
                    Log::info("Skipping existing interface");
                }
                else{

                Log::info("Creating interface ".$value->name);
                    $newlevelinterface->remote_id = $value->id;
                    $newlevelinterface->name = $value->name;
                    $newlevelinterface->original_id = $value->originalId;
                    $newlevelinterface->world_id = $value2->remote_id;
                    $newlevelinterface->game_id = $value2->game->remote_id;
                    $newlevelinterface->date = $value->date;
                    $newlevelinterface->save();
                    }
                }
            }
        }   

         Log::info("Level Interfaces Synced Successfully");     

    }



}
