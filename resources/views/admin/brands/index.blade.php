@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Brands</h4>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-gold rounded-pill px-4">
            <i class="fa-solid fa-plus me-2"></i> Add New Brand
        </a>
    </div>

    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td>#{{ $brand->id }}</td>
                        <td>
                            @if($brand->logo)
                                <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" width="40" height="40" class="rounded object-fit-cover">
                            @else
                                <span class="badge bg-light text-dark">No Logo</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $brand->name }}</td>
                        <td class="text-muted">{{ $brand->slug }}</td>
                        <td>
                            @if($brand->status)
                                <span class="status-badge status-success">Active</span>
                            @else
                                <span class="status-badge status-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-light border">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Delete this brand?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light border text-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $brands->links() }}
        </div>
    </div>
</div>
@endsection
