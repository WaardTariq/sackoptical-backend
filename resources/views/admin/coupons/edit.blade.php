@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Edit Coupon</h4>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>
    <div class="card card-premium p-4">
        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Coupon Code</label>
                <input type="text" name="code" class="form-control" value="{{ $coupon->code }}" required>
            </div>
             <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                    </select>
                </div>
                 <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Value</label>
                    <input type="number" step="0.01" name="value" class="form-control" value="{{ $coupon->value }}" required>
                </div>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" {{ $coupon->status ? 'checked' : '' }}>
                <label class="form-check-label">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Update</button>
        </form>
    </div>
</div>
@endsection
