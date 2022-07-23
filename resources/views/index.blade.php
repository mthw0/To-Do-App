@extends('layouts.app')
@section('title')
    Úlohy
@endsection
@section('content')
    <a href="/create" style="margin-top: 20px"><span id="novaUloha" class="btn btn-primary">Vytvoriť úlohu</span></a>
    <div id="tabulka"></div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"fetch",
                success:function(data)
                {
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
                                url:"fetch",
                                success:function(data)
                                {
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
                                url:"fetch",
                                success:function(data)
                                {
                                    $('#tabulka').html(data);
                                }
                            });
                            //alert("Vymazanie prebehlo úspešne!");
                        }
                    });

        });
    </script>


@endsection

