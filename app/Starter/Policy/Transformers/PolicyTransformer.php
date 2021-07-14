<?php

namespace App\Starter\Policy\Transformers;

use App\Starter\Cities\City;
use App\Starter\Policy\Policy;
use League\Fractal\TransformerAbstract;

class PolicyTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
    ];
    protected $availableIncludes = [
    ];


    public function transform(Policy $policy)
    {
        $transfromedData =  [
            'id' => (int) $policy->id,
            'description' => (string) $policy->description,

        ];


        return $transfromedData;
    }

}
