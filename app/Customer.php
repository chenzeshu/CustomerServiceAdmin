<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function contracts()
    {
        return $this->hasMany('App\Contract');
    }

    public function services()
    {
        return $this->hasManyThrough('App\Service', 'App\Customer');
    }
}
