<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Objednavka;
use App\Models\Sharing;
use App\Models\Todo;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::withoutTrashed()->orderBy('deleted_at')->orderBy('done')->orderBy('category')->get()->where('owner', '==', Auth::id());
        $todos2 = Todo::onlyTrashed()->orderBy('deleted_at')->orderBy('done')->orderBy('category')->get()->where('owner', '==', Auth::id());
        $sharing = DB::table('sharings')->get();
        foreach ($sharing as $share) {

            if ($share->user_id == Auth::id()) {
                $todos->add(Todo::all()->where('id', '==', $share->todo_id)->first());
            }
        }
        return view('index', ['todos' => $todos, 'todos2' => $todos2]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $todos = Todo::withoutTrashed()->orderBy('deleted_at')->orderBy('done')->orderBy('category')->get()->where('owner', '==', Auth::id());
            $todos2 = Todo::onlyTrashed()->orderBy('deleted_at')->orderBy('done')->orderBy('category')->get()->where('owner', '==', Auth::id());
            $sharing = DB::table('sharings')->get();
            foreach ($sharing as $share) {

                if ($share->user_id == Auth::id()) {
                    $todos->add(Todo::all()->where('id', '==', $share->todo_id)->first());
                }
            }
            return view('tabulka', ['todos' => $todos, 'todos2' => $todos2])->render();
        }
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
            $sharing = new Sharing();
            $rec = User::where('name', $data['user'])->pluck('id');
            $sharing->user_id = $rec[0];
            $sharing->todo_id = $todo->id;
            $sharing->save();
        } else {
            $id = DB::table('sharings')->where('todo_id', $todo->id)->get();
            $id = $id[0];
            DB::table('sharings')->delete($id->id);
        }
        $todo->category = $cat[0];
        $todo->owner = Auth::id();
        $todo->save();

        session()->flash('success', 'Úloha bola aktualizovaná');

        return redirect('/');
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return response('success', 200);

    }

    public function undelete($id)
    {
        $todo = Todo::withTrashed()->find($id);
        $todo->restore();
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
            //email send
            $message = [
                'greeting' => 'Ahoj',
                'body' => 'Používateľ ' . $data['user'] . 's vami zdieľa úlohu',
                'thanks' => 'Pozrite si ju tu:',
                'actionText' => 'Odkaz',
                'actionURL' => url('/show/' . $todo->id),
                'id' => $todo->id
            ];
            $user = User::find($rec);
            $user->notify(new EmailNotification($message));

        }

        session()->flash('success', 'Úloha bola vytvorená!');

        return redirect('/');

    }

    public function toggle_done(Todo $todo)
    {
        $todo->done = ($todo->done + 1) % 2;
        $todo->save();
        //email send
        if ($todo->done) {
            $message = [
                'greeting' => 'Ahoj',
                'body' => 'Uloha ' . $todo->name . ' bola dokončená',
                'thanks' => 'Bla bla bla toto je text',
                'actionText' => 'Odkaz',
                'actionURL' => url('/show/' . $todo->id),
                'id' => $todo->id
            ];
            $user = User::find($todo->owner);
            $user->notify(new EmailNotification($message));

        } else {
            $message = [
                'greeting' => 'Ahoj',
                'body' => 'Uloha ' . $todo->name . ' už nie je dokončená',
                'thanks' => 'Bla bla bla toto je text',
                'actionText' => 'Odkaz',
                'actionURL' => url('/show/' . $todo->id),
                'id' => $todo->id
            ];
            $user = User::find($todo->owner);
            $user->notify(new EmailNotification($message));

        }
        return redirect('/');
    }

    public function send()
    {
        //
    }

}
