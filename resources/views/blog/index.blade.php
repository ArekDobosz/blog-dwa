@extends('layouts.base')
@section('content')
	<div class="col-md-8 blog-main">
	  <h3 class="pb-3 mb-4 font-italic border-bottom">
	    From the Firehose
	  </h3>
	    
	    @foreach ($articles as $article)
	        <div class="blog-post">
	            <h2 class="blog-post-title">{!! $article->title !!}</h2>
	            <p class="blog-post-meta">{{ $article->getPublishedDate() }} przez <a href="#">{{ $article->getAuthorName() }}</a></p>
	            <p>{!! $article->getShortContent(300) !!} <a href={{ route('show-article', $article->id) }}>read more</a></p>
	        </div>
	    @endforeach

	  <nav class="blog-pagination">
	    <a class="btn btn-outline-primary" href="#">Older</a>
	    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
	  </nav>

	</div>
@endsection