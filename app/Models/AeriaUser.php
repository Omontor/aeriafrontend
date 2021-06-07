<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeriaUser extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    public $table = 'aspnetusers';    



    public function gamedata()
    {
        return $this->hasMany(UserGameData::class);
    }
}
