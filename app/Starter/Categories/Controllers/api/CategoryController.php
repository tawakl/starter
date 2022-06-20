<?php

namespace App\Starter\Categories\Controllers\api;

use App\Http\Controllers\Controller;
use App\Starter\BaseApp\Traits\ApiResponser;
use App\Starter\Categories\Category;
use App\Starter\Governorates\Governorate;
use App\Starter\Governorates\Transformers\ListGovernorateTransformer;
use App\Starter\Years\Year;


class CategoryController extends Controller
{
    use ApiResponser;

    public $model;
    public $module;
    protected $ResourceType = 'categories';

    public function __construct(Category $model)
    {
        $this->module = 'categories';
        $this->title = trans('app.categories');
        $this->model = $model;

    }
    public function index()
    {
        $data=$this->model->with('years','years.questions')->get();

        return response()->json(['data' => $data], 200);

//        return $this->transformDataModInclude($items,'',new ListGovernorateTransformer(),$this->ResourceType);

    }

}
