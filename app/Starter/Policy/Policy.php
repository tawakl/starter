<?php

namespace App\Starter\Policy;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{

    protected $table = 'policies';
    public $timestamps = true;
    protected $fillable = array('description');

}
