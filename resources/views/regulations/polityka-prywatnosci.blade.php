@extends('layouts.base')
@section('content')
	<div class="col-md-{{ isset($hideSidebar) ? '12' : '8' }} blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title text-center">Polityka Prywatności</h2>
            <ol class="pl-2">
            	<li>
            		Blog ma jednego autora i to on, samozwańczo, w oparciu o bogate doświadczenie i własne urojenia, ustala tu reguły.
				</li>
				<li>
					Autor pisze, bo jest ekstrawertykiem inwestycyjnym. Nie pisze dla wyższych idei czy pieniędzy. Choć z czasem mogą pojawić się jakieś nieinwazyjne reklamy.
				</li>
				<li>
					Cała zawartość bloga jest dostępna dla wszystkich użytkowników, o ile zechcą ją wyświetlić.
				</li>
				<li>
					Osoby, które wyświetlą coś przypadkiem, wbrew własnej woli, nie tracą praw nabytych w punkcie 3.
				</li>
				<li>
					Czytanie bloga jest całkowicie dobrowolne i nikt nikogo nie może do niego przymuszać. Nie dotyczy to prawomocnych wyroków sądów i pokuty danej przez księdza spowiednika.
				</li>
				<li>
					Treści zamieszczone na blogu można cytować na innych serwisach, pod warunkiem podania linka do oryginalnego wpisu.
				</li>
				<li>
					Komentarze osób niezalogowanych w serwisie podlegają surowej, acz uczciwej i niezwykle płynnej moderacji. Osoby zalogowane mogą spamować do woli, bądź do momentu trwałego zbanowania za spam.
				</li>
				<li>
					Osoby, które zauważyły wewnętrzną sprzeczność w drugim zdaniu punktu 7 niniejszego regulaminu, otrzymują +5 punktów szacunku.
				</li>
				<li>
					Regulamin nie jest preambułą Konstytucji, wobec czego dopuszcza się wprowadzanie zmian. Zmiany, zgodnie ze zdrowym rozsądkiem, działają od momentu wprowadzenia do przodu i wstecz.
				</li>
				<li>
					Na shoutbox może pisać każdy, przy czym niezalogowani mają ograniczenia czasowo ilościowe. Zalogowani piszą ile chcą i mogą przeklinać (byle z umiarem).
				</li>
				<li>
					Rejestracja na blogu uproszczona do granic możliwości.
				</li>
				<li>
					Wszelkie spory rozstrzyga autor bloga, zazwyczaj na swoją korzyść.
				</li>
            </ol>
        </div>
        <hr>
	</div>
@endsection