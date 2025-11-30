<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Records</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="fw-bold">Search Student</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('search-student') }}">
                    <div class="row row-cols-1 row-cols-lg-3 g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="a" name="last_name" class="form-control">
                                <label for="">Last Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="a" name="first_name" class="form-control">
                                <label for="">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="a" name="middle_name" class="form-control">
                                <label for="">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success px-5 mt-3">Search</button>
                </form>

            </div>
        </div>

    </div>
</body>
</html>