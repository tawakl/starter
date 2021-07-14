<?php

namespace App\Starter\Policy\Controllers;

use App\Http\Controllers\Controller;
use App\Starter\Policy\Policy;
use Illuminate\Http\Request;


class PolicyController extends Controller
{

    public $model;
    public $module;

    public function __construct(Policy $model)
    {
        $this->module = 'policies';
        $this->title = trans('app.Policy');
        $this->model = $model;
    }

    public function getEdit() {
        $data['row']=$this->model->findOrFail(auth()->user()->id);
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['module'] = $this->module;
        return view($this->module.'.edit', $data);
    }

    public function postEdit(Request $request) {
        $row=$this->model->findOrFail(auth()->user()->id);
        if($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return back();
        }

    }
}
