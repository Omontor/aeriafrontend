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

         return redirect()->route('admin.notifications.index')->with('error','This game does not have OneSignal configuration');
    }
    else{

    }

    try {
        $content = ["en" => $request->message];
        $fields = [
            'app_id' => $game->onesignal_id,
            'included_segments' => ['All'],
            'contents' => ['en' => $request->message],
            'large_icon' => '',
//            'url' => $request->link,
            'headings' => ['en' => $request->title],
            //'subtitle' => ['en' => $request->title]
        ];

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' .$game->api_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($response);

        if ($httpcode == 200) {
            if (true) {
                $request->session()->flash('status', true);
                
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->content = $request->message;
        $notification->game_id = $request->game;
        $notification->save();
        return redirect()->route('admin.notifications.index')->with('success','Notification Sent Successfuly');
            } else {
                dd($response);
           return redirect()->route('admin.notifications.index')->with('error', 'OneSignal error, please try again later');
            }
        }
        else
        {
            dd($response);
           return redirect()->route('admin.notifications.index')->with('error', 'OneSignal error, please try again later 2'); 
        }


    } catch (Exception $e) {
        

    return redirect()->route('admin.notifications.index')->with('error', $e);
    }


   }

}
