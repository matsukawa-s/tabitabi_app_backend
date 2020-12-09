<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable = [
        'place_id', 'spot_name', 'memory_latitube','memory_longitube','image_url','prefecture_id'
    ];
    // protected $fillable = [
    //     "place_id",
    //     "spot_name",
    //     "place_types",
    //     "latitube",
    //     "longitube",
    //     "image_url",
    //     "address",
    // ];
}
