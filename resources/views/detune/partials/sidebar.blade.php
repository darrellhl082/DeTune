<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block  sidebar collapse" style="background-color:rgb(0, 0, 0);" >
    <div class="position-sticky pt-3" >
      <ul class="nav flex-column">
        <li class="nav-item mt-3">
          <a class="nav-link  {{ Request::is('/') ? 'active' : '' }}" href="detune.test">
            <span data-feather="home" class="feather" style="color: white"></span>
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('/search*') ? 'active' : '' }}" href="/search">
            <span data-feather="search" class="feather" style="color: white"></span>
            Search
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Request::is('/library*') ? 'active' : '' }}" href="/library">
            <span data-feather="search" class="feather" style="color: white"></span>
            Library
          </a>
        </li>
        
      </ul>

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Saved reports</span>
      </h6>
    
    </div>
  </nav>