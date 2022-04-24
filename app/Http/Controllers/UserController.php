<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Newsletter;
use App\Models\Tag;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','IsAdmin'],  ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
    }

    //INDEX FUNCTION
    public function index()
    {
        
        $events_all = Event::all();
        $tags_all = Tag::all();
        $users_all = User::paginate(10);
        $subscribers_all = Newsletter::all();

        return view('users.index', compact('events_all', 'tags_all', 'users_all', 'subscribers_all'));
    }

    //CREATE FUNCTION
    public function create()
    {
        //
    }

    //STORE FUNCTION
    public function store(Request $request)
    {
        //
    }

    //SHOW FUNCTION
    public function show($id)
    {
        //
    }

    //EDIT FUNCTION
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //UPDATE FUNCTION
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'min:8', 'max:45', 'unique:users']
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        session()->flash('message', 'The user has been edited successfully');
        return redirect()->route('users.index');
    }

    //EDIT FUNCCTION
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message', 'The user has been deleted successfully');
        return redirect()->route('users.index');
    }
}
