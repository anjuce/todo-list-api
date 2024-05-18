<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'tasks','middleware'=> ['auth']],function() {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'create']);
    Route::post('/{taskId}', [TaskController::class, 'update'])->middleware('change_task');
    Route::post('/{taskId}/complete', [TaskController::class, 'complete']);
    Route::delete('/{taskId}', [TaskController::class, 'delete'])->middleware('change_task');
});
