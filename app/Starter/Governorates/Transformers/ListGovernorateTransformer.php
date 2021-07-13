<?php

namespace App\Starter\Governorates\Transformers;

use App\Starter\Governorates\Governorate;
use League\Fractal\TransformerAbstract;

class ListGovernorateTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];


    public function transform(Governorate $governorate)
    {
        $transfromedData =  [
            'id' => (int) $governorate->id,
            'name' => (string) $governorate->name,

        ];


        return $transfromedData;
    }

}
