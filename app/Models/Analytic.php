<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    public $table = 'aeria_analytics';

    public function game(){

    	  return $this->belongsTo(Game::class);
    }
}
