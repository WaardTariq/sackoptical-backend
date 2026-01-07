@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Coupons</h4>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-gold rounded-pill px-4"><i class="fa-solid fa-plus me-2"></i> Add New</a>
    </div>
    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>Code</th><th>Type</th><th>Value</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td class="fw-bold">{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td class="fw-bold">{{ $coupon->type == 'percent' ? $coupon->value.'%' : '$'.number_format($coupon->value, 2) }}</td>
                        <td>{!! $coupon->status ? '<span class="status-badge status-success">Active</span>' : '<span class="status-badge status-danger">Inactive</span>' !!}</td>
                        <td>
                             <div class="d-flex gap-2">
                                <a href="{{ route('admin.coupons.show', $coupon->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-light border text-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $coupons->links() }}</div>
    </div>
</div>
@endsection
