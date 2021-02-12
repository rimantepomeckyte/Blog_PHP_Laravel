<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        @if(Auth::check())
            <p class="text-white mt-1">Signed in as: <strong>{{Auth::user()->name}}</strong></p>
        @endif
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/categories-list/">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/add-post/">Add new post</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                @else
                    <li class="nav-item"><a href="/login">Login</a></li>
                    <li class="nav-item"><a href="/register">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
