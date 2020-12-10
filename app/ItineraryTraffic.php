<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryTraffic extends Model
{
    protected $table = "itinerary_traffic";
    
    protected $fillable = [
        "traffic_class",
        "travel_time",
        "traffic_cost",
        "itinerary_id",
    ];
}
