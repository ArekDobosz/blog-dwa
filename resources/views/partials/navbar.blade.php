<div class="nav-scroller py-1 mb-2 desktop">
    <nav class="nav d-flex justify-content-between container">
    	<a class="p-2 text-muted item logo hidden" href="{{ route('/') }}">
    		<span class="dwa">2</span><span class="miliony">miliony</span>
    	</a>
      @php($slug = isset($slug) ? $slug : '')
      <a class="p-2 text-muted item first-item{{ $slug === 'warsztat-inwestora' ? ' active' : '' }}" href="{{ route('/', 'warsztat-inwestora') }}">
        Warsztat inwestora
      </a>
      <a class="p-2 text-muted item{{ $slug === 'filozofia-inwestowania' ? ' active' : '' }}" href="{{ route('/', 'filozofia-inwestowania') }}">
        Filozofia inwestowania
      </a>
      <a class="p-2 text-muted item{{ $slug === 'ciemna-strona-gieldy' ? ' active' : '' }}" href="{{ route('/', 'ciemna-strona-gieldy') }}">Ciemna strona giełdy</a>
      <a class="p-2 text-muted item{{ $slug === 'analizy-biezace' ? ' active' : '' }}" href="{{ route('/', 'analizy-biezace') }}">Analizy bieżące</a>
      <a class="p-2 text-muted item{{ $slug === 'ogolnie-o-finansach' ? ' active' : '' }}" href="{{ route('/', 'ogolnie-o-finansach') }}">Ogólnie o finansach</a>
	    @if (Auth::guard('user')->check())
	    	<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle item" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Witaj {{ Auth::guard('user')->user()->firstName() }}
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#" onClick="document.querySelector('#form_logout').submit()">Wyloguj</a>
              @if (Auth::guard('user')->user()->hasAdminAccess())
                <a class="dropdown-item" href="{{ route('admin') }}">Panel Admina</a>
              @endif
		        </div>
	      	</li>
          	<form id="form_logout" action="{{ route('logout') }}" method="POST">
              	{{ csrf_field() }}
          	</form>
	    @else
	    	<a class="p-2 text-muted item" href="{{ route('login') }}">Logowanie / Rejestracja</a>
	    @endif
    </nav>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light mobile fixed-top">
  <a class="navbar-brand" href="{{ route('/') }}">Dwa miliony</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('/', 'warsztat-inwestora') }}">Warsztat inwestora<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('/', 'filozofia-inwestowania') }}">Filozofia inwestowania</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('/', 'ciemna-strona-gieldy') }}">Ciemna strona giełdy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('/', 'analizy-biezace') }}">Analizy bieżące</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('/', 'ogolnie-o-finansach') }}">Ogólnie o finansach</a>
      </li>
      @if (Auth::guard('user')->check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{ route('login') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Witaj {{ Auth::guard('user')->user()->firstName() }}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" onClick="document.querySelector('#form_logout').submit()">Wyloguj</a>
            <div class="dropdown-divider"></div>
            @if (Auth::guard('user')->user()->hasAdminAccess())
              <a class="dropdown-item" href="{{ route('admin') }}">Panel Admina</a>
            @endif
          </div>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Logowanie/Rejestracja</a>
        </li>
      @endif
    </ul>
  </div>
</nav>