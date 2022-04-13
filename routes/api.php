<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/package', [TransactionController::class, 'index']);
    $router->post('/package', [TransactionController::class, 'store']);
    $router->get('/package/{id}', [TransactionController::class, 'detail']);
    $router->delete('/package/{id}', [TransactionController::class, 'delete']);
    $router->put('/package/{id}', [TransactionController::class, 'update']);
    $router->patch('/package/{id}', [TransactionController::class, 'patch']);
});

