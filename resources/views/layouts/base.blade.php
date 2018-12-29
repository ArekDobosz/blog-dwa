<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '2 Miliony') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="container">
      @include('partials.header')
      @include('partials.flash_message')
      @include('partials.navbar')
      @unless (isset($hideTopContent))
        @include('partials.sponsored_article')
        @include('partials.latest_articles')
      @endunless
    </div>

    <main role="main" class="container">
      <div class="row">
        @yield('content')
        @unless (isset($hideSidebar))
          @include('partials.right_sidebar')
        @endunless
      </div>
    </main>

    <footer class="blog-footer">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    @yield('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#logout-button').on('click', function(e) {
                e.preventDefault();
                $('#logout').submit();
            })
        });
    </script>
</body>
</html>
