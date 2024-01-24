<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Collection;

class PredictionService
{
    protected Collection $teams;
    public function __construct(Collection $teams)
    {
        $this->teams = $teams;
        $this->teams->shuffle();
    }

    public function calculateChances()
    {
        $teams = Team::orderBy('point')->get();

        $totalPower = $teams->sum('power');

        return $teams->each(function ($team) use ($totalPower) {
            $team->chance = max(($team->power / max($totalPower, 1)) * 100, 0);
        })->sortByDesc('chance');

    }

}
