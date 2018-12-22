@extends('admin/app')
@section('content')
<div class="col-sm">
<form action="{{ route('article.update', $article->id) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field("PATCH") }}
	<div class="form-group">
		<input type="text" class="form-control" name="title" value="{{ $article->title }}">
	</div>
	<div class="form-group">
		<textarea class="form-control" rows="20" name="content" id="textarea">{{ $article->content }}</textarea>
	</div>
	<div class="form-group">
		<input type="checkbox" name="is_published" {{ $article->is_published ? 'checked' : '' }}>
		<label class="form-check-label" for="is_published">
		    Opublikowany
	  	</label>
	</div>
	<button type="submit" class="btn btn-success">Zapisz zmiany</button>
</form>
</div>
@endsection
@section('js')
@parent()
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=bduwccdo8ui9vw5pbts074njq8viua4192lmjp8zy71yca67"></script>
<script>
	$(document).ready(function() {
		tinymce.init({
    		selector: '#textarea',
    		toolbar: "image",
  			plugins: "image imagetools media"
	  	});
	});
</script>
@endsection