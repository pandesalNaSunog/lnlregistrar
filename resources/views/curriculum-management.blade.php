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
                                            <div class="dropdown">
                                                <button data-bs-toggle="dropdown" class="dropdown-toggle btn btn-outline-success">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="{{ route('add-prerequisite',$subject->id) }}" class="dropdown-item"><small>Add Prerequisite</small></a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('edit-subject',$subject->id) }}" class="dropdown-item"><small>Edit</small></a>
                                                    </li>
                                                    <li>
                                                        <form id="delete-form-{{ $subject->id }}" action="{{ route('delete-subject',$subject->id) }}" method="post">
                                                            @csrf
                                                            <button class="dropdown-item"><small>Delete</small></a></button>
                                                        </form>
                                                        <script>
                                                            var deleteForm = document.getElementById('delete-form-{{ $subject->id }}');
                                                            deleteForm.addEventListener('submit', function(event){
                                                                const confirmation = confirm("Are you sure you want to delete this subject?");
                                                                if(!confirmation){
                                                                    event.preventDefault();
                                                                }
                                                            })
                                                        </script>
                                                    </li>
                                                </ul>
                                            </div>

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
