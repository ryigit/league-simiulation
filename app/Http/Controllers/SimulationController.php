<?php

namespace App\Http\Controllers;

use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
use App\Services\PredictionService;
use App\Services\SimulationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SimulationController extends Controller
{
    public function __construct(
        public SimulationService $simulationService,
        public PredictionService $predictionService,
        public GameRepository $gameRepository,
        public TeamRepository $teamRepository,
    ){}
    public function index(): View
    {
        $teams = $this->teamRepository->getTeams();

        $weekGames = $this->gameRepository->getNextWeekGames();

        $predictions = $this->predictionService->calculateChances();

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
        $nextWeek = $this->gameRepository->getNextWeek();

        if(!$nextWeek) {
            return redirect()->back()->with('warning', 'League Already Ended');
        }

        $this->simulationService->simulateWeek($nextWeek->week);

        return redirect()->back()->with('success', 'Simulated');
    }

    public function simulateAllWeeks(): RedirectResponse
    {
        $weekCount = $this->gameRepository->getWeekCount();

        for ($w = 1; $w <= $weekCount; $w++) {
            $this->simulationService->simulateWeek($w);
        }

        return redirect()->back()->with('success', 'Simulated');
    }
}
