@extends('admin/app')
@section('content')
<div class="col-sm">

<hr>
<div class="row">
	<div class="col-md-2">
		<a href="{{ route('article.create') }}" class="btn btn-success pull-right">Dodaj artykuł</a>
	</div>
	<div class="col-md-10 inline">
		<form class="form form-inline text-center" action="{{ route('article.filtered') }}" method="POST">
			{{ csrf_field() }}
			<h5 class="mr-4">Wyświetl: </h5>
			<div class="form-check form-check-inline">
				<input 
					class="form-check-input" 
					name="published" 
					type="checkbox" 
					id="inlineCheckbox1" 
					value="true"
					@if(isset($request) && $request->published) checked @endif>
				<label class="form-check-label" for="inlineCheckbox1">Opublikowane</label>
			</div>
			<div class="form-check form-check-inline">
				<input 
					class="form-check-input" 
					name="unpublished" 
					type="checkbox" 
					id="inlineCheckbox2" 
					value="true"
					@if(isset($request) && $request->unpublished) checked @endif>
				<label class="form-check-label" for="inlineCheckbox2">Nieopublikowane</label>
			</div>
			<div class="col-md-3 form-check-inline"> 
				<select class="custom-select" name="createdAt">
					<option value="desc" @if(isset($request) && $request->createdAt === "desc") selected @endif>
						Od najnowszego
					</option>
					<option value="asc" @if(isset($request) && $request->createdAt === "asc") selected @endif>
						Od najstarszego
					</option>
				</select>
			</div>
			<button>Pokaż</button>
		</form>
	</div>
</div>
<hr>
	
<h1>Lista artykułów: </h1>

<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Tytuł</th>
			<th>Kategoria</th>
			<th>Opublikowany</th>
			<th>Akcje</th>
		</tr>
	</thead>
	<tbody>
		@foreach($articles as $article)
			<tr class="{{ $article->deleted_at ? 'strikeout' : '' }}">
				<td>{{ $loop->index + 1 }}</td>
				<td>{{ $article->title }}</td>
				<td>{{ $article->getCategoryName() }}</td>
				<td>
					<label class="switch">
						<input 
							type="checkbox"
							name="published"
							id="publishedArticle_{{$article->id}}"
							@if( $article->is_published)checked @endif
							@if( $article->deleted_at)disabled @endif>
						<span class="slider round"></span>
					</label>
				</td>
				<td>
					@if(!$article->deleted_at)
						<a href="{{ route('article.edit', $article->id) }}" class="btn btn-info">Edytuj</a>
						<form class="mt-1" action="#" method="POST" id="delete-article-form">
							{{ csrf_field() }}
							{{ method_field("DELETE") }}
							<button 
								type="button"
								class="btn btn-danger delete-article"
								data-msg-id="{{ $article->id }}" 
								data-toggle="modal" 
								data-target="#exampleModal">
								Usuń
							</button>
						</form>
					@else
						<form action="{{ route('article.restore', $article->id) }}" method="POST">
							{{ csrf_field() }}
							{{ method_field("PATCH") }}
							<input type="hidden" name="restore" value="true" />
							<button 
								type="submit"
								class="btn btn-success delete-article">
								Przywróć
							</button>
						</form>
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Usuwnie artykułu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Czy jesteś pewien, że chcesz usunąć artykuł wraz z komentarzami?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <button type="button" class="btn btn-danger" id="delete-message" data-msg-id="">Usuń</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.delete-article').on('click', function(e) {
            const DELETE_ROUTE = "{{ route('article.index') }}";
            var currentElement = e.target;
            document.querySelector('#delete-article-form').action = DELETE_ROUTE + '/' + currentElement.dataset.msgId;
        });

        $('#delete-message').on('click', function() {
            $('#delete-article-form').submit();
        });

		$('.switch input').on('change', function() {
			var elementId = this.id;
			var articleId = elementId.split('_')[1];
			var route = "{{ route('/') }}/admin/article-status/" + articleId;

			$.ajax(route, {
				method: "PATCH",
				data: {
					"_token": "{{ csrf_token() }}"
				}
			})
			.done(function() {
				console.log( "success" );
			})
			.fail(function() {
				console.log( "error" );
			})
		});
    });
</script>
@endsection