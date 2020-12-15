<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItinerarySpot extends Model
{
    protected $table = "itinerary_spots";

    protected $fillable = [
        "cost",
        "itinerary_id",
        "spot_id",
    ];

    //belongsTo設定
    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }
}
