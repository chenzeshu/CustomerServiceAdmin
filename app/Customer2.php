<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer2 extends Model
{
    protected $guarded = [];

    public function customer()
    {
        $this->belongsTo('App\Customer', 'name');
    }
}
