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
//    public function edit($id)
//    {
//        $model = City::findOrFail($id);
//        return view('cities.edit', compact('model'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        $record = City::findOrFail($id);
//        $record->update($request->all());
//        flash()->success('<p class="text-center" style="font-size:20px; font-weight:900;font-family:Arial" >لقـــد تـــــــم التحــديــــــــث بنــجـــــــاح</p>');
//        return redirect(route('cities.index'));
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $record = City::find($id);
//        if (!$record) {
//            return response()->json([
//                'status'  => 0,
//                'message' => 'تعذر الحصول على البيانات'
//            ]);
//        }
//
//        $record->delete();
//        return response()->json([
//                'status'  => 1,
//                'message' => 'تم الحذف بنجاح',
//                'id'      => $id
//            ]);
//    }

}
