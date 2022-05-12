@extends('detune.layouts.main')
@section('container')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-6">
              <a href="/library" class="hovertext" data-hover="Back to Library" >
                <span data-feather="chevron-left"  class="mb-3 p-1" style="width: 50px;height:50px;border-radius:50%; background-color: rgba(0, 0, 0, .3);"></span>
              </a>
       
                <h1>Upload Song</h1>
                <form action="/song" method="post" enctype="multipart/form-data">
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
               <div class="input-group my-4 mb-3 file-input" >
                   
                    <input type="file" name="songs[]" multiple class="form-control file-input" id="inputsongs" required accept="audio/mp3">
                  </div>
                    <button type="submit" onclick="showloading()" class="btn btn-file">Upload</button>
                  </form>
            </div>
        </div>
    </div>
@endsection