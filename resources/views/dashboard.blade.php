<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>Dashboard</title>
</head>
<body>
    <x-navbar :user="$user"></x-navbar> 

    <div class="container py-5">
        <h4 class="fw-bold">Reports</h4>
        <hr class="w-100">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Enrollment Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Promotion Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list-of-graduates') }}">List of Graduates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('enrollment-summary') }}">Enrollment Summary</a>
            </li>
        </ul>
    </div>
</body>
</html>