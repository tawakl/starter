<?php

namespace App\Starter\Governorates;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function users()
    {
        return $this->belongsToMany('App\Starter\users\user');
    }

    public function cities()
    {
        return $this->hasMany('App\Starter\cities\City');
    }

}
