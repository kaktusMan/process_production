<br/>
<div class="flash-message notification">
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if(Session::has('alert-' . $msg))
			<p class="text-center alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		@endif
	@endforeach
</div>