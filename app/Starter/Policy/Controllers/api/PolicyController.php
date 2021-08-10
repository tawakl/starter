<?php

namespace App\Starter\Policy\Controllers\api;

use App\Http\Controllers\Controller;
use App\Starter\BaseApp\Traits\ApiResponser;
use App\Starter\Policy\Policy;
use App\Starter\Policy\Transformers\PolicyTransformer;

class PolicyController extends Controller
{
    use ApiResponser;

    public $model;
    public $module;
    protected $ResourceType = 'policy';

    public function __construct(Policy $model)
    {
        $this->module = 'policies';
        $this->title = trans('app.Policy');
        $this->model = $model;

    }
    public function index()
    {
        $items = $this->model->get()->only('description');
        return response()->json(['data' => $items], 200);
    }

}
