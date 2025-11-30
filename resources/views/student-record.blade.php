<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Record</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
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
                    <div class="card-header">
                        <h3 class="fw-bold">Student Permanent Record</h3>
                    </div>
                    <div class="card-body">
                        @foreach($enrollments as $key => $enrollment)
                        <h4 class="fw-bold">{{ $enrollment->semester.", ".$enrollment->academic_year }}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Course Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th>Grade</th>
                                </thead>
                                <tbody>
                                    @foreach($enrolledSubjects[$key] as $enrolledSubjectsKey => $subject)
                                    <tr>
                                        <td>{{ $subject->course_code }}</td>
                                        <td>{{ $subject->descriptive_title }}</td>
                                        <td>{{ $units[$key][$enrolledSubjectsKey] }}</td>
                                        <td>{{ $grades[$key][$enrolledSubjectsKey] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>