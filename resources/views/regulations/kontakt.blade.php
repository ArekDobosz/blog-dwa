@extends('layouts.base')
@section('content')
	<div class="col-md-{{ isset($hideSidebar) ? '12' : '8' }} blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title text-center">Kontakt</h2>
            <form action="{{ route('contact') }}" method="POST">
            	{{csrf_field()}}
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Imię" value="{{ old('name') }}" autofocus>
					@if ($errors->has('name'))
                        <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}">
					@if ($errors->has('email'))
                        <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<textarea name="contact_message" class="form-control" placeholder="Treść wiadomości" rows="6">{{ old('contact_message') }}</textarea>
					@if ($errors->has('contact_message'))
                        <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('contact_message') }}</strong>
                        </span>
                    @endif
				</div>
				<button type="submit" class="btn btn-info btn-block">Wyślij</button>         	
            </form>
        </div>
        <hr>
	</div>
@endsection