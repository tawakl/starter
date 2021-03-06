@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
        @if(can('create-'.$module))
        <a href="{{$module}}/question/create" class="btn btn-success">
            <i class="fa fa-plus"></i> {{trans('app.Create')}}
        </a>
        @endif
</h6>
@endsection
@section('content')
<div class="section-wrapper">
    @if(can('view-'.$module))

    @if (!$rows->isEmpty())
    <div class="table-responsive">
        <table class="table display responsive nowrap">
            <thead>
                <tr>

                    <th class="wd-15p">{{trans('users.id')}} </th>
                    <th class="wd-15p">{{trans('users.questions')}} </th>
                    <th class="wd-15p">{{trans('users.question_recommendation')}} </th>
                    <th class="wd-15p"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    @foreach ($row->questions as $q)

                        <tr>
                            <td>{{$q->id}}</td>
                            <td>{{$q->question}}</td>
                            <td>{{$q->question_recommendation}}</td>
                            <td class="center">
                                <a class="btn btn-primary btn-xs" href="{{$module}}/question/edit/{{$q->id}}" title="{{trans('edit')}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @if(request('deleted') != 'yes')
                                    @if(can('delete-'.$module))
                                        <form class="d-inline" method="POST" action="{{route('delete' , $row->id)}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-xs" value="Delete Station"
                                                    data-confirm="{{trans('users.Are you sure you want to delete this item')}}?">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif

                                @endif

                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{trans("users.There is no results")}}
    @endif
    @endif

    <br>
    {{ $rows->links() }}
</div>
@endsection
