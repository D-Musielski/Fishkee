@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        {{$collection->name}} 
    </div>
    <div class="panel-body">
        <form action="{{ route('collection.add', [ 'id' => $collection->id ]) }}" method="post">
            {{ csrf_field() }}
            <table class="table table-hover">
                    <thead>
                        <th>
                            Przód
                        </th>
                        <th>
                            Tył
                        </th>
                    </thead>
                    <tbody>
                        @foreach($cards as $card)
                        <tr>
                            <td>{{$card->front}}</td>
                            <td>{{$card->back}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>
@endsection