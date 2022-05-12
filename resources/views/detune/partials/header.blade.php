<header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 shadow" style="background-color: rgb(0, 0, 0);border-bottom:1px solid rgb(203, 203, 203);">
  <div class="text-center navbar-brand ms-3">
    <img class="icon" src="/rsc/icon/headphone.png" alt="">
    <h1 class="d-inline-block " style="font-size: 20px;">DeTune</h1>
  </div>
  
  
    <div class="dropdown me-4">
      <button class="btn btn-transparent text-white dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
        @auth
           {{ auth()->user()->username }}
        @else
        Login
        @endauth
      </button>
      <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
      
        <li>
          @auth
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class=" btn btn-transparent dropdown-item px-3">Log out</button>
          </form>
           @else
              <a href="/login" class="btn btn-transparent dropdown-item px-3">Login</a>
          @endauth
        </li>
       
      </ul>
    </div>
  </header>