@extends('backend.index')

@section('navbar-top-title')
    
    <a class="navbar-brand" href="{{ url('/backend/setings') }}">

    	Settings

    </a>
    
@endsection

@push('navbar-top')

    <settings-navbar></settings-navbar>

@endpush

@section('workbench')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6">

            	<settings-workbench :user="{{ auth()->user() }}"></settings-workbench>

            </div>
        </div>
    </div>

@endsection