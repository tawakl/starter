@extends('layouts.master')
@section('title')
    <h6 class="slim-pagetitle">
        {{ @$page_title }}
        {{--        @if(can('create-'.$module))--}}
        {{--            <a href="{{$module}}/create" class="btn btn-success">--}}
        {{--                <i class="fa fa-plus"></i> {{trans('app.Create')}}--}}
        {{--            </a>--}}
        {{--        @endif--}}
    </h6>
@endsection
@section('content')
    <div class="section-wrapper">
        @if(can('view-'.$module))


            @if (!$records->isEmpty())
                <div class="table-responsive">
                    <table class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="">{{trans('Governorates.ID')}} </th>

                            <th class="">{{trans('Governorates.governorate')}} </th>

                            <th class="">{{trans('Governorates.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="center">{{$record->id}}</td>



                                <td class="center">{{$record->name}}</td>
                                <td class="center">

                                    @if(request('deleted') != 'yes')
                                        <a class="btn btn-success btn-xs" href="" title="{{trans('users.Edit')}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if(can('delete-'.$module))
                                            <form class="d-inline" method="POST" action="">
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
            {{ $records->links() }}

    </div>
@endsection
