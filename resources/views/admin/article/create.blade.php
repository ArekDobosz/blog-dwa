@extends('admin/app')
@section('content')
<div class="col-sm">
	
<h1 class="text-center">Dodaj artykuł</h1>
<form action="{{ route('article.store') }}" method="POST">
	{{ csrf_field() }}
	{{ method_field("POST") }}
	<div class="form-group">
		<label for="title">Tytuł</label>
		<input type="text" class="form-control" name="title">
	</div>
	<div class="form-group">
		<label for="slug">Slug</label>
		<input type="text" class="form-control" name="slug">
	</div>
	<div class="form-group">
		<label for="slug">Thumbnail</label>
		<input type="text" class="form-control" name="thumbnail">
	</div>
	<div class="form-group">
	    <label for="category_id">Kategoria</label>
	    <select class="form-control" name="category_id">
	    	<option></option>
	    	@foreach ($categories as $category)
	      		<option value="{{ $category->id }}">
	      			{{ $category->name }}
	      		</option>
	    	@endforeach
	    </select>
  	</div>
	<div class="form-group">
		<label for="category_id">Kategoria</label>
		<textarea class="form-control" rows="20" name="content" id="textarea"></textarea>
	</div>
	<input type="submit" class="btn btn-success" value="Dodaj">
</form>
</div>
<br>
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