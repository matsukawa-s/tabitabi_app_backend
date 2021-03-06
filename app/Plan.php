<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function plantag(){
        return $this->hasMany('App\PlanTag');
    }

    public function tag(){
        return $this->belongsToMany('App\Tag');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function members(){
        return $this->belongsToMany('App\User','members');
    }

    public function scopeOtherPeoplePlan($query){
        return $query->where('user_id','<>',Auth::id());
    }

    public function scopeOpenPlan($query){
        return $query->where('is_open',true);
    }
}
