@extends('layouts.master')
@section('title')
<h6 class="slim-pagetitle">
    {{ @$page_title }}
{{--    @if(can('create-'.$module))--}}
{{--    <a href="{{$module}}/create" class="btn btn-success">--}}
{{--        <i class="fa fa-plus"></i> {{trans('app.Create')}}--}}
{{--    </a>--}}
{{--    @endif--}}
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
                    <th class="wd-10p">{{trans('users.ID')}} </th>
                    <th class="wd-15p">{{trans('users.Name')}} </th>
                    <th class="wd-15p">{{trans('users.Email')}} </th>
                    <th class="wd-15p">{{trans('users.Mobile')}} </th>
                    <th class="wd-15p">{{trans('users.Governorate')}} </th>
                    <th class="wd-15p">{{trans('users.Result')}} </th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{$row->name}}</td>
                    <td class="center">{{$row->email}}</td>
                    <td class="center">{{$row->mobile_number}}</td>
                    <td class="center">{{$row->governorate}}</td>
                    <td class="center"></td>
                    <td class="center">
                        <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('users.View')}}">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if(request('deleted') != 'yes')
                            @if(can('delete-'.$module))
                                <form class="d-inline" method="POST" action="{{route('users.delete' , $row->id)}}">
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
