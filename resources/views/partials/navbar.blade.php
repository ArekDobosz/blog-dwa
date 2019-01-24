<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
    	<a class="p-2 text-muted item logo hidden" href="{{ route('/') }}">
    		<span class="dwa">2</span><span class="miliony">miliony</span>
    	</a>
        <a class="p-2 text-muted item" href="{{ route('/', 'warsztat-inwestora') }}">Warsztat inwestora</a>
        <a class="p-2 text-muted item" href="{{ route('/', 'filozofia-inwestowania') }}">Filozofia inwestowania</a>
        <a class="p-2 text-muted item" href="{{ route('/', 'ciemna-strona-gieldy') }}">Ciemna strona giełdy</a>
        <a class="p-2 text-muted item" href="{{ route('/', 'analizy-biezace') }}">Analizy bieżące</a>
        <a class="p-2 text-muted item" href="{{ route('/', 'ogolnie-o-finansach') }}">Ogólnie o finansach</a>
	    @if (Auth::guard('user')->check())
	    	<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle item" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Witaj {{ Auth::guard('user')->user()->firstName() }}
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#" onClick="document.querySelector('#form_logout').submit()">Wyloguj</a>
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