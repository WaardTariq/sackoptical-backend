@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Slider Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <div class="mb-4">
                <label class="fw-bold text-muted small d-block mb-2">BANNER IMAGE</label>
                <img src="{{ $slider->image ? asset($slider->image) : asset('assets/images/placeholder_banner.jpg') }}" class="img-fluid rounded border w-100" style="max-height: 400px; object-fit: cover;">
            </div>
            
             <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Title</th>
                    <td>{{ $slider->title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Link / URL</th>
                    <td><a href="{{ $slider->link }}" target="_blank">{{ $slider->link ?? 'N/A' }}</a></td>
                </tr>
                <tr>
                    <th>Sort Order</th>
                    <td>{{ $slider->sort_order }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $slider->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $slider->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
