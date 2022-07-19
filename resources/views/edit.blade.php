@extends('layouts.app')
@section('title')
    Edit Todo
@endsection
@section('content')

    <form action="/update/{{$todo->id}}" method="post" class="mt-4 p-4">
        @csrf
        <div class="form-group m-3">
            <label for="name">Názov úlohy</label>
            <input type="text" class="form-control" value="{{$todo->name}}" name="name">
        </div>
        <div class="form-group m-3">
            <label for="description">Popis úlohy</label>
            <textarea class="form-control" name="description" rows="3"> {{$todo->description}} </textarea>
        </div>
        <div class="form-group m-3">
            <input type="submit" class="btn btn-primary float-end" value="Odoslať">
        </div>
    </form>

@endsection