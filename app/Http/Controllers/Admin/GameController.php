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
use App\Models\CustomData;
use App\Models\CustomKey;
use App\Models\LevelInterface;
use App\Models\ShowedAd;
use App\Models\WatchedAd;
use App\Models\CohortDeath;
use Gate;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Redirect;
use App\Models\Player;
use App\Models\LevelProg;
use App\Models\LevelDif;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;
use Log;


class GameController extends Controller
{
    public function index()
    {       
   
        $games = Game::all();      
        return view('admin.games.index', compact('games'));
    }


    public function edit($index) {

        $game = Game::where('remote_id', $index)->first();

        return view('admin.games.edit', compact('game'));
    }



    public function view($index) {

    $gameid = $index;
    $game = Game::where('remote_id', $index)->first();
    $cohorts = Cohort::where('gameid', $index)->where('status', 1)->take(10)->get();
    $userdata = Cohort::where('gameid', $index)->with('userdata')->get();
    $worlds = World::where('game_id', $index)->get();
    $analytics = Analytic::where('game_id', $game->remote_id)->get();
    $customkeys = Analytic::where('game_id', $game->remote_id)->with('customkeys')->get();
    $levelinterfaces = LevelInterface::where('game_id', $game->remote_id)->get();
    $cohortdeaths = CohortDeath::where('game_id', $game->remote_id)->get();

    return view('admin.games.show', compact('game', 'cohorts', 'analytics', 'worlds', 'customkeys', 'userdata', 'levelinterfaces', 'cohortdeaths'));
    
    }

    public function dashboard ($id){


        $game = Game::where('remote_id', $id)->first();
        $cohorts = $game->cohorts;
        $userdata = Userdata::where('game_id', $id)->get();
        $todaysessions = UserData::where('game_id', $id)->where('last_activity', Carbon::today()->format('Y-m-d')."T00:00:00")->count();        
        $showedads = ShowedAd::where('game_id', $id)->get();
        $watchedads = WatchedAd::where('game_id', $id)->get();
        

        return view('admin.games.dashboard', compact('game', 'cohorts', 'userdata', 'todaysessions', 'showedads', 'watchedads'));
    }


    public function compare () {

        $index = 6;
        $cohortdata = Cohort::where('GameID', 6)->get();

    $response1 = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Game/'.$index, ['verify' => false]);
        //Turn response into array
        $game = collect($response1->json());

        return view('admin.games.compare', compact('cohortdata', 'game'));
    }



    public function resync() {
        
        $httpgames = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Game/AllGames', ['verify' => false]);
        $games = $httpgames->json([]);
        $gamescount = count($games);

        $httpusers = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Accounts/AllUsers', ['verify' => false]);
        $users = $httpusers->json([]);
        $userscount = count($users);


        /* Fill information */


        $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
        
        /* Fill Games*/
        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());

        foreach ($games as $game => $value) {
            
        $newgame = Game::firstOrNew(['remote_id' => $value->id]);
           $newgame->name = $value->name;
           $newgame->remote_id = $value->id;
           $newgame->appid = $value->appID;
           $newgame->secret = $value->secret;
           $newgame->save();

             /* Fill Worlds*/
        $worldsresponse = $client->request('GET', '/api/World/GetAllWorldPerGame/'.$value->id);
        $worlds = json_decode($worldsresponse->getBody()->getContents());

        
            foreach ($worlds as $world => $value2) {
               
            $newworld = World::firstOrNew(['remote_id' => $value2->id]);
           $newworld->name = $value2->name;
           $newworld->remote_id = $value2->id;
           $newworld->game_id = $value2->gameId;
           $newworld->save();

            }

        }

        $allgames = Game::all();

            /*Fill Analytics */ 

            foreach ($allgames as $key => $value) {
            $analyticresponse = $client->request('GET', '/api/AeriaAnalytics/AllAnalyticsPerGame/'.$value->remote_id);
            $analytics = json_decode($analyticresponse->getBody('analytics')->getContents());
              
         
            foreach ($analytics->analytics as $analytic => $anvalue) {
               
            $newanalytic = Analytic::firstOrNew(['remote_id' => $anvalue->id]);
            $newanalytic->remote_id = $anvalue->id;
            $newanalytic->name = $anvalue->name;
            $newanalytic->name = $anvalue->name;
            $newanalytic->game_id = $value->remote_id;
            $newanalytic->save();
                }

                   /* Fill Cohorts  */

        $url = "/api/Game/GetCohorts/".$value->remote_id;   
        $cohortresponse = $client->request('GET', $url);
        $cohorts = json_decode($cohortresponse->getBody()->getContents());

        foreach ($cohorts as $cohort => $value) {

        $newcohort = Cohort::firstOrNew(['remote_id' => $value->id]);
        $newcohort->gameid = $value->gameId;
        $newcohort->amount = $value->amount;
        $newcohort->name = $value->nameId;
        $newcohort->status = $value->status;
        $newcohort->save();

            }  
        }

           //$allcohorts = Cohort::latest()->take(20)->get();
           $allcohorts = Cohort::all();

              /*Fill User Data*/
        
                foreach ($allcohorts as $key => $value2) {
                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());
     
                $userdataarray = [];

                foreach ($userdata as $key => $value3) {

                $newuserdata = UserData::firstOrNew(['remote_id' => $value3->id]);
                $newuserdata->cohort_id = $value2->remote_id;
                $newuserdata->remote_id = $value3->id;
                $newuserdata->platform = $value3->platform;
                $newuserdata->last_activity = $value3->lastActivity;
                $newuserdata->days_playing = $value3->daysPlaying;
                $newuserdata->iap = $value3->iap;
                $newuserdata->watched_ads = $value3->watchedAds;
                $watched_ads = WatchedAd::firstOrNew(['cohort_id' => $value2->remote_id]);
                        $watched_ads->value += $newuserdata->watched_ads;
                        $watched_ads->save();
                
                $newuserdata->showed_ads = $value3->showedAds;
                               $showed_ads = ShowedAd::firstOrNew(['cohort_id' => $value2->remote_id]);
                        $showed_ads->value += $newuserdata->showed_ads;
                        $showed_ads->save();
                
                $newuserdata->star_group = $value3->starGroup;
                $newuserdata->sessions_played = $value3->sessionsPlayed;
                $newuserdata->days_played = $value3->daysPlayed;
                $newuserdata->first_time = $value3->firsTime;
                $newuserdata->save();
                
                    }



            }

             /*Fill User Data*/
        
                foreach ($allcohorts as $key => $value2) {
                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());

                foreach ($userdata as $key => $value3) {
                $date =  collect($value3->customData)->first();
                $index = collect($value3->customData)->flip()->first();
   
                $newCustomData = CustomData::firstOrNew(['date' => $date]);
                $newCustomData->user_data_id = $value3->id;
                $newCustomData->index = $index;
                $newCustomData->save();
$userdataarray[] = $value3;

                    }       
            }


         /*Fill Players */ 

        $playersresponse = $client->request('GET', '/api/Accounts/AllUsers');
        $players = json_decode($playersresponse->getBody()->getContents());

        foreach ($players as $player => $value) {

        $newplayer = Player::firstOrNew(['email' => $value->email]);
        $newplayer->username = $value->username;
        $newplayer->email = $value->email;
        $newplayer->save();

        
        }

        /*Fill Custom Keys */ 
        $analyticurl = '/api/AeriaCustomKeys/AllKeys/';

        $localanalytics = Analytic::all();

        foreach ($localanalytics as $analytic => $value) {

        $keyresponse = $client->request('GET', $analyticurl.$value->remote_id);
        $keys = json_decode($keyresponse->getBody()->getContents());

                foreach ($keys as $key => $value2) {

                $newkey = CustomKey::firstOrNew(['remote_id' => $value2->id]);
                $newkey->remote_id = $value2->id;
                $newkey->name = $value2->name;
                $newkey->analytic_id = $value2->aid;
                $newkey->save();
                    }    
        }


      /* Fill Level Interfaces */ 
        $allworlds = World::all();

        foreach ($allworlds as $analytic => $value) {

        $interfacesresponse = $client->request('GET', '/api/AeriaLevelInterfaces/GetAllPerWorld/'.$value->remote_id);
        $levelinterfaces = json_decode($interfacesresponse->getBody()->getContents());


                foreach ($levelinterfaces as $key => $value2) 
                {

                $newlevelInterface = LevelInterface::firstOrNew(['remote_id' => $value2->id]);
                $newlevelInterface->remote_id = $value2->id;
                $newlevelInterface->name = $value2->name;
                $newlevelInterface->original_id = $value2->originalId;
                $newlevelInterface->world_id = $value2->worldID;
                $newlevelInterface->game_id = Game::where('remote_id', $value->game_id)->first()->remote_id;
                $newlevelInterface->date = $value2->date;
                $newlevelInterface->save();
                    
                }    


        }

    

    
          $allleveldifs = LevelDif::all();
        $alllevelinterfaces =  LevelInterface::all();
        $testarray = [];
        LevelProg::truncate();
        foreach ($allleveldifs as $key => $value) {
                    
                foreach ($allcohorts as $key => $value2) {
                    
                    foreach ($alllevelinterfaces as $key => $value3) {
                        
$testurl = $value->remote_id."/".$value2->remote_id.'/'.$value3->remote_id;
$secondinterfacesresponse = $client->request('GET', '/api/user/getcohortprog/'.$value->remote_id."/".$value2->remote_id."/".$value3->remote_id);

        $levelinterfaces = $secondinterfacesresponse->getBody()->getContents();                       
        $interfaces = array($levelinterfaces);
        $interfacescollect = json_decode($levelinterfaces);
           if($levelinterfaces != "{}")
                {
                 
                foreach ($interfacescollect as $key => $value4) {
                $testarray[] = $value4;
                   
        $levelprogdate = Str::substr(Arr::flatten($interfaces)[0], 2 , 10);
                $newLevelProg = new LevelProg;
               
                $newLevelProg->level_dif = $value->remote_id;
                $newLevelProg->cohort_id = $value2->remote_id;
                $newLevelProg->interface_id = $value3->remote_id;
                $newLevelProg->date = $levelprogdate;

                    $index = 1;
                     foreach ($value4 as $key => $value5) {
                        if($index == 1){
                          $newLevelProg->users = $value5;  
                        }
                        
                      if($index == 2){
                          $newLevelProg->stars = $value5;  
                        }
                        
                        $index ++;
                    }


                $newLevelProg->save();
                
                            }
                }
            }
        }
     
    }
   
        return redirect::back()->with('success', 'data resynced Successfully');
    }


 public function create()
    {


        abort_if(Gate::denies('game_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.games.create');
    }

    public function store (Request $request) {
         

            $client = new Client([
                        'base_uri' => env('REMOTE_URL'),
                        'timeout'  => 20.0,
                        'verify' => false

                    ]);
            try { 
            $response = $client->request('POST', '/api/Game/Create', 
                ['json' => 
                    [
                     'name' => $request->name,
                     'appID' => $request->appid,
                     'secret' => $request->secret,
                    ]

                 ]);
        

            $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());

        foreach ($games as $key => $value) {

            $currentgame = Game::where('name',$value->name)->first();
            if (!$currentgame) {
            $game = new Game;
            $game->name = $request->name;
            $game->remote_id = $value->id;
            $game->appid = $value->appID;
            $game->secret = $value->secret;
            $game->api_key = $request->apikey;
            $game->onesignal_id = $request->onesingalid;
            $game->save();

            return redirect::route('admin.games.index')->with('success', 'Game Created Successfully');
            }
            else
            {

            continue;
            }
        }


         
            } 
            catch (Exception $e) {
                
                 return redirect::route('admin.games.index')->with('error', $e);

            }

  
    }

    public function destroy($id){   

    }

    public function update(Request $request, $id){
        $game = Game::find($id);
        $game->update($request->all());

        return redirect()->route('admin.games.index')->with('success', 'App data updated successfully'); 
    }


    public function filterByDate (Request $request){
    
    $gameid = $request->id;
    $game = Game::where('remote_id', $gameid)->first();
    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);
    $cohorts = Cohort::where('gameid', $gameid)->where('status', 1)->get();
    $userdata = Userdata::whereBetween('last_activity',[$start, $end])->get();
    $worlds = World::where('game_id', $gameid)->get();
    $analytics = Analytic::where('game_id', $game->remote_id)->get();
    $customkeys = Analytic::where('game_id', $game->remote_id)->with('customkeys')->get();
    $levelinterfaces = LevelInterface::where('game_id', $game->remote_id)->get();
    $cohortdeaths = CohortDeath::where('game_id', $game->remote_id)->get();


    return view('admin.games.filterdate', compact('game', 'cohorts', 'analytics', 'worlds', 'customkeys', 'userdata', 'levelinterfaces', 'cohortdeaths','start', 'end'));
    
    }


    public function gameSync(){

       Log::info("Games Synced Start"); 
        $client = new Client([
        'base_uri' => env('REMOTE_URL'),
        'timeout'  => 2.0,
        'verify' => false

        ]);


        $response = $client->request('GET', '/api/game/AllGames');
        $remotegames = json_decode($response->getBody()->getContents());
        if ($remotegames != null) {

            //if there are records in the database we go through them one by one to clone in local db
                foreach ($remotegames as $key => $value) {
                $newgame = Game::firstOrNew(['remote_id' => $value->id]);
                if ( $newgame->exists) {
                    Log::info("Skipping existing game");
                }
                else{
                Log::info("Creating game ".$value->name);
                    $newgame->remote_id = $value->id;
                    $newgame->name = $value->name;
                    $newgame->appid = $value->appID;
                    $newgame->save();
                    }
                }
            }
                    
        Log::info("Games Synced Successfully"); 
        $this->worldSync();

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
