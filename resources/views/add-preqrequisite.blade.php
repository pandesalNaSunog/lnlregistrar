<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Prerequisite</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <div class="col col-lg-4 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="fw-bold">Prerequisites for {{ $subject->course_code . " " . "($subject->descriptive_title)" }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th scope="col">Course Code</th>
                                <th scope="col">Descriptive Title</th>
                            </thead>
                            <tbody>
                                @foreach($prerequisites as $prerequisite)
                                <tr>

                                    <td>{{ $prerequisite['course_code'] }}</td>
                                    <td>{{ $prerequisite['descriptive_title'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mt-3">
                <div class="card-body">
                    <label for=""><small>Choose Prerequisite</small></label>
                    <form method="post" action="{{ route('post-add-prerequisite',$subject->id) }}">
                        @csrf
                        <select name="prerequisite_id" class="form-select">
                            <option value="None">-None-</option>
                            <option value="Third Year Standing">-Third Year Standing-</option>
                            <option value="Fourth Year Standing">-Fourth Year Standing-</option>
                            @foreach($allSubjects as $subject)
                            <option value="{{ $subject->id }}"><small>{{ $subject->course_code . " ($subject->descriptive_title)" }}</small></option>
                            @endforeach
                        </select>
                        <button class="btn btn-success w-100 mt-3">Confirm</button>
                    </form>
                </div>
            </div>
            <a href="{{ route('manage-curriculum',$programId) }}"><button class="btn btn-link">Back to Curriculum Management</button></a>
        </div>
    </div>
</body>
</html>