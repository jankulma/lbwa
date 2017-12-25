@extends('backend.index')

@section('navbar-top-title')
    
    <a class="navbar-brand" href="{{ url('/') }}">

	    {{ env('APP_NAME') }}

    </a>
    
@endsection

@push('navbar-top')

    <dashboard-navbar></dashboard-navbar>

@endpush

@section('workbench')

    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12 col-xl-6"> --}}

                <dashboard-workbench></dashboard-workbench>

            {{-- </div> --}}
        </div>
    </div>

@endsection