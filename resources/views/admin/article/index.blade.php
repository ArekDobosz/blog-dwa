@extends('admin/app')
@section('content')
<div class="col-sm">

<hr>
<a href="{{ route('article.create') }}" class="btn btn-success pull-right">Dodaj artykuł</a>
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
			<tr>
				<td>{{ $article->id }}</td>
				<td>{{ $article->title }}</td>
				<td>{{ $article->getCategoryName() }}</td>
				<td>{{ $article->is_published }}</td>
				<td>
					<a href="{{ route('article.edit', $article->id) }}" class="btn btn-info">Edytuj</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection