<?php

namespace App\Http\Controllers;

use App\Models\Songs;
use App\Models\Playlists;
use Illuminate\Http\Request;
use wapmorgan\Mp3Info\Mp3Info;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Songs $song)
    {
       
        Songs::where('id', $song->id)->update(['plays'=>$song->plays +1]);
      
        return view("detune.play", [
            "title" => "Play",
            "song" => $song,
            "songs" => $song->inRandomOrder()->limit(30)->get(),
              "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
            'playlists' => Playlists::all()
            // limit(floor(Songs::all()->count()*1/3))->
        ]);
    }
    public function add(Songs $song){
        Songs::where('id', $song->id)->update(['plays'=>$song->plays +1]);
    }
    /**s
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('detune.upload',[
            "title"=>"Upload"
        ]);
    }

    public function add_to_playlist(Request $request, Songs $song){
 
        $playlist = Playlists::find([$request->playlist_id]);
        Songs::firstWhere('key',$request->song_key)->playlists()->attach($playlist);
        return 'success';
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        foreach($request->file('songs') as $file){
         
        
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $allowedfileExtension=['mp3'];
            $check=in_array($file->getClientOriginalExtension(),$allowedfileExtension);
            if($check){
                $audio = new Mp3Info($file);
                $audio_duration= date("i:s",floor($audio->duration));
                $validatedData["name"] = $name;
                $validatedData["path"] =  $file->store('songs');
                $validatedData["duration"] = $audio_duration;
                $validatedData['user_id'] = auth()->user()->id;
                $validatedData["key"] = bin2hex(random_bytes(10));
                if(Songs::where('key', $validatedData["key"])){
                    $validatedData["key"] = bin2hex(random_bytes(10));
                }
                 Songs::create($validatedData);    
            } else {
                return back()->with('failed', 'Not Audio File Format!!');
            }
        }
        echo "success";
        return redirect('/song/create')->with('success', 'New Song has been added!');
               
               
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Songs  $songs
     * @return \Illuminate\Http\Response
     */
    public function show(Songs $songs)
    {
        //
    }
      public function searchSong(Request $request) {      
        $songs = Songs::with('user')->get();      
        if($request->key != ''){      
            $songs = Songs::inRandomOrder()->where('name','LIKE','%'.$request->key.'%')->with('user')->get();     
         }      
         if($request->role == 'general'){
         return view::make('detune.partials.cardsearch',[
             'songs'=>$songs,
               "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
            'playlists' =>Playlists::all(),
            
         ]); 
        } elseif($request->role == 'swap') {
            return view::make('detune.partials.cardsearchswap',[
                'songs'=>$songs,
                  "playlists_owner" => Playlists::where("user_id", auth()->user()->id)->get(),
               'playlists' =>Playlists::all(),
            ]); 
        }  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Songs  $songs
     * @return \Illuminate\Http\Response
     */
    public function edit(Songs $songs)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Songs  $songs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Songs $song)
    {
        $rules = [
            'name' =>'required|max:225' 
        ];
        $validatedData = $request->validate($rules);  
        Songs::where('id', $song->id)->update($validatedData);
        return redirect('/library')->with('success', 'Song has been updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Songs  $songs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Songs $song)
    {
        if($song->path){
            Storage::delete($song->path);
        }
        Songs::destroy($song->id);
        return redirect('/library')->with('success', 'Song deleted!');

    }
}
