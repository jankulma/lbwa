<nav class="navbar navbar-expand fixed-bottom navbar-dark bg-dark navbar-bottom">

        <ul class="navbar-nav mx-auto">

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'dashboard') ? 'active' : '' }}" href="{{ url('backend/dashboard') }}">
                    <i class="fa fa-circle-o" aria-hidden="true"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'cms') ? 'active' : '' }}" href="{{ url('backend/cms') }}">
                    <i class="fa fa-pencil" aria-hidden="true"></i> CMS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'settings') ? 'active' : '' }}" href="{{ url('backend/settings') }}">
                    <i class="fa fa-cog" aria-hidden="true"></i> Settings
                </a>
            </li>
        </ul>

</nav>