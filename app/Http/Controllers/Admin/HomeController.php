<?php

namespace App\Http\Controllers\Admin;
//Import these lines in every controller that uses API
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Game;
use App\Models\Cohort;
use App\Models\Analytic;
use App\Models\CustomKey;
use App\Models\CohortDeath;
use App\Models\World;
use App\Models\Player;
use App\Models\UserData;
use App\Models\CustomData;
use App\Models\LevelInterface;
use App\Models\LevelProg;
use App\Models\LevelDif;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\ShowedAd;
use App\Models\WatchedAd;
use Spatie\Async\Pool;
class HomeController
{
        private $client;

        public function __construct(){
                $this->client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
        }


 public function index()
    {
    /* Fill information */

       $this->client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
            /* Fill Games*/
                $this->FillGames();
            /* Fill Worlds*/
                $this->fillWorlds();
            /*Fill Analytics */ 
                $this->fillAnalytics();
            /* Fill Cohorts  */
                $this->fillCohorts();
            /*Fill User Data*/
                $this->FillUserData();
            /*Fill Players */ 
                $this->FillPlayers();
            /*Fill Custom Keys */ 
                $this->fillCustomKeys();
            /* Fill Level Interfaces */ 
                $this->fillLevelInterfaces();


/*Heavy load starts here*/

        /*Fill Level Progression*/
     /*  $this->fillLevelProgression();*/


       
        $games = Game::All();
        $gamescount = $games->count();
        $users = Player::all();
        $userscount= $users->count();



        return view('home', compact('games', 'gamescount', 'users', 'userscount'));
    }


public function fillDeaths (){

     $postclient = new Client([
                        'base_uri' => env('REMOTE_URL'),
                        'timeout'  => 40.0,
                        'verify' => false
                    ]);


$pool = Pool::create();

            try { 
                $testdeaths = [];
      foreach ($allgames as $analytic => $value) {


                foreach ($allcohorts as $key => $value2) {
                   
            $deathsresponse = $client->request('POST', '/api/AnalyticsLevel/FilteredByCohort/'.$value2->remote_id."/".$value->remote_id, 
                ['json' => 
                    [
                   "filterMethod"=> 0,
                            
                            "customKey"=> 114,
                            "gameId"=> $value->remote_id,
                            "userId"=> "none",
                            "levelId"=> "0",
                            "bvc"=> 0,
                            "analyticId"=> 24,
                            "startDate"=> "1988-01-01T00:00:00",
                            "endDate"=> "2022-01-01T00:00:00"
                    ]

                 ]);

                    $alldeaths = json_decode($deathsresponse->getBody()->getContents());

                           foreach ($alldeaths as $key => $value3) 
                        {

                            $testdeaths[] = $value3;





                                           
            $newDeath = CohortDeath::find('date', $value3->creationDate)->first();

            if (!$newDeath) {
               $pool->add(function () use ($value3) {

                $newDeath = new CohortDeath;
           $newDeath->cohort_id = $value2->remote_id;
           $newDeath->game_id = $value->remote_id;
           $newDeath->level_id = 0;
           $newDeath->value = $value3->value;
           $newDeath->date = $value3->creationDate;
           $newDeath->entry = $value3->entry;
           $newDeath->save();
    })->then(function ($output) {
        // Handle success
    })->catch(function (Throwable $exception) {
        // Handle exception
    });
            }

            else
            {
                return;
            }

           
                        }  
                    }
                }  
            } 
              catch (Exception $e) {
                
                //this is an error

            }
}



    public function FillGames() {

              $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());
        foreach ($games as $game => $value) {
        $newgame = Game::firstOrNew(['remote_id' => $value->id]);
           $newgame->name = $value->name;
           $newgame->remote_id = $value->id;
           $newgame->appid = $value->appID;
           $newgame->secret = $value->secret;
           $newgame->save();
           }
    }

    public function fillWorlds() {
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());
        foreach ($games as $game => $value) {

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


    }

    public function fillAnalytics (){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
        $allgames = Game::all();
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
        }
    }

    public function fillCohorts (){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
        $allgames = Game::all();
    foreach ($allgames as $key => $value) {
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
    }

    public function FillUserData(){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
        $allcohorts = Cohort::all();
        $pool = Pool::create();

                foreach ($allcohorts as $key => $value2) {
                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());

                foreach ($userdata as $key => $value3) {
 $newuserdata = UserData::where('remote_id', $value3->id)->first();

                if (!$newuserdata) {
    $pool->add(function () use ($value3) {
   

               
                $newuserdata = new UserData;
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


       
                $date =  collect($value3->customData)->first();
                $index = collect($value3->customData)->flip()->first();

                 $newCustomData = CustomData::where('date',$date)->first();
                 if (!$newCustomData) {
                     $newCustomData = new CustomData;
                $newCustomData->user_data_id = $value3->id;
                $newCustomData->index = $index;
                $newCustomData->save();
                 }
                 else
                 {
                    return;
                 }
               



    })->then(function ($output) {
             
    })->catch(function (Throwable $exception) {
        dd($exception);
    });
                    }
                else
                {
                    return;
                }


                    } 

$pool->wait();

            }
    }

    public function FillPlayers (){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);

        $playersresponse = $client->request('GET', '/api/Accounts/AllUsers');
        $players = json_decode($playersresponse->getBody()->getContents());
        foreach ($players as $player => $value) {
        $newplayer = Player::firstOrNew(['email' => $value->email]);
        $newplayer->username = $value->username;
        $newplayer->email = $value->email;
        $newplayer->save();
        }  
    }


    public function fillCustomKeys () {
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
$localanalytics = Analytic::all();
        foreach ($localanalytics as $analytic => $value) {
        $keyresponse = $client->request('GET', "/api/AeriaCustomKeys/AllKeys/".$value->remote_id);
        $keys = json_decode($keyresponse->getBody()->getContents());
                foreach ($keys as $key => $value2) {
                $newkey = CustomKey::firstOrNew(['remote_id' => $value2->id]);
                $newkey->remote_id = $value2->id;
                $newkey->name = $value2->name;
                $newkey->analytic_id = $value2->aid;
                $newkey->save();
                    }    
        }
    }


    public function fillLevelInterfaces(){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
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
    }

    public function fillLevelProgression(){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
           $allleveldifs = LevelDif::all();
        $alllevelinterfaces =  LevelInterface::all();
        $testarray = [];
        $allcohorts = Cohort::all();
    /*Create async pool*/
    $pool = Pool::create();

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

                    /*async operation*/
                    $pool->add(function () use ($value4) {
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
                        })->then(function ($output) {
                          
                        })->catch(function (Throwable $exception) {
                            // Handle exception
                        });
                $pool->wait();
                /* end async operation*/
                    }
                }
            }
        }
    
    }
}

   
}
