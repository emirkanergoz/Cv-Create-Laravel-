    @extends('admin.layouts.app')
    @section('title','Edit User')

    @section('content')
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

            <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                        <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    @endsection
