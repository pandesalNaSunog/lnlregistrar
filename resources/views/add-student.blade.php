<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Student</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>

    <div class="container py-5">
         <nav style="--bs-breadcrumb-divider: '>'; color: green; text-decoration: none;" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('enrollment') }}">Enrollment</a></li>
                <li class="breadcrumb-item"><a href="{{ route('enrollment-list',$program->id) }}">{{ $program->program }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('add-enrollee', $program->id) }}">Student List</a></li> 
                <li class="breadcrumb-item active">Add New Student</li>
            </ol>
        </nav>
        <form action="{{ route('post-add-student') }}" method="post">
            @csrf
        <div class="card shadow">
            <div class="card-header">
                <h5 class="fw-bold">Student Information</h5>
            </div>
            <div class="card-body">
                <div class="form-floating">
                    <div class="row row-cols-1 row-cols-lg-3 g-3">
                        <input type="hidden" name="year_level" value="1">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="last_name" placeholder="a" class="form-control @error('last_name') is-invalid @enderror">
                                <label for="">Last Name</label>
                            </div>
                            @error('last_name')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="first_name" placeholder="a" class="@error('first_name') is-invalid @enderror form-control">
                                <label for="">First Name</label>
                            </div>
                            @error('first_name')
                            <x-error-text>{{ $message }}</x-error-text>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="middle_name" placeholder="a" class="form-control">
                                <label for="">Middle Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="hidden" name="program_id" value="{{ $program->id }}">
                                <input type="text" value="{{ $program->program }}" placeholder="a" class="form-control" disabled>
                                <label for="">Program</label>
                            </div>
                        </div>
                        <div class="col">
                            <label for="" class="text-secondary">Civil Status</label>
                            <select name="civil_status" class="form-select">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="" class="text-secondary">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="" class="text-secondary">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control">
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" placeholder="a" name="place_of_birth" class="form-control">
                                <label for="">Place of Birth</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="guardian" placeholder="a" class="form-control">
                                <label for="">Guardian</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" name="contact_number" placeholder="a" class="form-control">
                                <label for="">Contact Number</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="address" placeholder="a" class="form-control">
                                <label for="">Address</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="email" name="email" placeholder="a" class="form-control">
                                <label for="">Email</label>
                            </div>
                        </div>


                        <div class="col">
                            <label for="" class="text-secondary">Student Type</label>
                            <select name="type" class="form-select">
                                <option value="Regular">Regular</option>
                                <option value="Foreign">Foreign</option>
                            </select>
                        </div>
                    </div>
                    <h5 class="fw-bold mt-3">Education History</h5>
                    <hr class="w-100">
                    <div class="row row-cols-1 row-cols-lg-2 g-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="elementary" placeholder="a" class="form-control">
                                <label for="">Elementary</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" name="elem_year_grad" placeholder="a" class="form-control">
                                <label for="">Year Graduated</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="secondary" placeholder="a" class="form-control">
                                <label for="">Secondary</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" name="secondary_year_grad" placeholder="a" class="form-control">
                                <label for="">Year Graduated</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success px-5 mt-3">Confirm</button>
        </form>
    </div>

</body>
</html>