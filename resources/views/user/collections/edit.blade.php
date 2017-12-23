@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Edytuj {{$collection->name}}
    </div>
    <div class="panel-body">
        <form action="{{ route('collection.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nazwa zbioru</label>
                <input type="text" name="name" class="form-control" value="{{$collection->name}}" required>
            </div>
            <div class="form-group">
                <label for="cards">Fiszki</label>
                @foreach($cards as $card)
                    <input type="text" name="front[]" class="form-control" value="{{$card->front}}" required>
                    <input type="text" name="back[]" class="form-control" value="{{$card->back}}" required>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cards">Fiszki</label>
                    <input type="text" name="front" class="form-control" required>
                    <input type="text" name="back" class="form-control"  required>
                </select>
            </div>
            {{--  <input type="hidden" name="user_id" value="{{$user_id}}">  --}}
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>
@endsection