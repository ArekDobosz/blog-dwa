@extends('admin/app')
@section('content')
<div class="col-sm">

<hr>
<a href="{{ route('category.create') }}" class="btn btn-success pull-right">Dodaj kategorię</a>
<hr>
	
<h1 class="pull-left">Lista kategorii: </h1>

<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nazwa</th>
			<th>Akcje</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td>{{ $category->name }}</td>
				<td>
					<a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edytuj</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection