<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - DeTune</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="/css/login.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
        h1{
            font-size:60px;
        }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .invalid-feedback{
        display: block;
        color: white;
      }
    @media (max-width: 575.98px) {
    .icon{
        width:50px;
        height:50px;
        margin-bottom:28px;
    }
    h1 {
        font-size:50px;
    }
}
    </style>
  </head>
  <body class="text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <main class="form-login text-start">
            <form action="/register" method="post">
              @csrf
              <div class="text-center mt-1">
                <img class="icon" src="/rsc/icon/headphone.png" alt="">
                <h1 class="d-inline-block mb-2 ms-2" style="">DeTune</h1>
              </div>
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
              <h5 class="mb-2">Register Here</h5>
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" required class="form-control @error('name') is_invalid @enderror" id="name" name="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
               @enderror
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" required class="form-control @error('username') is_invalid @enderror" id="username" name="username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" required class="form-control @error('password') is_invalid @enderror" name="password" id="exampleInputPassword1">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
              </div>
              <div class="mb-3">
                <label for="passwordconfirm" class="form-label">Password Confirm</label>
                <input type="password" required class="form-control @error('password_confirm') is_invalid @enderror" name="password_confirm" id="passwordconfirm">
                @error('password_confirm')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
              <button type="submit" class="btn mt-3 w-100">Register</button>
              <p class="mt-2">Registered? Login <a href="/login" class="text-white">Here</a></p>
            </form>
          </main>
       
        </div>
      </div>
    </div>



    
  </body>
</html>
