<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enrollment</title>
    <x-imports></x-imports>
</head>
<body>
    <x-navbar :user="$user"></x-navbar>
    <div class="container py-5">
        <div class="col col-lg-4 mx-auto">

            @foreach($programs as $program)
            <a href="{{ route('enrollment-list',$program->id) }}">
                <button class="btn btn-outline-success px-5 w-100 mt-3">{{ $program->program }}</button>
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>