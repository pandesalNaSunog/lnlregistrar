<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>Search Results</title>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="fw-bold">Search Results</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
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