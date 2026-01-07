@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Sub Categories</h4>
        <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-gold rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i> Add New
        </a>
    </div>

    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Parent Category</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $sub)
                    <tr>
                        <td>#{{ $sub->id }}</td>
                        <td><span class="badge bg-light text-dark">{{ $sub->category->name ?? 'N/A' }}</span></td>
                        <td class="fw-bold">{{ $sub->name }}</td>
                        <td>
                            @if($sub->status) <span class="status-badge status-success">Active</span>
                            @else <span class="status-badge status-danger">Inactive</span> @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.sub-categories.show', $sub->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.sub-categories.edit', $sub->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('admin.sub-categories.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Delete?');">
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
        <div class="p-4">{{ $subCategories->links() }}</div>
    </div>
</div>
@endsection
