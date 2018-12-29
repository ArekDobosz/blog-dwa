@extends('admin/app')
@section('content')
<div class="col-sm">
	
<h1>Dodaj kategorię:</h1>
<form action="{{ route('category.store') }}" method="POST">
	{{ csrf_field() }}
	{{ method_field("POST") }}
	<div class="form-group">
		<input type="text" class="form-control" name="name">
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="slug">
	</div>
	<input type="submit" name="Dodaj">
</form>
</div>	
@endsection