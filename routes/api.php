<?php

use App\Http\Controllers\Admin\EntryController;
use App\Http\Controllers\Admin\TagTypeController;
use App\Http\Controllers\Admin\TagController;
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

// Route::get('entries', [EntryController::class, 'index'])->name('entries.index');
Route::apiResource('entries', EntryController::class);
Route::apiResource('tag-types', TagTypeController::class);
Route::apiResource('tags', TagController::class);