<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3">
    <div class="container px-5">
        <a class="navbar-brand" href="index.html">
            <span class="fw-bolder text-white">StadiGo</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home.user') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('acara') }}">Match Schedule</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('tiket') }}">
                        <i class="bi bi-ticket-detailed"></i> Ticket</a></li>
                @guest
                    <!-- Jika belum login -->
                    <li class="nav-item ms-3">
                        <a class="btn btn-light text-info" href="{{ route('login') }}">Login / Sign Up</a>
                    </li>
                @endguest

                @auth
                    <!-- Jika sudah login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- <li>
                                <form method="POST" action="{{ route('profile') }}">
                                    @csrf
                                    <button class="dropdown-item text-info" type="submit">Profile</button>
                                </form>
                            </li> --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
