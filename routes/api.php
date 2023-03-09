<?php

use App\Http\Controllers\Admin\EntryController as AdminEntryController;
use App\Http\Controllers\Admin\TagTypeController as AdminTagTypeController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Client\EntryController;

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


Route::controller(AuthController::class)->group(function(){
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout');
    Route::post('/auth/register', 'register');
});
;

Route::resource('entries', EntryController::class)->only(['index', 'show']);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    ''
], function(){
    Route::apiResource('entries', AdminEntryController::class);
    Route::apiResource('tag-types', AdminTagTypeController::class);
    Route::apiResource('tags', AdminTagController::class);

    Route::get('profile/show', [AdminProfileController::class, 'show']);

});





