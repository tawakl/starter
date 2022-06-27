<?php

namespace App\Starter\Users\Controllers;

use App\Exports\UsersExport;
use App\Starter\Cars\Car;
use App\Starter\Users\Requests\CreateUserRequest;
use App\Starter\Users\Requests\UpdateUserRequest;
use App\Starter\Users\User;
use App\Starter\Users\UserEnums;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class UsersController extends Controller
{
    public $model;
    public $module;

    public function __construct(User $model)
    {
        $this->module = 'users';
        $this->title = trans('app.Users');
        $this->model = $model;
    }

    public function getIndex()
    {
        $data['module'] = $this->module;

        $data['page_title'] = trans('app.List Users');
        $data['rows'] = $this->model->getData()->paginate(12);

        $data['rows']->appends(request(['type', 'deleted']));
        return view($this->module . '.index', $data)->with('no', 1);
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

    public function postCreate(CreateUserRequest $request)
    {
        authorize('create-' . $this->module);
        //////////////////////////////// check type
        $request->type == 'admin' ? $is_admin = 1 : $is_admin = 0;
        ////////////////////////////////
        if ($row = $this->model->create(array_merge($request->all(), ['is_admin' => $is_admin]))) {
            $row->attachRole($request->role_id);
            flash()->success(trans('app.Created successfully'));
            return redirect('/' . $this->module);
        }
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

    public function postEdit(UpdateUserRequest $request, $id)
    {
        authorize('edit-' . $this->module);
        $row = $this->model->findOrFail($id);
        //////////////////////////////// check type
        $request->type == 'admin' ? $is_admin = 1 : $is_admin = 0;
        $row->is_admin = $is_admin;
        if ($row->update($request->all())) {
            flash(trans('app.Update successfully'))->success();
            return redirect('/' . $this->module);
        }
        flash()->error(trans('app.failed to save'));
        return redirect('/' . $this->module);
    }

    public function getView($phone)
    {
        authorize('view-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module.'?'.request()->getQueryString()];
        $data['rows'] = $this->model->where('mobile_number',$phone)->get();
        return view($this->module . '.view', $data);
    }

        public function getDelete($id)
        {
            authorize('delete-' . $this->module);
            $row = $this->model->findOrFail($id);
            $row->delete();
            flash()->success(trans('app.Deleted Successfully'));
            return back();
        }

    public function getExport()
    {
        return Excel::download(new UsersExport, 'users.xlsx');

    }
}
