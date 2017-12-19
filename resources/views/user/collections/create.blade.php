@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Utwórz nowy zbiór fiszek
    </div>
    <div class="panel-body">
        <form action="{{ route('collection.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nazwa zbioru</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Utwórz zbiór</button>
            </div>
        </form>
    </div>
</div>
@endsection