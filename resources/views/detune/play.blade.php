
@extends('detune.layouts.main')
@section('container')
    <div class="container">
        <div class="row play-container">
            <div class="col-lg-8">
                <div class="player">
                    <div class="details">
                        <div class="now-playing" style="margin-top:-20px">PLAYING x OF y</div>
                        <div class="track-name mt-md-5 text-center">Track Name</div>
                
                    </div>
                    <div class="buttons">
                        <div class="repeatBtn" onclick="repeatTrack()"><span data-feather="repeat"></span></div>
                        <div class="prev-track" onclick="prevTrack()"><span data-feather="chevrons-left"></span></div>
                        <div class="playpause-track" onclick="playpauseTrack()">
                            <img src="/rsc/icon/play-circle.svg" class="playpause" alt="">
                        </div>
                        <div class="next-track" onclick="nextTrack()"><span data-feather="chevrons-right"></span></div>
                        <div class="btnshare  share-play"  > <span data-feather="share-2" class="btnshare  share-play"  ></span></div>
                    </div>
                    <div class="slider_container">
                        <div class="current-time">00:00</div>
                        <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
                        <div class="total-duration">00:00</div>
                    </div>
                    <div class="slider_container">
                        <i class="fa fa-volume-down"></i>
                        <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
                        <i class="fa fa-volume-up"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                
                <div class="list  ">
                    <div class="d-flex flex-row">
                        <div class="swap-active fs-5 p-2 swap-t">TRACK LIST</div>
                        <div class=" fs-5 p-2 swap-s">SEARCH</div>
                    </div>
                    
                    <div class="track-branch">
                        <div class="search-swap">
                            <form  class="d-flex flex-row form-search">
                                @csrf
                                    <input type="text" class="form-control d-inline-block w-100 swap-search-key"  placeholder="Search.." value="{{ request('search') }}" name="search">
                                   
                            </form>
                            <ul class="list-group w-100 search-field" style="height: 100%">
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
                                            {{-- action="/addtoplaylist/{{ $song->key }}" --}}
                                            @csrf
                                            <input type="hidden" name="playlist_id" class="cat_id">
                                            <input type="hidden" name="song_key" class="song_key" value="{{ $song->key }}">
                                        </form>
                                        @foreach ($playlists_owner as $playlist1)
                                            <li class="dropdown-item playlist-list playlist-play " style="background-color: black"  name="{{ $playlist1->id }}">{{ $playlist1->name }}</li>
                                        @endforeach
                                      </ul>
            
                                     @endauth
                                   
                                </div>
                                
                            </li>
                      
                            @endforeach
                            </ul>
                        </div>
                       
                        <ul class="list-group w-100 list-swap " style="height: 100%;">
                            <li class="list-group-item p-3 "  id="0" name="{{ $song->name }}">
                                <div class="track-list-branch">
                                    <div class="d-block">
                                        <h3 class="fs-6">{{ $song->name }}</h3>
                                        <p class="card-text">{{ $song->duration }}</p>
                                    </div>
                                    <a href="/play/{{ $song->key }}"  class="text-decoration-none hovertext" data-hover="Play Now">
                                        <img class="icon" src="/rsc/icon/play.png" alt="">
                                     </a>
                                    <a href="#"  class="text-decoration-none hovertext playnext" data-hover="Play Next">
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
                                            <input type="hidden" name="song_key" class="song_key" value="{{ $song->key }}">
                                        </form>
                                        @foreach ($playlists_owner as $playlist1)
                                            <li class="dropdown-item playlist-list playlist-play " style="background-color: black"  name="{{ $playlist1->id }}">{{ $playlist1->name }}</li>
                                        @endforeach
                                      </ul>
            
                                     @endauth
                                </div>
                                
                            </li>
                            <?php $i = 1;?>
                            @foreach ($songs as $song1)
                            <li class="list-group-item p-3 " id="{{ $i }}" name="{{ $song1->name }}">
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
                                            <input type="hidden" name="song_key" class="song_key" value="{{ $song->key }}">
                                        </form>
                                        @foreach ($playlists_owner as $playlist1)
                                            <li class="dropdown-item playlist-list playlist-play " style="background-color: black"  name="{{ $playlist1->id }}">{{ $playlist1->name }}</li>
                                        @endforeach
                                      </ul>
            
                                     @endauth
                                </div>
                                
                            </li>
                            <?php $i++;?>
                            @endforeach
                            
                          </ul>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
     $(".btnshare").click(function(e){
        let link = e.target.getAttribute("link");
        console.log(link)
        navigator.clipboard.writeText(link)
    })
        let now_playing = document.querySelector(".now-playing");
     
        let track_name = document.querySelector(".track-name");
        let track_artist = document.querySelector(".track-artist");
    
        let playpause_btn = document.querySelector(".playpause-track");
        let next_btn = document.querySelector(".next-track");
        let prev_btn = document.querySelector(".prev-track");
        
        let seek_slider = document.querySelector(".seek_slider");
        let volume_slider = document.querySelector(".volume_slider");
        let curr_time = document.querySelector(".current-time");
        let total_duration = document.querySelector(".total-duration");
        let repeatBtn = document.querySelector('.repeatBtn')
        let track_index = 0;
        let isPlaying = false;
        let updateTimer;
        let repeat = false;
        let play_next_check = false;
        let next_play;
        document.querySelectorAll('.playnext').forEach(element => {
            element.addEventListener('click',function(e){
       
              play_next_check = true;
              next_play = e.target.parentNode.parentNode.parentNode.id;
              document.querySelector('.notif').innerHTML = e.target.parentNode.parentNode.parentNode.getAttribute("name") + ' will played after this';
              document.querySelector('.notif').classList.remove('d-none');
              setTimeout(() => {
                
                    document.querySelector('.notif').style.opacity=0;
                    setTimeout(() => {
                    document.querySelector('.notif').classList.add('d-none');
                    document.querySelector('.notif').style.opacity=0.9;
                    }, 2000);
              }, 3000);
             
      })
        });
      
        function repeatTrack(){
           if (repeat == false){
               repeatBtn.classList.add('repeat-true');
               repeat = true;
           } else {
               repeat = false;
               repeatBtn.classList.remove('repeat-true');
           }
        
        }
        // Create new audio element
        let curr_track = document.createElement('audio');
    
        // Define the tracks that have to be played;
        let track_list = [<?= json_encode($song)?>];
        let other = <?= json_encode($songs)?>;
       other.forEach(i=> {
           track_list.push(i)
       });
       function now_playing_status(current_track){
           document.getElementById(current_track).style.background = 'rgba(0,0,0,.5)';
       }
       function end_status(current_track){
            document.getElementById(current_track).style.background = 'rgba(0,0,0,.8)';
       }
        function loadTrack(track_index) {
            clearInterval(updateTimer);
            resetValues();
            let key = track_list[track_index].key;
            // Load a new track
            $('.share-play').attr("link", `https://detune.my.id/play/${key}`) ;
            curr_track.src = '/'+ track_list[track_index].path;
            curr_track.title = track_list[track_index].name;
            curr_track.load();
     
            // Update details of the track
           
            track_name.textContent = track_list[track_index].name;
            now_playing_status(track_index);
            now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;
    
            // Set an interval of 1000 milliseconds for updating the seek slider
            updateTimer = setInterval(seekUpdate, 1000);
    
            // Move to the next track if the current one finishes playing
            curr_track.addEventListener("ended",  nextTrack);
            
            // Apply a random background color
            random_bg_color();
           
        }
    
        function random_bg_color() {
    
            // Get a random number between 64 to 256 (for getting lighter colors)
            let red = Math.floor(Math.random() * 256 - 64);
            let green = Math.floor(Math.random() * 256 - 64);
            let blue = Math.floor(Math.random() * 256 - 64);
    
            // Construct a color withe the given values
            let bgColor = "rgb(" + red + "," + green + "," + blue + ")";
    
            // Set the background to that color
            // document.querySelector(".play-container").background = bgColor;
            document.body.style.background = bgColor;
        }
    
        // Reset Values
        function resetValues() {
            curr_time.textContent = "00:00";
            total_duration.textContent = "00:00";
            seek_slider.value = 0;
        }
    
        function playpauseTrack() {
            if (!isPlaying) playTrack();
            else pauseTrack();
        }
    
        function playTrack() {
            curr_track.play();
            isPlaying = true;
            document.title = curr_track.title;
            // Replace icon with the pause icon
            playpause_btn.innerHTML = '<img src="/rsc/icon/pause-circle.svg" class="playpause">';
        }
    
        function pauseTrack() {
            curr_track.pause();
            isPlaying = false;
            document.title = "Pause - DeTune";
            // Replace icon with the play icon
            playpause_btn.innerHTML = '<img src="/rsc/icon/play-circle.svg" class="playpause">';
        }
    
    
        function nextTrack() {
          
            if (repeat == true){
                track_index = track_index;
            } else {
                document.getElementById(track_index).style.background = 'rgba(0,0,0,.8)';
                if(play_next_check){
                   track_index = next_play;
                   play_next_check= false;
                } else {
                    if (track_index < track_list.length - 1){
                        track_index++;
                    } else {
                        track_index = 0;
                    }
                }
               
            }
            const Http = new XMLHttpRequest();
const url='/song/' + track_list[track_index].key;
Http.open("GET", url);
Http.send();

Http.onreadystatechange = (e) => {
  console.log('success')
}
            loadTrack(track_index);
            playTrack();
        }   
        
    
        function prevTrack() {
            document.getElementById(track_index).style.background = 'rgba(0,0,0,.8)';
         
               
            if (track_index > 0)
                track_index -= 1;
            else track_index = track_list.length;
            loadTrack(track_index);
            playTrack();
        }
    
        function seekTo() {
            seekto = curr_track.duration * (seek_slider.value / 100);
            curr_track.currentTime = seekto;
        }
    
        function setVolume() {
            curr_track.volume = volume_slider.value / 100;
        }
    
        function seekUpdate() {
            let seekPosition = 0;
    
            // Check if the current track duration is a legible number
            if (!isNaN(curr_track.duration)) {
                seekPosition = curr_track.currentTime * (100 / curr_track.duration);
                seek_slider.value = seekPosition;
    
                // Calculate the time left and the total duration
                let currentMinutes = Math.floor(curr_track.currentTime / 60);
                let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
                let durationMinutes = Math.floor(curr_track.duration / 60);
                let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);
    
                // Adding a zero to the single digit time values
                if (currentSeconds < 10) {
                    currentSeconds = "0" + currentSeconds;
                }
                if (durationSeconds < 10) {
                    durationSeconds = "0" + durationSeconds;
                }
                if (currentMinutes < 10) {
                    currentMinutes = "0" + currentMinutes;
                }
                if (durationMinutes < 10) {
                    durationMinutes = "0" + durationMinutes;
                }
    
                curr_time.textContent = currentMinutes + ":" + currentSeconds;
                total_duration.textContent = durationMinutes + ":" + durationSeconds;
            }
        }
       
        // Load the first track in the tracklist
        loadTrack(track_index);
        playTrack();

     
    </script>
@endsection
