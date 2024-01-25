<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
use App\Services\FixtureService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LeagueController extends Controller
{
    public function __construct(
        public TeamRepository $teamRepository,
        public GameRepository $gameRepository,
    ){}

    public function start(): View
    {
        $teams = $this->teamRepository->getTeams();

        return view('start', ['teams' => $teams]);
    }

    public function generateFixture(): RedirectResponse
    {
        $teams = $this->teamRepository->getTeams();

        $fixtureService = new FixtureService($teams);

        $matches = $fixtureService->createFixtures();

        foreach ($matches as $match) {
            $this->gameRepository->createGame(
                [
                    'home_team_id' => $match['away_team_id'],
                    'away_team_id' => $match['home_team_id'],
                    'week' => $match['week'],
                ]
            );
        }

        return redirect()->route('fixture.show');
    }

    public function showFixture(): View
    {
        $weeks = $this->gameRepository->getAllGames()->groupBy('week');

        return view('fixture', ['weeks' => $weeks]);
    }

    public function reset(): RedirectResponse
    {
        $this->gameRepository->resetGames();

        $this->teamRepository->resetTeams();

        return redirect()->route('start');
    }
}
