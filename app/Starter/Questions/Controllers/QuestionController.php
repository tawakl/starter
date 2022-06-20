<?php

namespace App\Starter\Questions\Controllers;

use App\Http\Controllers\Controller;
use App\Starter\Cities\City;
use App\Starter\Governorates\Governorate;
use App\Starter\Questions\Question;
use App\Starter\Years\Year;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public $model;
    public $module;

    public function __construct(Question $model)
    {
        $this->module = 'questions';
        $this->title = trans('app.questions');
        $this->model = $model;
    }

    public function questions($cat_id,$year_id)
    {
        $data['module'] = $this->module;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['page_title'] = trans('app.List questions');
        $data['rows'] = Year::where('id',$year_id)->whereHas('category',function ($q) use ($cat_id) {
            $q->where('slug', $cat_id);
        })->with('questions')->paginate();
        return view($this->module . '.questions_index', $data);
    }

    public function getCreate()
    {
        authorize('create-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Create') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model;
        return view($this->module . '.create', $data);
    }

    public function postCreate(Request $request)
    {
        authorize('create-' . $this->module);
        $row = $this->model->create($request->all()) ;
        flash()->success(trans('app.Created successfully'));
        return redirect('/' . $this->module);

        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }


    public function getEdit($id)
    {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['row'] = $this->model->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit(Request $request, $id)
    {
        authorize('edit-' . $this->module);
        $row = $this->model->findOrFail($id);
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/categories' );
    }


}
