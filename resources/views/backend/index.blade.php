@extends('layouts.backend')

@push('styles')

<style>

</style>

@endpush

@section('content')


	@include('backend._partials.navbar-top')


	<main>

		<div id="workbench">


			@yield('workbench')

{{-- 			@if(isset($view))

				@include('backend.' . $view)

			@endif --}}

		</div>

	</main>


	@include('backend._partials.navbar-bottom')


@endsection
