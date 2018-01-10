@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li class="active">
                <a href="#public" data-toggle="tab">Publiczne</a>
            </li>
            <li>
                <a href="#group" data-toggle="tab">Grupowe</a>
            </li>
        </ul>
    </div>
    <div class="tab-content clearfix">
        <div class="tab-pane active" id="public">
            <table class="table table-hover">
                <thead>
                    <th>
                        Nazwa zbioru
                    </th>
                    <th>
                        Przeglądaj
                    </th>
                </thead>
                <tbody>
                    @foreach($public as $p)
                    <tr>
                        <td>{{$p->name}}</td>
                        <td>
                            <a href="{{ route('collection.browseCollection', ['id' => $p->id ]) }}" class="btn btn-xs btn-info">Przeglądaj</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="group">
            <table class="table table-hover">
                <thead>
                    <th>
                        Nazwa zbioru
                    </th>
                    <th>
                        Przeglądaj
                    </th>
                </thead>
                <tbody>
                    @foreach($group as $g)
                    <tr>
                        <td>{{$g->name}}</td>
                        <td>
                            <a href="{{ route('collection.browseCollection', ['id' => $g->id ]) }}" class="btn btn-xs btn-info">Przeglądaj</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection