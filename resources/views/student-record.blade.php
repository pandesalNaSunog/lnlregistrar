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

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student-records') }}">Student Records</a></li>
                <li class="breadcrumb-item active">
                    {{ $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name }}</li>
            </ol>
        </nav>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col">
                            <label class="text-secondary">Name</label>
                            <p class="fw-bold">
                                {{ $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name }}
                            </p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Program</label>
                            <p class="fw-bold mb-0">{{ $program->program }}</p>
                            <button data-bs-toggle="modal" data-bs-target="#shift_modal"
                                class="btn btn-outline-success w-100">Shift</button>
                        </div>
                        <div class="col mt-3">
                            <label for="" class="text-secondary">Year Level</label>
                            <p class="fw-bold">
                                @php
                                    switch($student->year_level){
                                        case '1':
                                            echo 'First Year';
                                            break;
                                        case '2':
                                            echo 'Second Year';
                                            break;
                                        case '3':
                                            echo 'Third Year';
                                            break;
                                        case '4':
                                            echo 'Fourth Year';
                                            break;
                                    }

                                    
                                @endphp
                            </p>
                        </div>
                        <div class="col mt-3">
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
                            <p class="fw-bold">{{ 'Mr. and Mrs. ' . $student->guardian }}</p>
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
                        <div class="col">
                            <label class="text-secondary">Elementary</label>
                            <p class="fw-bold">
                                {{ $student->elementary }}<em>{{ ' (' . $student->elem_year_grad . ')' }}</em></p>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Secondary</label>
                            <p class="fw-bold">
                                {{ $student->secondary }}<em>{{ ' (' . $student->secondary_year_grad . ')' }}</em></p>
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
                        @foreach ($studentRecord as $record)
                            <h4 class="fw-bold">
                                {{ $record['semester'] . ', ' . $record['academic_year'] . '  Degree: ' . $record['program'] }}
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <th>Course Code</th>
                                        <th>Descriptive Title</th>
                                        <th>Units</th>
                                        <th>Grade</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($record['enrolled_subjects'] as $subject)
                                            <tr>
                                                <td>{{ $subject['course_code'] }}</td>
                                                <td>{{ $subject['descriptive_title'] }}</td>
                                                <td>{{ $subject['units'] }}</td>
                                                <td>{{ $subject['grade'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                 <div class="accordion mt-3" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Subjects to be Accomplished {{ '('.count($toBeAccomplishedSubjects).')' }}
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul>
                                @foreach($toBeAccomplishedSubjects as $toBeAccomplishedSubject)
                                     <li>
                                        {{ $toBeAccomplishedSubject }}
                                    </li> 
                                  
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('apply-for-graduation', $student->id) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ count($toBeAccomplishedSubjects) }}" name="to_accomplish">
                        <button class="btn btn-success px-5 mt-3">Apply for Graduation</button>
                    </form>
                
            </div>
        </div>


    </div>


    <div class="modal fade" id="shift_modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Program Shifting</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Warning! Check active semester first before proceeding!<br>
                        Current active semester: <span class="fw-bold">{{ $activeSemester->semester }}</span>
                    </div>
                    <label for="">From</label>
                    <input class="form-control" disabled value="{{ $program->program }}">
                    
                    <form id="shift" action="{{ route('shift-program', $student->id) }}" method="post">
                        @csrf
                        <label for="" class="mt-3"><small>To</small></label>
                        <select name="program_id" id="" class="form-select">
                            @foreach ($shiftPrograms as $program)
                                <option value="{{ $program->id }}">{{ $program->program }}</option>
                            @endforeach
                        </select>
                        <button type="button" onclick="document.getElementById('shift').submit()" class="btn btn-success w-100 mt-3">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
