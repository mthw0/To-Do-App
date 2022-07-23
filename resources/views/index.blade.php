@php


    @endphp


@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <a href="/create" style="margin-top: 20px"><span id="novaUloha" class="btn btn-primary">Vytvoriť úlohu</span></a>
    <hr>
    <form action="filter" id="filterForm" method="post" class="mt-4 p-4">
        @csrf
        <fieldset>
            <legend>Dokončené:</legend>
            <label>Ano:
                <input type="checkbox" name="doneYes" value="Checked" checked id="doneTrue"/></label>
            <label>Nie:
                <input type="checkbox" name="doneNo" value="Checked" checked id="doneFalse"/></label>

        </fieldset>
        <br>
        <fieldset>
            <legend>Moje:</legend>
            <label>Ano:
                <input type="checkbox" name="mineYes" value="Checked" checked id="mineTrue"/></label>
            <label>Nie:
                <input type="checkbox" name="mineNo" value="Checked" checked id="mineFalse"/></label>

        </fieldset>
        <br>
        <fieldset>
            <legend>Kategorie:</legend>
            @foreach($cats as $cat)
                <label>{{$cat}}:
                    <input type="checkbox" name="category{{$cat}}" value="Checked" checked/></label>
            @endforeach
        </fieldset>
        <div class="form-group m-3">
            <input type="submit" id="filterButton" class="btn btn-primary float-end" value="Filtrovať">
        </div>
    </form>

    <div id="tabulka"></div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "fetch",
                success: function (data) {
                    $('#tabulka').html(data);
                }
            });

        });
        $(document).off('click', '.deleteTodo').on('click', '.deleteTodo', function (e) {
            e.preventDefault();

            const id = $(this).data("id");
            const token = $("meta[name='csrf-token']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax(
                {
                    url: "todo/" + id,
                    type: 'DELETE',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function (res) {
                        $.ajax({
                            url: "fetch",
                            success: function (data) {
                                $('#tabulka').html(data);
                            }
                        });
                    }
                });

        });
        $(document).off('click', '.toggleDoneTodo').on('click', '.toggleDoneTodo', function (e) {
            e.preventDefault();

            const id = $(this).data("id");
            const token = $("meta[name='csrf-token']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax(
                {
                    url: "hotovo/" + id,
                    type: 'GET',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function (res) {
                        $.ajax({
                            url: "fetch",
                            success: function (data) {

                            }
                        });
                    }
                });

        });
        $("#filterForm").submit(function(e) {

            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(),
                success: function(data)
                {
                    $('#tabulka').html(data);
                }
            });

        });
        $(document).off('click', '.undeleteTodo').on('click', '.undeleteTodo', function (e) {
            e.preventDefault();

            const id = $(this).data("id");
            const token = $("meta[name='csrf-token']").attr("content");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax(
                {
                    url: "undelete/" + id,
                    type: 'GET',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function (res) {
                        $.ajax({
                            url: "fetch",
                            success: function (data) {
                                $('#tabulka').html(data);
                            }
                        });
                    }
                });

        });


    </script>

@endsection

