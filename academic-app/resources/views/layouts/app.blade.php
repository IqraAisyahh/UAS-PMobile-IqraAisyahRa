<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Academic
  </title>

  @include('include.style')
</head>

<body class="">

    @include('include.sidebar')
    <!-- End Navbar -->

    <div class="main-content">
        @yield('content')
    </div>

  </div>

  @include('include.script')

  </body>
</html>
