@extends('layouts.app')
@section('title')
    My Todo App
@endsection
@section('content')
    <a href="/create"><span class="btn btn-primary">Vytvoriť úlohu</span></a>
    <table class="table table-hover table-responsive" style="display: inline-table">
        <thead>
        <tr>
            <th scope="col">Názov</th>
            <th scope="col">Dokončené</th>
            <th scope="col">Vlastník</th>
            <th scope="col">Kategória</th>
            <th scope="col">Akcie</th>
        </tr>
        </thead>
        <tbody id="tabulka_body">
        @foreach($todos as $todo)
            @include('row')

        @endforeach

        </tbody>
    </table>





@endsection
