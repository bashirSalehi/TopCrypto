<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::name('api.v1.')->namespace('App\Http\Controllers\V1')->prefix('v1/')->group(function () {
    Route::get('fetch-manual-cryptocurrency-data', 'CoinController@manualGetData')->name('fetch.manual.cryptocurrency.data');
});
