@extends('detune.layouts.main')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mt-2">
               <h1>Add Playlists</h1>
               <form action="/playlists" method="post">
                @csrf
                @if(session()->has('success'))
            <div class="alert alert-light alert-dismissible fade show" role="alert">
               {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ session('failed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="mb-2">
                <label for="name" class="form-label fs-5">Name</label>
                <input type="text" required class="form-control @error('name') is_invalid @enderror file-input" id="name" name="name" style="width: 300px">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
               @enderror
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label fs-5">Description</label>
               <textarea name="desc" id="desc" class="form-control file-input" style="width: 300px;height:100px" cols="30" rows="10"></textarea>
              
               @error('desc')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
               @enderror
              </div>
                <button type="submit" class="btn btn-file" style="width: 100px">Create</button>
              </form>
            </div>
        </div>
    </div>
@endsection