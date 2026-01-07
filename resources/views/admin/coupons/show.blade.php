@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Coupon Details</h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-gold rounded-pill px-4">Edit</a>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
        </div>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Code</th>
                            <td class="fw-bold text-uppercase">{{ $coupon->code }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ ucfirst($coupon->type) }}</td>
                        </tr>
                        <tr>
                            <th>Value</th>
                            <td class="fw-bold text-success">
                                {{ $coupon->type == 'percent' ? $coupon->value . '%' : '$' . number_format($coupon->value, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Min Purchase</th>
                            <td>${{ number_format($coupon->min_purchase, 2) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                     <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Start Date</th>
                            <td>{{ $coupon->start_date ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $coupon->end_date ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Usage Limit</th>
                            <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $coupon->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $coupon->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
