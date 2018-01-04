@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Grupa: {{$group->name}}
    </div>
    <div class="panel-body">
        <form action="{{ route('group.update', [ 'id' => $group->id ]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nazwa grupy</label>
                <input type="text" name="name" class="form-control" value="{{$group->name}}" required>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Zmien</button>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <th>
                    Imię i nazwisko
                </th>
                <th>
                    E-mail
                </th>
                @if(Auth::user()->id == $owner_id)
                <th>
                    Usuń
                </th>
                @endif
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        @if(Auth::user()->id == $owner_id)
                        <td>
                            <a href="{{ route('group.deleteUser', ['id' => $user->id ]) }}" class="btn btn-xs btn-danger">Usuń</a>
                        </td>
                        @endif 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('group.addUser') }}" method="post">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </form>
    </div>
</div>
@endsection