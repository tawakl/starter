@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}

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
                    <th class="wd-15p">{{trans('users.Description')}} </th>
                    <th class="wd-15p">&nbsp;{{trans('users.Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->description}}</td>
                    <td class="center">

                        @if(request('deleted') != 'yes')
                            @if(can('edit-'.$module))
                                <a class="btn btn-success btn-xs mr-5" href="{{$module}}/edit/{{$row->id}}" title="{{trans('roles.Edit')}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endif

                        @endif

                    </td>
                </tr>
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
