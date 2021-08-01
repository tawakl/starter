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

        </table>
        @endforeach

    </div>
</div>
@endsection
