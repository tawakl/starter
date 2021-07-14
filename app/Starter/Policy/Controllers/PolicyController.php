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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['module'] = $this->module;

        $data['page_title'] = trans('app.Policy');
        $data['rows'] = $this->model->latest()->paginate();

        return view($this->module . '.index', $data);
    }
//    public function getCreate()
//    {
//        authorize('create-' . $this->module);
//        $data['module'] = $this->module;
//        $data['page_title'] = trans('app.Create') . " " . $this->title;
//        $data['breadcrumb'] = [$this->title => $this->module];
//        $data['row'] = $this->model;
//        return view($this->module . '.create', $data);
//    }
//
//    public function postCreate(Request $request)
//    {
//        authorize('create-' . $this->module);
//            $row = $this->model->create($request->all());
//            flash()->success(trans('app.Created successfully'));
//            return redirect('/' . $this->module);
//
//        flash()->error(trans('app.failed to save'));
//        return redirect('/' . $this->module);
//    }
    public function getEdit($id) {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit(Request $request, $id) {
        authorize('edit-' . $this->module);
            $row = $this->model->findOrFail($id);
            $row->update($request->all());
            flash(trans('app.Update successfully'))->success();
        return redirect('/' . $this->module);
        }


}
