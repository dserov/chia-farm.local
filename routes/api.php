<?php

use App\Http\Controllers\Api\HostController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [ApiController::class, 'login'])->name('api::login');

Route::group([
    'middleware' => ['auth:sanctum'],
], function (){
    Route::post('/logout', [ApiController::class, 'logout'])->name('api::logout');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/hosts/{ip}', [HostController::class, 'show']);
    Route::post('/hosts/{ip}', [HostController::class, 'update']);

    Route::post('/tasks/{task}/log', [TaskController::class, 'log']);
    Route::get('/tasks/{ip}', [TaskController::class, 'getTask']);

    Route::get('/orders/{orderId}', [OrderController::class, 'getById']);
    Route::post('/orders/{orderId}', [OrderController::class, 'update']);
    Route::post('/orders/{orderId}/pay', [OrderController::class, 'pay']);

    Route::get('/users/{userId}', [UserController::class, 'getById']);
});

Route::fallback(function () {
    return response()->json([
        'error' => 'Resource not found'
    ], 404);
})->name('api::fallback::404');
