<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Game;

class NotificationController extends Controller
{
   public function index(){

    $notifications = Notification::all();
    return view('admin.notifications.index', compact('notifications'));

   }

   public function create(){


    $games= Game::all();
    return view('admin.notifications.create', compact('games'));

   }

   public function store(Request $request){

    $game = Game::where('remote_id', $request->game)->first();

    if ($game->onesignal_id == null) {

         return redirect()->route('admin.notifications.index')->with('error','This game does not have a One Signal ID registered');
    }
    else{

    }

    try {

        $notification = new Notification;
        $notification->title = $request->title;
        $notification->content = $request->message;
        $notification->game_id = $request->game;
        $notification->save();
        return redirect()->route('admin.notifications.index')->with('success','Notification Sent Successfuly');

    } catch (Exception $e) {
        

    return redirect()->route('admin.notifications.index')->with('error', $e);
    }


   }

}
