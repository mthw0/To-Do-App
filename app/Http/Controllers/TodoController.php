<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sharing;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all()->where('owner', '==', Auth::id());
        $sharing = DB::table('sharings')->get();
        foreach ($sharing as $share) {

            if ($share->user_id == Auth::id()) {
                $todos->add(Todo::all()->where('id', '==', $share->todo_id)->first());
            }

        }

        return view('index')->with('todos', $todos);
    }

    public function create()
    {
        $nazvy = [];
        foreach (Category::all() as $cat) {
            $nazvy[] = $cat->name;

        }
        $users = [];
        foreach (User::all() as $user) {
            if ($user->id != Auth::id()) {
                $users[] = $user->name;
            }

        }
        return view('todos.create', ['nazvy' => $nazvy, 'users' => $users]);
    }

    public function show(Todo $todo)
    {
        return view('show')->with('todos', $todo);
    }

    public function edit(Todo $todo)
    {
        $nazvy = [];
        foreach (Category::all() as $cat) {
            $nazvy[] = $cat->name;
        }
        $users = [];
        foreach (User::all() as $user) {
            if ($user->id != Auth::id()) {
                $users[] = $user->name;
            }
        }
        return view('edit', ['nazvy' => $nazvy, 'users' => $users])->with('todo', $todo);
    }

    public function update(Todo $todo)
    {
        $this->validate(request(), [
            'name' => ['required'],
            'description' => ['required'],

        ]);


        $data = request()->all();

        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $cat = Category::where('name', $data['category'])->pluck('id');

        if ($data['user'] != null) {
            $sharing= new Sharing();
            $rec = User::where('name', $data['user'])->pluck('id');
            $sharing->user_id = $rec[0];
            $sharing->todo_id = $todo->id;
            $sharing->save();
        } else {
            $id = DB::table('sharings')->where('todo_id',$todo->id)->get();
            $id=$id[0];
            DB::table('sharings')->delete($id->id);
        }
        $todo->category = $cat[0];
        $todo->owner = Auth::id();
        $todo->save();

        session()->flash('success', 'Úloha bola aktualizovaná');

        return redirect('/');

    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        return redirect('/');
    }

    public function store()
    {


        $this->validate(request(), [
            'name' => ['required'],
            'description' => ['required']
        ]);

        $data = request()->all();

        $todo = new Todo();
        $sharing = new Sharing();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $cat = Category::where('name', $data['category'])->pluck('id');
        $todo->category = $cat[0];
        $todo->owner = Auth::id();
        $todo->save();
        if ($data['user'] != null) {
            $rec = User::where('name', $data['user'])->pluck('id');
            $sharing->todo_id = $todo->id;
            $sharing->user_id = $rec[0];
            $sharing->save();
        }

        session()->flash('success', 'Úloha bola vytvorená!');

        return redirect('/');

    }

    public function toggle_done(Todo $todo)
    {
        $todo->done = ($todo->done + 1) % 2;
        $todo->save();
        return redirect('/');
    }
}
