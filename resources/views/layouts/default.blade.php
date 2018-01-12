<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Sample App')</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    @include('layouts.header')

    <div class="container">
      <div class="col-md-offset-1 col-md-10">
        @yield('content')
        @include('layouts.foot')
      </div>
    </div>
  </body>
</html>