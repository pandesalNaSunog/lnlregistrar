<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solo Parent Students and Students with Solo Parent</title>
    <x-imports></x-imports>
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
                <a class="nav-link" href="{{ route('promotion-report') }}">Promotion Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('first-generation-students') }}">List of First Generation
                    Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ip-students') }}">List of Indigenous People Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">List of Solo Parents and Students with Solo Parent</a>
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

        <div class="row row-cols-1 row-cols-lg-2 g-3 mt-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('first-generation-students') }}">
                            <label for="" class="text-secondary"><small>Select Academic Year</small></label>
                            <select name="academic_year" id="" class="form-select">
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->academic_year }}">{{ $year->academic_year }}</option>
                                @endforeach
                            </select>
                            <label for="" class="text-secondary mt-3"><small>Select Semester</small></label>
                            <select name="semester" id="" class="form-select">
                                <option value="First Semester" @if ($activeSemester == 'First Semester') selected @endif>First
                                    Semester</option>
                                <option value="Second Semester" @if ($activeSemester == 'Second Semester') selected @endif>Second
                                    Semester</option>
                                <option value="Summer" @if ($activeSemester == 'Summer') selected @endif>Summer</option>
                            </select>
                            <button class="btn btn-success w-100 mt-3">Load</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="fw-bold fs-6">{{ $semester . ', ' . $academicYear }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Sex</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Solo Parent Student</th>
                                    <th>Student With Solo Parent</th>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $student->last_name }}</td>
                                            <td>{{ $student->first_name }}</td>
                                            <td>{{ $student->middle_name }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ $programs[$key]->program }}</td>
                                            <td>{{ $student->year_level }}</td>
                                            <td>
                                                @if ($student->solo_parent_student == 'on')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" fill="currentColor" class="bi bi-check"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                    </svg>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($student->student_with_solo_parent == 'on')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" fill="currentColor" class="bi bi-check"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                                                    </svg>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
