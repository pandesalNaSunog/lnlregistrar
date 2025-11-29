<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>Curriculum</title>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="fw-bold">Programs</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th scope="col">Program</th>
                            <th scope="col">Abbreviation</th>
                            <th scope="col">Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <tr>
                                    <td>{{$program->program}}</td>
                                    <td>{{ $program->abbreviation }}</td>
                                    <td><a href="{{ route('manage-curriculum',$program->id) }}"><button class="btn btn-outline-success">Manage Curriculum</button></a></td>
                                </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>