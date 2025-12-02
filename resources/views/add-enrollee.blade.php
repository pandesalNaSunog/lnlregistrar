<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Enrollee</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('enrollment') }}">Enrollment</a></li>
                <li class="breadcrumb-item"><a href="{{ route('enrollment-list',$program->id) }}">{{ $program->program }}</a></li>
                <li class="breadcrumb-item active">Student List</li> 
            </ol>
        </nav>
        <div class="card shadow">
            <div class="card-header">
                <h5 class="fw-bold">{{ $program->program . " Student List" }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Actions</th>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{ $student->last_name }}</td>
                                <td>
                                    {{ $student->first_name }}
                                </td>
                                <td>{{ $student->middle_name }}</td>
                                <td>
                                    <a href={{ route('add-enrollment-subjects',$student->id) }}>
                              
                                        <button class="btn btn-outline-success px-5"><small>Enroll</small></button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="{{ route('add-student',$program->id) }}"><button class="btn btn-success px-5 mt-3">Add New Student</button></a>
    </div>
</body>
</html>