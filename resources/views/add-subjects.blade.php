<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Subjects</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('enrollment') }}">Enrollment</a></li>
                <li class="breadcrumb-item"><a href="{{ route('enrollment-list',$program->id) }}">{{ $program->program }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('add-enrollee', $program->id) }}">Student List</a></li> 
                <li class="breadcrumb-item active">Enroll</li>
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
                            <p class="fw-bold">{{ date_format(date_create($student->date_of_birth), 'M d, Y') }}</p>
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
                        <h5 class="fw-bold">Subjects Enrolled for Academic Year {{ date('Y')."-".date('Y')+1 .", " . $enrollment->semester}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th scope="col">Course Code</th>
                                    <th scope="col">Descriptive Title</th>
                                    <th scope="col">Lec Units</th>
                                    <th>Lab Units</th>
                                </thead>
                                <tbody>
                                    @foreach($enrolledSubjects as $subject)
                                        <tr>

                                            <td>{{ $subject['course_code'] }}</td>
                                            <td>{{ $subject['descriptive_title'] }}</td>
                                            <td>{{ $subject['lec_units'] }}</td>
                                            <td>{{ $subject['lab_units'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <label for="" class="text-secondary mt-3">Select Subjects</label>

                <form action="{{ route('post-add-enrolled-subject',$enrollment->id) }}" method="post">
                    @csrf
                    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->course_code . " ($subject->descriptive_title)" }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                    <button class="mt-3 btn btn-success px-5">Add</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>