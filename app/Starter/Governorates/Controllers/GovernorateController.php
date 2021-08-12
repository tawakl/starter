<?php

namespace App\Starter\Governorates\Controllers;

use App\Http\Controllers\Controller;
use App\Starter\Cities\City;
use App\Starter\Governorates\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{

    public $model;
    public $module;

    public function __construct(Governorate $model)
    {
        $this->module = 'governorates';
        $this->title = trans('app.Governorates');
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

        $data['page_title'] = trans('app.List Governorates');
        $data['records'] = $this->model->paginate(10);

        return view($this->module . '.index', $data);
    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        $governorates = Governorate::pluck('name', 'id')->toArray();
//        return view('cities.create', compact('governorates'));
//    }
//
//
//    public function store(Request $request)
//    {
//        $rules = [
//            'name' => 'required',
//            'governorate_id' => 'required'
//        ];
//        $message = [
//            'name.required' => 'name is required'
//        ];
//        $this->validate($request, $rules, $message);
//        $record = City::create($request->all());
//        flash()->success('تمت إضافة المدينة بنجاح');
//        return redirect(route('cities.index'));
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
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
        return redirect('/' . $this->module);
    }

    public function getDelete($id)
    {
        authorize('delete-' . $this->module);
        $row = $this->model->findOrFail($id);
        $row->delete();
        flash()->success(trans('app.Deleted Successfully'));
        return back();
    }

}
