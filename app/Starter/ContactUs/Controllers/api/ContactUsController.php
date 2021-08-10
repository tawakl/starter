<?php

namespace App\Starter\ContactUs\Controllers\api;

use App\Http\Controllers\Controller;
use App\Starter\BaseApp\Traits\ApiResponser;
use App\Starter\ContactUs\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ApiResponser;

    public $model;
    public $module;
    protected $ResourceType = 'contact_us';

    public function __construct(Contact $model)
    {
        $this->module = 'contact_us';
        $this->title = trans('app.contact_us');
        $this->model = $model;

    }
    public function store(Request $request)
    {
        $item = $this->model->create($request->all());
        if ($item) {
            return response()->json([
                    'message' => trans('app.Created Successfully', ['module_name' => __('app.'.$this->module)])
            ]);
        } else {
            return response()->json([
                    'message' => trans('app.Can’t Be Created', ['module_name' => __('app.'.$this->module)])
            ]);
        }
    }

}
