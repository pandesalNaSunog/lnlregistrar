<nav class="sticky-top navbar navbar-dark navbar-expand-lg bg-success">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-brand fw-bold" href="#">The LNL Registrar</a>
                <p class="mb-0 text-light fs-6"><small>Welcome, {{ $user->first_name . " " . $user->last_name}}</small></p>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{ route('enrollment') }}" class="nav-link active">Enrollment</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{ route('grades') }}" class="nav-link active">Grades</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{ route('student-records') }}" class="nav-link active">Student Records</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{ route('active-semester') }}" class="nav-link active">Active Semester</a>
                    </li>
                    <li class="nav-item ms-4">
                    <a class="nav-link active" aria-current="page" href="{{ route('curriculum') }}">Curriculum</a>
                    </li>
                    <li class="nav-item ms-4 dropdown">
                        <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                        <ul class="dropdown-menu">
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