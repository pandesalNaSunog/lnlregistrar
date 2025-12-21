<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Subject</title>
    <x-imports></x-imports>
</head>

<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('curriculum') }}">Curriculum</a></li>
                <li class="breadcrumb-item" ><a href="{{ route('manage-curriculum',$program->id) }}">{{ $program->program }}</a></li>
                <li class="breadcrumb-item active">Edit Subject</li>
            </ol>
        </nav>
        <div class="col col-lg-4 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold"><small>Edit Subject</small></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-edit-subject', $subject->id) }}" method="post">
                        @csrf
                        <div class="form-floating mt-3">
                            
                            <input value="{{ $subject->course_code }}" type="text" name="course_code"
                            class="form-control @error('course_code') is-invalid @enderror" placeholder="Course Code">
                            <label><small>Course Code</small></label>
                        </div>
                        @error('course_code')
                        <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <div class="form-floating mt-3">
                            
                            <input value="{{ $subject->descriptive_title }}" type="text" name="descriptive_title"
                            class="form-control @error('descriptive_title') is-invalid @enderror"
                            placeholder="Descriptive Title">
                            <label><small>Descriptive Title</small></label>
                        </div>
                        @error('descriptive_title')
                        <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <div class="form-floating mt-3">
                            
                            <input value="{{ $subject->lab_units }}" type="number" name="lab_units"
                            class="form-control @error('lab_units') is-invalid @enderror"
                            placeholder="Descriptive Title">
                            <label><small>Lab Units</small></label>
                        </div>
                        @error('lab_units')
                        <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <div class="form-floating mt-3">
                            
                            <input value="{{ $subject->lec_units }}" type="number" name="lec_units"
                            class="form-control @error('lec_units') is-invalid @enderror"
                            placeholder="Descriptive Title">
                            <label><small>Lec Units</small></label>
                        </div>
                        @error('lec_units')
                        <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <button class="btn btn-success w-100 mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
