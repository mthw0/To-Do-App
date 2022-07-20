<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sharing;
use App\Models\Todo;
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

            if ($share->user_id==Auth::id()) {
                $todos->add( Todo::all()->where('id','==',$share->todo_id)->first());
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
        return view('todos.create', ['nazvy' => $nazvy]);
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
        return view('edit', ['nazvy' => $nazvy])->with('todo', $todo);
    }

    public function update(Todo $todo)
    {
        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required'],

            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $cat = Category::where('name', $data['category'])->pluck('id');

        $todo->category = $cat[0];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

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
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $cat = Category::where('name', $data['category'])->pluck('id');
        $todo->category = $cat[0];
        $todo->owner = Auth::id();

        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');

    }

    public function toggle_done(Todo $todo)
    {
        $todo->done = ($todo->done + 1) % 2;
        $todo->save();
        return redirect('/');
    }
}
