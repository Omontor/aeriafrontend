<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;
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
        $response =$response = Http::withoutVerifying()->get('https://localhost:5001/api/Game/AllGames', ['verify' => false]);
        //Turn response into array
        $games = $response->json([]);
        return view('admin.games.index', compact('games'));
    }

    public function view($index) {

        $game = $index;
        $gameid = $index;

        //Connecting to API
        $client = new Client([
            'base_uri' => env('API_URL'),
            'timeout'  => 2.0,
        ]);
        $response =$response = Http::withoutVerifying()->get('https://localhost:5001/api/AeriaMessages', ['verify' => false]);
        //Turn response into array
        $messages = $response->json([]);


        return view('admin.games.show', compact('gameid', 'messages'));
    }

}
