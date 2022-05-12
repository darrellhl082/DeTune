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
    <link href="/css/login.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
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
            <form action="/login" method="post">
              @csrf
              <div class="text-center">
                <img class="icon" src="/rsc/icon/headphone.png" alt="">
                <h1 class="d-inline-block mb-5 ms-2">DeTune</h1>
              </div>
              @if(session()->has('loginFailed'))
              <div class="alert alert-dismissible fade show m-auto mb-3 text-center " style="width: 370px;background-color:black;color:white;border:1px solid white" role="alert">
                 {{ session('loginFailed') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if(session()->has('success'))
              <div class="alert alert-success alert-dismissible fade show m-auto mb-3 mt-3" style="width: 370px;background-color:black;color:white;border:1px solid white" role="alert">
                 {{ session('success') }}
                  <button type="button" class="btn-close" style="color: white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <h5 class="mb-2">Please Login</h5>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" required id="username" name="username">
            
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" required name="password" id="exampleInputPassword1">
              </div>
              <button type="submit" class="btn mt-3 w-100">Login</button>
              <p class="mt-2">Not registered yet? Register <a href="/register" class="text-white">Here</a></p>
            </form>
          </main>
       
        </div>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
  </body>
</html>
