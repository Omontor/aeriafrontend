<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
use App\Models\Level;
use App\Models\World;
use App\Models\Cohort;
use App\Models\CohortGroup;
use App\Models\UserCohort;
use App\Models\Message;
use App\Models\UserGameData;
use App\Models\CustomKey;
use Gate;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//Import these lines in every controller that uses API
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index()
    {       
       
        $httpgames = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Game/AllGames', ['verify' => false]);
        $games = $httpgames->json([]);

        return view('admin.games.index', compact('games'));
    }

    public function view($index) {

    $gameid = $index;
    //Game
    $httpgame = Http::withoutVerifying()->get('https://localhost:5001/api/Game/'.$index, ['verify' => false]);
    $game = collect($httpgame->json());
    //Messages
    $httpmessages = Http::withoutVerifying()->get('https://localhost:5001/api/AeriaMessages', ['verify' => false]);
    $messages = $httpmessages->json([]);

    $httpanalytics = Http::withoutVerifying()->get('https://localhost:5001/api/AeriaAnalytics/AllAnalyticsPerGame/'.$index, ['verify' => false]);
        $analytics = $httpanalytics->json([]);

    $httpworld = Http::withoutVerifying()->get('https://localhost:5001/api/World/GetAllWorldPerGame/'.$index, ['verify' => false]);
    $worldsarray = $httpworld->json([]);



 $httcohortgroup = Http::withoutVerifying()->get('https://localhost:5001/api/Game/GetCohorts/'.$index, ['verify' => false]);
    $cohortgroupsarray = $httcohortgroup->json([]);
        //Turn response into array
        $cohortgroups = collect($cohortgroupsarray);
     
 $httplevels = Http::withoutVerifying()->get('https://localhost:5001/api/Game/GetCohorts/'.$index, ['verify' => false]);
    $levelsarray = $httcohortgroup->json([]);
        //Turn response into array
        $levels = collect($cohortgroupsarray);
     



  

        return view('admin.games.show', compact('game','messages', 'analytics', 'worldsarray', 'cohortgroups', 'levels'));
    }


    public function compare () {

        $index = 6;
        $cohortdata = Cohort::where('GameID', 6)->get();

    $response1 = Http::withoutVerifying()->get('https://localhost:5001/api/Game/'.$index, ['verify' => false]);
        //Turn response into array
        $game = collect($response1->json());

        return view('admin.games.compare', compact('cohortdata', 'game'));
    }

}
