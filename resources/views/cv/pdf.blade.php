<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>{{ $cv->first_name }} {{ $cv->last_name }}</title>
    <style>
        body {
            background-color: #f8f9fa !important; /* sayfa kenarları açık */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }

        /* --- Form Container Dark Mode --- */
        .container {
            max-width: 700px !important;
            margin: auto !important;
            background-color: #2c2c2c !important; /* koyu orta kutu */
            padding: 30px !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
            color: #f1f1f1 !important;
        }

        /* Label ve başlık renkleri */
        .container label,
        .container h1,
        .container h4 {
            color: #e0e0e0 !important;
        }

        /* Input, textarea ve select dark mode */
        .container input.form-control,
        .container textarea.form-control,
        .container select.form-select {
            background-color: #383838 !important;
            color: #f1f1f1 !important;
            border: 1px solid #555 !important;
        }

        /* Input focus */
        .container input.form-control:focus,
        .container textarea.form-control:focus,
        .container select.form-select:focus {
            border-color: #00bcd4 !important;
            box-shadow: none !important;
        }

        /* --- Skill Group --- */
        .skill-group {
            display: flex !important;
            gap: 10px !important;
            margin-bottom: 20px !important;
        }

        .skill-group input {
            width: 100% !important;
        }

        .skill-group .input-group button#add_skill {
            flex: 1 !important;
            font-size: 0.8rem !important;
            padding: 0.25rem 0.5rem !important;
        }

        /* --- Submit Button --- */
        button.btn {
            background-color: black !important;
            color: white !important;
            width: 200px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            display: block !important;
        }

        button.btn:hover {
            background-color: aqua !important;
        }

        /* --- CV Sayfası (Soft Dark Mode ve Ortada Vurgu) --- */
        .cv-container {
            max-width: 900px !important;
            margin: auto !important;
            padding: 30px !important;
            background-color: #2c2c2c !important; /* orta kutu koyu gri */
            color: #f1f1f1 !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
        }

        .profile-header {
            text-align: center !important;
            margin-bottom: 30px !important;
        }

        .profile-pic {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            border-radius: 50% !important;
            border: 4px solid #00bcd4 !important;
            margin-bottom: 15px !important;
        }

        .profile-header h1 {
            color: #00bcd4 !important;
            margin-bottom: 5px !important;
        }

        .profile-header p {
            font-size: 1rem !important;
            color: #e0e0e0 !important;
        }

        .card-section {
            margin-bottom: 20px !important;
            padding: 20px !important;
            background-color: #383838 !important; /* kartlar orta koyulukta */
            border-radius: 10px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4) !important;
        }

        .card-section h2 {
            border-bottom: 2px solid #00bcd4 !important;
            padding-bottom: 5px !important;
            margin-bottom: 15px !important;
            color: #00bcd4 !important;
        }

        .card-section p {
            color: #dcdcdc !important;
        }

        .badge-skill {
            background-color: #00bcd4 !important;
            color: #2c2c2c !important;
            margin-right: 5px !important;
            margin-bottom: 5px !important;
            font-weight: 500 !important;
        }

    </style>

</head>
<body>
<div class="container">
    <h2>CV Detail</h2>

    {{-- Profile Picture --}}
    @php
        $media = $cv->getFirstMedia('profile_pics');
    @endphp

    @if($media && file_exists($media->getPath()))
        <img src="{{ $media->getPath() }}" alt="Profile Picture" width="200">
    @endif

    {{-- CV Bilgileri --}}
    <p><strong>First Name:</strong> {{ $cv->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $cv->last_name }}</p>
    <p><strong>Email:</strong> {{ $cv->email }}</p>
    <p><strong>Phone:</strong> {{ $cv->phone }}</p>
    <p><strong>Birth Date:</strong> {{ $cv->birth_date }}</p>
    <p><strong>Skills:</strong> {{ $cv->skills }}</p>

    <p><strong>Education:</strong> {{ $cv->education }}</p>
    <p><strong>Experience:</strong> {{ $cv->experience }}</p>
    <p><strong>About:</strong> {{ $cv->about }}</p>
</div>
</body>
</html>
