@extends('admin/app')
@section('content')
<div class="col-sm">
	
<h1>Dodaj artykuł :)</h1>
<form action="{{ route('article.store') }}" method="POST">
	{{ csrf_field() }}
	{{ method_field("POST") }}
	<div class="form-group">
		<input type="text" class="form-control" name="title">
	</div>
	<div class="form-group">
		<textarea class="form-control" rows="20" name="content" id="textarea"></textarea>
	</div>
	<input type="submit" name="Dodaj">
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