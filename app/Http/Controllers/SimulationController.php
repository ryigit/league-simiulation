<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Services\PredictionService;
use Illuminate\Contracts\View\View;

class SimulationController extends Controller
{
    public function index(): View
    {
        $teams = Team::all();
        $week = Game::where('is_played', 0)->first();
        $weekGames = Game::where('week', $week->week)->get();

        $predictionService = new PredictionService($teams);

        $predictions = $predictionService->calculateChances();

        return view('simulation',
            [
                'teams' => $teams,
                'weekGames' => $weekGames,
                'predictions' => $predictions,
            ]
        );
    }
}
