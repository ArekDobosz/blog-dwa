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
	<div class="form-group">
		<input type="checkbox" name="is_published">
		<label class="form-check-label" for="is_published">
			Opublikowany
		</label>
	</div>
	<input type="submit" class="btn btn-success" value="Dodaj">
</form>
</div>
<br>
@endsection
@section('js')
@parent()
<script src="https://cdn.tiny.cloud/1/t9kt2wecrdt5ntoilm8t8kyn87rw9mv1lfabwyl2qz7xfexi/tinymce/5/tinymce.min.js"></script>
<script>
	$(document).ready(function() {
		tinymce.init({
    		selector: '#textarea',
			paste_as_text: true,
    		toolbar: "image",
  			plugins: "image imagetools media"
	  	});
	});
</script>	
@endsection