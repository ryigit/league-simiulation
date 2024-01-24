<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Services\FixtureService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LeagueController extends Controller
{
    public function start(): View
    {
        $teams = Team::all();

        return view('start', ['teams' => $teams]);
    }

    public function generateFixture(): RedirectResponse
    {
        $teams = Team::all();

        $fixtureService = new FixtureService($teams);

        $matches = $fixtureService->createFixtures();

        foreach ($matches as $match) {
            Game::create([
                'home_team_id' => $match['away_team_id'],
                'away_team_id' => $match['home_team_id'],
                'week' => $match['week'],
            ]);
        }

        return redirect()->route('fixture.show');
    }

    public function showFixture(): View
    {
        $weeks = Game::all()->groupBy('week');

        return view('fixture', ['weeks' => $weeks]);
    }
}
