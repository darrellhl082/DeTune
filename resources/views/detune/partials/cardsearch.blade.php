@foreach ($songs as $song)
<div class="col-md-6 mt-3">
    <div class="card position-relative" name="{{ $song->key }}">
        <div class="card-body">
            <div class="update-form d-none e{{ $song->key }}">
                <form action="/song/{{ $song->id }}" method="post">
                    @method('put')
                    @csrf
                    <input type="text" name="name" id="name_update" value="{{ $song->name }}">
                    <button type="submit" class="btn btn-transparent btn-upd">Update</button>
                </form>
            </div>
      
        <h5 class="card-title" id="{{ $song->key }}">{{ $song->name }}</h5>
   
        <p class="card-text text-muted">{{ $song->duration }}</p>
        <span class="d-block mb-2" style="right:20px;bottom:15px;">{{$song->plays }} plays - Uploaded By {{$song->user->username }}</span>
        <a href="/play/{{$song->key  }}" class="card-link text-decoration-none hovertext" data-hover="Play Now">
            <span data-feather="play"  style="width: 27px;height:27px"></span>
        </a>
      
         <a class="card-link text-decoration-none hovertext" data-hover="Copy Link">
            <span data-feather="share-2" class="btnshare" link="https://detune.my.id/play/{{ $song->key }}" style="width: 27px;height:27px"></span>
        </a>
        @if($song->user->id == auth()->user()->id)
        <a class="card-link text-decoration-none hovertext" id="confirm_delete" name="confirm_delete"
        data-bs-toggle="modal" data-bs-target="#Modal{{ $song->key }}">
        <span data-feather="trash-2"  style="width: 27px;height:27px"></span>
    </a>
      
          
        <a  class="card-link text-decoration-none hovertext edit" data-hover="Edit">
            <span data-feather="edit-2"  style="width: 27px;height:27px"></span>
        </a>            
        @endif
       
        <a class="text-decoration-none hovertext"  data-hover="Add to Playlist" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="icon ms-3" style="width:38px;height:38px;margin-bottom:-10px" src="/rsc/icon/playlist3.png" alt="">
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <form class="cat_form" method="post"  id="ss{{ $song->key }}">
                {{-- action="/addtoplaylist/{{ $song->key }}" --}}
                @csrf
                <input type="hidden" name="playlist_id" class="cat_id">
                <input type="hidden" name="song_key" class="song_key" value="{{ $song->key }}">
            </form>
            @foreach ($playlists_owner as $playlist1)
                <li class="dropdown-item playlist-list" data-song="{{ $song->key }}" name="{{ $playlist1->id }}">{{ $playlist1->name }}</li>
            @endforeach
          </ul>
        
        </div>
    </div>
</div>
<div class="modal fade" id="Modal{{ $song->key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {{ $song->name }}.mp3 will be deleted, Sure?
            </div>
            <div class="modal-footer" style="border: none">
                <button type="button" class="btn  btn-file" style="width: min-content" id="cancel" data-bs-dismiss="modal">Batal</button>
                <form action="/song/{{ $song->id}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    
                    <button type="submit" class="btn btn-file" style="width: min-content">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="/js/dashboard.js"></script>
<script>
    $(".btnshare").click(function(e){
        let link = e.target.getAttribute("link");
        navigator.clipboard.writeText(link)
    })
</script>


