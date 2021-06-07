<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCohort extends Model
{
    use HasFactory;
     protected $connection = 'mysql2';
    public $table = 'aeria_cohortuser';


        public function user()
    {
        return $this->belongsTo('\App\Models\AeriaUser','Id');
    }
}
