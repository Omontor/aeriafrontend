<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;
    protected $guarded = [];

       public function cohort()
    {
        return $this->belongsTo('App\Models\Cohort', 'cohort_id', 'remote_id');
    }
}
