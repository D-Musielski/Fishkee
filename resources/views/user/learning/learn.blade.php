@extends('layouts.app') 
@section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Postęp {{$cards->count() - $cardsToLearn->count()}} / {{$cards->count()}}
    </div>
    <div class="panel-body text-center">
        @if(isset($card->front))
            <form action="{{ route('learn.know', ['collection_id' => $collection_id, 'card_id' => $card->id]) }}" method="post">
                {{ csrf_field() }}
                {{$card->front}} - {{$card->back}} <br>
                <a href="{{route('learn.start', ['id' => $collection_id])}}" class="btn btn-danger">Nie znam :(</a>
                <button type="submit" class="btn btn-success">Znam! :)</button>
            @else
                {{$card}} <br>
                <a href="{{ route('learn.restart', ['id' => $collection_id]) }}" class="btn btn-success">Jeszcze raz!</a>
            @endif
            </form>
    </div>
</div>
@endsection