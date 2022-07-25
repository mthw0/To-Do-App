@php
    use App\Models\User;
    use App\Models\Category;
    $owner = User::where('id',$todo->owner)->pluck('name');
    $cat = Category::where('id',$todo->category)->pluck('name');
    $owner=$owner[0];
    $cat=$cat[0];
@endphp
<tr id="row{{$todo->id}}" data-id="{{ $todo->id }}">

    @if($todo->done)

        <th scope="row">
            <input type="checkbox" href="/hotovo/{{$todo->id}}" class="form-check-input toggleDoneTodo"
                   {{$todo->done==0?"":"checked"}} data-id="{{ $todo->id }}">
        </th>
        <td><a data-id="{{ $todo->id }}" href="show/{{$todo->id}}">
                <del>{{$todo->name}}</del>
            </a></td>
        <td>
            <del>{{$todo->owner==Auth::id()?"Ja (".$owner.")":$owner }}</del>
        </td>
        <td>
            <del>{{$cat }}</del>
        </td>
    @else
        <th scope="row">
            <input type="checkbox" href="/hotovo/{{$todo->id}}" class="form-check-input toggleDoneTodo"
                   {{$todo->done==0?"":"checked"}} data-id="{{ $todo->id }}">
        </th>
        <td>
            <a href="show/{{$todo->id}}" >{{$todo->name}}</a>
        </td>
        <td>{{$todo->owner==Auth::id()?"Ja (".$owner.")":$owner }}</td>
        <td>{{$cat }}</td>
    @endif
    <td style="color:green;">
        @if($todo->deleted_at==null)
            <a href="/edit/{{$todo->id}}" title="Upraviť" class="btn btn-outline-primary">✏️</a>
            @if(Auth::id()==$todo->owner)
                <a href="{{ route('todo.delete', $todo->id) }}" class="btn btn-outline-danger deleteTodo"
                   data-id="{{ $todo->id }}" title="Vymazať">
                    @csrf
                    @method('delete')
                    🗑️
                </a>
            @endif

        @else
            <a href="/undelete/{{$todo->id}}" class="btn btn-outline-danger undeleteTodo" data-id="{{ $todo->id }}">Obnoviť</a>
        @endif


    </td>
</tr>
