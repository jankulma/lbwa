@extends('layouts.backend')

@section('content')

<div class="login">

    <h1 class="login-header">LBWA</h1>

    <form action="{{ route('login') }}" method="POST" class="login-form">

        {{ csrf_field() }}

        <input class="" type="email" name="email" placeholder="email" autofocus="">

        <input type="password" name="password" placeholder="password">

        <button type="submit">
            enter <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>

    </form>

    <forgot-password></forgot-password>

</div>

@endsection
