<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator</title>
    <x-imports></x-imports>
</head>
<body>
    <x-admin-navbar></x-admin-navbar>

    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="fw-bold">Encoders</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Username</th>
                            <th>Surname</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->middle_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <a href="{{ route('add-encoder') }}"><button class="btn btn-success px-5 mt-3">+ Add Encoder</button></a>
    </div>
</body>
</html>