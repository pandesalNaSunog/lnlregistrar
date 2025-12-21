<nav class="sticky-top navbar navbar-dark navbar-expand-lg bg-success">
        <div class="container">
            <div class="navbar-brand">
                <div class="d-flex">
                    <div class="col me-3">
                        <img src="/lnl.png" style="height: 50px; width: 50px" alt="" class="img-fluid">
                    </div>
                    <div class="col">

                        <a class="navbar-brand fw-bold" href="#">The LNL Registrar</a>
                        <p class="mb-0 text-light fs-6"><small>Welcome, Administrator</small></p>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin-dashboard') }}">Users</a>
                    </li>
                    <li class="nav-item ms-4 dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('change-password') }}">Change Password</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>