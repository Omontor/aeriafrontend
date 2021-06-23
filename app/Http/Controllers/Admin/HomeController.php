<?php

namespace App\Http\Controllers\Admin;
//Import these lines in every controller that uses API
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Game;
use App\Models\Cohort;
use App\Models\Analytic;
use App\Models\CustomKey;
use App\Models\World;
use App\Models\Player;
use App\Models\UserData;


class HomeController
{
    public function index()
    {
    	$httpgames = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Game/AllGames', ['verify' => false]);
        $games = $httpgames->json([]);
        $gamescount = count($games);

        $httpusers = Http::withoutVerifying()->get(env('REMOTE_URL').'/api/Accounts/AllUsers', ['verify' => false]);
        $users = $httpusers->json([]);
        $userscount = count($users);


        /* Fill information */


        $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
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

        /* Fill Cohorts  */


        $url = "/api/Game/GetCohorts/".$value->id;   
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

        $allcohorts = Cohort::all();

              /*Fill User Data*/
        
                foreach ($allcohorts as $key => $value2) {
                $userdataresponse = $client->request('GET', '/api/user/GetAllUserData/'.$value2->remote_id);
                $userdata = json_decode($userdataresponse->getBody()->getContents());
     
                foreach ($userdata as $key => $value3) {

                $newuserdata = UserData::firstOrNew(['remote_id' => $value3->id]);
                $newuserdata->cohort_id = $value2->remote_id;
                $newuserdata->remote_id = $value3->id;
                $newuserdata->platform = $value3->platform;
                $newuserdata->last_activity = $value3->lastActivity;
                $newuserdata->days_playing = $value3->daysPlaying;
                $newuserdata->iap = $value3->iap;
                $newuserdata->watched_ads = $value3->watchedAds;
                $newuserdata->showed_ads = $value3->showedAds;
                $newuserdata->star_group = $value3->starGroup;
                $newuserdata->sessions_played = $value3->sessionsPlayed;
                $newuserdata->days_played = $value3->daysPlayed;
                $newuserdata->first_time = $value3->firsTime;
                $newuserdata->save();



                    }
                
            }



        /*Fill Analytics */ 

        $analyticresponse = $client->request('GET', '/api/aeriaanalytics/AllAnalytics');
        $analytics = json_decode($analyticresponse->getBody()->getContents());

        foreach ($analytics as $analytic => $value) {

        $newanalytic = Analytic::firstOrNew(['remote_id' => $value->id]);

        $newanalytic->remote_id = $value->id;
        $newanalytic->name = $value->name;
        $newanalytic->save();
        
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


      



        return view('home', compact('games', 'gamescount', 'users', 'userscount'));
    }
}
