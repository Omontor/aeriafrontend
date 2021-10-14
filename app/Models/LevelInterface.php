<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelInterface extends Model
{
    use HasFactory;
    protected $guarded = [];

      public function world()

    { 
        return $this->belongsTo('\App\Models\World','world_id', 'remote_id');
    }
   
}
