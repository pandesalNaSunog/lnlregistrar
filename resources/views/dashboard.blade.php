<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-imports></x-imports>
    <title>Dashboard</title>
</head>
<body>
    <x-navbar :user="$user"></x-navbar> 

    <div class="container py-5">
        <h4 class="fw-bold">Reports</h4>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col">
                <button class="btn btn-outline-success w-100">Enrollment Report</button>
            </div>
            <div class="col">
                <button class="btn btn-outline-success w-100">Promotion Report</button>
            </div>
        </div>
    </div>
</body>
</html>