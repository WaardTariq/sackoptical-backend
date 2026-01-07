@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Page Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ target="_blank" class="btn btn-link" href="{{ url($page->slug) }}">Preview</a>
            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-3">
                 <h2 class="fw-bold">{{ $page->title }}</h2>
                 <span class="badge {{ $page->status ? 'bg-success' : 'bg-secondary' }}">
                    {{ $page->status ? 'Active' : 'Hidden' }}
                </span>
             </div>
             <p class="text-muted small">Slug: /{{ $page->slug }} | Last Updated: {{ $page->updated_at->format('M d, Y') }}</p>
             <hr>
             <div class="page-content mt-4">
                 {!! $page->content !!}
             </div>
        </div>
    </div>
</div>
@endsection
