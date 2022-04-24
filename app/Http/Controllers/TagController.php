<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Event;
use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'IsAdmin'],  ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']]);
    }

    public function index()
    {
        $tags_all = Tag::paginate(10);    
        $events_all = Event::all();
        $users_all = User::all();
        $subscribers_all = Newsletter::all();

        return view('tag.index', compact('events_all', 'tags_all', 'users_all', 'subscribers_all'));
    }

    public function create()
    {
        return view('tag.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:200', 'unique:tags'],
        ]);
       
        $tag = Tag::firstOrCreate([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        session()->flash('message', 'Tag created successfully');
        return redirect()->route('tag.index');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

   
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:200', 'unique:tags'],
        ]);
       
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        session()->flash('message', 'Tag updated successfully');
        return redirect()->route('tag.index');
    }

    
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('message', 'Tag deleted successfully');
        return redirect()->route('tag.index');    
    }
}
