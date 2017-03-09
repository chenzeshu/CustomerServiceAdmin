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

    public function customer2s()
    {
        return $this->hasMany('App\Customer2','customer_name', 'name');
    }
}
