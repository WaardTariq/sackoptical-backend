@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0">User Profile</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-light border rounded-pill px-4">Back</a>
    </div>

    <div class="row g-4">
        <!-- User Details Card -->
        <div class="col-lg-4">
            <div class="card card-premium h-100">
                <div class="card-body text-center p-4">
                    <img src="{{ $user->image ? asset($user->image) : asset('assets/images/placeholder_user.png') }}" class="rounded-circle mb-3 shadow-sm" width="120" height="120" style="object-fit: cover;">
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>
                    
                    <div class="d-grid gap-2 mb-4">
                        <span class="badge rounded-pill {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->status ? 'Active' : 'Banned' }}
                        </span>
                    </div>

                    <ul class="list-group list-group-flush text-start small">
                        <li class="list-group-item d-flex justify-content-between px-2">
                            <span class="text-muted">User ID</span>
                            <span class="fw-bold">#{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-2">
                            <span class="text-muted">Phone</span>
                            <span class="fw-bold">{{ $user->phone ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-2">
                            <span class="text-muted">Joined</span>
                            <span class="fw-bold">{{ $user->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-2">
                            <span class="text-muted">Total Spend</span>
                            <span class="fw-bold text-success">${{ number_format($user->total_spend, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-2">
                            <span class="text-muted">Total Orders</span>
                            <span class="fw-bold">{{ $user->total_orders }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Addresses & Recent Orders -->
        <div class="col-lg-8">
            <!-- Addresses -->
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0">Address Book</h5>
                </div>
                <div class="card-body">
                    @if($user->addresses->count() > 0)
                        <div class="row g-3">
                            @foreach($user->addresses as $addr)
                            <div class="col-md-6">
                                <div class="p-3 border rounded bg-light position-relative">
                                    @if($addr->is_default)
                                        <span class="badge bg-gold position-absolute top-0 end-0 m-2">Default</span>
                                    @endif
                                    <h6 class="fw-bold mb-1">{{ ucfirst($addr->type) }} Address</h6>
                                    <p class="small text-muted mb-0">
                                        {{ $addr->address }}<br>
                                        {{ $addr->city }}, {{ $addr->state }} {{ $addr->zip }}<br>
                                        {{ $addr->country }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0 small text-center py-3">No addresses found for this user.</p>
                    @endif
                </div>
            </div>

            <!-- Prescriptions -->
            <div class="card card-premium mb-4">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0">Saved Prescriptions</h5>
                </div>
                <div class="card-body">
                    @if($user->prescriptions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle mb-0 text-white">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-3">Title</th>
                                        <th>OD (Right)</th>
                                        <th>OS (Left)</th>
                                        <th>PD / Add</th>
                                        <th class="text-end pe-3">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->prescriptions as $pres)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-bold">{{ $pres->title ?? 'Untitled Script' }}</div>
                                            @if($pres->image_path)
                                                <a href="{{ asset($pres->image_path) }}" target="_blank" class="small text-info text-decoration-none"><i class="fa-solid fa-paperclip me-1"></i> View Image</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small">SPH: {{ $pres->od_sph }}</div>
                                            <div class="small text-muted">CYL: {{ $pres->od_cyl ?? '-' }} / Axis: {{ $pres->od_axis ?? '-' }}</div>
                                        </td>
                                        <td>
                                            <div class="small">SPH: {{ $pres->os_sph }}</div>
                                            <div class="small text-muted">CYL: {{ $pres->os_cyl ?? '-' }} / Axis: {{ $pres->os_axis ?? '-' }}</div>
                                        </td>
                                        <td>
                                            @if($pres->pd) <div><span class="text-muted">PD:</span> {{ $pres->pd }}</div> @endif
                                            @if($pres->add) <div><span class="text-muted">Add:</span> {{ $pres->add }}</div> @endif
                                        </td>
                                        <td class="text-end pe-3 small text-muted">{{ $pres->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0 small text-center py-3">No saved prescriptions found for this user.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card card-premium">
                <div class="card-header-custom">
                    <h5 class="card-title mb-0">Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user->orders()->latest()->take(5)->get() as $order)
                                <tr>
                                    <td class="ps-4 fw-bold">#{{ $order->order_number }}</td>
                                    <td class="small">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-secondary">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                                    </td>
                                    <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                                    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border">View</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted small">No orders found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
