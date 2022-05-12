<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PlaylistsController;
use App\Models\Songs;
use App\Models\Playlists;


Route::get('/', function (Songs $songs, Playlists $playlist) {
    
    return view('detune.index', [
        "title" => "Home",
        "songs" => $songs->orderBy('plays','desc')->paginate(50),
        'songs_count' => count(Songs::all()),
        'playlists' => $playlist->orderBy('views','desc')->get(),
        "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
        "is_owner" => false
    ]);
});

Route::get('/search', function () {
    return view('detune.search', [
        "title" => "Search",
        'is_owner' => false,
        'songs' => Songs::inRandomOrder()->get(),
          "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
        'playlists' => Playlists::all()
    ]);
})->middleware('auth');
Route::get('/library/upload', function () {
    return view('detune.upload', [
        "title" => "Upload"
    ]);
})->middleware('auth');

Route::get('/library', [LibraryController::class,'index'] )->middleware('auth');
Route::get('/play/{song:key}', [SongsController::class,"index"]);
Route::get('/playlist/play/{playlist:key}', [PlaylistsController::class,"index"])->middleware('auth');

Route::get('/login',[LoginController::class,'index'])->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate'])->name('login')->middleware('guest');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/register',[RegisterController::class,'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);
Route::resource('/song', SongsController::class)->middleware('auth');
Route::get('/songs', [SongsController::class,"create"])->middleware('auth');
Route::get('/song/{song:key}', [SongsController::class,"add"])->middleware('auth');
Route::post('/addtoplaylist', [SongsController::class,"add_to_playlist"])->middleware('auth');
Route::post('/removefromplaylist', [PlaylistsController::class,"remove_from_playlist"])->middleware('auth');
Route::resource('/playlists', PlaylistsController::class)->except("show")->middleware('auth');
Route::get('/playlists/{playlist:key}', [PlaylistsController::class,"show"])->middleware('auth');
Route::post('/search/song', [SongsController::class,"searchSong"]);
Route::post('/search/playlist', [PlaylistsController::class,"searchPlaylist"]);


