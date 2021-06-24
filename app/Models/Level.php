<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{


  public function world()
    {
        return $this->belongsTo('\App\Models\World','WorldID');
    }
   
}
