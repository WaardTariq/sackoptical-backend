@extends('admin.layouts.master')
@section('content')
<div class="container-fluid h-100 d-flex flex-column">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Chat #{{ $chat->id }} - {{ $chat->user->name ?? 'Guest' }}</h4>
        <a href="{{ route('admin.chats.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <div class="card card-premium flex-grow-1 d-flex flex-column">
        <div class="card-body overflow-auto flex-grow-1" style="max-height: 60vh;">
            @foreach($chat->messages as $msg)
            <div class="d-flex mb-3 {{ $msg->is_admin ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="p-3 rounded-3" style="max-width: 70%; background: {{ $msg->is_admin ? 'black' : '#f1f1f1' }}; color: {{ $msg->is_admin ? 'white' : 'black' }}">
                    <div>{{ $msg->message }}</div>
                    <div class="small opacity-50 mt-1 text-end">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer bg-white border-top p-3">
             <form action="" method="POST"> <!-- Placeholder for reply implementation -->
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your reply...">
                    <button class="btn btn-gold">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
