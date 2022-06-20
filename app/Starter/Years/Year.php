<?php

namespace App\Starter\Years;

use App\Starter\Categories\Category;
use App\Starter\Questions\Question;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{

    protected $table = 'years';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'year',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
