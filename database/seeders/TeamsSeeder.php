<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = config('league.teams') ?? [
            ['name' => 'Liverpool'],
            ['name' => 'Manchester City'],
            ['name' => 'Chelsea'],
            ['name' => 'Arsenal'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
