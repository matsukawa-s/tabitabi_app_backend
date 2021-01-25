<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        "user_id",
        "plan_id",
        "c_contents",
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
