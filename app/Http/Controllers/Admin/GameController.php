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
        //Connecting to API
        $client = new Client([
            'base_uri' => env('API_URL'),
            'timeout'  => 2.0,
        ]);
        $response = Http::withoutVerifying()->get('https://localhost:5001/api/Game/AllGames', ['verify' => false]);
        //Turn response into array
        $games = $response->json([]);

        return view('admin.games.index', compact('games'));
    }

    public function view($index) {

$gameid = $index;
 /*
         
        $response1 = Http::withoutVerifying()->get('https://localhost:5001/api/Game/'.$index, ['verify' => false]);
        //Turn response into array
        $game = collect($response1->json());

        $response = Http::withoutVerifying()->get('https://localhost:5001/api/AeriaMessages', ['verify' => false]);
        //Turn response into array
        $messages = $response->json([]);


      $response2 = Http::withoutVerifying()->get('https://localhost:5001/api/AeriaAnalytics/AllAnalyticsPerGame/'.$index, ['verify' => false]);
        //Turn response into array
        $analytics = $response2->json([]);


   $httpworld = Http::withoutVerifying()->get('https://localhost:5001/api/World/GetAllWorldPerGame/'.$index, ['verify' => false]);
    $worldsarray = $httpworld->json([]);
        //Turn response into array
    //    $worlds = collect($worldsarray);
     


 $httcohortgroup = Http::withoutVerifying()->get('https://localhost:5001/api/Game/GetCohorts/'.$index, ['verify' => false]);
    $cohortgroupsarray = $httcohortgroup->json([]);
        //Turn response into array
        $cohortgroups = collect($cohortgroupsarray);
     
 $httplevels = Http::withoutVerifying()->get('https://localhost:5001/api/Game/GetCohorts/'.$index, ['verify' => false]);
    $levelsarray = $httcohortgroup->json([]);
        //Turn response into array
        $levels = collect($cohortgroupsarray);
     


*/
     
    

        //Eloquents
        $game = Game::where('ID', "6")->get();
        $messages = Message::where('gameID', $index)->get();
        $cohorts = Cohort::where('GameID', $index)->get();
        $worlds = World::where('GameId', $index)->get();
        $cohortgroups = CohortGroup::where('GameID', $index)->get();
        $cohortusers = UserCohort::all();
        $usergamedata = UserGameData::where('GameID', $index)->get();
        $customkeys = CustomKey::where('AnalyticID', $index)->get();

        $insanedeaths = CustomKey::where('AnalyticID', $index)->where('Name', 'insaneDeaths')->get();
        $insanetime = CustomKey::where('AnalyticID', $index)->where('Name', 'insaneTime')->get();




        return view('admin.games.show', compact('gameid', 'messages', 'game', 'worlds', 'cohorts', 'cohortgroups', 'cohortusers', 'usergamedata', 'customkeys', 'insanedeaths', 'insanedeaths' ));
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
