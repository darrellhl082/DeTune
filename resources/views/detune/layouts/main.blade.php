<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>DeTune - {{ $title }} </title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 
    <style>
       @keyframes loadings{
        from {
          transform: rotateZ(0deg)
        }
        to {
          transform: rotateZ(360deg)
        }
      }
      .loading {
        background-color: rgba(0,0,0,.4);
        width: 100vw;
        height: 100vh;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
       
        
      }
     
      .loading .feather{
        width: 60px;
        height: 60px;
        animation:loadings 2s infinite linear;
      }
      .playlist-title{
          font-size:5rem;
      }
      @media (max-width: 575.98px) {
    .playlist-title{
        font-size:30px;
    }
}

     
    </style>
  </head>
  <body>
        <div class="loading position-fixed top-0 right-0 left-0 bottom-0">
      <span data-feather="loader"></span>
    </div>
    @include('detune.partials.header')
    <div class="container-fluid">
        <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse" style="background-color:rgb(0, 0, 0);" >
            <div class="position-sticky pt-3" >
              <ul class="nav flex-column mt-3">
                <li class="nav-item">
                  <a class="nav-link  {{ Request::is('/') ? 'active' : '' }}" href="/">
                    <span data-feather="home" ></span>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  {{ Request::is('search*') ? 'active' : '' }}" href="/search">
                    <span data-feather="search" ></span>
                    Search
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link  {{ Request::is('library*') ? 'active' : '' }}" href="/library">
                    <span data-feather="folder" ></span>
                    Library
                  </a>
                </li>
              </ul>
        
           
            
            </div>
          </nav>
        
            <main class="col-md-9 mt-2 ms-sm-auto col-lg-10 px-md-4 ">
              @yield('container')
            </main>
       
       
        </div>

    </div>
    <div class="mob-sidebar fixed-bottom py-2" >
      <ul class="nav flex-row justify-content-center">
       
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('search*') ? 'active' : '' }}" href="/search">
            <span data-feather="search" ></span>
          
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('/') ? 'active' : '' }}" href="/">
            <span data-feather="home" ></span>
         
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('library*') ? 'active' : '' }}" href="/library">
            <span data-feather="folder" ></span>
          
          </a>
        </li>
      </ul>
    </div>
    <div class="notif position-sticky end-50 start-50 text-center d-none" style="width:max-content;height:35px; bottom:20vh;background-color:black;z-index:99999;line-height:35px;border-radius:10px;opacity:.9;transition:2s;padding:0 10px;">Songs Deleted</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
  
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/script7.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.min.js'></script>

    @if(!str_contains(Request::path(),'play/'))
    <script>
     $(".btnshare").click(function(e){
        let link = e.target.getAttribute("link");
        navigator.clipboard.writeText(link)
    })
      random_bg_color()
      setInterval(() => {
        random_bg_color()
      }, 7000);
      function random_bg_color() {
    let red = Math.floor(Math.random() * 128  );
    let green = Math.floor(Math.random() * 128);
    let blue = Math.floor(Math.random() * 128);
    let bgColor = "rgb(" + red + "," + green + "," + blue + ")";
    document.body.style.background = bgColor;
}
    </script>
    
     @endif
     @if(session()->has('success'))
     <script>
      document.querySelector('.notif').innerHTML = "{{ session('success') }}";
      document.querySelector('.notif').classList.remove('d-none');
      setTimeout(() => {
        document.querySelector('.notif').style.opacity=0;
        setTimeout(() => {
          document.querySelector('.notif').classList.add('d-none');
          document.querySelector('.notif').style.opacity=0.9;
        }, 2000);
      }, 3000);
    </script>
     @endif
   
  
  </body>
</html>
