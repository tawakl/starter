@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    <div class="table-responsive">
        @foreach ($rows as $row)

        <table  cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered pull-left p-5">
            <tr>
                <td width="25%" class="align-left">{{trans('users.First name')}}</td>
                <td width="75%" class="align-left">{{$row->name}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.Email')}}</td>
                <td width="75%" class="align-left">{{$row->email}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.Mobile')}}</td>
                <td width="75%" class="align-left">{{$row->mobile_number}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.birth date')}}</td>
                <td width="75%" class="align-left">{{$row->birth_date}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.lang_age')}}</td>
                <td width="75%" class="align-left">{{$row->lang_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.move_age')}}</td>
                <td width="75%" class="align-left">{{$row->move_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.think_age')}}</td>
                <td width="75%" class="align-left">{{$row->think_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.social_age')}}</td>
                <td width="75%" class="align-left">{{$row->social_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.self_age')}}</td>
                <td width="75%" class="align-left">{{$row->self_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.test_age')}}</td>
                <td width="75%" class="align-left">{{$row->test_age}}</td>
            </tr>
            <tr>
                <td width="25%" class="align-left">{{trans('users.age')}}</td>
                <td width="75%" class="align-left">{{$row->age}}</td>
            </tr>

        </table>
        @endforeach

    </div>
</div>
@endsection
