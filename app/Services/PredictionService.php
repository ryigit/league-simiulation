<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class PredictionService
{
    public function calculateChances()
    {
        $teams = Team::orderByDesc('point')->get();

        $totalPower = $teams->sum('power');
        $topPoint = $teams->first()->point;

        $weekCount = 2 * (count($teams) - 1);

        $nextWeek = Game::where('is_played', 0)->first();

        $nextWeekId = $nextWeek ? $nextWeek->week : $weekCount + 1;

        $availablePoints = 3 * ($weekCount - $nextWeekId + 1);

        return $teams->each(function ($team) use ($totalPower, $topPoint, $availablePoints) {
            $team->chance = round($this->calculateTeamChance($team, $totalPower, $topPoint, $availablePoints), 2);
        })->sortByDesc('chance');

    }

    private function calculateTeamChance(Team $team, $totalPower, $topPoint, $availablePoints)
    {
        Log::info('Calculating Chance For:' . $team->id);

        //There is no mathematical chance for championship
        if ($availablePoints + $team->point < $topPoint) {
            return 0;
        }

        return max(($team->power / max($totalPower, 1)) * 100, 0);
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
