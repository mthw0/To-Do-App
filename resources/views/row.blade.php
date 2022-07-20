@php
    use App\Models\User;
    use App\Models\Category;
    $owner = User::where('id',$todo->owner)->pluck('name');
    $cat = Category::where('id',$todo->category)->pluck('name');
    $owner=$owner[0];
    $cat=$cat[0];
@endphp
<tr>
    <th scope="row"><a href="show/{{$todo->id}}"
                       style="color: cornflowerblue">{{$todo->name}}</a></th>
    <td>{{$todo->done==0?"Prebieha":"Dokončené"}}</td>
    <td>{{$todo->owner==Auth::id()?"Ja":$owner }}</td>
    <td>{{$cat }}</td>

    <td>
        <a href="/edit/{{$todo->id}}"><span class="btn btn-primary">Upraviť</span></a>
        <a href="/delete/{{$todo->id}}"><span class="btn btn-danger">Vymazať</span></a>
        <a href="/hotovo/{{$todo->id}}"><span
                class="btn btn-success">{{$todo->done==0?"Dokončiť":"Pokračovať"}}</span></a>
    </td>
</tr>
