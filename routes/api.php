<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\NumberController;
use App\Http\Controllers\API\MoneyController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PlayerTypeController;
use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\FCMController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\SettingController;

/** 
 *      
 *  Number Routes.
 * 
 */

Route::post('numbers', [NumberController::class, 'store'])->name('numbers.store');

Route::patch('numbers/{number}/verify', [NumberController::class, 'verify'])->name('numbers.verify');

Route::post('register/{number}/varified', RegisterController::class)->name('user.register');


/** 
 *      
 *  PlayerType index Route.
 * 
 */
Route::get('playerTypes', PlayerTypeController::class)->name('playerTypes.index');

/**
 * 
 * City Routes.
 * 
 */
Route::get('cities', [CityController::class, 'index'])->name('cities.index');

Route::get('cities/{city}', [CityController::class, 'show'])->name('cities.show');


/**
 * 
 *  Settings end point
 * 
 */

Route::get('settings', SettingController::class)->name('settings');


Route::middleware('auth:sanctum')->group(function () {

    /**
     * 
     * Matche (Game) Routes.
     * 
     */
    Route::get('games', [GameController::class, 'index'])->name('games.index');

    Route::get('games/next-games', [GameController::class, 'next'])->name('games.next-games');

    Route::get('games/last-games', [GameController::class, 'last'])->name('games.last-games');

    Route::post('games/{game}/join', [GameController::class, 'join'])->name('games.join');

    Route::delete('games/{game}/out', [GameController::class, 'out'])->name('games.out');

    Route::get('games/{game}', [GameController::class, 'show'])->name('games.show');



    /**
     * 
     * Request Money back
     * 
     */

    Route::post('money-back', MoneyController::class)->name('money-back.store');

    Route::get('money-back', MoneyController::class)->name('money-back.show');



    /**
     * 
     * Notification settings
     * 
     */

    Route::patch('notifications', NotificationController::class)->name('notifications');

    Route::get('notifications', NotificationController::class)->name('notifications');


    /**
     * 
     * Application to admin.
     * 
     */

    Route::post('applications', ApplicationController::class)->name('Applications.store');



    /**
     * 
     * Profile Routes.
     * 
     */

    Route::get('profile', ProfileController::class)->name('profile.show');

    Route::post('profile', ProfileController::class)->name('profile.update');





    /**
     * 
     *  Update user token.
     *
     */
    
    Route::patch('tokens', FCMController::class)->name('fcm.update');
});
