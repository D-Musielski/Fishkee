@extends('layouts.app') 
@section('header')
{!! Charts::styles() !!}
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        {!! $chart->html() !!}
    </div>
</div>

{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection