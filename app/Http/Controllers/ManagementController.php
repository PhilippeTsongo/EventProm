<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Newsletter;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','IsAdmin'],  ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
    }

    public function index()
    {
        $events_all = Event::paginate(5);
        $tags_all = Tag::all();
        $users_all = User::all();
        $subscribers_all = Newsletter::all();

        return view('management.index', compact('events_all', 'tags_all', 'users_all', 'subscribers_all'));
    }


    public function create()
    {
       //
    }


    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    public function edit(Event $management)
    {
        return view('management.edit', compact('management'));
    }

    
    //ADMIN UPDATE AN EVENT
    public function update(Request $request, Event $management)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:250', 'unique:events'],
            'content' => ['required', 'min:5'],
            'starts_at' => ['required', 'max:30'],
            'end_date' => ['required', 'max:30']
        ]);

        $management->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'premium' => $request->filled('premium'),
            'starts_at' => $request->starts_at,
            'end_date' => $request->end_date
        ]);

        session()->flash('message', 'Event edited successfully');
        return redirect()->route('management.index');
    }

    //DELETE FUNCTION
    public function destroy(Event $management)
    {
        $management->delete();
        session()->flash('message', 'Event delete successfully');
        return redirect()->route('management.index');
    }

}
