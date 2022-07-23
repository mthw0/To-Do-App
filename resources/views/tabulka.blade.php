<table id="tabulka1" class="table table-hover table-responsive" style="display: inline-table">
    <thead>
    <tr>
        <th scope="col">Názov</th>
        <th scope="col">Vlastník</th>
        <th scope="col">Kategória</th>
        <th scope="col">Akcie</th>
    </tr>
    </thead>
    <tbody id="tabulka1_body">
    @foreach($todos as $todo)
        @include('row')
    @endforeach

    </tbody>

</table>
<h2>Vymazané</h2>
<table id="tabulka2" class="table table-hover table-responsive" style="display: inline-table">
    <thead>
    <tr>
        <th scope="col">Názov</th>
        <th scope="col">Vlastník</th>
        <th scope="col">Kategória</th>
        <th scope="col">Akcie</th>
    </tr>
    </thead>
    <tbody id="tabulka2_body">
    @foreach($todos2 as $todo)
        @include('row')
    @endforeach

    </tbody>

</table>
