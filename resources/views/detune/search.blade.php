@extends('detune.layouts.main')
@section('container')
    <div class="container">
        <div class="row justify-content-start mt-4">
            <div class="col-lg-4">
                <form  class="d-flex flex-row form-search">
                    @csrf
                        <input type="text" class="form-control d-inline-block w-75 search-key"  placeholder="Search.." value="{{ request('search') }}" name="search">
                        <select class="form-select d-inline-block w-50 search-select" aria-label="Default select example">
                            <option value="song">Songs</option>
                            <option value="playlist">Playlists</option>
                          </select>
                </form>
            </div>
        </div>
        <div class="row justify-content-between mt-4">
            <div class="col-md-5">
                <h2>Result</h2>
            </div>
        </div>
        <div class="row mb-4 playlists-field">
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
        <div class="row songs-field">
            @foreach ($songs as $song)
                @include('detune.partials.card')
            @endforeach
           
        </div>
     
        
    </div>
@endsection