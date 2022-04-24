<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Tag;
use App\Models\Event;
use App\Models\User;

class NewsletterController extends Controller
{
    //INDEX FUNCTION
    public function index()
    {

        $events_all = Event::all();
        $tags_all = Tag::all();
        $users_all = User::all();
        $subscribers_all = Newsletter::paginate(10);

        return view('newsletter.index', compact('events_all', 'tags_all', 'users_all', 'subscribers_all'));

        

    }

    //CREATE A RECORD
    public function create()
    {
        //
    }

    //STORE A RECORD
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'min:10', 'max:45', 'unique:newsletters']
        ]);

        $newsletter = Newsletter::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email
        ]);
        session()->flash('message', 'You have been subscribed to our newsletter!');
        return redirect()->route('event.index');
    }

    //SHOW A RECORDemail
    public function show($id)
    {
        //
    }

    //EDIT A RECORD
    public function edit($id)
    {
        //
    }

    //UPDATE A RECORD    
    public function update(Request $request, $id)
    {
        //
    }

    //DELETE A RECORD
    public function destroy($id)
    {
        //
    }
}
