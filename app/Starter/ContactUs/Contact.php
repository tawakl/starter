<?php

namespace App\Starter\ContactUs;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Contact extends Model
{
    use SoftDeletes, Searchable;
    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = array('name','mobile_number','description');

    public function getData()
    {
        $query = $this
            ->when(request('type'), function ($q) {
                return $q->where('type', request('type'));
            })
            ->when(request('deleted') == 'yes', function ($q) {
                return $q->onlyTrashed();
            });
        return $query;
    }
}
