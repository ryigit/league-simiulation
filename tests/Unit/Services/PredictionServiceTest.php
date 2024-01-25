<?php

namespace Tests\Unit\Services;

use App\Models\Game;
use App\Models\Team;
use App\Repositories\GameRepository;
use App\Repositories\TeamRepository;
use App\Services\PredictionService;
use Mockery\MockInterface;
use Tests\TestCase;

class PredictionServiceTest extends TestCase
{
    public function testCalculateChancesBeforeFirstMatch()
    {
        $teams = Team::factory()->count(2)->make([
            'point' => 0,
        ]);

        $mockTeamRepository = $this->mock(TeamRepository::class, function (MockInterface $mock) use ($teams) {
            $mock->shouldReceive('getTeamsByPoint')->once()->andReturn($teams);
        });

        $game = Game::factory()->make();

        $mockGameRepository = $this->mock(GameRepository::class, function (MockInterface $mock) use ($game) {
            $mock->shouldReceive('getNextWeek')->once()->andReturn($game);
        });

        $predictionService = new PredictionService($mockGameRepository, $mockTeamRepository);

        $result = $predictionService->calculateChances();

        foreach ($result as $team){
            $this->assertEquals(50, $team->chance);
        }
    }

    public function testCalculateChancesForDifferentPoints()
    {
        $teams = collect();

        $team1 = Team::factory()->make([
            'point' => 6,
        ]);
        $teams->push($team1);

        $team2 = Team::factory()->make([
            'point' => 0,
        ]);
        $teams->push($team2);

        $mockTeamRepository = $this->mock(TeamRepository::class, function (MockInterface $mock) use ($teams) {
            $mock->shouldReceive('getTeamsByPoint')->once()->andReturn($teams);
        });

        $game = Game::factory()->make();

        $mockGameRepository = $this->mock(GameRepository::class, function (MockInterface $mock) use ($game) {
            $mock->shouldReceive('getNextWeek')->once()->andReturn($game);
        });

        $predictionService = new PredictionService($mockGameRepository, $mockTeamRepository);

        $result = $predictionService->calculateChances();

        $result->toArray();
        $this->assertTrue($result[0]->chance > $result[1]->chance);

    }
}
