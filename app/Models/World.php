<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class World extends Model
{

    protected $guarded = [];
       public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id', 'remote_id');
    }

    public function levels(){

         return $this->hasMany('App\Models\Level', 'world_id', 'remote_id');
    }
    
}
