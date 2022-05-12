
@extends('detune.layouts.main')
@section('container')
<div class="container">
    <div class="row">
        <h1 class="mt-3 mb-4">Your Library</h1>
    </div>
    <div class="row justify-content-start-4">
        <div class="col-md-5">
            <h5 class="d-inline">{{count($playlists)}} Playlists</h5>
            <a href="/playlists/create" class="text-decoration-none d-inline ms-auto">
                <span data-feather="plus"></span>
              </a>
          
        </div>
      
       
    </div>
    <div class="row mb-4">
@foreach ($playlists as $playlist)
<div class="col-md-3 mt-3">
    <div class="card" >
        <div class="card-body">
        <h4 class="card-title">{{ $playlist->name }}</h4>
        <span class="card-subtitle mb-2 d-block text-muted">{{count($playlist->songs)}} Songs - {{ $playlist->views }} Views</span>
        <span class="card-subtitle mb-2 d-block text-muted">Created By {{ $playlist->user->username }}</span>
        <p class="card-text">{{ $playlist->desc }}</p>
       
        <a href="/playlists/{{ $playlist->key }}" class="card-link text-decoration-none">
            <span data-feather="eye"  style="width: 27px;height:27px"></span>
        </a>
        <a href="#" class="card-link text-decoration-none">
              <span data-feather="share-2" class="btnshare" link="https://detune.my.id/playlists/{{ $playlist->key }}" style="width: 27px;height:27px"></span>
        </a>
        
        </div>
    </div>
</div>
@endforeach
   
        
  
        
        
    </div>
    <div class="row justify-content-between mt-5">
        <div class="col-md-5">
            <h5 class="d-inline">{{$songs_count}} Songs</h5>
            <a href="/song/create" class="text-decoration-none d-inline ms-auto">
                <span data-feather="plus"></span>
              </a>
              <div class="mt-3">
                {{ $songs->links() }}
            </div>
        
        </div>
       
       
    </div>
    <div class="row mb-4">
        
        @foreach ($songs as $song)
       @include('detune.partials.card')
        @endforeach
   
        
    </div>
     <div class="mt-3">
            {{ $songs->links() }}
        </div>
    
</div>
@endsection