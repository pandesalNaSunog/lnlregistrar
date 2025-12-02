<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Grades</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('grades') }}">Grades</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $student->last_name . ", " . $student->first_name . " " . $student->middle_name }}</li>
            </ol>
        </nav>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col">
                            <label class="text-secondary">Name</label>
                            <p class="fw-bold">{{ $student->last_name . ", " . $student->first_name . " " . $student->middle_name }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Program</label>
                            <p class="fw-bold">{{ $program->program }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Civil Status</label>
                            <p class="fw-bold">{{ $student->civil_status }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Gender</label>
                            <p class="fw-bold">{{ $student->gender }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Date of Birth</label>
                            <p class="fw-bold">{{ $student->date_of_birth }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Place of Birth</label>
                            <p class="fw-bold">{{ $student->place_of_birth }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Guardian</label>
                            <p class="fw-bold">{{ "Mr. and Mrs. " . $student->guardian }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Contact Number</label>
                            <p class="fw-bold">{{ $student->contact_number }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Address</label>
                            <p class="fw-bold">{{ $student->address }}</p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Email</label>
                            <p class="fw-bold">{{ $student->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h4 class="fw-bold">{{ $enrollment->semester . ', ' . $enrollment->academic_year }}</h4>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Course Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Lec Units</th>
                                    <th>Lab Units</th>
                                    <th>Prelim</th>
                                    <th>Midterm</th>
                                    <th>Semi-Final</th>
                                    <th>Final</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                        <form action="{{ route('update-grade', $subject['enrolled_subject']->id) }}" method="post">
                                        @csrf
                                        <tr>
                                            <td>{{ $subject['course_code'] }}</td>
                                            <td>{{ $subject['descriptive_title'] }}</td>
                                            <td>{{ $subject['lec_units'] }}</td>
                                            <td>{{ $subject['lab_units'] }}</td>
                                            

                                            <td>
                                                <input type="text" class="form-control" name="prelim" value="{{ $subject['enrolled_subject']->prelim }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="midterm" value="{{ $subject['enrolled_subject']->midterm }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="semi_final" value="{{ $subject['enrolled_subject']->semi_final }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="final" value="{{ $subject['enrolled_subject']->final }}">
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-success px-5"><small>Update</small></button>
                                            </td>
                                        </tr>
                                    </form>
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