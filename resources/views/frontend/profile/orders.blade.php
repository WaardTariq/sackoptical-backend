@extends('frontend.layouts.master')

@section('title', 'My Orders - Sacks Optical')

@section('content')
<section class="profile-page py-5 min-vh-100 bg-black text-white">
    <div class="container mt-5 pt-5">
        <div class="row g-5">
            <!-- Profile Sidebar -->
            <div class="col-lg-4">
                <div class="profile-card p-4 rounded-0 bg-dark-soft border border-secondary border-opacity-25 fade-up">
                    <div class="text-center mb-4">
                        <div class="avatar-large mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-white text-black display-4"
                            style="width: 100px; height: 100px;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h4 class="fw-bold mb-1 text-white">{{ $user->name }}</h4>
                        <p class="text-white-50 small mb-0">{{ $user->email }}</p>
                    </div>

                    <div class="nav flex-column gap-2">
                        <a href="{{ route('profile.index') }}"
                            class="btn btn-outline-light w-100 text-start d-flex align-items-center gap-3 border-secondary border-opacity-25 rounded-0 py-3">
                            <i class="fa-solid fa-user"></i> My Profile
                        </a>
                        <a href="{{ route('profile.orders') }}"
                            class="btn btn-premium w-100 text-start d-flex align-items-center gap-3 rounded-0 py-3 active">
                            <i class="fa-solid fa-shopping-bag"></i> My Orders
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit"
                                class="btn btn-outline-danger w-100 text-start d-flex align-items-center gap-3 border-danger border-opacity-25 rounded-0 py-3">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Orders Content -->
            <div class="col-lg-8">
                <div class="orders-content fade-up">
                    <h2 class="fw-bold mb-4 letter-spacing-1">ORDER HISTORY</h2>

                    @forelse($orders as $order)
                        <div class="order-card p-4 rounded-0 bg-dark-soft border border-secondary border-opacity-25 mb-4 fade-up position-relative">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h6 class="fw-bold mb-1 text-white">ORDER #{{ $order->order_number }}</h6>
                                    <p class="text-white-50 small mb-0">Placed on {{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge rounded-0 border border-secondary border-opacity-50 px-3 py-2 text-uppercase letter-spacing-1 small bg-transparent text-white">
                                        {{ $order->status }}
                                    </span>
                                    <div class="mt-2 small text-white-50">
                                        Payment: <span class="text-white">{{ $order->payment_status }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="order-items-scroll border-top border-bottom border-secondary border-opacity-25 py-4 my-3">
                                <div class="row g-4 align-items-center">
                                    @foreach($order->items as $item)
                                        <div class="col-12">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-thumb" style="width: 70px; height: 70px;">
                                                    @php
                                                        $thumb = $item->product->primary_image ?? 'assets/images/placeholder_product.png';
                                                        if ($thumb && !Str::startsWith($thumb, 'storage/') && !Str::startsWith($thumb, 'http') && $thumb != 'assets/images/placeholder_product.png') {
                                                            $thumb = 'storage/' . $thumb;
                                                        }
                                                    @endphp
                                                    <img src="{{ asset($thumb) }}" class="w-100 h-100 object-fit-cover border border-secondary border-opacity-25" alt="{{ $item->product->name ?? 'Product' }}">
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0 fw-bold text-white small">{{ $item->product->name ?? 'Unknown Product' }}</h6>
                                                    <p class="mb-0 text-white-50 small">Qty: {{ $item->quantity }} • ${{ number_format($item->price, 2) }}ea</p>
                                                </div>
                                                <div class="text-end">
                                                    <p class="mb-0 fw-bold text-white small">${{ number_format($item->total, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <div class="total-box">
                                    <p class="text-white-50 small mb-0 uppercase letter-spacing-1" style="font-size: 0.7rem;">TOTAL AMOUNT</p>
                                    <h4 class="fw-bold mb-0 text-white">${{ number_format($order->total, 2) }}</h4>
                                </div>
                                <a href="#" class="btn btn-outline-light rounded-0 px-4 py-2 small magnetic-item">VIEW DETAILS</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 bg-dark-soft border border-secondary border-opacity-25">
                            <i class="fa-solid fa-shopping-bag display-4 text-white-50 mb-3"></i>
                            <h4 class="text-white-50">You haven't placed any orders yet.</h4>
                            <a href="{{ route('shop.index') }}" class="btn btn-premium mt-3 rounded-0 px-5">START SHOPPING</a>
                        </div>
                    @endforelse

                    <div class="mt-4 custom-pagination">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-dark-soft { background-color: #0c0c0c; }
    .letter-spacing-1 { letter-spacing: 1.5px; }
    .btn-premium.active { background-color: white; color: black; }
    .custom-pagination .page-link {
        background-color: transparent;
        border-color: rgba(255,255,255,0.1);
        color: white;
    }
    .custom-pagination .page-item.active .page-link {
        background-color: white;
        border-color: white;
        color: black;
    }
</style>
@endsection
