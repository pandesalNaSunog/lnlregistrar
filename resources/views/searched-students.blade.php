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
                            <th>Name</th>
                            <th>Course</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($students as $key => $student)
                            <tr>
                                <td>{{ $student->last_name . ", " . $student->first_name . " " . $student->middle_name }}</td>
                                <td>{{ $courses[$key]['course'] }}</td>
                                <td>
                                    <a href="{{ route('student-record',$student->id) }}"><button class="btn btn-outline-success px-5"><small>View Records</small></button></a>
                                </td>
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