<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryNote extends Model
{
    protected $table = "itinerary_notes";

    protected $fillable = [
        "memo",
        "itinerary_id",
    ];
}
