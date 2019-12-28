@extends('admin/app')
@section('content')
<div class="col-sm">
	
<h1>Edycja kategorii id#{{ $category->id }}</h1>
<form action="{{ route('category.update', $category->id) }}" method="POST">
	{{ csrf_field() }}
	{{ method_field("PATCH") }}
	<div class="form-group">
		<input type="text" class="form-control" name="name" value="{{ $category->name }}">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="slug" value="{{ $category->slug }}">
	</div>
	<div class="row">
		<div class="col-md-6">
			<input type="submit" class="btn btn-success btn-block" name="edit" value="Edytuj">
		</div>
		<div class="col-md-6">
			<a href="{{ route('category.index') }}" class="btn btn-info btn-block">Powrót</a>
		</div>
	</div>
</form>
</div>	
@endsection