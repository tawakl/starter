<?php

namespace App\Starter\Questions;

use App\Starter\Categories\Category;
use App\Starter\Years\Year;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $table = 'questions';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'question',
        'question_recommendation',
        'year_id',
    ];

//    public function getYears()
//    {
//        return Year::pluck('year', 'id')->toArray();
//    }

}
