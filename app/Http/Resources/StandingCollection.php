<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StandingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "position" => $this->position,
            "team_name" => $this->team->name ,
            "played" => $this->played ,
            "wins" => $this->wins,
            "draws"=> $this->draws ,
            "losses" => $this->losses ,
            "goalsFor" => $this->goalsFor ,
            "goalsAgainst"=> $this->goalsAgainst,
            "points"=> $this->points ,
            "result"=> $this->result
        ];
    }
}
