<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Support\Collection;

class GameRepository
{
    public function getAllGames(): Collection
    {
        return Game::all();
    }
    public function getNextWeekGames(): Collection
    {
        $week = $this->getNextWeek();

        if($week) {
            return Game::where('week', $week->week)->get();
        }

        return collect();
    }

    public function getWeekGames(int $weekId): ?Collection
    {
        return Game::where('week', $weekId)->get();
    }

    public function getNextWeek(): ?Game
    {
        return Game::where('is_played', 0)->first();
    }

    public function getWeekCount(): int
    {
        return Game::max('week');
    }

    public function createGame(array $gameData)
    {
        Game::create($gameData);
    }

    public function resetGames(): void
    {
        Game::truncate();
    }
}
