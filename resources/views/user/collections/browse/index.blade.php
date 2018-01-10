@extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Wybierz język oraz kategorię fiszek
    </div>
    <div class="panel-body">
        <form action="{{ route('collections.browse') }}" method="post">
            {{ csrf_field() }}

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
                <button class="btn btn-success" type="submit">Przeglądaj</button>
            </div>
        </form>
    </div>
</div>
@endsection