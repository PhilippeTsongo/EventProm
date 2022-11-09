<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AuthorEventController;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $events = Event::where('starts_at', '>=' , now())
                        ->with(['image'])
                        ->orderBy('starts_at', 'ASC')
                        ->take('3')
                        ->get();              

    $events_all = Event::orderBy('starts_at', 'ASC')->paginate(5);    

    return view('event.index', compact(['events', 'events_all']));    
});

Route::resource('/event', EventController::class);
Route::PUT('event/{management}', [ EventController::class, 'event'])->name('event.myevent');
Route::get('myevent', [ EventController::class, 'myevent'])->name('event.myevent');
Route::resource('/comment', CommentController::class);
Route::resource('/newsletter', NewsletterController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/author', AuthorEventController::class);
Route::get('/search', [EventController::class, 'search'])->name('event.search');


//Admin Route
Route::resource('/management', ManagementController::class);
Route::resource('/users', UserController::class);
Route::resource('/tag', TagController::class);

require __DIR__.'/auth.php';
