@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">

    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left">


            <tr>
                <td width="25%" class="align-left">{{trans('app.name')}}</td>
                <td width="75%" class="align-left">{{@$row->name}}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('app.Mobile')}}</td>
                <td width="75%" class="align-left">{{@$row->mobile_number}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('app.description')}}</td>
                <td width="75%" class="align-left">{{@$row->description}}</td>
            </tr>


        </table>
    </div>
</div>
@endsection
