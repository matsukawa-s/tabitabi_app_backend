<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenPhoto extends Model
{
    protected $table = "open_photos";

    protected $fillable = [
        "review_id",
        "photo_url",
    ];
}
