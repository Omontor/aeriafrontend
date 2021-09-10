<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id','remote_id');
    }
}
