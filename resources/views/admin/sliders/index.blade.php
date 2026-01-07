@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Homepage Banners</h4>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-gold rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i> Add New Banner
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-premium shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase text-secondary small">
                            <tr>
                                <th class="px-4 py-3 border-0">Image</th>
                                <th class="py-3 border-0">Title / Subtitle</th>
                                <th class="py-3 border-0">Sort Order</th>
                                <th class="py-3 border-0">Status</th>
                                <th class="py-3 border-0 text-end px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <td class="px-4">
                                        @php
                                            // Ensure path is correct for display
                                            $imagePath = $slider->image;
                                            if ($imagePath && !Str::startsWith($imagePath, 'storage/') && !Str::startsWith($imagePath, 'http')) {
                                                $imagePath = 'storage/' . $imagePath;
                                            }
                                        @endphp
                                        <div class="rounded-3 overflow-hidden position-relative border"
                                            style="width: 120px; height: 60px;">
                                            <img src="{{ asset($imagePath) }}" alt="Banner"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="mb-1 fw-bold text-dark">{{ $slider->title ?? 'No Title' }}</h6>
                                        <small class="text-muted">{{ $slider->subtitle }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">{{ $slider->sort_order }}</span>
                                    </td>
                                    <td>
                                        @if($slider->status)
                                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Active</span>
                                        @else
                                            <span
                                                class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end px-4">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                            class="btn btn-sm btn-light border me-2">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fa-regular fa-images fa-3x mb-3 opacity-25"></i>
                                            <p class="mb-0">No banners found. Start by adding one!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($sliders->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $sliders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection