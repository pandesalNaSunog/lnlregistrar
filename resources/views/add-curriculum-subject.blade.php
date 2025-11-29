<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Subject</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <div class="card shadow col col-lg-4 mx-auto">
            <div class="card-header">
                <h5 class="fw-bold">Add Subjects for {{ $program->program }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('post-add-curriculum-subject', $program->id) }}" method="post">
                    @csrf
                    <label><small>Select Year</small></label>
                    <select name="year"class="form-select">
                        <option value="First Year" selected>First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                    </select>
                    <label class="mt-3"><small>Select Semester</small></label>
                    <select name="semester"class="form-select">
                        <option value="First Semester" selected>First Semester</option>
                        <option value="Second Semester">Second Semester</option>
                    </select>
                    
                    <div class="form-floating mt-3">
                        
                        <input value="{{ old('course_code') }}" type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" placeholder="Course Code">
                        <label><small>Course Code</small></label>
                    </div>
                    @error('course_code')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                    <div class="form-floating mt-3">
                        
                        <input value="{{ old('descriptive_title') }}" type="text" name="descriptive_title" class="form-control @error('descriptive_title') is-invalid @enderror" placeholder="Descriptive Title">
                        <label><small>Descriptive Title</small></label>
                    </div>
                       @error('descriptive_title')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                    <div class="form-floating mt-3">
                        
                        <input value="{{ old('lab_units') }}" type="number" name="lab_units" class="form-control @error('lab_units') is-invalid @enderror" placeholder="Descriptive Title">
                        <label><small>Lab Units</small></label>
                    </div>
                    @error('lab_units')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                    <div class="form-floating mt-3">
                        
                        <input value="{{ old('lec_units') }}" type="number" name="lec_units" class="form-control @error('lec_units') is-invalid @enderror" placeholder="Descriptive Title">
                        <label><small>Lec Units</small></label>
                    </div>
                    @error('lec_units')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                    <button class="btn btn-success w-100 mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>