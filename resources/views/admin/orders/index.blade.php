@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Orders</h4>
    <div class="card card-premium shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="fw-bold">{{ $order->order_number }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-2 rounded-circle bg-light d-flex align-items-center justify-content-center text-dark fw-bold" style="width: 32px; height: 32px; font-size: 12px;">
                                    {{ substr($order->user->name ?? 'G', 0, 1) }}
                                </div>
                                <span>{{ $order->user->name ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'pending' => 'bg-warning bg-opacity-10 text-warning border-warning border-opacity-25',
                                    'processing' => 'bg-info bg-opacity-10 text-info border-info border-opacity-25',
                                    'delivered' => 'bg-success bg-opacity-10 text-success border-success border-opacity-25',
                                    'cancelled' => 'bg-danger bg-opacity-10 text-danger border-danger border-opacity-25',
                                    default => 'bg-light text-dark'
                                };
                            @endphp
                            <span class="badge rounded-pill border {{ $statusClass }} px-3 py-2 text-uppercase letter-spacing-1" style="font-size: 0.65rem;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            @php
                                $payClass = match($order->payment_status) {
                                    'paid' => 'bg-success bg-opacity-10 text-success border-success border-opacity-25',
                                    'pending' => 'bg-warning bg-opacity-10 text-warning border-warning border-opacity-25',
                                    'failed' => 'bg-danger bg-opacity-10 text-danger border-danger border-opacity-25',
                                    default => 'bg-light text-dark'
                                };
                            @endphp
                            <span class="badge rounded-pill border {{ $payClass }} px-3 py-2 text-uppercase letter-spacing-1" style="font-size: 0.65rem;">
                                {{ $order->payment_status }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this order from the system?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border" title="Delete Order">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-top">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<style>
    .letter-spacing-1 { letter-spacing: 1px; }
    .table-custom tr:hover { background-color: rgba(0,0,0,0.01); }
    .btn-outline-dark:hover { background-color: #000; color: #fff; }
</style>
@endsection
