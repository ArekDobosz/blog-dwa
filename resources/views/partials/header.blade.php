<header class="blog-header">
  <div class="flex-nowrap justify-content-between align-items-center">
    <a class="header-logo-link" href="{{ route('/') }}">
      <div class="col-8 logo-2-miliony"></div>
    </a>
      {{-- <img src="{{ asset('img/logo.png') }}" alt="Dwa miliony"> --}}
      {{-- <a class="text-muted" href="#">Subscribe</a> --}}
    {{-- <div class="col-4 d-flex justify-content-end align-items-center">
      @if (Auth::guard('user')->check())
              <form action="{{ route('logout') }}" method="POST">
                  {{ csrf_field() }}
                  <button type="submit"> 
                      Witaj {{ Auth::guard('user')->user()->firstName() }}
                  </button>
              </form>

      @else
          <a class="btn btn-sm btn-outline-secondary btn-login" href="{{ route('login') }}">Logowanie</a>
          <a class="btn btn-sm btn-outline-secondary btn-register" href="{{ route('register') }}">Rejestracja</a>
      @endif --}}
    {{-- </div> --}}
  </div>
</header>