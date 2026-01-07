@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Lens Coating Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.lens-coatings.edit', $lensCoating->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.lens-coatings.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 200px;">Name</th>
                    <td>{{ $lensCoating->name }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $lensCoating->slug }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td class="fw-bold">${{ number_format($lensCoating->price, 2) }}</td>
                </tr>
                <tr>
                    <th>Tax %</th>
                    <td>{{ $lensCoating->tax_percentage }}%</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $lensCoating->description ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $lensCoating->status ? 'bg-success' : 'bg-secondary' }}">
                            {{ $lensCoating->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
