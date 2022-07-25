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
            success: function () {
                $.ajax({
                    type: "POST",
                    url: 'filter',
                    data: form.serialize(),
                    success: function (data) {
                        $('#tabulka').html(data);
                    }
                });
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
                    type: "POST",
                    url: 'filter',
                    data: form.serialize(),
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
                    success: function (data) {
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
        success: function (data) {
            $('#tabulka').html(data);
        }
    });
})
$('#novaUloha').click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: 'create',
        success: function (data) {
            $('#obsah').html(data);
        }
    })
})


$(document).off('click', '.todoName').on('click', '.todoName', function (e){
    e.preventDefault();
    const token = $("meta[name='csrf-token']").attr("content");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const id = $(this).data("id");
    $.ajax({
        type:"GET",
        token:token,
        url: 'show/' + id,
        success: function (data) {
            $('#obsah').html(data);
        }
    })

})

