@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Add Coupon</h4>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>
    <div class="card card-premium p-4">
        <form action="{{ route('admin.coupons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Coupon Code</label>
                <input type="text" name="code" class="form-control" required placeholder="e.g. SUMMER2024">
            </div>
             <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select">
                        <option value="percent">Percentage (%)</option>
                        <option value="fixed">Fixed Amount ($)</option>
                    </select>
                </div>
                 <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Value</label>
                    <input type="number" step="0.01" name="value" class="form-control" required>
                </div>
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" checked>
                <label class="form-check-label">Active</label>
            </div>
            <button type="submit" class="btn btn-gold rounded-pill px-5">Save</button>
        </form>
    </div>
</div>
@endsection
