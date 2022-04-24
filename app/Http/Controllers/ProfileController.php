<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Imageprofile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //INDEX FUNCTION RETURN THE AUTHENTICATED USER PROFILE
    public function index()
    {
        $user_id = auth()->user()->id;
        $my_events = Event::where('user_id', $user_id)
                            ->with('user')
                            ->orderBy('id','DESC')
                            ->get();

        $auth_user = auth()->user();
        return view('profile.index', compact('auth_user', 'my_events', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // EDIT MY PROFILE
    public function edit(User $profile)
    {
        $user_id = auth()->user()->id;
        $my_events = Event::where('user_id', $user_id)
                            ->with('user')
                            ->orderBy('id','DESC')
                            ->get();

        $auth_user = auth()->user();

        return view('profile.edit', compact('profile', 'my_events', 'auth_user'));
    }

    //UPDATE MY PROFILE
    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'max:30'],
            'last_name' => ['min:3', 'max:10'],
            'location' => ['max:30'],
            'intro' => ['max: 100']
        ]);

        // $file_name = time() .''. rand();
        // $path = $request->profile_image->storeAs('profilesimages', $file_name , 'public');

        $user = $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'last_name' => $request->last_name,
            'location' => $request->location,
            'intro' => $request->intro
        ]);

        $imageprofile = new Imageprofile();

        // $imageprofile->path = $path;
        // $user->imageprofile()->save($imageprofile);
        

        session()->flash('message', 'Your profile has been updated successfully');
        return redirect()->route('profile.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
