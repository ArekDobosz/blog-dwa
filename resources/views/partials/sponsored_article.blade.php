@if ($promoted)
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
	<div class="col-md-6 px-0">
		<h1 class="display-4 font-italic">{{ $promoted->title }}</h1>
		<p class="lead my-3">{!! $promoted->getShortContent(200) !!}</p>
		<!-- <p class="lead mb-0"> -->
			<a href="{{ route('show-article', $promoted->slug) }}" class="text-white font-weight-bold">Kontynuuj czytanie...</a>
		<!-- </p> -->
	</div>
</div>
@endif