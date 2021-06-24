<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;

    
    protected $guarded = [];


    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'id');
    }

    public function userdata()
    {
      return $this->hasMany('App\Models\UserData', 'cohort_id', 'remote_id');
    }
}
