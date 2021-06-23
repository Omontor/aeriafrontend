<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    use HasFactory;
    protected $guarded = [];

        public function customkeys()
    {
      return $this->hasMany('App\Models\CustomKey', 'analytic_id', 'remote_id');
    }
}
