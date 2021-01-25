<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "reviews";

    protected $fillable = [
        "user_id",
        "plan_id",
        "r_contents",
    ];

    public function openPhoto(){
        return $this->hasMany('App\OpenPhoto');
    }
}
