@extends('admin.layouts.app')
@section('title','Edit CV')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit CV #{{ $cv->id }}</h1>

    <form action="{{ route('admin.cvs.update',$cv->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group"><label>First Name</label><input name="first_name" class="form-control" value="{{ old('first_name',$cv->first_name) }}" required></div>
                <div class="form-group"><label>Last Name</label><input name="last_name" class="form-control" value="{{ old('last_name',$cv->last_name) }}" required></div>
                <div class="form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email',$cv->email) }}" required></div>
                <div class="form-group"><label>Phone</label><input name="phone" class="form-control" value="{{ old('phone',$cv->phone) }}" required></div>
                <div class="form-group"><label>Birth Date</label><input type="date" name="birth_date" class="form-control" value="{{ old('birth_date',$cv->birth_date) }}" required></div>
            </div>
            <div class="col-md-6">
                <div class="form-group"><label>Education</label><textarea name="education" class="form-control" rows="3" required>{{ old('education',$cv->education) }}</textarea></div>
                <div class="form-group"><label>Experience</label><textarea name="experience" class="form-control" rows="3" required>{{ old('experience',$cv->experience) }}</textarea></div>
                <div class="form-group"><label>Skills</label><textarea name="skills" class="form-control" rows="3">{{ old('skills',$cv->skills) }}</textarea></div>
                <div class="form-group"><label>About</label><textarea name="about" class="form-control" rows="3" required>{{ old('about',$cv->about) }}</textarea></div>
                <div class="form-group"><label>Profile Picture</label><input type="file" name="profile_pic" class="form-control"></div>
                @php $media = $cv->getFirstMedia('profile_pics'); @endphp
                @if($media)
                    <img src="{{ $media->getUrl() }}" alt="Current" style="height:80px" class="mt-2">
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('admin.cvs.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection


