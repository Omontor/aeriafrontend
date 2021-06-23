<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

        public function cohorts()
    {
        return $this->hasMany('App\Models\Cohort', 'gameid', 'remote_id');
    }

    public function analytics()
    {
        return $this->hasMany('App\Models\Analytic', 'game_id', 'remote_id');
    }

}
