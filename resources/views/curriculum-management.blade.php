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
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('curriculum') }}">Curriculum</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $program->program }}</li>
            </ol>
        </nav>
        <a href="{{ route('add-curriculum-subject', $program) }}"><button
                class="shadow btn btn-success px-5 mb-3 fixed-button">+ Add Subject</button></a>
        

        <div class="row row-cols-1 row-cols-lg-2 g-3">
            @foreach($curriculumData as $data)
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="fw-bold"><small>{{ $data['year'] . ' ' . $data['semester'] }}</small></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Course Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Lec Units</th>
                                    <th>Lab Units</th>
                                    <th>Prerequisites</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach($data['subjects'] as $key => $subject)
                                    <tr>
                                        <td>{{ $subject->course_code }}</td>
                                        <td>{{ $subject->descriptive_title }}</td>
                                        <td>{{ $subject->lec_units }}</td>
                                        <td>{{ $subject->lab_units }}</td>
                                        <td>{{ $data['prerequisites'][$key] }}</td>
                                        <td>
                                            <a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success"><small>Add Prerequisite</small></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
