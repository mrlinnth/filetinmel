@extends('filetinmel::layouts.master')

@push('styles')
    {{-- Laravel Mix - CSS File --}}
    <link rel="stylesheet" href="{{ asset('vendor/filetinmel/css/app.css') }}">
@endpush

@section('body')

	<div id="app" class="m-10">
		<div class="flex">
			<div class="flex-1">
				<h2 class="text-3xl font-medium leading-none mb-2">@yield('heading')</h2>
			</div>
			<div class="flex-1">
				<ul class="flex float-right">
				  <li class="mr-6">
				    <a class="text-gray-500 hover:text-gray-600" href="{{route('filetinmel.test')}}">Test</a>
				  </li>
				</ul>
			</div>
		</div>

		<div class="my-5">

			@yield('content')

		</div>
	</div>

@endsection

@push('scripts')
    {{-- Laravel Mix - JS File --}}
    <script src="{{ asset('vendor/filetinmel/js/app.js') }}"></script>
@endpush
