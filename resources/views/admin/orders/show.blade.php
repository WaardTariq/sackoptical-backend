@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Order Details: {{ $order->order_number }}</h4>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-light border rounded-pill px-4">Back to List</a>
        </div>

        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card card-premium h-100">
                    <div class="card-header-custom">
                        <h5 class="card-title mb-0">Shipping Address</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($order->shipping_address) && is_array($order->shipping_address))
                            <p class="mb-0 text-muted">
                                <strong>{{ ($order->shipping_address['first_name'] ?? '') . ' ' . ($order->shipping_address['last_name'] ?? '') }}</strong><br>
                                @if(isset($order->shipping_address['email']))
                                    <small class="text-muted d-block mb-2">{{ $order->shipping_address['email'] }}</small>
                                @endif
                                {{ $order->shipping_address['address'] ?? '' }}<br>
                                @if(!empty($order->shipping_address['apartment']))
                                    {{ $order->shipping_address['apartment'] }}<br>
                                @endif
                                {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }}
                                {{ $order->shipping_address['zip_code'] ?? '' }}<br>
                                {{ $order->shipping_address['country'] ?? '' }}<br>
                                @if(isset($order->shipping_address['delivery_method']))
                                    <span class="badge bg-light text-dark border mt-2">Method:
                                        {{ ucfirst($order->shipping_address['delivery_method']) }}</span>
                                @endif
                            </p>
                        @else
                            <p class="text-muted small">No shipping address provided.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-premium h-100">
                    <div class="card-header-custom">
                        <h5 class="card-title mb-0">Billing Address</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($order->billing_address) && is_array($order->billing_address))
                            <p class="mb-0 text-muted">
                                <strong>{{ ($order->billing_address['first_name'] ?? '') . ' ' . ($order->billing_address['last_name'] ?? '') }}</strong><br>
                                {{ $order->billing_address['address'] ?? '' }}
                            </p>
                        @else
                            <p class="text-muted small">No billing address provided.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card card-premium mb-4">
                    <div class="card-header-custom">
                        <h5 class="card-title">Order Items</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Optical</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $item->product_name }}</div>
                                            <div class="small text-muted">SKU: {{ $item->product->id ?? 'N/A' }}</div>
                                        </td>
                                        <td>
                                            @if($item->lensType)
                                                <div class="small"><span class="fw-bold">Lens:</span> {{ $item->lensType->name }}
                                                </div>
                                            @endif
                                            @if($item->lensCoating)
                                                <div class="small"><span class="fw-bold">Coating:</span>
                                                    {{ $item->lensCoating->name }}</div>
                                            @endif
                                            @if(isset($item->prescription_data) || $item->prescription_file)
                                                <button class="btn btn-xs btn-outline-info mt-1" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#pres-{{ $item->id }}">View
                                                    Prescription</button>
                                                <div class="collapse mt-2 small text-muted" id="pres-{{ $item->id }}">
                                                    <div class="card card-body bg-light border-0 p-2">
                                                        @if($item->prescription_file)
                                                            <div class="mb-3">
                                                                <small class="fw-bold text-uppercase d-block mb-1">Uploaded File</small>
                                                                <a href="{{ asset('storage/' . $item->prescription_file) }}"
                                                                    target="_blank" class="btn btn-sm btn-gold">
                                                                    <i class="fa-solid fa-file-pdf me-1"></i> View / Download
                                                                    Prescription
                                                                </a>
                                                                @if($item->prescription_doctor)
                                                                    <div class="mt-2">
                                                                        <strong>Doctor:</strong> {{ $item->prescription_doctor }}<br>
                                                                        <strong>Date:</strong> {{ $item->prescription_date ?? 'N/A' }} |
                                                                        <strong>Time:</strong> {{ $item->prescription_time ?? 'N/A' }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif

                                                        @if(isset($item->prescription_data) && (isset($item->prescription_data['od_sph']) || isset($item->prescription_data['variant_name'])))
                                                            <small class="fw-bold text-uppercase text-muted mb-2 d-block">Manual Entry /
                                                                Metadata</small>
                                                            @if(isset($item->prescription_data['variant_name']))
                                                                <div class="mb-2"><strong>Variant:</strong>
                                                                    {{ $item->prescription_data['variant_name'] }}</div>
                                                            @endif

                                                            @if(isset($item->prescription_data['od_sph']))
                                                                <table class="table table-sm table-bordered mb-0 small">
                                                                    <thead class="bg-light">
                                                                        <tr>
                                                                            <th>Eye</th>
                                                                            <th>SPH</th>
                                                                            <th>CYL</th>
                                                                            <th>Axis</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fw-bold">OD</td>
                                                                            <td>{{ $item->prescription_data['od_sph'] ?? '-' }}</td>
                                                                            <td>{{ $item->prescription_data['od_cyl'] ?? '-' }}</td>
                                                                            <td>{{ $item->prescription_data['od_axis'] ?? '-' }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fw-bold">OS</td>
                                                                            <td>{{ $item->prescription_data['os_sph'] ?? '-' }}</td>
                                                                            <td>{{ $item->prescription_data['os_cyl'] ?? '-' }}</td>
                                                                            <td>{{ $item->prescription_data['os_axis'] ?? '-' }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-premium mb-4">
                    <div class="card-header-custom">
                        <h5 class="card-title">Order Status</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Order Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                    </option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Payment Status</label>
                                <select name="payment_status" class="form-select">
                                    <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid
                                    </option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                    </option>
                                    <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>
                                        Refunded</option>
                                </select>
                            </div>
                            <button class="btn btn-gold w-100 rounded-pill">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection