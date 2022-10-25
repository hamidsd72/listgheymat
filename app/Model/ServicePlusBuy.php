<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ServicePlusBuy extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function buy()
    {
        return $this->belongsTo('App\Model\ServiceBuy','buy_id');
    }
    public function factor()
    {
        return $this->belongsTo('App\Model\ServiceFactor','buy_id');
    }
    public function plus()
    {
        return $this->belongsTo('App\Model\ServicePlus','plus_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function service()
    {
        return $this->belongsTo('App\Model\Service','service_id');
    }
}
