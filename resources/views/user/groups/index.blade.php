@extends('layouts.app') 

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <th>
                    Nazwa grupy
                </th>
                <th>
                    Usuń
                </th>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>
                            <a href="{{ route('group.edit', ['id' => $group->id ]) }}" class="btn btn-xs btn-info">
                                {{$group->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('group.delete', ['id' => $group->id ]) }}" class="btn btn-xs btn-danger">Usuń</a>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection