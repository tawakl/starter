<?php

namespace App\Starter\Cities\Transformers;

use App\Starter\Cities\City;
use League\Fractal\TransformerAbstract;

class ListCityTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];


    public function transform(City $city)
    {
        $transfromedData =  [
            'id' => (int) $city->id,
            'name' => (string) $city->name,
            'governorate' => (string) $city->governorate->name,

        ];


        return $transfromedData;
    }

}
