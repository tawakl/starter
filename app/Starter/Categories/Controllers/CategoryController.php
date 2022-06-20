<?php

namespace App\Starter\Categories\Controllers;

use App\Exports\UsersExport;
use App\Starter\Categories\Category;
use App\Starter\Questions\Question;
use App\Starter\Users\Requests\CreateUserRequest;
use App\Starter\Users\Requests\UpdateUserRequest;
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
        $data['breadcrumb'] = ['years' => 'categories/'.$cat_id.'/years'];
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
        $data['row'] = $this->question_model;
        return view($this->module . '.create', $data);
    }

    public function postCreate(Request $request)
    {
        authorize('create-' . $this->module);
        $row = $this->question_model->create($request->all()) ;
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
        $data['row'] = $this->question_model->findOrFail($id);
        return view($this->module . '.edit', $data);
    }

    public function postEdit(Request $request, $id)
    {
        authorize('edit-' . $this->module);
        $row = $this->question_model->findOrFail($id);
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }
//
//    public function getView($phone)
//    {
//        authorize('view-' . $this->module);
//        $data['module'] = $this->module;
//        $data['page_title'] = trans('app.View') . " " . $this->title;
//        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
//        $data['rows'] = $this->model->where('mobile_number',$phone)->get();
//        return view($this->module . '.view', $data);
//    }
//
//    public function getDelete($id)
//    {
//        authorize('delete-' . $this->module);
//        $row = $this->question_model->findOrFail($id);
//        $row->delete();
//        flash()->success(trans('app.Deleted Successfully'));
//        return back();
//    }

}
