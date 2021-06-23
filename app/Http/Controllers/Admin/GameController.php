<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Models\Level;
use App\Models\World;
use App\Models\Analytic;
use App\Models\Cohort;
use App\Models\CohortGroup;
use App\Models\UserCohort;
use App\Models\Message;
use App\Models\UserData;
use App\Models\CustomKey;
use Gate;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Redirect;


use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index()
    {       
        $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());

        return view('admin.games.index', compact('games'));
    }





    public function view($index) {

    $gameid = $index;
    $game = Game::where('remote_id', $index)->first();
    $cohorts = Cohort::where('gameid', $index)->where('status', 1)->get();
    $worlds = World::where('game_id', $index)->get();
    $analytics = Analytic::where('game_id', $game->remote_id)->get();
    $customkeys = Analytic::where('game_id', $game->remote_id)->with('customkeys')->get();

    return view('admin.games.show', compact('game', 'cohorts', 'analytics', 'worlds', 'customkeys'));
    
    }


    public function compare () {

        $index = 6;
        $cohortdata = Cohort::where('GameID', 6)->get();

    $response1 = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Game/'.$index, ['verify' => false]);
        //Turn response into array
        $game = collect($response1->json());

        return view('admin.games.compare', compact('cohortdata', 'game'));
    }


 public function create()
    {
        abort_if(Gate::denies('game_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.games.create');
    }

    public function store (Request $request) {
         


            $client = new Client([
                        'base_uri' => env('REMOTE_URL'),
                        'timeout'  => 2.0,
                        'verify' => false

                    ]);
            try { 
            $response = $client->request('POST', '/api/Game/Create', 
                ['json' => 
                    [
                    'name' => $request->name   
                    ]

                 ]);
            return redirect::route('admin.games.index')->with('success', 'Game Created Successfully');
            } 
            catch (Exception $e) {
                
                 return redirect::route('admin.games.index')->with('error', $e);

            }

  
    }
}
