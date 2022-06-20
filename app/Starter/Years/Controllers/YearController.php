<?php

namespace App\Starter\Years\Controllers;

use App\Http\Controllers\Controller;
use App\Starter\Categories\Category;
use App\Starter\Cities\City;
use App\Starter\Governorates\Governorate;
use App\Starter\Years\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{

    public $model;
    public $module;

    public function __construct(Year $model)
    {
        $this->module = 'years';
        $this->title = trans('app.years');
        $this->model = $model;
    }

    public function years($slug)
    {
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.List years');
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['rows'] = Category::where('slug',$slug)->with('years')->get();
        return view($this->module . '.years_index', $data);
    }

}
