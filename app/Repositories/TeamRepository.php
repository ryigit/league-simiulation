<?php

namespace App\Repositories;

use App\Models\Team;
use Illuminate\Support\Collection;

class TeamRepository
{
    public function getTeams(): Collection
    {
        return Team::all();
    }

    public function getTeamsByPoint(): Collection
    {
        return Team::orderByDesc('point')->get();
    }

    public function resetTeams(): void
    {
        $this->getTeams()->each(fn(Team $team) => $team->update([
            'point' => 0,
            'win' => 0,
            'loss' => 0,
            'draw' => 0,
            'goal_difference' => 0,
        ]));
    }
}
