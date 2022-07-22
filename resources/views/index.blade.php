@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <a href="/create" style="margin-top: 20px"><span id="novaUloha" class="btn btn-primary">Vytvoriť úlohu</span></a>
    <table id="tabulka" class="table table-hover table-responsive" style="display: inline-table">
        <thead>
        <tr>
            <th scope="col">Názov</th>
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

    <h2>Vymazané</h2>

    <table id="tabulka" class="table table-hover table-responsive" style="display: inline-table">
        <thead>
        <tr>
            <th scope="col">Názov</th>
            <th scope="col">Vlastník</th>
            <th scope="col">Kategória</th>
            <th scope="col">Akcie</th>
        </tr>
        </thead>
        <tbody id="tabulka_body">
        @foreach($todos2 as $todo)
            @include('row')
        @endforeach

        </tbody>

    </table>


@endsection
