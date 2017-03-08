<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function duties()
    {
        return $this->hasMany('App\Duty');
    }
}
