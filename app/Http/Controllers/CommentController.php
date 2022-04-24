<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function create()
    {
    
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit(Request $request, $id)
    {
        
        $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'website' => ['max:35'],
            'comment' => ['required', 'min:2'],
            'email' => ['required', 'min:10', 'max:45']
        ]);

        $event = Event::findOrFail($id); 


        $comment = Comment::create([
            'name' => $request->name,
            'website' => $request->website,
            'comment' => $request->comment,
            'event_id' => $event->id,
            'email' => $request->email
        ]);

        session()->flash('message', 'Your Comment has been posted successfully');

        return redirect(route('event.show', $event));
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
