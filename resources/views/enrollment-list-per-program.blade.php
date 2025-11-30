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
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="fw-bold">
                            {{ $program->program }}
                        </h5>
                        <label for=""><small class="text-secondary">Academic Year</small></label>
                        <select name="academic-year" class="form-select">
                            @foreach($academicYears as $academicYear)
                            <option value="{{ $academicYear->id }}">{{ $academicYear->academic_year }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-success mt-3 w-100">Load</button>
                        
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <input type="text" placeholder="Search" class="form-control">
                <div class="card shadow mt-3">
                    <div class="card-header">
                        <p class="fw-bold mb-0">List of Enrollees</p>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
                <a href="{{ route('add-enrollee',$program->id) }}"><button class="btn btn-success px-5 mt-3">Student List</button></a>
            </div>
        </div>
    </div>
</body>
</html>