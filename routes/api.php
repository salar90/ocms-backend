<?php

use App\Http\Controllers\Admin\EntryController as AdminEntryController;
use App\Http\Controllers\Admin\TagTypeController as AdminTagTypeController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
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

Route::middleware('auth:sanctum')->group([], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    
});


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    ''
], function(){
    Route::apiResource('entries', AdminEntryController::class);
    Route::apiResource('tag-types', AdminTagTypeController::class);
    Route::apiResource('tags', AdminTagController::class);
});



