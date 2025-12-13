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
                <a class="nav-link" href="{{ route('promotion-report') }}">Promotion Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('first-generation-students') }}">List of First Generation Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ip-students') }}">List of Indigenous People Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('solo-parent') }}">List of Solo Parents and Students with Solo Parent</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pwd-students') }}">List of PWD Students and Students with PWD Parent</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list-of-graduates') }}">List of Graduates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('enrollment-summary') }}">Enrollment Summary</a>
            </li>
        </ul>

        @foreach($enrollmentReport as $report)
        <div class="card shadow mt-3">
            <div class="card-header">
                <h5 class="fw-bold"><small>{{ $report['program'] .' Year Level: ' . $report['year_level'] }}</small></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            @foreach($report['subject_table_heads'] as $head)
                            <th>{{ $head['0'] }}</th>
                            <th>{{ $head['1'] }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach($report['students'] as $key => $student)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ strtoupper($student['student']->last_name.', '.$student['student']->first_name.' '.$student['student']->middle_name) }}</td>
                                <td>{{ strtoupper($student['student']->address) }}</td>
                                <td>{{ strtoupper($student['student']->gender) }}</td>
                                @foreach($student['enrolledSubjects'] as $subject)
                                <td>{{ $subject['course_code'] }}</td>
                                <td>{{ $subject['units'] }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>