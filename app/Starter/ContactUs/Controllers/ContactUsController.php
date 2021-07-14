<?php

namespace App\Starter\ContactUs\Controllers;

use App\Http\Controllers\Controller;
use App\Starter\ContactUs\Contact;
use App\Starter\Policy\Policy;
use Illuminate\Http\Request;


class ContactUsController extends Controller
{

    public $model;
    public $module;

    public function __construct(Contact $model)
    {
        $this->module = 'contact_us';
        $this->title = trans('app.contact_us');
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

        $data['page_title'] = trans('app.contact_us');
        $data['rows'] = $this->model->latest()->paginate(12);
        return view($this->module . '.index', $data);
    }

    public function getView($id) {
        authorize('view-' . $this->module);
        $data['module'] = $this->module;
        $data['page_title'] = trans('app.View') . " " . $this->title;
        $data['breadcrumb'] = [$this->title => $this->module];
        $data['row'] = $this->model->findOrFail($id);
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
}
