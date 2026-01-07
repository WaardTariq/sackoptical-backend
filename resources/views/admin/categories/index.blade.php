@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Categories</h4>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-gold rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i> Add New
            </a>
        </div>

        <div class="card card-premium">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>#{{ $category->id }}</td>
                                <td>
                                    <img src="{{ $category->image }}" width="40" height="40"
                                        class="rounded object-fit-cover"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';">
                                </td>
                                <td class="fw-bold">{{ $category->name }}</td>
                                <td>
                                    @if ($category->is_featured)
                                        <span class="badge bg-warning text-dark">Featured</span>
                                    @else
                                        <span class="badge bg-light text-muted">Standard</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($category->status)
                                        <span class="status-badge status-success">Active</span>
                                    @else
                                        <span class="status-badge status-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.categories.show', $category->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Delete?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light border text-danger"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $categories->links() }}</div>
        </div>
    </div>
@endsection
