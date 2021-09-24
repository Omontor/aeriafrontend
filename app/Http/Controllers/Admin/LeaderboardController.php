<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;

class LeaderboardController extends Controller
{
    public function index () {

        $games = Game::all();
        return view('admin.leaderboards.index', compact('games'));
    }
}
