@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Utwórz nową grupę
    </div>
    <div class="panel-body">
        <form action="{{ route('group.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nazwa grupy</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <div class="form-group">
                <button class="btn btn-success" type="submit">Utwórz grupę</button>
            </div>
        </form>
    </div>
</div>
@endsection