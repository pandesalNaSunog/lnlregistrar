<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grades</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <form action="{{ route('grades') }}">
            <div class="row row-cols-1 row-cols-lg-2 g-3">
                <div class="col col-lg-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <label for="" class="text-secondary"><small>Select Academic Year</small></label>
                            <select name="academic_year" id="" class="form-select">
                                @foreach($academicYears as $year)
                                <option value="{{ $year->academic_year }}">{{ $year->academic_year }}</option>
                                @endforeach
                            </select>
                            <label for="" class="text-secondary"><small>Select Semester</small></label>
                            <select name="semester" id="" class="form-select">
                            <option value="First Semester" @if($activeSemester->semester == "First Semester") selected @endif>First Semester</option>
                            <option value="Second Semester" @if($activeSemester->semester == "Second Semester") selected @endif>Second Semester</option>
                            <option value="Summer" @if($activeSemester->semester == "Summer") selected @endif>Summer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-9">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="fw-bold">Search Student</h5>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-lg-3 g-3">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="last_name" placeholder="a" class="form-control">
                                        <label for=""><small>Last Name</small></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="first_name" placeholder="a" class="form-control">
                                        <label for=""><small>First Name</small></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" name="middle_name" placeholder="a" class="form-control">
                                        <label for=""><small>Middle Name</small></label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success px-5 mt-3">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card shadow mt-3">
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
                                <td>{{ $student['student']->last_name . ', ' . $student['student']->first_name. ' ' . $student['student']->middle_name }}</td>
                                <td>{{ $courses[$key]->program }}</td>
                                <td>
                                    <a href="{{ route('view-grades', $student['enrollment_id']) }}"><button class="btn btn-outline-success px-5"><small>View Grades</small></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">

            {{ $studentPagination->links() }}
        </div>
    </div>
</body>
</html>