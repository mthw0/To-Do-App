@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <div id="obsah">

        <a href="/create" style="margin-top: 20px" id="novaUloha" title="Nová úloha"
           class="btn btn-outline-primary">➕</a>
        <hr>
        <form action="filter" id="filterForm" method="post" class="mt-4 p-4">
            @csrf
            <fieldset>
                <legend>Dokončené</legend>
                <label>Ano:
                    <input class="form-check-input" type="checkbox" name="doneYes" value="Checked" checked
                           id="doneTrue"/></label>
                <label>Nie:
                    <input class="form-check-input" type="checkbox" name="doneNo" value="Checked" checked
                           id="doneFalse"/></label>

            </fieldset>
            <br>
            <fieldset>
                <legend>Vlastníctvo</legend>
                <label>Moje:
                    <input class="form-check-input" type="checkbox" name="mineYes" value="Checked" checked
                           id="mineTrue"/></label>
                <label>Zdieľané so mnou:
                    <input class="form-check-input" type="checkbox" name="mineNo" value="Checked" checked
                           id="mineFalse"/></label>

            </fieldset>
            <br>
            <fieldset>
                <legend>Kategorie</legend>
                @foreach($cats as $cat)
                    <label>{{$cat}}:
                        <input class="form-check-input" type="checkbox" name="category{{$cat}}" value="Checked"
                               checked/></label>
                @endforeach
            </fieldset>
        </form>

        <div id="tabulka"></div>
    </div>
@endsection

