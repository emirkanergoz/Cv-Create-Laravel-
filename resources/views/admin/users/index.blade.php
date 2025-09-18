@extends('admin.layouts.app')
@section('title','Users')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Users</h1>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Add New User</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit',$user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.users.toggleRole',$user->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-info btn-sm">Toggle role</button>
                        </form>
                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
