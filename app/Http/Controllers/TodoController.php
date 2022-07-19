<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {

        $todos = Todo::all();
        return view('index')->with('todos', $todos);

    }

    public function create()
    {
        return view('todos.create');
    }

    public function show(Todo $todo)
    {

        return view('show')->with('todos', $todo);

    }

    public function edit(Todo $todo)
    {

        return view('edit')->with('todo',$todo);

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
        //dd($todo);
        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');

    }
}