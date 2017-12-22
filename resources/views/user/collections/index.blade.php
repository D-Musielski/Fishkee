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
                    Edytuj
                </th>
                <th>
                    Usuń
                </th>
            </thead>
            <tbody>
                @foreach($collections as $collection)
                    <tr>
                        <td>{{$collection->name}}</td>
                        <td>
                            <a href="{{ route('collection.edit', ['id' => $collection->id ]) }}" class="btn btn-xs btn-info">Edytuj</a>
                        </td>
                        <td>
                            <a href="{{ route('collection.delete', ['id' => $collection->id ]) }}" class="btn btn-xs btn-danger">Usuń</a>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection