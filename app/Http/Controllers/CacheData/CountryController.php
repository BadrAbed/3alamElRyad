<?php

namespace App\Http\Controllers\CacheData;

use App\Nationality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use \Unirest\Request;

class CountryController extends Controller
{
    public function fillNationality(){
        // These code snippets use an open-source library. http://unirest.io/php
        $response = \Unirest\Request::get("https://myanmarunicorn-bhawlone-v1.p.mashape.com/countries",
            array(
                "X-Mashape-Key" => "QNYzZqmaX9mshOIUmN4UbyMqefuFp1u8BVZjsnQ3sVj6AiUcSB",
                "Accept" => "application/json"
            )
        );

        $countries = $response->body->data ;

        $nationalities = Nationality::all();
        foreach ( $nationalities as $nationality) {
            $nationality->delete();
        }

        foreach ($countries as $country){
            $nationality = new Nationality() ;
            $nationality->nationality = $country->name ;
            $nationality->save();
        }

        return response()->json(["status"=>true, "messages"=>"filled nantionalities table", "result"=>[]]);
    }
}
