<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\StoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);





Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('Ticket', TicketController::class);
    Route::resource('Influencer', InfluencerController::class);
    Route::resource('Service', ServiceController::class);
    Route::resource('Story', StoryController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

