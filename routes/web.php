<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view("administrator.include.master") ;
    return view('welcome');
});

Route::get("/test", function (){
    return view("administrator.home") ;
});


Route::get("/t", function (){
    // These code snippets use an open-source library. http://unirest.io/php
    $response = Unirest\Request::get("https://myanmarunicorn-bhawlone-v1.p.mashape.com/countries",
        array(
            "X-Mashape-Key" => "QNYzZqmaX9mshOIUmN4UbyMqefuFp1u8BVZjsnQ3sVj6AiUcSB",
            "Accept" => "application/json"
        )
    );

    return $response->body->data ;
});
