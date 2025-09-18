@extends('admin.layouts.auth')
@section('title','Register')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Create Account</h1>
                </div>
                @if ($errors->any())
                  <div class="alert alert-danger small" role="alert">{{ $errors->first() }}</div>
                @endif
                <form class="user" method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" name="name" class="form-control form-control-user" placeholder="Full name" value="{{ old('name') }}" required>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Email" value="{{ old('email') }}" required>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Confirm password" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="{{ url('/admin/login-template') }}">Already have an account? Log in</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


