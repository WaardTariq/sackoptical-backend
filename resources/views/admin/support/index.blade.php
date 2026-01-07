@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Support Messages</h4>
                <p class="text-muted small mb-0">Manage customer inquiries and feedback</p>
            </div>
        </div>

        <div class="card card-premium shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $msg)
                            <tr class="{{ $msg->is_read ? '' : 'table-light fw-bold' }}">
                                <td class="text-muted small">{{ $msg->created_at->format('M d, H:i') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2 rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold"
                                            style="width: 32px; height: 32px; font-size: 12px;">
                                            {{ substr($msg->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-dark">{{ $msg->name }}</div>
                                            <div class="text-muted small">{{ $msg->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Str::limit($msg->subject, 40) }}</td>
                                <td>
                                    @if($msg->is_read)
                                        <span class="badge rounded-pill bg-light text-dark border">Read</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">New</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.support-messages.show', $msg->id) }}" class="btn btn-sm btn-outline-dark rounded-circle" title="Read Message">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                        <form action="{{ route('admin.support-messages.destroy', $msg->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this message?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">No messages found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $messages->links() }}
            </div>
        </div>
    </div>

    <style>
        .table-custom tr.fw-bold {
            background-color: rgba(255, 193, 7, 0.02);
        }

        .avatar-sm {
            flex-shrink: 0;
        }
    </style>
@endsection