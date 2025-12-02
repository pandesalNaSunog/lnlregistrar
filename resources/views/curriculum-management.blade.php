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
        <a href="{{ route('add-curriculum-subject',$program) }}"><button class="shadow btn btn-success px-5 mb-3 fixed-button">+ Add Subject</button></a>
        <div class="card shadow">
            <div class="card-header">
                <h4 class="fw-bold">{{ $program->program }}</h4>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-lg-2 g-3">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">First Year - First Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($firstYearFirstSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $firstYearFirstSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success"><small>Add Prerequisite</small></button></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">First Year - Second Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($firstYearSecondSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $firstYearSecondSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Second Year - First Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($secondYearFirstSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $secondYearFirstSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Second Year - Second Semester</h5>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($secondYearSecondSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $secondYearSecondSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Third Year - First Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($thirdYearFirstSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $thirdYearFirstSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                            
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Third Year - Second Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($thirdYearSecondSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $thirdYearSecondSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Fourth Year - First Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($fourthYearFirstSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $fourthYearFirstSemesterPrerequisites[$key] }}</td>
                                               <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="fw-bold">Fourth Year - Second Semester</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped tabled-hover">
                                        <thead>
                                            <th scope="col">Course Code</th>
                                            <th scope="col">Descriptive Title</th>
                                            <th scope="col">Lab Units</th>
                                            <th scope="col">Lec Units</th>
                                            <th scope="col">Prerequisites</th>
                                            <th scope="col">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($fourthYearSecondSemester as $key => $subject)
                                            <tr>
                                                <td>{{ $subject->course_code }}</td>
                                                <td>
                                                    {{ $subject->descriptive_title }}
                                                </td>
                                                <td>{{ $subject->lab_units }}</td>
                                                <td>{{ $subject->lec_units }}</td>
                                                <td>{{ $fourthYearSecondSemesterPrerequisites[$key] }}</td>
                                                <td><a href="{{ route('add-prerequisite',$subject->id) }}"><button class="btn btn-outline-success">Add Prerequisite</button></a></td>
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
        </div>
    </div>
</body>
</html>