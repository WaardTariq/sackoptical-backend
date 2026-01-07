@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">Transaction Details</h4>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <div class="card card-premium mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Transaction ID</th>
                            <td class="fw-bold text-wrap">{{ $transaction->payment_id }}</td>
                        </tr>
                        <tr>
                            <th>Order Number</th>
                             <td>
                                <a href="{{ route('admin.orders.show', $transaction->order_id) }}">
                                    #{{ $transaction->order->order_number ?? 'N/A' }}
                                </a>
                            </td>
                        </tr>
                         <tr>
                            <th>User</th>
                             <td>
                                <a href="{{ route('admin.users.show', $transaction->user_id) }}">
                                    {{ $transaction->user->name ?? 'Guest' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td class="fw-bold text-success">${{ number_format($transaction->amount, 2) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                     <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Payment Method</th>
                            <td class="text-uppercase">{{ $transaction->payment_method }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $transaction->status == 'paid' ? 'bg-success' : ($transaction->status == 'refunded' ? 'bg-info' : 'bg-danger') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($transaction->response_json)
            <div class="mt-4">
                <h6 class="fw-bold">Gateway Response</h6>
                <div class="bg-light p-3 rounded border font-monospace small" style="max-height: 200px; overflow-y: auto;">
                    {{ $transaction->response_json }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
