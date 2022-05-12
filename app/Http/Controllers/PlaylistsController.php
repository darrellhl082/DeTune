<?php

namespace App\Http\Controllers;

use App\Models\Playlists;
use App\Models\Songs;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Playlists $playlist)
    {
        // return dd($playlist->songs[0]);
        return view('detune.play', [
            "title" => $playlist->name,
            "song" => $playlist->songs[0],
            "songs" => $playlist->songs,
            "playlists" =>Playlists::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('detune.add_playlist', [
            "title" => "Create Playlist"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'desc' => 'required'
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData["key"] = bin2hex(random_bytes(10));
        if(Playlists::where('key', $validatedData["key"])){
            $validatedData["key"] = bin2hex(random_bytes(10));
        }
        Playlists::create($validatedData);  
        return redirect('/playlists/create')->with('success', 'New playlist has been created!');
               
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playlists  $playlists
     * @return \Illuminate\Http\Response
     */
    public function show(Playlists $playlist)

    {
        Playlists::where('id', $playlist->id)->update(['views'=>$playlist->views +1]);
        $is_owner = false;
        if($playlist->user->id==auth()->user()->id){
            $is_owner = true;
        }
        return view('detune.playlist',[
            "title" => $playlist->name,
            'playlist'=>Playlists::where('id',$playlist->id)->with(["songs",'user'])->get(),
            'is_owner' => $is_owner
        ]);
    }
    public function remove_from_playlist(Request $request){
     
        $song = Songs::find($request->song_id);
        Playlists::firstWhere('id',$request->playlist_id)->songs()->detach($song);
        return 'success';
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlists  $playlists
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlists $playlist)
    {
        return view("detune.edit_playlist",[
            "title" => $playlist->name,
            "playlist" => $playlist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlists  $playlists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlists $playlist)
    {
        
        $rules = [
            'name' => 'required|max:255',
            'desc' => 'required'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        Playlists::where('id', $playlist->id)->update($validatedData);
        return back()->with('success', 'Playlist has been updated!');
    }
    public function searchPlaylist(Request $request) {      
        $playlist = Playlists::with("user")->get();      
        if($request->key != ''){      
            $playlist = Playlists::inRandomOrder()->where('name','LIKE','%'.$request->key.'%')->with(['user','songs'])->get();     
         }      
         return response()->json([        
              'playlist' => $playlist    
             ]);   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlists  $playlists
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlists $playlist)
    {
        Playlists::destroy($playlist->id);
        return redirect('/library')->with('success', 'Playlist deleted!');
    }
}
