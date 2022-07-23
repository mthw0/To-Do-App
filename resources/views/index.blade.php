@php


@endphp


@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <a href="/create" style="margin-top: 20px"><span id="novaUloha" class="btn btn-primary">Vytvoriť úlohu</span></a>
    <hr>
    <section>
        <form>
            <fieldset>
                <legend>Dokončené:</legend>
                <label>Ano:
                    <input type="checkbox" name="done" value="Ano" checked id="doneTrue"/></label>
                <label>Nie:
                    <input type="checkbox" name="done" value="Nie" checked id="doneFalse"/></label>

            </fieldset>
            <br>
            <fieldset>
                <legend>Moje:</legend>
                <label>Ano:
                    <input type="checkbox" name="mine" value="Ano" checked id="mineTrue"/></label>
                <label>Nie:
                    <input type="checkbox" name="mine" value="Nie" checked id="mineFalse"/></label>

            </fieldset>
            <br>
            <fieldset>
                <legend>Kategorie:</legend>
                @foreach($cats as $cat)
                    <label>{{$cat}}:
                        <input type="checkbox" name="category" value="{{$cat}} " checked/></label>
                @endforeach


        </form>
    </section>

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
                        //alert("Vymazanie prebehlo úspešne!");
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
                                $('#tabulka').html(data);
                            }
                        });
                        //alert("Vymazanie prebehlo úspešne!");
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
                        //alert("Vymazanie prebehlo úspešne!");
                    }
                });

        });

        const checkbox = document.getElementById('doneTrue')

        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                alert('checked');
            } else {
                alert('not checked');
            }
        })


    </script>

@endsection

