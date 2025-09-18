<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Project</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    @vite('resources/css/style.css')
</head>
<body>
@auth
    <form id="logout-form-top" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

    <div style="position: fixed; top: 10px; right: 10px; z-index: 1050;" class="d-flex align-items-center gap-2">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary">
                Go To Dashboard
            </a>
        @endif

        <button type="button" class="btn btn-sm btn-secondary"
                formnovalidate
                onclick="document.getElementById('logout-form-top').submit();">
            Logout
        </button>

        <span class="ms-2 small text-muted">{{ auth()->user()->name }}</span>
    </div>
@endauth
@guest
<div style="position: fixed; top: 10px; right: 10px; z-index: 1050; display: flex; gap: 8px;">
  <a href="{{ url('/admin/login-template') }}" class="btn btn-sm btn-primary">Admin Panel</a>
</div>
@endguest
<h1 class="text-center" id="baslik">CV Form</h1>

<div class="container" style="max-width: 600px;">
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">

            <!-- SweetAlert success mesajı -->
            @if(session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '{{ session("success") }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                </script>
            @endif

            <form action="{{ route('cv.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>

                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>

                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>

                <label for="phone" class="form-label">Phone:</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>

                <label for="birth_date" class="form-label">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date" class="form-control" required>

                <label for="education" class="form-label">Education:</label>
                <textarea id="education" name="education" rows="4" class="form-control" required></textarea>

                <label for="experience" class="form-label">Experience:</label>
                <textarea id="experience" name="experience" rows="4" class="form-control" required></textarea>

                <label for="skill" class="form-label">Skill:</label>
                <div class="skill-group">
                    <input type="text" id="skill_input" name="skill" placeholder="Ex: Python" class="form-control">
                    <div class="input-group">
                        <select id="skill_level" class="form-select">
                            <option value="">Select Level:</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                        <button type="button" id="add_skill" class="btn btn-secondary">Add</button>
                    </div>
                </div>

                <h4>Skill List:</h4>
                <ul id="skill_list"></ul>
                <input type="hidden" name="skills" id="skills_hidden">

                <label for="about" class="form-label">About:</label>
                <textarea name="about" id="about" rows="4" class="form-control" required></textarea>

                <label for="profile_pic" class="form-label">Profile Picture:</label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*" class="form-control" required>

                <button type="submit" id="submit_btn" class="btn mt-3">Submit</button>
                <div id="errors" style="color:red; margin-top:10px;"></div>
            </form>


            @isset($cv)
                @if($cv->getFirstMediaUrl('profile_pics'))
                    <img src="{{ $cv->getFirstMediaUrl('profile_pics') }}" alt="Profile Picture" width="150">
                @endif
            @endisset
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
@vite('resources/js/app.js')
</body>
</html>
