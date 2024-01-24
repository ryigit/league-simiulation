<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PredictionService
{
    public function calculateChances()
    {
        $teams = Team::orderBy('point')->get();

        $totalPower = $teams->sum('power');

        return $teams->each(function ($team) use ($totalPower) {
            $team->chance = max(($team->power / max($totalPower, 1)) * 100, 0);
        })->sortByDesc('chance');

    }

    public function predictMatchResult(Team $home, Team $away): array
    {
        [$homeDominance, $awayDominance] = $this->getDominance($home->power, $away->power);

        Log::info('Home:' . $homeDominance);
        Log::info('Away:' . $awayDominance);

        $homeScore = intval(ceil((rand(0, rand(1, 3))) + (($homeDominance - $awayDominance) / 100)));
        $awayScore = intval(ceil((rand(0, rand(1, 3))) + (($awayDominance - $homeDominance) / 100)));

        return [
            'home_goals' => max($homeScore, 0),
            'away_goals' => max($awayScore, 0),
        ];
    }

    public function getDominance(float $homeStrength, float $awayStrength): array
    {
        $total = max($homeStrength + $awayStrength, 1);

        return [
            $homeStrength / $total,
            $awayStrength / $total,
        ];
    }

}
