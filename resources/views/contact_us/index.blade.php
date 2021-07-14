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
                    <th class="wd-10p">{{trans('users.ID')}} </th>
                    <th class="wd-15p">{{trans('users.Name')}} </th>
                    <th class="wd-15p">{{trans('users.Mobile')}} </th>
                    <th class="wd-15p">{{trans('app.description')}} </th>
                    <th class="wd-15p">&nbsp;{{trans('app.Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{$row->id}}</td>
                    <td class="center">{{$row->name}}</td>
                    <td class="center">{{$row->mobile_number}}</td>
                    <td class="center">{{ substr($row->description, 0,  60) }}...</td>
                    <td class="center">

                        @if(request('deleted') != 'yes')
                            @if(can('view-'.$module))
                                <a class="btn btn-primary btn-xs" href="{{$module}}/view/{{$row->id}}" title="{{trans('app.View')}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                                @if(can('delete-'.$module))
                                    <form class="d-inline" method="POST" action="{{route('contactUs.delete' , $row->id)}}">
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
