<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $program->program }}</title>
    <x-imports></x-imports>
</head>

<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('enrollment') }}">Enrollment</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $program->program }}</li>
            </ol>
        </nav>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="fw-bold">
                            {{ $program->program }}
                        </h5>
                        <form action="{{ route('enrollment-list', $program->id) }}">
                            <div class="form-floating mt-3">
                                <input type="text" class="form-control" placeholder="a" name="last_name">
                                <label for=""><small>Last Name</small></label>
                            </div>
                            <div class="form-floating mt-3">
                                <input type="text" class="form-control" placeholder="a" name="first_name">
                                <label for=""><small>First Name</small></label>
                            </div>
                            <div class="form-floating mt-3">
                                <input type="text" class="form-control" placeholder="a" name="middle_name">
                                <label for=""><small>Middle Name</small></label>
                            </div>
                            <label class="mt-3" for=""><small class="text-secondary">Academic
                                    Year</small></label>
                            <select name="academic_year" class="form-select">
                                @foreach ($academicYears as $academicYear)
                                    <option value="{{ $academicYear->academic_year }}">{{ $academicYear->academic_year }}</option>
                                @endforeach
                            </select>
                            <label class="mt-3" for=""><small class="text-secondary">Semester</small></label>
                            <select name="semester" class="form-select">
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                <option value="Summer">Summer</option>
                            </select>
                            <button class="btn btn-outline-success mt-3 w-100">Load</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="fw-bold mb-0">List of Enrollees</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Name</th>
                                    <th>Year Level</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($studentList as $student)
                                        <tr>
                                            <td>{{ $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name }}
                                            </td>
                                            <td>{{ $student->year_level }}</td>
                                            <td>
                                                <button class="btn btn-outline-success px-5">View Enrollment</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('add-enrollee', $program->id) }}"><button class="btn btn-success px-5 mt-3">Student
                        List</button></a>
            </div>
        </div>
    </div>
</body>

</html>
