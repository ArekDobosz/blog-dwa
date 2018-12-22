@extends('layouts.base')
@section('content')
	<div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{!! $article->title !!}</h2>
            <p class="blog-post-meta">{{ $article->getPublishedDate() }} przez <a href="#">{{ $article->getAuthorName() }}</a></p>
            <p>{!! $article->content !!}</p>
        </div>
	</div>
@endsection