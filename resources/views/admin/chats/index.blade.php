@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Support Chats</h4>
    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>ID</th><th>User</th><th>Last Message</th><th>Status</th><th>Updated</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($chats as $chat)
                    <tr>
                        <td>#{{ $chat->id }}</td>
                        <td>{{ $chat->user->name ?? 'Guest' }}</td>
                        <td>{{ Str::limit($chat->messages->last()->message ?? 'No Date', 50) }}</td>
                        <td>
                             @if($chat->status == 'open') <span class="status-badge status-success">Open</span>
                             @else <span class="status-badge status-warning">Closed</span> @endif
                        </td>
                        <td>{{ $chat->updated_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('admin.chats.show', $chat->id) }}" class="btn btn-sm btn-gold">Open Chat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $chats->links() }}</div>
    </div>
</div>
@endsection
