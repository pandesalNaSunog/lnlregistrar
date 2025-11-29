<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Active Semester</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <div class="col col-lg-4 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold">Choose Active Semester</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-active-semester') }}" method="post">
                        @csrf
                        <select name="semester" class="form-select">
                            <option value="First Semester" @if($activeSemester == 'First Semester') selected @endif>First Semester</option>
                            <option value="Second Semester"@if($activeSemester == 'Second Semester') selected @endif >Second Semester</option>
                            <option value="Summer"@if($activeSemester == 'Summer') selected @endif>Summer</option>
                        </select>
                        <button class="btn btn-success mt-3 w-100">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>