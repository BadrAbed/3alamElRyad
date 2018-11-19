<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StandingCollection;
use App\Leagues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class LeaguesController extends Controller
{
    public function index(){
        // These code snippets use an open-source library. http://unirest.io/php
//        $response = \Unirest\Request::get("https://myanmarunicorn-bhawlone-v1.p.mashape.com/competitions",
//            array(
//                "X-Mashape-Key" => "QNYzZqmaX9mshOIUmN4UbyMqefuFp1u8BVZjsnQ3sVj6AiUcSB",
//                "Accept" => "application/json"
//            )
//        );

        $response = Leagues::all();
        return response(["status" => true , "message" => "All leagues and Champions at all of the world ", "result" => $response]);
    }

    public function show(){
        $rules = [
            "id" => "required"
        ];

        $validator = Validator::make(\request()->all(), $rules);

        if($validator->fails()){
            return response(["status" => false , "message" => " request parameter not valid ", "result" => $validator->messages()]);
        } else {
            $id = \request("id");
            $response = \Unirest\Request::get("https://myanmarunicorn-bhawlone-v1.p.mashape.com/competitions/" . $id,
                array(
                    "X-Mashape-Key" => "QNYzZqmaX9mshOIUmN4UbyMqefuFp1u8BVZjsnQ3sVj6AiUcSB",
                    "Accept" => "application/json"
                )
            );

            return response(["status" => true, "message" => " leagues or  Champions Details ", "result" => $response->body->data]);
        }
    }

    public function standing(){
        $rules = [
            "id" => "required"
        ];

        $validator = Validator::make(\request()->all(), $rules);

        if($validator->fails()){
            return response(["status" => false , "message" => " request parameter not valid ", "result" => $validator->messages()]);
        } else {
            $id = \request("id");
            $response = \Unirest\Request::get("https://myanmarunicorn-bhawlone-v1.p.mashape.com/competitions/".$id."/standings",
                array(
                    "X-Mashape-Key" => "QNYzZqmaX9mshOIUmN4UbyMqefuFp1u8BVZjsnQ3sVj6AiUcSB",
                    "Accept" => "application/json"
                )
            );

            $all_standings = $response->body->data->standings;
            $standings = [] ;
            foreach ($all_standings as $standing){
                
                $obj = [
                    "position" => $standing->position,
                    "team_name" => $standing->team->name ,
                    "played" => $standing->played ,
                    "wins" => $standing->wins,
                    "draws"=> $standing->draws ,
                    "losses" => $standing->losses ,
                    "goalsFor" => $standing->goalsFor ,
                    "goalsAgainst"=> $standing->goalsAgainst,
                    "points"=> $standing->points ,
                    "result"=> $standing->result
                ];
                    
                array_push($standings,$obj);
            }

            return response(["status" => true, "message" => " leagues or  Champions standing ", "result" => $standings]);
        }
    }
}
