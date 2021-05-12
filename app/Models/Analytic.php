<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Analytic extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'analytics';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bvc',
        'game_id',
        'entry',
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
