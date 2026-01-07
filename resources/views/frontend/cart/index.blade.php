@extends('frontend.layouts.master')

@section('content')
    @php
        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
    @endphp

    <div class="cart-page section-padding pt-5">
        <div class="container">
            <h1 class="display-5 fw-bold mb-5 fade-up">YOUR BAG ({{ count($cart) }})</h1>

            @if(count($cart) > 0)
                <div class="row g-5">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        <div class="cart-items fade-up">
                            @foreach($cart as $id => $details)
                                <div
                                    class="cart-item p-4 rounded-4 bg-dark border border-secondary border-opacity-25 mb-4 position-relative">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            @php
                                                $cartImg = $details['image'];
                                                if ($cartImg && !Str::startsWith($cartImg, 'storage/') && !Str::startsWith($cartImg, 'http')) {
                                                    $cartImg = 'storage/' . $cartImg;
                                                }
                                            @endphp
                                            <img src="{{ $details['image'] ? asset($cartImg) : asset('assets/images/placeholder_product.png') }}"
                                                class="img-fluid rounded-3 bg-black" alt="{{ $details['name'] }}"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                        </div>
                                        <div class="col-md-5">
                                            <h5 class="fw-bold mb-1">{{ $details['name'] }}</h5>
                                            @if($details['variant_name'])
                                                <p class="text-white-50 small mb-0">{{ $details['variant_name'] }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="qty-control d-flex align-items-center gap-3">
                                                <span class="text-white-50 small">QTY:</span>
                                                <span class="fw-bold">{{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-md-end">
                                            <h5 class="fw-bold mb-0">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}</h5>
                                        </div>
                                    </div>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST"
                                        class="position-absolute top-0 end-0 m-3">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-close btn-close-white p-2"
                                            style="font-size: 0.7rem;"></button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="col-lg-4">
                        <div class="cart-summary p-4 p-md-5 rounded-4 bg-dark border border-secondary border-opacity-25 sticky-top fade-up"
                            style="top: 100px;">
                            <h4 class="fw-bold mb-4">SUMMARY</h4>

                            <div class="d-flex justify-content-between mb-3 text-white-50">
                                <span>Subtotal</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 text-white-50">
                                <span>Estimated Shipping</span>
                                <span>FREE</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4 text-white-50">
                                <span>Tax</span>
                                <span>$0.00</span>
                            </div>

                            <hr class="border-secondary border-opacity-25 mb-4">

                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="fw-bold mb-0">TOTAL</h5>
                                <h5 class="fw-bold mb-0">${{ number_format($subtotal, 2) }}</h5>
                            </div>

                            <a href="{{ route('checkout') }}"
                                class="btn-premium w-100 magnetic-item text-center text-decoration-none d-block">
                                CHECKOUT NOW
                            </a>

                            <div class="mt-4 text-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png"
                                    height="15" class="me-3 opacity-50">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png"
                                    height="15" class="opacity-50">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container fade-up text-center py-5">
                    <i class="fa-solid fa-shopping-bag display-1 text-white-50 mb-4 op-2"></i>
                    <p class="lead text-white-50 mb-5">Your bag is currently empty.</p>
                    <a href="{{ route('shop.index') }}" class="btn-premium magnetic-item text-decoration-none">START
                        SHOPPING</a>
                </div>
            @endif
        </div>
    </div>
@endsection