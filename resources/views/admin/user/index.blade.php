@extends('admin/app')
@section('content')
<div class="col-sm">

<hr>
<h3 class="text-center">Lista użytkowników</h3>
<hr>
	
<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nazwa</th>
			<th>E-mail</th>
			<th>Rola</th>
			<th>Akcje</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->getRole() }}</td>
				<td>
					<a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">Edytuj</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection