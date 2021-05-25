<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelInterface extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    public $table = 'aeria_levelinterface';
}
