@if(count($songs)<1)
    <p>No Result Found</p>
@else 
@foreach ($songs as $song1)
<li class="list-group-item p-3 "  name="{{ $song1->name }}">
    <div class="track-list-branch"  >
        <div class="d-block">
            <h3 class="fs-6">{{ $song1->name }}</h3>
            <p class="card-text">{{ $song1->duration }}</p>
        </div>
        <a href="/play/{{ $song1->key }}" class="text-decoration-none hovertext" data-hover="Play Now">
            <img class="icon" src="/rsc/icon/play.png" alt="">
         </a>
        <a href="#" class="text-decoration-none hovertext playnext" data-hover="Play Next">
           <img class="icon" src="/rsc/icon/playlist.png" alt="">
        </a>
       @auth
        <a class="text-decoration-none hovertext" data-hover="Add to Playlist" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="icon" src="/rsc/icon/playlist3.png" alt="">
        </a>
        <ul class="dropdown-menu" class="playlist-play"  style="background-color: black" aria-labelledby="dropdownMenuLink">
            <form class="cat_form" method="post">
             
                @csrf
                <input type="hidden" name="playlist_id" class="cat_id">
                <input type="hidden" name="song_key" class="song_key" value="{{ $song1->key }}">
            </form>
            @foreach ($playlists_owner as $playlist1)
                <li class="dropdown-item playlist-list playlist-play " style="background-color: black"  name="{{ $playlist1->id }}">{{ $playlist1->name }}</li>
            @endforeach
          </ul>
          @endauth
    </div>
    
</li>

@endforeach
@endif
