@extends('layouts.base')
@section('content')
	<div class="col-md-8 blog-main">
	  	@if ($category)
	  		<h3 class="pb-3 mb-4 font-italic border-bottom">
	  			Artykuły w kategorii "{{ $category->name }}":
	  		</h3>
	  	@endif
	    @forelse ($articles as $article)
	        <div class="blog-post shadow">
	            <h2 class="blog-post-title">{!! $article->title !!}</h2>
	            <p class="blog-post-meta">
	            	{{ $article->getPublishedDate() }} przez <a href="#">{{ $article->getAuthorName() }}</a>
	            </p>
	            {{-- <div class="blog-thumbnail" style="background-image: url({{ $article->thumbnail }});"></div> --}}
	            <p>{!! $article->getShortContent(300) !!} <a href={{ route('show-article', $article->slug) }}>czytaj dalej</a></p>
	        </div>
        @empty
        	<p>Aktualnie brak artykułów w kategorii.</p>
	    @endforelse

	  <nav class="blog-pagination text-center">
	  	<div class="pagination-container">{{ $articles->links() }}</div>
	    {{-- <a class="btn btn-outline-primary" href="#">Starsze</a>
	    <a class="btn btn-outline-secondary disabled" href="#">Nowsze</a> --}}
	  </nav>

	</div>
@endsection