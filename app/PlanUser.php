<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id', 'user_id',
    ];
}
