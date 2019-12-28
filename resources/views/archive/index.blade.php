@extends('layouts.base')
@section('content')
	<div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title archive-title text-center">{{ $title }}:</h2>
        </div>
        <div class="blog-post">
	        @foreach ($articles as $article)
	         <a href={{ route('show-article', $article->slug) }}>
	         	<h2 class="archive-title">{{$article->title}} ({{ $article->getCreatedDate() }})</h2>
	         </a>
	         <p>{!! $article->getShortContent(200) !!}</p>
	          <hr>
	        @endforeach
	     </div>
	</div>
@endsection