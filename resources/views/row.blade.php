@php
    use App\Models\User;
    $owner = User::where('id',$todo->owner)->pluck('name');
@endphp
<tr>
    <th scope="row"><a href="show/{{$todo->id}}"
                       style="color: cornflowerblue">{{$todo->name}}</a></th>
    <td>{{$todo->done==0?"Prebieha":"Dokončené"}}</td>
    <td>{{$owner[0] }}</td>

    <td>
        <a href="/edit/{{$todo->id}}"><span class="btn btn-primary">Upraviť</span></a>
        <a href="/delete/{{$todo->id}}"><span class="btn btn-danger">Vymazať</span></a>
        <a href="/hotovo/{{$todo->id}}"><span
                class="btn btn-success">{{$todo->done==0?"Dokončiť":"Pokračovať"}}</span></a>
    </td>
</tr>
