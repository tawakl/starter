<?php

namespace App\Starter\ContactUs;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = array('name','mobile_number','description');

}
