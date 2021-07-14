<?php

namespace App\Starter\Cities\Controllers\api;

use App\Http\Controllers\Controller;
use App\Starter\BaseApp\Traits\ApiResponser;
use App\Starter\Cities\City;
use App\Starter\Cities\Transformers\ListCityTransformer;

class CityController extends Controller
{
    use ApiResponser;

    public $model;
    public $module;
    protected $ResourceType = 'cities';

    public function __construct(City $model)
    {
        $this->module = 'cities';
        $this->title = trans('app.Cities');
        $this->model = $model;

    }
    public function index()
    {
        $items = $this->model->paginate();
        return $this->transformDataModInclude($items,'',new ListCityTransformer(),$this->ResourceType);
    }

}
