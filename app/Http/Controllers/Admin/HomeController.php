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
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
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
         /* Fill Games*/
                $this->FillGames();
            /* Fill Worlds*/
                $this->fillWorlds();
            /*Fill Analytics */ 
                $this->fillAnalytics();
            /* Fill Cohorts  */
                $this->fillCohorts();
       
        $games = Game::All();
        $gamescount = $games->count();
        $users = Player::all();
        $userscount= $users->count();
        $cohorts = Cohort::count();
        $records= UserData::count();

        $todaydate = Carbon::today()->format('Y-m-d')."T00:00:00";
        $today =     UserData::where('last_activity', $todaydate);

        $today1date = Carbon::today()->subDays(1)->format('Y-m-d')."T00:00:00";
        $today1 =    UserData::where('last_activity', $today1date);

        $today2date = Carbon::today()->subDays(2)->format('Y-m-d')."T00:00:00";
        $today2 =    UserData::where('last_activity', $today2date);      

        $today3date = Carbon::today()->subDays(3)->format('Y-m-d')."T00:00:00";
        $today3 =    UserData::where('last_activity', $today3date);        

        $today4date = Carbon::today()->subDays(4)->format('Y-m-d')."T00:00:00";
        $today4 =    UserData::where('last_activity', $today4date);

        $today5date = Carbon::today()->subDays(5)->format('Y-m-d')."T00:00:00";
        $today5 =    UserData::where('last_activity', $today5date);        

        $today6date = Carbon::today()->subDays(6)->format('Y-m-d')."T00:00:00";
        $today6 =    UserData::where('last_activity', $today6date);

        $today7date = Carbon::today()->subDays(7)->format('Y-m-d')."T00:00:00";
        $today7 =    UserData::where('last_activity', $today7date);

        return view('home', compact('games', 'gamescount', 'users', 'userscount', 'today', 'today1', 'today2', 'today3', 'today4','today5', 'today6', 'today7', 'cohorts', 'records'));
    }


public function ResyncData()

{                      
    $client = new Client([
    'base_uri' => env('REMOTE_URL'),
    'verify' => false

]);
                $pool = Pool::create();
                $pool2 = Pool::create();

              /*Fill User Data*/
        
                foreach (Cohort::all() as $key => $value2) {


$pool2->add(function () use ($value2) {
                
                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());
                $userdataarray = [];



                foreach ($userdata as $key => $value3) {

                $pool->add(function () use ($value3) {

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


       
                $date =  collect($value3->customData)->first();
                $index = collect($value3->customData)->flip()->first();

                 $newCustomData = CustomData::where('date',$date)->first();
                 if (!$newCustomData) {
                     $newCustomData = new CustomData;
                     $newCustomData->date = $date;
                $newCustomData->user_data_id = $value3->id;
                $newCustomData->index = $index;
                $newCustomData->save();
}

                    })->then(function ($output) {
                        
                    })->catch(function (Throwable $exception) {
                        // Handle exception
                    });


                
                    }

                $pool->wait();
    })->then(function ($output) {
      
    })->catch(function (Throwable $exception) {
        // Handle exception
    });



            }
$pool2->wait();
    /*Fill Players */ 
                $this->FillPlayers();
            /*Fill Custom Keys */ 
                $this->fillCustomKeys();
            /* Fill Level Interfaces */ 
                $this->fillLevelInterfaces();
  return redirect()->back()->withSuccess('Success');               

}


public function secondsync (){


               /*Fill Level Progression*/
             $this->fillLevelProgression();

 return redirect()->back()->withSuccess('Level progression synced');
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

    public function FillUserData()

    {

        $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);

    $pool = Pool::create();
    $pool2 = Pool::create();


        $allcohorts = Cohort::all();
                foreach ($allcohorts as $key => $value2) {

                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());

                foreach ($userdata as $key => $value3) {

                 
                     $pool2->add(function () use ($value3) {


               

                $newworld = UserData::firstOrNew(['remote_id' => $value3->id]);

       
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
dd($newuserdata);    

       
                $date =  collect($value3->customData)->first();
                $index = collect($value3->customData)->flip()->first();

                 $newCustomData = CustomData::where('date',$date)->first();
                 if (!$newCustomData) {
                     $newCustomData = new CustomData;
                     $newCustomData->date = $date;
                $newCustomData->user_data_id = $value3->id;
                $newCustomData->index = $index;
                $newCustomData->save();

                 }

            
                    })->then(function ($output) {
                        // Handle success
                    })->catch(function (Throwable $exception) {
                        // Handle exception
                    });   



        }
        $pool2->wait();
                  
    }


    return redirect()->back()->withSuccess('Success');
  
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

 /*TODO EXTRACT THIS LOOPS TO COHORTS AND INTERFACES IN ORDER TO GET RID OF THIS FUNCTION*/

    public function fillLevelProgression(){
                      $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'verify' => false

        ]);
           $allleveldifs = LevelDif::all();
        $alllevelinterfaces =  LevelInterface::all();
        $testarray = [];
        $allcohorts = Cohort::all();
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
               
                /* end async operation*/
                    }
                     $pool->wait();
                }
            }
        }
    
    }
}

   
}
