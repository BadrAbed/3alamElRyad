<?php

use Illuminate\Http\Request;

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

Route::group(["namespace" => "CacheData"], function () {
    Route::post("cacheCountry","CountryController@fillNationality");
});

Route::group(["namespace" => "Api"],function (){
    Route::post("/Leagues","LeaguesController@index");
    Route::post("/LeagueDetails","LeaguesController@show");
    Route::post("/standings","LeaguesController@standing");
});