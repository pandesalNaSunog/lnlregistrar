<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>List of Graduates</title>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <h4 class="fw-bold">Reports</h4>
        <hr class="w-100">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Enrollment Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Promotion Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">List of Graduates</a>
            </li>
        </ul>
        <div class="card shadow mt-3">
            <div class="card-header">
                <h5 class="fw-bold">List of Graduates</h5>
            </div>
            <div class="card-body">
                <div class="table responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Batch</th>
                            <th>SO No.</th>
                            <th>SO Application Status</th>
                        </thead>
                        <tbody>
                            @foreach($graduates as $graduate)
                            <tr>
                                <td>{{ $graduate['name'] }}</td>
                                <td>{{ $graduate['course'] }}</td>
                                <td>{{ $graduate['graduate']->year }}</td>
                                <td>{{ $graduate['graduate']->so_number }}</td>
                                <td>{{ $graduate['graduate']->so_application_status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>