@extends('layouts.app') 

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <th>
                    Nazwa zbioru
                </th>
                <th>
                    Ucz się
                </th>
            </thead>
            <tbody>
                @foreach($collections as $collection)
                    <tr>
                        <td>{{$collection->name}}</td>
                        <td>
                            <a href="{{ route('learn.start', ['id' => $collection->id ]) }}" class="btn btn-xs btn-info">Ucz się!</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection