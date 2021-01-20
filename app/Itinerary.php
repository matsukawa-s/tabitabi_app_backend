<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $fillable = [
        "itinerary_order",
        "spot_order",
        "day",
        "plan_id",
    ];
}
