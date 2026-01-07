@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Product Reviews</h4>
    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>Product</th><th>User</th><th>Rating</th><th>Comment</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->product->name ?? 'N/A' }}</td>
                        <td>{{ $review->user->name ?? 'Guest' }}</td>
                        <td class="text-warning">
                            @for($i=0; $i<$review->rating; $i++) <i class="fa-solid fa-star"></i> @endfor
                        </td>
                        <td>{{ Str::limit($review->comment, 50) }}</td>
                        <td>{!! $review->status ? '<span class="status-badge status-success">Approved</span>' : '<span class="status-badge status-warning">Pending</span>' !!}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button class="btn btn-sm btn-light border">{{ $review->status ? 'Hide' : 'Approve' }}</button>
                                </form>
                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Delete?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light border text-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $reviews->links() }}</div>
    </div>
</div>
@endsection
