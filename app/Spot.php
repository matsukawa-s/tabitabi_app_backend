<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    //
    protected $fillable = [
        "place_id",
        "spot_name",
        "place_types",
        "memory_latitube",
        "memory_longitube",
        "image_url",
        "address",
    ];

    //hasMany設定
    public function itinerarySpot()
    {
        return $this->hasMany('App\ItinerarySpot');
    }
}
