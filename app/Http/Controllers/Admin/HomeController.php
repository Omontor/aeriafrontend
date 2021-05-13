<?php

namespace App\Http\Controllers\Admin;
//Import these lines in every controller that uses API
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class HomeController
{
    public function index()
    {
    	$httpgames = Http::withoutVerifying()->get('https://localhost:5001/api/Game/AllGames', ['verify' => false]);
        $games = $httpgames->json([]);
        $gamescount = count($games);


        $httpusers = Http::withoutVerifying()->get('https://localhost:5001/api/Accounts/AllUsers', ['verify' => false]);
        $users = $httpusers->json([]);
        $userscount = count($users);

        return view('home', compact('games', 'gamescount', 'users', 'userscount'));
    }
}
