@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <a href="/create" style="margin-top: 20px"><span id="novaUloha" title="Nová úloha" class="btn btn-outline-primary">➕</span></a>
    <hr>
    <form action="filter" id="filterForm" method="post" class="mt-4 p-4">
        @csrf
        <fieldset>
            <legend>Dokončené</legend>
            <label>Ano:
                <input class="form-check-input" type="checkbox" name="doneYes" value="Checked" checked id="doneTrue"/></label>
            <label>Nie:
                <input class="form-check-input" type="checkbox" name="doneNo" value="Checked" checked id="doneFalse"/></label>

        </fieldset>
        <br>
        <fieldset>
            <legend>Vlastníctvo</legend>
            <label>Moje:
                <input class="form-check-input" type="checkbox" name="mineYes" value="Checked" checked id="mineTrue"/></label>
            <label>Zdieľané so mnou:
                <input class="form-check-input" type="checkbox" name="mineNo" value="Checked" checked id="mineFalse"/></label>

        </fieldset>
        <br>
        <fieldset>
            <legend>Kategorie</legend>
            @foreach($cats as $cat)
                <label>{{$cat}}:
                    <input class="form-check-input" type="checkbox" name="category{{$cat}}" value="Checked" checked/></label>
            @endforeach
        </fieldset>
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
        $(document).off('change', '.toggleDoneTodo').on('change', '.toggleDoneTodo', function (e) {
            e.preventDefault();

            const id = $(this).data("id");
            const token = $("meta[name='csrf-token']").attr("content");
            let form = $('#filterForm');
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
                    success: function () {
                        $.ajax({
                            type: "POST",
                            url: 'filter',
                            data: form.serialize(),
                            success: function(data)
                            {
                                $('#tabulka').html(data);
                            }
                        });
                    }
                });
        });
        $('.form-check-input').change(function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: 'filter',
                data: $("#filterForm").serialize(),
                success: function(data)
                {
                    $('#tabulka').html(data);
                }
            });
        })

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

