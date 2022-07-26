<div class="card text-center mt-5">
    <div class="card-header">
        <h5 class="card-title">{{$todos->name}}{{$todos->done==1?" - dokončné":" - prebieha"}}</h5>
    </div>
    <div class="card-body">
        <p class="card-text">{{$todos->description}}.</p>

        @if(Auth::id()==$todos->owner)
            @if($todos->deleted_at==null)

                <a href="/hotovo/{{$todos->id}}" title="Dokončiť"
                   class="btn btn-outline-success">{{$todos->done==0?"✔️":"✔️"}}</a>
                <a href="/edit/{{$todos->id}}" title="Upraviť" id="todoEdit" data-id="{{ $todos->id }}"
                   class="btn btn-outline-primary">✏️</a>
                <a href="/delete/{{$todos->id}}" title="Vymazať" class="btn btn-outline-danger">
                    🗑️
                </a>
            @else

                <a href="/undelete/{{$todos->id}}" class="btn btn-outline-danger undeleteTodo" title="Obnoviť"
                   data-id="{{ $todos->id }}"></a>
            @endif
        @endif
        <a title="Prejsť naspäť" href="" id="backButton" class="btn btn-outline-secondary">🔙</a>
    </div>
</div>

