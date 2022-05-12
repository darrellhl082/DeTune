<?php

namespace App\Http\Controllers;
use App\Models\Playlists;
use App\Models\User;
use App\Models\Songs;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
   
    public function index(){
         $songs = Songs::where('user_id',  auth()->user()->id)->get();
        return view('detune.library', [
            "title" => "Library",
            "songs" =>Songs::where('user_id',  auth()->user()->id)->latest()->paginate(50),
            "songs_count" =>count($songs),
            "playlists" =>Playlists::where('user_id',  auth()->user()->id)->latest()->get(),
              "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
            "is_owner" =>true
        ]);
    }
}
