<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotType extends Model
{
    protected $table = "spot_type";
    
    protected $fillable = [
        "type_id",
        "spot_id",
    ];
}
