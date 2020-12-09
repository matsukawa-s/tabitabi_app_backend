<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotUser extends Model
{
    protected $table = 'spot_user';
    
    protected $fillable = [
        'spot_id','user_id'
    ];
}
