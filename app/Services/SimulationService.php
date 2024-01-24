<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\Log;

class SimulationService
{
    public function simulateWeek(int $week): void
    {
        $games = Game::where('week', $week)->get();

        $games->each(fn(Game $game) => $this->simulateGame($game));
    }

    private function simulateGame(Game $game): void
    {
        $scores = (new PredictionService())->predictMatchResult($game->homeTeam, $game->awayTeam);

        $game->home_goals = $scores['home_goals'];
        $game->away_goals = $scores['away_goals'];
        $game->is_played = true;
        $game->save();

        $game->awayTeam->goal_difference = $scores['away_goals'] - $scores['home_goals'];
        $game->homeTeam->goal_difference = $scores['home_goals'] - $scores['away_goals'];

        //Home team win
        if($scores['home_goals'] > $scores['away_goals']) {
            $game->homeTeam->win++;
            $game->homeTeam->point+=3;
            $game->homeTeam->save();
        }

        //Away team win
        if($scores['home_goals'] < $scores['away_goals']) {
            $game->awayTeam->win++;
            $game->awayTeam->point+=3;
            $game->awayTeam->save();
        }

        //Draw
        if($scores['home_goals'] === $scores['away_goals']) {
            $game->homeTeam->draw++;
            $game->homeTeam->point++;
            $game->homeTeam->save();

            $game->awayTeam->draw++;
            $game->awayTeam->point++;
            $game->awayTeam->save();
        }

    }
}
