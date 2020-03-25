@if(session('status'))
	@component('filetinmel::components.alert-success')
		{{ session('status') }}
	@endcomponent
@endif
