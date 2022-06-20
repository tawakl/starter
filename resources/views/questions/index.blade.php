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
            <tbody>
            <tr>
                @foreach ($rows as $row)
                    <td class="center">  <a href="years/{{$row->slug}}/years" >{{$row->name}}</a></td>
                @endforeach
            </tr>
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
