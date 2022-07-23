@php
    use App\Models\User;
    use App\Models\Category;
    $owner = User::where('id',$todo->owner)->pluck('name');
    $cat = Category::where('id',$todo->category)->pluck('name');
    $owner=$owner[0];
    $cat=$cat[0];
@endphp
<tr>
    @if($todo->done)
        <th scope="row"><a href="show/{{$todo->id}}" style="color: cornflowerblue">
                <del>{{$todo->name}}</del>
            </a></th>
        <td>
            <del>{{$todo->owner==Auth::id()?"Ja (".$owner.")":$owner }}</del>
        </td>
        <td>
            <del>{{$cat }}</del>
        </td>
    @else

        <th scope="row"><a href="show/{{$todo->id}}"
                           style="color: cornflowerblue">{{$todo->name}}</a></th>
        <td>{{$todo->owner==Auth::id()?"Ja (".$owner.")":$owner }}</td>
        <td>{{$cat }}</td>
    @endif
    <td style="color:green;">
        @if($todo->deleted_at==null)
            <a href="/edit/{{$todo->id}}"><span class="btn btn-primary">Upraviť</span></a>
            @if(Auth::id()==$todo->owner)
                <a href="{{ route('todo.delete', $todo->id) }}" class="btn btn-danger deleteTodo"
                   data-id="{{ $todo->id }}">
                    @csrf
                    @method('delete')
                    Vymazať
                </a>
            @endif
            <a href="/hotovo/{{$todo->id}}"><span
                    class="btn {{$todo->done==0?"btn-success":"btn-outline-success"}}">{{$todo->done==0?"Dokončiť":"Pokračovať"}}</span></a>
        @else
            <a href="/undelete/{{$todo->id}}"><span class="btn btn-outline-danger">Obnoviť</span></a>
        @endif


    </td>
</tr>
