
@extends('detune.layouts.main')
@section('container')
   <div class="container pb-5 playlist">
       <div class="row mt-3 justify-content-between">
            <div class="col-lg-8">
                <a href="/library" class="hovertext" data-hover="Back to Library" >
                    <span data-feather="chevron-left"  class="mb-4 p-1" style="width: 50px;height:50px;border-radius:50%; background-color: rgba(0, 0, 0, .3);"></span>
                  </a>
                <span class="d-block">PLAYLIST</span>
                <h1 class="playlist-title" >{{ $playlist[0]->name }}</h1>
                <p class="text-white">{{ $playlist[0]->desc }}</p>
                <span class="text-white">{{ $playlist[0]->views }} Views - Created by {{ $playlist[0]->user->username }}</span>
                <br>
                <span>{{ count($playlist[0]->songs) }} Songs</span>
                <div class="mt-3">
                    <a href="/playlist/play/{{ $playlist[0]->key }}" class="text-decoration-none hovertext" data-hover="Play">
                        <img class="icon" src="/rsc/icon/play.png" alt="">
                     </a>
                     @if ($is_owner)
                     <a href="/playlists/{{ $playlist[0]->id }}/edit" class="text-decoration-none hovertext" data-hover="Edit Detail">
                        <img class="icon" src="/rsc/icon/edit.png" alt="">
                     </a>
                     <a class=" text-decoration-none hovertext" id="confirm_delete" name="confirm_delete"
                     data-bs-toggle="modal" data-bs-target="#Modal{{ $playlist[0]->key }}" data-hover="Delete">
                     <span data-feather="trash-2"  style="width: 27px;height:27px"></span>
                 </a>
                     @endif
                   
                    <a class="text-decoration-none hovertext" data-hover="Copy Link" href="#" >
                       <span data-feather="share-2" class="btnshare" link="https://detune.my.id/playlists/{{ $playlist[0]->key }}" style="width: 27px;height:27px"></span>
                    </a>
                   
                </div>
            </div>
            <div class="modal fade" id="Modal{{ $playlist[0]->key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog text-white ">
                    <div class="modal-content" style="background-color: rgba(0,0,0,.8); border:1px solid white">
                        <div class="modal-header">
                            <div class="modal-title">
                                <img class="icon" src="/rsc/icon/headphone.png" alt="">
                                <h1 class="d-inline-block " style="font-size: 20px;">DeTune</h1>
                              </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="border-bottom: none">
                            {{ $playlist[0]->name }} Playlist will be deleted, Sure?
                        </div>
                        <div class="modal-footer" style="border: none">
                            <button type="button" class="btn  btn-file" style="width: min-content" id="cancel" data-bs-dismiss="modal">Batal</button>
                            <form action="/playlists/{{ $playlist[0]->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                
                                <button type="submit" class="btn btn-file" style="width: min-content">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
       <div class="row mt-4">
           <div class="col-lg-8">
            <div class="list-songs ">
               
                <ul class="list-group w-100 ">
                    @foreach ($playlist[0]->songs as $song)
                    <li class="list-playlist list-group-item d-flex align-items-center justify-content-between ">
                        
                       <div class="container-fluid p-1">
            <div class="row justify-content-around align-items-center">
                <div class="col-md-8">
                    <div class="d-inline-block ">
                        <h5 class="">{{ $song->name }}</h5>
                        <p class="card-text">{{ $song->duration }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ms-auto w-100 text-md-end">
                        <a href="/play/{{ $song->key }}" class="text-decoration-none hovertext" data-hover="Play Single">
                            <img class="icon" src="/rsc/icon/play.png" alt="">
                         </a>
                         @if ($is_owner)
                            <span class="text-decoration-none hovertext remove" data-song="{{ $song->id  }}" data-hover="Remove from Playlist">
                                <img class="icon" src="/rsc/icon/remove.png" alt="">
                            </span>
                            
                         @endif
                       
                        <a class="text-decoration-none hovertext" data-hover="Share" href="#" >
                         <span data-feather="share-2" class="btnshare" link="https://detune.my.id/play/{{ $song->key }}" ></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
                      
                    </li>
                   
                    @endforeach
             
                  </ul>
            </div> 
           </div>
       </div>
   </div>
   <form  id="form_remove" method="POST">
       @csrf
       <input type="hidden" id='song_key' name="song_key">
       <input type="hidden" id="playlist_id" name="playlist_id">
   </form>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script>
        $('.remove').click(function(e){
            let song_key = e.target.parentNode.getAttribute('data-song');
            let playlist = "{{ $playlist[0]->id }}";
            let form_remove =  $('#form_remove');
            $('#song_key').val(song_key);
            $('#playlist_id').val(playlist)
            let serializedData =form_remove.serialize();
         
            request = $.ajax({
              url: "/removefromplaylist",
              type: "post",
              data: serializedData,
              success:function(data) {  
              console.log(data)
              e.target.parentNode.parentNode.parentNode.classList.add('d-none');
              document.querySelector('.notif').innerHTML = "Removed from Playlist";
              document.querySelector('.notif').classList.remove('d-none');
              setTimeout(() => {
                  document.querySelector('.notif').style.opacity=0;
                  setTimeout(() => {
                    document.querySelector('.notif').classList.add('d-none');
                    document.querySelector('.notif').style.opacity=0.9;
                  }, 2000);
              }, 3000);
              }
            });
       })
      
            
        //   
   </script>
@endsection