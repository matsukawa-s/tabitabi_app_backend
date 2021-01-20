<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanTag extends Model
{
    protected $table = "plan_tag";

    protected $fillable = [
        "tag_id",
        "plan_id"
    ];

    //belongsTo設定
    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }

}
