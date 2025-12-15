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
        <div class="col mx-auto col-lg-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold">Add Encoder</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-add-encoder') }}" method="post">
                        @csrf
                        <div class="form-floating">
                            <input type="text" name="username" placeholder="a" class="form-control @error('username') is-invalid @enderror">
                            <label for=""><small>Username</small></label>
                            @error('username')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" name="last_name" placeholder="a" class="mt-3 form-control @error('last_name') is-invalid @enderror">
                            <label for=""><small>Last Name</small></label>
                            @error('last_name')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" name="first_name" placeholder="a" class="mt-3 form-control @error('first_name') is-invalid @enderror">
                            <label for=""><small>First Name</small></label>
                            @error('first_name')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="form-floating">
                            <input type="text" name="middle_name" placeholder="a" class="mt-3 form-control @error('middle_name') is-invalid @enderror">
                            <label for=""><small>Middle Name</small></label>
                            @error('middle_name')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <button class="btn btn-success w-100 mt-3">Confirm</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>