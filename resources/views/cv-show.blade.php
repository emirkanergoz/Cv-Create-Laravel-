<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Detail</title>
    @vite('resources/css/style.css')
</head>
<body>
<div class="container" style="max-width: 600px;">
    <h2>CV Detail</h2>
    @if($cv->getFirstMediaUrl('profile_pics'))
        <img src="{{ $cv->getFirstMediaUrl('profile_pics') }}" alt="Profile Picture" width="200">
    @endif

    <p><strong>First Name:</strong> {{ $cv->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $cv->last_name }}</p>
    <p><strong>Email:</strong> {{ $cv->email }}</p>
    <p><strong>Phone:</strong> {{ $cv->phone }}</p>
    <p><strong>Birth Date:</strong> {{ $cv->birth_date }}</p>
    <p><strong>Skills:</strong> {{ $cv->skills }}</p>
    <p><strong>Education:</strong> {{ $cv->education }}</p>
    <p><strong>Experience:</strong> {{ $cv->experience }}</p>
    <p><strong>About:</strong> {{ $cv->about }}</p>


    <p><a href="{{ route('cv.form') }}">Back to form</a></p>
</div>
@vite('resources/js/app.js')
</body>
</html>


