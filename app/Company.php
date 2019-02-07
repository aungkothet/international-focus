<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','logo','address'];

    public function demandletter()
    {
        return $this->hasMany('App\DemandLetter');
    }
}
