<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{

    protected $connection = 'mysql2';
    public $table = 'aeria_level';

  public function world()
    {
        return $this->belongsTo('\App\Models\World','WorldID');
    }
   
}
