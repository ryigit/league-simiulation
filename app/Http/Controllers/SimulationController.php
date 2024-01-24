<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Services\PredictionService;
use App\Services\SimulationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SimulationController extends Controller
{
    public function index(): View
    {
        $teams = Team::all();
        $week = Game::where('is_played', 0)->first();
        $weekGames = Game::where('week', $week->week)->get();

        $predictionService = new PredictionService();

        $predictions = $predictionService->calculateChances();

        return view('simulation',
            [
                'teams' => $teams,
                'weekGames' => $weekGames,
                'predictions' => $predictions,
            ]
        );
    }

    public function simulateNextWeek(): RedirectResponse
    {
        $nextWeek = Game::where('is_played', 0)->first();

        $simulationService = new SimulationService();

        $simulationService->simulateWeek($nextWeek->week);

        return redirect()->back()->with('success', 'Simulated');
    }

    public function simulateAllWeeks(): RedirectResponse
    {
        $weekCount = Game::max('week');
        $simulationService = new SimulationService();

        for ($w = 1; $w <= $weekCount; $w++) {
            $simulationService->simulateWeek($w);
        }

        return redirect()->back()->with('success', 'Simulated');
    }
}
