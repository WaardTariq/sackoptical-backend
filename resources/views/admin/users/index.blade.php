@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Registered Users</h4>
    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>Name</th><th>Email</th><th>Orders</th><th>Spend</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->total_orders ?? 0 }}</td>
                        <td>${{ number_format($user->total_spend ?? 0, 2) }}</td>
                        <td>{!! $user->status ? '<span class="status-badge status-success">Active</span>' : '<span class="status-badge status-danger">Banned</span>' !!}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-light border">View</a>
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" onsubmit="return confirm('Change status?');">
                                    @csrf @method('PUT')
                                    <button class="btn btn-sm btn-light border text-danger">Block/Unblock</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
