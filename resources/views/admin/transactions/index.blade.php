@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Transactions</h4>
    <div class="card card-premium">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>ID</th><th>User</th><th>Order #</th><th>Amount</th><th>Type</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
                <tbody>
                    @foreach($transactions as $trx)
                    <tr>
                        <td>#{{ $trx->id }}</td>
                        <td>{{ $trx->user->name ?? 'Guest' }}</td>
                        <td>
                            @if($trx->order)
                                <a href="{{ route('admin.orders.show', $trx->order->id) }}" class="text-decoration-none fw-bold">#{{ $trx->order->order_number }}</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="fw-bold">${{ number_format($trx->amount, 2) }}</td>
                        <td><span class="badge bg-light text-dark">{{ ucfirst($trx->payment_method) }}</span></td>
                        <td>{!! $trx->status == 'paid' ? '<span class="status-badge status-success">Paid</span>' : '<span class="status-badge status-danger">Failed</span>' !!}</td>
                        <td>{{ $trx->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.transactions.show', $trx->id) }}" class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $transactions->links() }}</div>
    </div>
</div>
@endsection
