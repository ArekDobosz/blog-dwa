@if ($message = Session::get('flash_message'))
	<div class="flash-container">
		<div class="alert alert-{{ $message['color'] }} alert-dismissible fade show" role="alert">
		  	{{ $message['message'] }}
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	</div>
@endif