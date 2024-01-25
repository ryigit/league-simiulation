<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'point',
        'win',
        'loss',
        'draw',
        'goal_difference',
    ];

    protected $appends = [
        'power',
    ];

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id')->orderBy('week');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id')->orderBy('week');
    }

    protected function power(): Attribute
    {
        return new Attribute(get: fn() => max(
            $this->point + $this->goal_difference/2, 1
        ));
    }
}
