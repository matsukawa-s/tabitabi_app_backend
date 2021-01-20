<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefectures extends Model
{
    protected $table = 'prefectures';

    public function spots()
    {
        return $this->hasMany('App\Spot','prefecture_id');
    }
}
