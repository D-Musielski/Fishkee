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
                <label for="cards">Fiszki</label>
                @if($cards->count() > 0)
                    @foreach($cards as $card)
                        <input type="text" name="fronty[]" class="form-control" value="{{$card->front}}" required>
                        <input type="text" name="backi[]" class="form-control" value="{{$card->back}}" required>
                        <a class="btn btn-info" href="{{ route('card.update', ['collection_id' => $collection->id, 'card_id' => $card->id, 'front' => $card->front, 'back' => $card->back]) }}">Edytuj</a>
                        <a class="btn btn-danger" href="{{ route('card.delete', ['collection_id' => $collection->id, 'id' => $card->id]) }}">Usuń</a>
                        <br>
                        <br>
                    @endforeach
                @else
                    <h3 class="text-center">Nie masz jeszcze żadnych fiszek</h3>
                @endif
                </select>
            </div>
            <div class="form-group">
                <label for="front">Przód fiszki</label>
                <input type="text" name="front" class="form-control">
            </div>
            <div class="form-group">
                <label for="back">Tył fiszki</label>
                <input type="text" name="back" class="form-control">
            </div>
            {{--  <input type="hidden" name="user_id" value="{{$user_id}}">  --}}
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>
@endsection