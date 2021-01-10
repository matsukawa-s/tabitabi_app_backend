<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        "plan_code",
        "title",
        "description",
        "start_day",
        "end_day",
        "image_url",
        "cost",
        "is_open",
        "favorite_count",
        "number_of_views",
        "referenced_number",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
