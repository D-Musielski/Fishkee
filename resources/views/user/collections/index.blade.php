@extends('layouts.app') 

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <h3 class="text-center">Twoje zbiory</h3>
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
        <h3 class="text-center">Scal zbiory</h3>
        <form action="{{ route('collections.merge') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="collection1">Zbiór 1</label>
                <select name="collection1" id="collection1" class="form-control">
                    @foreach($collections as $collection)
                        <option value="{{$collection->id}}">{{$collection->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="collection2">Zbiór 2</label>
                <select name="collection2" id="collection2" class="form-control">
                    @foreach($collections as $collection)
                        <option value="{{$collection->id}}">{{$collection->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Scal</button>
            </div>
        </form>
    </div>
</div>
@endsection