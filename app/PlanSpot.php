<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanSpot extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'plan_spot';

    protected $fillable = [
        "plan_id",
        "spot_id",
    ];

    //belongsTo設定
    public function spot()
    {
        return $this->belongsTo('App\Spot');
    }
}
