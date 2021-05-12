<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class World extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'worlds';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'game_id',
        'name',
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
