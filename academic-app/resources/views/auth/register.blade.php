<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Register
  </title>
  @include('include.style')
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand">
            <img src=" /backend/assets/img/brand/desain.png" class="navbar-brand-img" alt="..." >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="../assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('login')}}">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Login</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <form role="form" method="POST" action="{{ route('register-proses') }}">
                    @csrf <!-- Tambahkan CSRF Token -->
                    <div class="text-center text-muted mb-4">
                        <small>Register a new membership</small>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                              </div>
                              <input class="form-control" name="nama" placeholder="Name" type="text" value="{{old('nama')}}">
                            </div>
                            @error('nama')
                            <small>{{$message}}</small>
                        @enderror
                        </div>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" name="email" placeholder="Email" type="email" value="{{old('email')}}"> <!-- Tambahkan name="email" -->
                        </div>
                        @error('email')
                            <small>{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" name="password" placeholder="Password" type="password"> <!-- Tambahkan name="password" -->
                        </div>
                        @error('password')
                            <small>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">Sign up</button>
                    </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('include.script')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if ($message = Session::get('success'))

  <script>
    Swal.fire('{{ $message }}');
  </script>

  @endif
  @if ($message = Session::get('failed'))

  <script>
    Swal.fire('{{ $message }}');
  </script>

  @endif
</body>

</html>
