<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    public function homeGames(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id')->orderBy('week');
    }

    public function awayGames(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id')->orderBy('week');
    }
}
