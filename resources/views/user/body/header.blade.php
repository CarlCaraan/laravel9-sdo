@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

        <div id="logo">
            <h1><a href="{{ route('user.welcome') }}">DepEd <span>SDO</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt=""></a>-->
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link {{ ($route == 'user.welcome') ? 'active' : '' }}" href="{{ route('user.welcome')  }}">Fill Up (PDS)</a></li>
                <li><a class="nav-link {{ ($route == 'submit.pdf') ? 'active' : '' }}" href="{{ route('submit.pdf')  }}">Submit (PDS)</a></li>
                <li><a class="nav-link {{ ($route == 'view.request.servicerecord' || $route == 'view.archive.servicerecord') ? 'active' : '' }}" href="{{ route('view.request.servicerecord')  }}">Request Service Record</a></li>
                <li><a class="nav-link {{ ($route == 'user.profile.view') ? 'active' : '' }}" href="{{ route('user.profile.view')  }}">{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</a></li>
                <li><a class="nav-link" href="{{ route('admin.logout')  }}">Logout</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header>