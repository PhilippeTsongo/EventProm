<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EventController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy', 'myevent'] ]);

    }

    public function index()
    {
        $events = Event::where('starts_at', '>=' , now())
                        ->with(['image'])
                        ->orderBy('starts_at', 'ASC')
                        ->take('3')
                        ->get();              

        $events_all = Event::orderBy('starts_at', 'ASC')->paginate(5);    

        return view('event.index', compact(['events', 'events_all']));    
    }

    public function create()
    {
        $auth_user = auth()->user()->id;

        $my_events = Event::where('user_id',$auth_user)
                        ->with(['user'])
                        ->orderBy('id', 'DESC')
                        ->take('6')
                        ->get();

        $events_all = Event::orderBy('starts_at', 'ASC')->paginate(5);                 

        return view('event.create', compact('my_events' , 'events_all'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'min:5', 'max:250', 'unique:events'],
            'content' => ['required', 'min:5'],
            'starts_at' => ['required', 'max:30'],
            'end_date' => ['required', 'max:30'],
            
        ]);

        $file_name = time() .''. rand();
        $path = $request->EventFile->storeAs('eventsimages', $file_name , 'public');

        $user_con = auth()->user();

        $event = $user_con->events()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'premium' => $request->filled('premium'),
            'starts_at' => $request->starts_at,
            'end_date' => $request->end_date,
        ]);

        $image = new Image();
        $image->path = $path;
        $event->image()->save($image);

       
        $tag = Tag::firstOrCreate([
            'name' => $request->tags,
            'slug' => Str::slug($request->tags)
        ]);
        $event->tags()->attach($tag->id);
        
        session()->flash('message', 'Event created successfully');
        return redirect()->route('event.myevent');
    }

   //SHOWING ONE EVENT
    public function show(Event $event, Tag $tag)
    {
        return view('event.event', compact('event'));
    }

    //EDIT FUNCTION
    public function edit(Event $event, Tag $tag)
    {
        $auth_user = auth()->user()->id;

        $my_events = Event::where('user_id',$auth_user)
                        ->with(['user'])
                        ->orderBy('id', 'DESC')
                        ->take('6')
                        ->get();

        return view('event.eventedit', compact('event', 'tag', 'my_events' ));

    }
    
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:250'],
            'content' => ['required', 'min:5'],
            'starts_at' => ['required', 'max:30'],
            'end_date' => ['required', 'max:30'],
            
        ]);

        $event->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'premium' => $request->filled('premium'),
            'starts_at' => $request->starts_at,
            'end_date' => $request->end_date
        ]);
            
        $tag = Tag::firstOrCreate([
            'name' => $request->tags,
            'slug' => Str::slug($request->tags)
        ]);


        $event->tags()->attach($tag->id);

        session()->flash('message', 'Event edited successfully');
        return redirect()->route('event.myevent');

    }

    public function destroy(event $event)
    {
        $event->delete();
        session()->flash('message', 'Event deleted successfully');
        return redirect()->route('event.create');
    }

    public function myevent()
    {
        $auth_user = auth()->user()->id;

        $my_events = Event::where('user_id',$auth_user)
                        ->with(['user'])
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('event.myevent', compact('my_events'));
    }

    //SEARCH FUNCTION
    public function search()
    {
        $search = $_GET['query'];
        $events = Event::where('title', 'LIKE', '%' . $search . '%')->get();

        $events_all = Event::orderBy('starts_at', 'ASC')->paginate(5);    

        return view('event.search', compact('events', 'events_all', 'search'));
    }


}
