@extends('admin.layouts.app')
@section('title','CV Records')
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">CV Records</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cvs as $cv)
            <tr>
                <td>{{ $cv->id }}</td>
                <td>{{ $cv->first_name }} {{ $cv->last_name }}</td>
                <td>{{ $cv->email }}</td>
                <td>{{ $cv->phone }}</td>
                <td>{{ $cv->created_at }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.cvs.edit',$cv->id) }}">Edit</a>
                    <form action="{{ route('admin.cvs.destroy',$cv->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this CV?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $cvs->links() }}
</div>
@endsection


