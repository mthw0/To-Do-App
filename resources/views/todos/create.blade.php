<form id="createNewForm" action="store-data" method="post" class="mt-4 p-4">
    @csrf
    <div class="form-group m-3">
        <label for="name">Názov úlohy</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group m-3">
        <label for="description">Popis úlohy</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <div class="form-group m-3">
        <label for="category">Kategória</label>
        <select class="form-control" id="category" name="category">

            @foreach((array)$nazvy as $nazov)
                <option>{{$nazov}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-3">
        <label for="user">Zdieľanie</label>
        <select class="form-control" id="user" name="user">
            <option></option>
            @foreach((array)$users as $user)
                <option>{{$user}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-3">
        <input type="submit" class="btn btn-primary float-end" id="createNewConfirmButton" value="Odoslať">
    </div>
    <a href="" id="backButton" class="btn btn-secondary">Späť</a>
</form>
