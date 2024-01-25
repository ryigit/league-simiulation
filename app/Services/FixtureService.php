<?php

namespace App\Services;

use Illuminate\Support\Collection;

class FixtureService
{
    protected Collection $teams;

    public function __construct(Collection $teams)
    {
        $this->teams = $teams;
        $this->teams->shuffle();
    }

    public function createFixtures(): array
    {
        $matches = [];

        $teamCount = count($this->teams);
        $weekCount = 2 * (count($this->teams) - 1);

        for ($week = 1; $week <= $weekCount; $week++) {
            for ($i = 0; $i < $teamCount/2; $i++) {
                $homeTeam = $this->teams[$i];
                $awayTeam = $this->teams[$teamCount - 1 - $i];

                if ($week % 2 === 0) {
                    $matches[] = [
                        'home_team_id' => $homeTeam->id,
                        'away_team_id' => $awayTeam->id,
                        'week' => $week,
                    ];
                } else {
                    $matches[] = [
                        'home_team_id' => $awayTeam->id,
                        'away_team_id' => $homeTeam->id,
                        'week' => $week,
                    ];
                }
            }

            $temp = $this->teams->pop();
            $this->teams->splice(1, 0, [$temp]);
        }

        return $matches;
    }

}
