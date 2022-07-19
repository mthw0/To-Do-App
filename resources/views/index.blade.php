@extends('layouts.app')
@section('title')
    My Todo App
@endsection
@section('content')
    <a href="/create"><span class="btn btn-primary">Vytvoriť úlohu</span></a>
    <div class="row mt-3">
        <div class="col-12 align-self-center">
            <ul class="list-group">
                @foreach($todos as $todo)
                    <li class="list-group-item"><a href="show/{{$todo->id}}"
                                                   style="color: cornflowerblue">{{$todo->name}}</a>
                        {{$todo->done==1?" - dokončné":" - prebieha"}}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
