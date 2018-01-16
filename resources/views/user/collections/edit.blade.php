@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Edytuj {{$collection->name}}
    </div>
    <div class="panel-body">
        <form action="{{ route('collection.update', [ 'id' => $collection->id ]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nazwa zbioru</label>
                <input type="text" name="name" class="form-control" value="{{$collection->name}}" required>
            </div>
            <div class="form-group">
                <label for="front">Przód fiszki</label>
                <input type="text" name="front" class="form-control">
            </div>
            <div class="form-group">
                <label for="back">Tył fiszki</label>
                <input type="text" name="back" class="form-control">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Zapisz</button>
            </div>
        </form>
        <label for="cards">Fiszki</label>
        @if($cards->count() > 0)
            @foreach($cards as $card)
            <form action="{{ route('card.update', ['collection_id' => $collection->id, 'card_id' => $card->id, 'front' => $card->front, 'back' => $card->back]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="front" class="form-control" value="{{$card->front}}" required>
                    <input type="text" name="back" class="form-control" value="{{$card->back}}" required>
                    <button class="btn btn-info" type="submit">Edytuj</button>
                    <a class="btn btn-danger" href="{{ route('card.delete', ['collection_id' => $collection->id, 'id' => $card->id]) }}">Usuń</a>
                    <br>
                    <br>
                </div>
            </form> 
            @endforeach
        @else
            <h3 class="text-center">Nie masz jeszcze żadnych fiszek</h3>
        @endif
    </div>
</div>
@endsection