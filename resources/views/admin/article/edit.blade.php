@extends('admin/app')
@section('content')
<div class="row">	
	<div class="col-sm">
		<form action="{{ route('article.update', $article->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field("PATCH") }}
			<div class="form-group">
				<label for="title">Tytuł</label>
				<input type="text" class="form-control" name="title" value="{{ $article->title }}" placeholder="Tytuł">
			</div>
			<div class="form-group">
				<label for="title">Slug</label>
				<input type="text" class="form-control" name="slug" value="{{ $article->slug }}" placeholder="Slug">
			</div>
			<div class="form-group">
				<label for="slug">Thumbnail</label>
				<input type="text" class="form-control" name="thumbnail" value="{{ $article->thumbnail }}" placeholder="Thumbnail url">
			</div>
			<div class="form-group">
			    <label for="category_id">Kategoria</label>
			    <select class="form-control" name="category_id">
			    	@foreach ($categories as $category)
			      		<option value="{{ $category->id }}" @if ($category->id === $article->category_id) selected @endif>
			      			{{ $category->name }}
			      		</option>
			    	@endforeach
			    </select>
		  	</div>
			<div class="form-group">
				<label for="title">Treść</label>
				<textarea class="form-control" rows="20" name="content" id="textarea">{{ $article->content }}</textarea>
			</div>
			<div class="form-group">
				<input type="checkbox" name="is_published" {{ $article->is_published ? 'checked' : '' }}>
				<label class="form-check-label" for="is_published">
				    Opublikowany
			  	</label>
			</div>
			<div class="form-group">
				<input type="checkbox" name="promoted" {{ $article->promoted ? 'checked' : '' }}>
				<label class="form-check-label" for="promoted">
				    Promowany
			  	</label>
			</div>
			<button type="submit" class="btn btn-success">Zapisz zmiany</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-sm">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>User</th>
					<th>Treść</th>
					<th>Widoczny</th>
					<th>Akcje</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($article->comments as $comment)
					<tr>
						<form action="{{ route('comment.update', $comment->id) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field('PATCH') }}
							<td>
								{{ $comment->user ? $comment->user->name : 'Anonimowy' }}
							</td>
							<td>
								<textarea name="text" class="form-control">{{ $comment->text }}</textarea>
							</td>
							<td>
								<input type="checkbox" name="visible" @if ($comment->visible) checked @endif>
							</td>
							<td>
								<button type="submit" class="btn btn-success">Zapisz</button>
							</td>
						</form>
					</tr>
				@endforeach
			</tbody>
		</table>
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