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
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="col">
                            <label class="text-secondary">Name</label>
                            <h5 class="fw-bold">{{ $student->last_name . ", " . $student->first_name . " " . $student->middle_name }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Program</label>
                            <h5 class="fw-bold">{{ $program->program }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Civil Status</label>
                            <h5 class="fw-bold">{{ $student->civil_status }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Gender</label>
                            <h5 class="fw-bold">{{ $student->gender }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Date of Birth</label>
                            <h5 class="fw-bold">{{ $student->date_of_birth }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Place of Birth</label>
                            <h5 class="fw-bold">{{ $student->place_of_birth }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Guardian</label>
                            <h5 class="fw-bold">{{ "Mr. and Mrs. " . $student->guardian }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Contact Number</label>
                            <h5 class="fw-bold">{{ $student->contact_number }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Address</label>
                            <h5 class="fw-bold">{{ $student->address }}</h5>
                        </div>
                        <div class="col">
                            <label class="text-secondary">Email</label>
                            <h5 class="fw-bold">{{ $student->email }}</h5>
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <label for="" class="text-secondary mt-3">Select Subjects</label>

                <form action="{{ route('post-add-enrolled-subject',$enrollment->id) }}" method="post">
                    @csrf
                    <select name="subject_id" class="form-select">
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->course_code . " ($subject->descriptive_title)" }}</option>
                        @endforeach
                    </select>
                    <button class="mt-3 btn btn-success px-5">Add</button>
                </form>
            </div>
        </div>
        
    </div>
</body>
</html>