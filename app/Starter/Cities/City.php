<?php

namespace App\Starter\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'governorate_id');

    public function users()
    {
        return $this->hasMany('App\Starter\users\user');
    }

//    public function governorate()
//    {
//        return $this->belongsTo('App\Starter\City');
//    }
}
