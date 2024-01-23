<?php

namespace App\Http\Controllers;

use App\Models\Team;

class LeagueController extends Controller
{
    public function start()
    {
        $teams = Team::all();

        return view('start', ['teams' => $teams]);
    }
}
