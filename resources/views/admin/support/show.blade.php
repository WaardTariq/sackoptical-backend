@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <a href="{{ route('admin.support-messages.index') }}" class="btn btn-sm btn-outline-dark mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to List
            </a>
            <h4 class="fw-bold">Support Message #{{ $message->id }}</h4>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-premium shadow-sm border-0 p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                        <div>
                            <h6 class="text-muted small text-uppercase fw-bold mb-1">Subject</h6>
                            <h4 class="fw-bold text-dark">{{ $message->subject }}</h4>
                        </div>
                        <div class="text-end">
                            <span class="badge rounded-pill bg-light text-dark border px-3">
                                Received {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted small text-uppercase fw-bold mb-1">Sender Details</h6>
                        <div class="p-3 bg-light rounded d-flex align-items-center gap-3">
                            <div class="avatar-sm rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold"
                                style="width: 45px; height: 45px;">
                                {{ substr($message->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark">{{ $message->name }}</div>
                                <div class="text-muted small">{{ $message->email }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted small text-uppercase fw-bold mb-1">Message Content</h6>
                        <div class="p-4 border rounded text-dark fs-6"
                            style="line-height: 0.2;">
                            {{ $message->message }}
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}"
                            class="btn btn-dark px-4">
                            <i class="fa-solid fa-reply me-2"></i> Reply via Email
                        </a>
                        <form action="{{ route('admin.support-messages.destroy', $message->id) }}" method="POST"
                            onsubmit="return confirm('Delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger px-4">
                                <i class="fa-solid fa-trash-can me-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-premium shadow-sm border-0 p-4">
                    <h6 class="fw-bold mb-3">Message Info</h6>
                    <ul class="list-unstyled mb-0 d-grid gap-3">
                        <li class="d-flex justify-content-between">
                            <span class="text-muted small">Status:</span>
                            <span
                                class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-25 pb-2">Read</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted small">Sent At:</span>
                            <span class="text-dark small fw-bold">{{ $message->created_at->format('M d, Y H:i') }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted small">Reference ID:</span>
                            <span class="text-dark small fw-bold">#{{ str_pad($message->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection