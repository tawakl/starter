@extends('layouts.master')
@section('title')
{{--    <h6 class="slim-pagetitle">--}}
{{--        {{ @$page_title }}--}}
{{--        @if(can('create-'.$module))--}}
{{--            <a href="{{$module}}/create" class="btn btn-success">--}}
{{--                <i class="fa fa-plus"></i> {{trans('app.Create')}}--}}
{{--            </a>--}}
{{--        @endif--}}
{{--    </h6>--}}
@endsection
@section('content')
    <div class="section-wrapper">
        @if(can('view-'.$module))


            @if (!$records->isEmpty())
                <div class="table-responsive">
                    <table class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="">{{trans('cities.ID')}} </th>

                            <th class="">{{trans('cities.city')}} </th>
                            <th class="">{{trans('cities.governorate')}} </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="center">{{$record->id}}</td>
                                <td class="center">{{$record->name}}</td>
                                <td class="center">{{$record->governorate->name}}</td>
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
