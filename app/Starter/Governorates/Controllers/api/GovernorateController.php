<?php

namespace App\Starter\Governorates\Controllers\api;

use App\Http\Controllers\Controller;
use App\Starter\BaseApp\Traits\ApiResponser;
use App\Starter\Governorates\Governorate;
use App\Starter\Governorates\Transformers\ListGovernorateTransformer;


class GovernorateController extends Controller
{
    use ApiResponser;

    public $model;
    public $module;
    protected $ResourceType = 'governorates';

    public function __construct(Governorate $model)
    {
        $this->module = 'governorates';
        $this->title = trans('app.governorates');
        $this->model = $model;

    }
    public function index()
    {
        $items = $this->model->all();
        return response()->json(['data' => $items], 200);

//        return $this->transformDataModInclude($items,'',new ListGovernorateTransformer(),$this->ResourceType);

    }

}
