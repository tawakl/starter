<?php

namespace App\Starter\Categories\Controllers;

use App\Exports\UsersExport;
use App\Starter\Categories\Category;
use App\Starter\Categories\Requests\QuestionRequest;
use App\Starter\Questions\Question;
use App\Starter\Users\UserEnums;
use App\Http\Controllers\Controller;
use App\Starter\Years\Year;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class CategoryController extends Controller
{
    public $years;
    public $question_model;
    public $model;
    public $module;

    public function __construct(Category $model,Question $question_model)
    {
        $this->years = 'years';
        $this->module = 'categories';
        $this->title = trans('app.categories');
        $this->model = $model;
        $this->question_model = $question_model;
    }

    public function index()
    {
        $data['module'] = $this->module;

        $data['page_title'] = trans('app.List categories');
        $data['rows'] = $this->model->get();
        return view($this->module . '.index', $data);
    }
    public function years($slug)
    {
        $data['module'] = $this->module;

        $data['page_title'] = trans('app.List years');
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['rows'] = $this->model->where('slug',$slug)->with('years')->get();
        return view($this->module . '.years_index', $data);
    }

    public function questions($cat_id,$year_id)
    {
        $data['module'] = $this->module;
        $year =  Year::find($year_id);
        $data['breadcrumb'] = [trans('app.List years') => 'categories/'.$cat_id.'/years'];
        $data['page_title'] = trans('app.List questions');
        return view($this->module . '.questions_index',$data, compact( 'year'));
    }

    public function getCreate(Year  $year)
    {

        authorize('create-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Create_question');
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->question_model;
        return view($this->module . '.create',$data ,  compact(  'year'));
    }

    public function postCreate(QuestionRequest $request , Year  $year)
    {
        authorize('create-' . $this->module);
        $row = $year->questions()->create($request->all()) ;
            flash()->success(trans('app.Created successfully'));
            return redirect('/categories/' . $year->category->slug .'/'.$year->id. '/questions' );

        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }

    public function getView($id)
    {
        authorize('view-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View_question');
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['row'] = $this->question_model->findOrFail($id);
        return view($this->module . '.view', $data);
    }

    public function getEdit(Year  $year ,$id)
    {
        authorize('edit-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.Edit_question');
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['row'] =  $year->questions()->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit(QuestionRequest $request, Year  $year ,$id)
    {
        authorize('edit-' . $this->module);
        $row = $year->questions()->findOrFail($id);
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return redirect('/categories/' . $year->category->slug .'/'.$year->id. '/questions' );
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }


}
