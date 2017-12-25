<nav class="navbar navbar-expand navbar-light navbar-top">


        @yield('navbar-top-title')


    <ul class="navbar-nav mr-auto">

        @stack('navbar-top')

    </ul>

    <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">

        {{ csrf_field() }}

        <button class="logout-button"><i class="fa fa-power-off fa-2x" aria-hidden="true"></i></button>

    </form>
    
</nav>

