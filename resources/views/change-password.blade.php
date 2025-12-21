<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
    <x-imports></x-imports>
</head>

<body>
    @if ($user->role == 0)
        <x-navbar :user="$user"></x-navbar>
    @else
        <x-admin-navbar></x-admin-navbar>
    @endif
    <div class="container py-5">
        <div class="col col-lg-4 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold"><small>Change Password</small></h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('post-change-password') }}" method="post">
                        @csrf
                        <div class="form-floating">
                            <input type="password" name="current_password" placeholder="a"
                                class="@error('current_password') is-invalid @enderror form-control">
                            <label for="">Current Password</label>
                            @error('current_password')
                                <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="form-floating mt-3">

                            <input type="password" name="new_password" placeholder="a"
                                class="@error('new_password') is-invalid @enderror form-control">
                            <label for="">New Password</label>
                        </div>
                        @error('new_password')
                            <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <div class="form-floating mt-3">

                            <input type="password" name="new_password_confirmation" placeholder="a"
                                class="form-control">
                            <label for="">Retype New Password</label>
                        </div>
                        <button class="btn mt-3 btn-success w-100">Change Password</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
