@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
</h6>
@endsection
@section('content')
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-8 ftco-animate" style="     word-wrap: break-word;">--}}
{{--                <p class="mb-5">--}}
{{--                    <img src={{asset('assets/images/mada.png')}} alt="" class="img-fluid">--}}
{{--                </p>--}}
{{--                <p> {!! $row->id!!}</p>--}}
{{--                <p> {!! $row->question!!}</p>--}}
{{--                <p> {!! $row->question_recommendation!!}</p>--}}

{{--                <div class="about-author d-flex p-4 bg-light">--}}
{{--                    <div class="desc">--}}
{{--                        <h3>{{ $row->author}}</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}



{{--            </div> <!-- .col-md-8 -->--}}

{{--        </div>--}}
{{--    </div>--}}
<div class="section-wrapper">
    @if(can('edit-'.$module) && ! $row->deleted_at)
    <a href="{{$module}}/question/edit/{{$row->id}}" class="btn btn-success">
        <i class="fa fa-edit"></i> {{trans('users.Edit')}}
    </a><br>
    @endif
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" style="  table-layout: fixed;" class="table table-striped table-bordered pull-left">

            <tr>
                <td width="25%" class="align-left">{{trans('app.id')}}</td>
                <td width="75%" class="align-left">{{@$row->id}}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('app.question')}}</td>
                <td width="75%" style="word-wrap: break-word;" class="align-left">{!!@$row->question!!}</td>

            </tr>

            <tr>
                <td width="25%" class="align-left">{{trans('app.question_recommendation')}}</td>
                <td width="75%" style="word-wrap: break-word;" class="align-left">{!!@$row->question_recommendation!!}</td>
            </tr>

        </table>
    </div>
</div>
@endsection
