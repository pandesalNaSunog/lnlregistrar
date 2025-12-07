<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enrollment Summary</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <h4 class="fw-bold">Reports</h4>
        <hr class="w-100">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Enrollment Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Promotion Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('list-of-graduates') }}">List of Graduates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Enrollment Summary</a>
            </li>
        </ul>
        <div class="row row-cols-1 row-cols-lg-3 g-3 mt-3">
            <div class="col col-lg-3">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{ route('enrollment-summary') }}">
                            <label for="" class="text-secondary"><small>Select Academic Year</small></label>
                            <select name="academic_year" id="" class="form-select">
                                @foreach($academicYears as $year)
                                <option value="{{ $year->academic_year }}">{{ $year->academic_year }}</option>
                                @endforeach
                            </select>
                            <label for="" class="text-secondary mt-3"><small>Select Semester</small></label>
                            <select name="semester" id="" class="form-select">
                                <option value="First Semester">First Semester</option>
                                <option value="Second Semester">Second Semester</option>
                                <option value="Summer">Summer</option>
                            </select>
                            <button class="btn btn-success w-100 mt-3">Load</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-lg-9">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="fw-bold">Enrollment Summary of {{ $semester.', '.$academicYear }}</h5>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Program</th>
                                    <th>First Year Male</th>
                                    <th>First Year Female</th>
                                    <th>Second Year Male</th>
                                    <th>Second Year Female</th>
                                    <th>Third Year Male</th>
                                    <th>Third Year Female</th>
                                    <th>Fourth Year Male</th>
                                    <th>Fourth Year Female</th>
                                </thead>
                                <tbody>
                                    @foreach($enrollmentSummary as $summary)
                                    <tr>
                                        <td>{{ $summary['program'] }}</td>
                                        <td>{{ $summary['firstMales'] }}</td>
                                        <td>{{ $summary['firstFemales'] }}</td>
                                        <td>{{ $summary['secondMales'] }}</td>
                                        <td>{{ $summary['secondFemales'] }}</td>
                                        <td>{{ $summary['thirdMales'] }}</td>
                                        <td>{{ $summary['thirdFemales'] }}</td>
                                        <td>{{ $summary['fourthMales'] }}</td>
                                        <td>{{ $summary['fourthFemales'] }}</td>
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