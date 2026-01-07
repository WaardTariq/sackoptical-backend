@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Lens Type Details</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.lens-types.edit', $lensType->id) }}"
                    class="btn btn-gold rounded-pill px-4">Edit</a>
                <a href="{{ route('admin.lens-types.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
            </div>
        </div>

        <div class="card card-premium mb-4">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Image</th>
                        <td>
                            @php
                                $lensImg = $lensType->image;
                                if ($lensImg && !Str::startsWith($lensImg, 'storage/') && !Str::startsWith($lensImg, 'http')) {
                                    $lensImg = 'storage/' . $lensImg;
                                }
                            @endphp
                            @if ($lensType->image)
                                <img src="{{ asset($lensImg) }}" class="rounded shadow-sm"
                                    style="max-width: 200px; max-height: 200px; object-fit: contain;"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                            @else
                                <img src="{{ asset('assets/images/placeholder_product.png') }}" class="rounded shadow-sm"
                                    style="max-width: 100px; opacity: 0.5;">
                                <span class="text-muted small ms-2">No image uploaded</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $lensType->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $lensType->slug }}</td>
                    </tr>
                    <tr>
                        <th>Price Modifier</th>
                        <td class="fw-bold">+${{ number_format($lensType->price_modifier, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $lensType->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $lensType->status ? 'bg-success' : 'bg-secondary' }}">
                                {{ $lensType->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection