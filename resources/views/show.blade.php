@extends('layouts.app')

@section('title')
    Details
@endsection

@section('content')

    <div class="card text-center mt-5">
        <div class="card-header">
            <h5 class="card-title">{{$todos->name}}{{$todos->done==1?" - dokončné":" - prebieha"}}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{$todos->description}}.</p>
            <a href="/edit/{{$todos->id}}"><span class="btn btn-primary">Upraviť</span></a>
            <a href="/delete/{{$todos->id}}"><span class="btn btn-danger">Vymazať</span></a>
            <a href="/hotovo/{{$todos->id}}"><span class="btn btn-success">{{$todos->done==0?"Dokončiť":"Pokračovať"}}</span></a>
        </div>
    </div>

@endsection
