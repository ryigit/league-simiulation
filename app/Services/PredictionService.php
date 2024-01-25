<?php

namespace App\Services;

use App\Models\Team;
use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;

class PredictionService
{
    public function __construct(
        public GameRepository $gameRepository,
        public TeamRepository $teamRepository,
    ){}
    public function calculateChances()
    {
        $teams = $this->teamRepository->getTeamsByPoint();

        $totalPower = $teams->sum('power');
        $topPoint = $teams->first()->point;
        $secondTopPoint = $teams->skip(1)->first()->point;

        $weekCount = 2 * (count($teams) - 1);

        $nextWeek = $this->gameRepository->getNextWeek();

        $nextWeekId = $nextWeek ? $nextWeek->week : $weekCount + 1;

        $availablePoints = 3 * ($weekCount - $nextWeekId + 1);

        return $teams->each(function ($team) use ($totalPower, $topPoint, $availablePoints, $secondTopPoint) {
            $team->chance = round($this->calculateTeamChance($team, $totalPower, $topPoint, $availablePoints, $secondTopPoint), 2);
        })->sortByDesc('chance');

    }

    private function calculateTeamChance(Team $team, float $totalPower, int $topPoint, int $availablePoints, int $secondTopPoint)
    {
        //There is no mathematical chance for championship
        if ($availablePoints + $team->point < $topPoint) {
            return 0;
        }

        //Team mathematically won the league
        if ($availablePoints + $secondTopPoint < $team->point) {
            return 100;
        }

        return max(($team->power / max($totalPower, 1)) * 100, 0);
    }

    public function predictMatchResult(Team $home, Team $away): array
    {
        [$homeDominance, $awayDominance] = $this->getRelativePower($home->power, $away->power);

        $homeScore = intval(ceil((rand(0, rand(1, 3))) + (($homeDominance - $awayDominance) / 100)));
        $awayScore = intval(ceil((rand(0, rand(1, 3))) + (($awayDominance - $homeDominance) / 100)));

        return [
            'home_goals' => max($homeScore, 0),
            'away_goals' => max($awayScore, 0),
        ];
    }

    private function getRelativePower(float $homeStrength, float $awayStrength): array
    {
        $total = max($homeStrength + $awayStrength, 1);

        return [
            $homeStrength / $total,
            $awayStrength / $total,
        ];
    }

}
