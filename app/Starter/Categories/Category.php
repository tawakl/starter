<?php

namespace App\Starter\Categories;

use App\Starter\Questions\Question;
use App\Starter\Years\Year;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'name',
        'slug'
    ];

    public function years()
    {
        return $this->hasMany(Year::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=>true
            ]
        ];
    }

}
