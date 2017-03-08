<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function duties()
    {
        return $this->hasManyThrough('App\Duty', 'App\Service');
    }
}
