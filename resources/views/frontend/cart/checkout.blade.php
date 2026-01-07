@extends('frontend.layouts.master')

@section('title', 'Checkout - Sacks Optical')

@section('content')
    <section class="checkout-page py-5 min-vh-100 bg-black text-white">
        <div class="container mt-5 pt-5">
            <div class="row g-4">
                <!-- Left Column: Checkout Form -->
                <div class="col-lg-7">
                    <form action="{{ route('checkout.place') }}" method="POST" enctype="multipart/form-data"
                        id="checkout-form">
                        @csrf

                        <!-- Contact Section -->
                        <div class="checkout-section mb-4">
                            <h4 class="fw-bold mb-3 text-white">Contact</h4>
                            <div
                                class="card bg-dark-soft border border-secondary border-opacity-25 p-4 rounded-0 shadow-none">
                                <div class="mb-3">
                                    <input type="text" name="contact" class="form-control form-control-dark"
                                        placeholder="Email or mobile phone number"
                                        value="{{ Auth::check() ? (Auth::user()->email ?: Auth::user()->phone) : '' }}"
                                        required>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input bg-transparent border-secondary" type="checkbox"
                                        id="email-offers">
                                    <label class="form-check-label small text-white-50" for="email-offers">
                                        Email me with news and offers
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address Section -->
                        <div class="checkout-section mb-4">
                            <h4 class="fw-bold mb-3 text-white">Shipping Address</h4>
                            <div
                                class="card bg-dark-soft border border-secondary border-opacity-25 p-4 rounded-0 shadow-none">
                                <input type="hidden" name="delivery_method" value="ship">

                                <div class="shipping-fields row g-3">
                                    <div class="col-12">
                                        <label class="small text-white-50 mb-1">Country/Region</label>
                                        <select name="country" class="form-select form-select-dark">
                                            <option value="United States" selected>United States</option>
                                            <option value="Canada">Canada</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="first_name" class="form-control form-control-dark"
                                            placeholder="First name (optional)"
                                            value="{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="last_name" class="form-control form-control-dark"
                                            placeholder="Last name"
                                            value="{{ Auth::check() ? (explode(' ', Auth::user()->name)[1] ?? '') : '' }}"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <div class="position-relative">
                                            <input type="text" name="address" class="form-control form-control-dark"
                                                placeholder="Address" required>
                                            <i
                                                class="fa-solid fa-magnifying-glass position-absolute top-50 end-0 translate-middle-y me-3 text-white-50"></i>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="apartment" class="form-control form-control-dark"
                                            placeholder="Apartment, suite, etc. (optional)">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="city" class="form-control form-control-dark"
                                            placeholder="City" required>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="state" class="form-select form-select-dark" required>
                                            <option disabled selected>State</option>
                                            <option value="NY">New York</option>
                                            <option value="CA">California</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="zip_code" class="form-control form-control-dark"
                                            placeholder="ZIP code" required>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="form-check">
                                            <input class="form-check-input bg-transparent border-secondary" type="checkbox"
                                                id="save-info">
                                            <label class="form-check-label small text-white-50" for="save-info">
                                                Save this information for next time
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Prescription Upload Section -->
                        <div class="checkout-section mb-4">
                            <h4 class="fw-bold mb-3 d-flex align-items-center gap-2 text-white">
                                Upload Prescription <small class="text-white-50 fw-normal fs-6">(If needed)</small>
                            </h4>
                            <div
                                class="card bg-dark-soft border border-secondary border-opacity-25 p-4 rounded-0 shadow-none prescription-card">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label small fw-bold text-white">Doctor Name</label>
                                        <input type="text" name="prescription_doctor"
                                            class="form-control form-control-dark py-3" placeholder="Dr. Wade Warren">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-white">Date</label>
                                        <input type="date" name="prescription_date"
                                            class="form-control form-control-dark py-3">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-white">Time</label>
                                        <input type="time" name="prescription_time"
                                            class="form-control form-control-dark py-3">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="upload-area border border-dashed border-secondary border-opacity-50 p-5 text-center bg-black cursor-pointer"
                                            id="prescription-drop-zone">
                                            <input type="file" name="prescription_file" id="prescription-input"
                                                class="d-none" accept="image/*,.pdf">
                                            <div class="upload-icon mb-3">
                                                <i class="fa-solid fa-cloud-upload-alt fs-1 text-white-50"></i>
                                            </div>
                                            <h6 class="fw-bold mb-1 text-white">choose file to upload</h6>
                                            <p class="small text-white-50 mb-3">Select image or pdf</p>
                                            <div id="file-preview" class="mt-3 d-none">
                                                <span class="badge bg-gold p-2" id="file-name"></span>
                                            </div>
                                            <button type="button" class="btn btn-outline w-100 py-3 magnetic-item"
                                                onclick="document.getElementById('prescription-input').click()">Take a Photo
                                                / Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Section -->
                        <div class="checkout-section mb-4">
                            <h4 class="fw-bold mb-3 text-white">Payment</h4>
                            <p class="small text-white-50 mb-3">All transactions are secure and encrypted.</p>
                            <div
                                class="card bg-dark-soft border border-secondary border-opacity-25 p-4 rounded-0 shadow-none">
                                <div class="payment-method-box border border-secondary border-opacity-25 p-3 mb-3 active">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="payment_method"
                                                id="pay-stripe" value="stripe" checked>
                                            <label class="form-check-label fw-bold text-white" for="pay-stripe">Credit
                                                card</label>
                                        </div>
                                        <div class="card-icons">
                                            <i class="fa-brands fa-cc-visa text-white-50 fs-4"></i>
                                            <i class="fa-brands fa-cc-mastercard text-white-50 fs-4 ms-1"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4 payment-fields">
                                        <div class="mb-3 position-relative">
                                            <input type="text" class="form-control form-control-dark py-3"
                                                placeholder="Card number">
                                            <i
                                                class="fa-solid fa-lock position-absolute top-50 end-0 translate-middle-y me-3 text-white-50"></i>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <input type="text" class="form-control form-control-dark py-3"
                                                    placeholder="Expiration date (MM / YY)">
                                            </div>
                                            <div class="col-md-6 position-relative">
                                                <input type="text" class="form-control form-control-dark py-3"
                                                    placeholder="Security code">
                                                <i
                                                    class="fa-solid fa-circle-question position-absolute top-50 end-0 translate-middle-y me-3 text-white-50"></i>
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <input type="text" class="form-control form-control-dark py-3"
                                                placeholder="Name on card">
                                        </div>
                                        <div class="mt-3 pt-3 border-top border-secondary border-opacity-25">
                                            <div class="form-check">
                                                <input class="form-check-input bg-transparent border-secondary"
                                                    type="checkbox" id="billing-same" checked>
                                                <label class="form-check-label small text-white-50" for="billing-same">
                                                    Use shipping address as billing address
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-method-box border border-secondary border-opacity-25 p-3">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="payment_method" id="pay-cod"
                                            value="cod">
                                        <label class="form-check-label fw-bold text-white" for="pay-cod">Cash on
                                            Delivery</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 py-3 fs-5 mt-4 magnetic-item">Pay now</button>
                    </form>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="col-lg-5">
                    <div class="card bg-dark-soft border border-secondary border-opacity-25 p-4 rounded-0 shadow-none sticky-top"
                        style="top: 8rem;">
                        @php
                            $cart = session('cart', []);
                            $subtotal = 0;
                            foreach ($cart as $item) {
                                $subtotal += $item['price'] * $item['quantity'];
                            }
                        @endphp

                        <div class="cart-items mb-4">
                            @foreach($cart as $details)
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="item-img position-relative" style="width: 64px; height: 64px;">
                                        @php
                                            $cartImg = $details['image'];
                                            if ($cartImg && !Str::startsWith($cartImg, 'storage/') && !Str::startsWith($cartImg, 'http')) {
                                                $cartImg = 'storage/' . $cartImg;
                                            }
                                        @endphp
                                        <img src="{{ $details['image'] ? asset($cartImg) : asset('assets/images/placeholder_product.png') }}"
                                            class="w-100 h-100 object-fit-cover rounded-0 border border-secondary border-opacity-25">
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-black">
                                            {{ $details['quantity'] }}
                                        </span>
                                    </div>
                                    <div class="item-info flex-grow-1">
                                        <h6 class="mb-0 fw-bold text-white">{{ $details['name'] }}</h6>
                                        <p class="small text-white-50 mb-0">{{ $details['variant_name'] ?? 'Standard' }}</p>
                                    </div>
                                    <div class="item-price">
                                        <h6 class="mb-0 fw-bold text-white">
                                            ${{ number_format($details['price'] * $details['quantity'], 2) }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="summary-details pt-4 border-top border-secondary border-opacity-25">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-white-50">Subtotal</span>
                                <h6 class="mb-0 fw-bold text-white">${{ number_format($subtotal, 2) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between mb-2 align-items-center">
                                <span class="text-white-50 d-flex align-items-center gap-2">
                                    Shipping <i class="fa-solid fa-circle-question small"></i>
                                </span>
                                <span class="small text-white-50">Enter shipping address</span>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <h5 class="fw-bold fs-4 text-white">Total</h5>
                                <div class="text-end">
                                    <small class="text-white-50 d-block" style="font-size: 0.7rem;">USD</small>
                                    <h5 class="fw-bold fs-4 mb-0 text-white">${{ number_format($subtotal, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        .bg-dark-soft {
            background-color: #0c0c0c;
        }

        .form-control-dark {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.8rem 1rem;
            border-radius: 0;
        }

        .form-control-dark:focus {
            background-color: transparent;
            border-color: #fff;
            color: white;
            box-shadow: none;
        }

        .form-control-dark::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select-dark {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 0.8rem 1rem;
            border-radius: 0;
        }

        .form-select-dark:focus {
            border-color: #fff;
            box-shadow: none;
        }

        .delivery-box,
        .payment-method-box {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            background: transparent;
        }

        .delivery-box.active,
        .payment-method-box.active {
            border-color: #fff !important;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .bg-gold {
            background-color: #c5a572;
            color: #fff;
        }

        /* Override Bootstrap inputs */
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Prescription File Upload Preview
            const fileInput = document.getElementById('prescription-input');
            const fileNameDisplay = document.getElementById('file-name');
            const previewContainer = document.getElementById('file-preview');

            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    fileNameDisplay.textContent = e.target.files[0].name;
                    previewContainer.classList.remove('d-none');
                }
            });

            // Payment Method Box Toggle
            const paymentBoxes = document.querySelectorAll('.payment-method-box');
            paymentBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    paymentBoxes.forEach(b => b.classList.remove('active'));
                    box.classList.add('active');
                    box.querySelector('input').checked = true;
                });
            });
        });
    </script>
@endsection