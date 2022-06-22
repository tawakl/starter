@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
        @if(can('create-'.$module))
        <a href="{{route('questions.create',$year)}}" class="btn btn-success">
            <i class="fa fa-plus"></i> {{trans('app.Create_question')}}
        </a>
        @endif
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('view-'.$module))


    <div class="table-responsive">
        <table class="table display responsive nowrap">
            <thead>
                <tr>

                    <th class="wd-15p">{{trans('app.id')}} </th>
                    <th class="wd-15p">{{trans('app.questions')}} </th>
                    <th class="wd-15p">{{trans('app.question_recommendation')}} </th>
                    <th class="wd-15p"></th>

                </tr>
            </thead>
            <tbody>

                    @foreach ($year->questions as $q)

                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{!! Str::limit($q->question, 30)!!}</td>
                            <td>{!! Str::limit($q->question_recommendation, 30)!!}</td>

                            <td class="center">
                                <a class="btn btn-primary btn-xs" href="{{$module}}/{{$year->id}}/question/edit/{{$q->id}}" title="{{trans('app.edit')}}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a class="btn btn-success btn-xs" href="{{$module}}/question/view/{{$q->id}}" title="{{trans('app.view')}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach

            </tbody>
        </table>
    </div>
    @else
    {{trans("users.There is no results")}}
    @endif


    <br>

</div>
@endsection
