<?php

use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/start', [LeagueController::class, 'start']);

Route::post('/fixture/generate', [LeagueController::class, 'generateFixture'])->name('fixture.generate');
Route::get('/fixture/show', [LeagueController::class, 'showFixture'])->name('fixture.show');

Route::get('/simulation', [SimulationController::class, 'index'])->name('simulation.index');
Route::post('/simulation/next_week', [SimulationController::class, 'simulateNextWeek'])->name('simulation.simulateNextWeek');
Route::post('/simulation/all', [SimulationController::class, 'simulateAllWeeks'])->name('simulation.simulateAllWeeks');
