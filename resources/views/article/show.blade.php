@extends('layouts.base')
@section('content')
	<div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{!! $article->title !!}</h2>
            <p class="blog-post-meta">{{ $article->getPublishedDate() }}
				przez 
				<a href="#">{{ $article->getAuthorName() }}</a>
				@if (Auth::guard('user')->user()->hasAdminAccess() && Auth::guard('user')->user()->id === $article->author)
					| <a href="{{ route('article.edit', $article->id) }}">edytuj</a>
				@endif
			</p>
            <p>{!! $article->content !!}</p>
        </div>
        <hr>
        <h3>{{ $article->getCommentsCount() }} Komentarzy:</h3>

        @foreach ($article->comments as $comment)
        	@if ($comment->visible)
				<div class="comment-block">
					<div class="comment-header">
						<span class="username"> 
							@if ($comment->user)
								{{ $comment->user->name }},
							@else
								Anonimowy,
							@endif
						</span>
						{{ $comment->getPublishedDate() }}
					</div>
					<div class="comment-text">
						{{ $comment->text }}
					</div>
				</div>
			@endif
        @endforeach

		<div class="comment-form">
	    	<form action="{{ route('comment.add', $article->id) }}" method="POST">
	    		{{ csrf_field() }}
	    		<div class="form-group">
	        		<textarea name="text" class="form-control" rows="4" placeholder="Wpisz komentarz...">{{ old('text') }}</textarea>
	        		@if ($errors->has('text'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif
	    		</div>
	    		<button type="submit" class="btn btn-outline-secondary btn-block">Dodaj komentarz</button>
	    	</form>
		</div>
	</div>
@endsection