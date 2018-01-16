@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Grupa: {{$group->name}}
    </div>
    <div class="panel-body">
        @if(Auth::user()->id == $owner_id)
            <form action="{{ route('group.update', [ 'id' => $group->id ]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nazwa grupy</label>
                    <input type="text" name="name" class="form-control" value="{{$group->name}}" required>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Zmień</button>
                </div>
            </form>
        @endif
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
                            {{$user->name}} @if($user->id == $owner_id) (Admin) @endif
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        @if(Auth::user()->id == $owner_id)
                        <td>
                                @if($user->id != $owner_id) <a href="{{ route('group.deleteUser', ['user_id' => $user->id, 'group_id' => $group->id ]) }}" class="btn btn-xs btn-danger">Usuń</a> @endif
                        </td>
                        @endif 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('group.addUser') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="group_id" value="{{ $group->id }}">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Dodaj</button>
            </div>
        </form>
        <h4>Postęp nauki użytkowników</h4>
        @foreach ($collections as $collection)
            <a href="{{ route('group.chart', ['id' => $collection->id]) }}">{{$collection->name}}</a> <br>
        @endforeach
    </div>
</div>
@endsection