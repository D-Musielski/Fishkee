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
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="language">Język</label>
                <select name="language_id" id="language" class="form-control">
                    @foreach($langs as $lang)
                        <option value="{{$lang->id}}">{{$lang->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category">Kategoria</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach($cats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rights">Prawa dostępu</label>
                <select id="rights-form" name="rights" id="rights" class="form-control">
                    <option value="0">Publiczny</option>
                    <option value="1">Prywatny</option>
                    <option value="0">Grupowy</option>
                </select>
            </div>
            <div id="group-form" class="form-group">
                <label for="group">Grupa</label>
                <select name="group" id="group" class="form-control">
                    <option value="0" hidden></option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <div class="form-group">
                <button class="btn btn-success" type="submit">Utwórz zbiór</button>
            </div>
        </form>
    </div>
</div>
@endsection