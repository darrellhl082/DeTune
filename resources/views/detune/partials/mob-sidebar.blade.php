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