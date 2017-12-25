@extends('backend.index')

@section('navbar-top-title')
    
    <a class="navbar-brand" href="{{ url('/backend/cms') }}">

	    CMS

    </a>

@endsection

@push('navbar-top')

    <cms-navbar></cms-navbar>

@endpush

@section('workbench')

    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-12 col-md-6"> --}}

                <cms-workbench></cms-workbench>

            {{-- </div> --}}
        </div>
    </div>

@endsection