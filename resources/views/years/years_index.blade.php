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
{{--                <tr>--}}

{{--                    <th class="wd-15p">{{trans('users.years')}} </th>--}}

{{--                </tr>--}}
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    @foreach ($row->years as $year)
                    <td class="center">  <a href="questions/{{$row->slug}}/{{$year->id}}/questions" >{{$year->year}}</td>
                    @endforeach
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
{{--    {{ $rows->links() }}--}}
</div>
@endsection
