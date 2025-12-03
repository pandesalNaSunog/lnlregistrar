<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>The LNL Registrar</title>

</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center">
            <img src="/lnl.png" style="height: 150px; width: 150px;"alt="" class="img-fluid">
            <h1 class="fw-bold mt-2">The <span class="text-success">LNL</span> Registrar</h1>
        </div>

        <div class="col col-lg-4 mx-auto">
            <div class="text-center">
                Log In
            </div>
            <div class="card shadow mt-3">
                <div class="card-body">
                    <form action="{{ route('post-login') }}" method="post">
                        @csrf
                        <div class="form-floating my-0">
                            <input type="text" name="username" placeholder="Username" class="form-control @error('username') is-invalid @enderror">
                            <label for=""><small>Username</small></label>
                            
                        </div>
                        @error('username')
                        <x-error-text>{{ $message }}</x-error-text>
                        @enderror
                        <div class="form-floating mt-3">
                            <input type="password" name="password" placeholder="Password" class="form-control @error('username') is-invalid @enderror ">
                            <label for=""><small>Password</small></label>
                            
                        </div>
                        
                        <button class="btn btn-success w-100 mt-3">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>