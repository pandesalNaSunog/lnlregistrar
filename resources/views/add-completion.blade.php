<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Completion</title>
    <x-imports></x-imports>
</head>

<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('grades') }}">Grades</a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a
                        href="{{ route('view-grades', $enrollment->id) }}">{{ $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name }}</a>
                </li>
                <li class="breadcrumb-item active">
                    Completion for {{ $subject->course_code }}
                </li>
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
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="fw-bold"><small>Add Completion</small></h5>
                    </div>
                    <div class="card-body">
                        <label for="" class="form-label">Select Term</label>
                        <form action="{{ route('post-add-completion', $subjectEnrolled->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <select name="term" class="form-select">
                                <option value="prelim">Prelim</option>
                                <option value="midterm">Midterm</option>
                                <option value="semi-final">Semi-Final</option>
                                <option value="final">Final</option>
                            </select>
                            <div class="form-floating mt-3">
                                <input type="number" name="completion_grade" placeholder="a"
                                    class="@error('completion_grade') is-invalid @enderror form-control">
                                @error('completion_grade')
                                    <x-error-text>{{ $message }}</x-error-text>
                                @enderror
                                <label for="" class="form-label">Completion Grade</label>
                            </div>
                            <label for="" class="form-label mt-3">Upload Completion Form</label>
                            <input type="file" accept="image/*" name="completion_form"
                                class="@error('completion_form') is-invalid @enderror form-control">
                            @error('completion_form')
                                <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                            <button class="btn btn-success w-100 mt-3">Confirm</button>
                        </form>
                    </div>
                </div>
                <div class="card shadow mt-3">
                    <div class="card-header">
                        <h5 class="fw-bold"><small>Completion for {{ $subject->course_code }}</small></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-reponsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Term</th>
                                    <th>Grade</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($completions as $completion)
                                        <tr>
                                            <td>{{ $completion->term }}</td>
                                            <td>{{ $completion->completion_grade }}</td>
                                            <td>
                                                <button class="btn btn-outline-success px-5">View Completion
                                                    Form</button>
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
