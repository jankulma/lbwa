@extends('layouts.backend')

@section('content')

<div class="login">

    <h1 class="login-header">LBWA</h1>

    <form action="{{ route('password.request') }}" method="POST" class="login-form">

        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <input class="" type="email" name="email" placeholder="email" autofocus="">

        <input type="password" name="password" placeholder="password">

        <input type="password" name="password_confirmation" placeholder="repeat password">

        <button type="submit">
            reset <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>

    </form>

    <span class="ajax-status">
        @foreach($errors->all() as $error)
            {{ $error }} <br>
        @endforeach
    </span>

</div>

@endsection
