@extends('frontend.layouts.master')

@section('content')

    <div class="product-page section-padding pt-5">
        <div class="container">
            <div class="row g-5">
                <!-- Product Gallery (Left Side - Scrolling) -->
                <div class="col-lg-7">
                    <div class="product-gallery">
                        <!-- Primary Image -->
                        <div class="gallery-item mb-4 fade-up">
                            @php
                                $primaryImage = $product->primary_image;
                                if ($primaryImage && !Str::startsWith($primaryImage, 'storage/') && !Str::startsWith($primaryImage, 'http')) {
                                    $primaryImage = 'storage/' . $primaryImage;
                                }
                            @endphp
                            <img src="{{ $product->primary_image ? asset($primaryImage) : asset('assets/images/placeholder_product.png') }}"
                                class="w-100 rounded-4" alt="{{ $product->name }}"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                        </div>

                        <!-- Additional Images -->
                        @foreach($product->images as $image)
                            @php
                                $addImg = $image->image_path;
                                if ($addImg && !Str::startsWith($addImg, 'storage/') && !Str::startsWith($addImg, 'http')) {
                                    $addImg = 'storage/' . $addImg;
                                }
                            @endphp
                            <div class="gallery-item mb-4 fade-up">
                                <img src="{{ asset($addImg) }}" class="w-100 rounded-4" alt="{{ $product->name }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Details (Right Side - Sticky) -->
                <div class="col-lg-5">
                    <div class="product-details sticky-top" style="top: 100px;">
                        <nav aria-label="breadcrumb" class="fade-up">
                            <ol class="breadcrumb small text-uppercase">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                        class="text-white-50 text-decoration-none magnetic-item">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}"
                                        class="text-white-50 text-decoration-none magnetic-item">Shop</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>

                        <h1 class="display-5 fw-bold mb-3 fade-up">{{ $product->name }}</h1>

                        <div class="d-flex justify-content-between align-items-center mb-4 fade-up">
                            <h3 class="fw-bold mb-0">${{ number_format($product->price, 2) }}</h3>
                            @if($product->stock > 0)
                                <span class="badge rounded-pill bg-white text-black px-3 py-2">In Stock</span>
                            @else
                                <span class="badge rounded-pill bg-secondary text-white px-3 py-2">Out of Stock</span>
                            @endif
                        </div>

                        <div class="description mb-5 fade-up">
                            <p class="text-white-50">
                                {{ $product->description ?? 'Experience premium eyewear crafted with precision and style. Designed for comfort and durability.' }}
                            </p>
                        </div>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add') }}" method="POST" class="mb-5 fade-up" id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="buy_now" id="buy-now-input" value="0">

                            <!-- Variants (if any) -->
                            @if($product->variants->count() > 0)
                                <div class="mb-4">
                                    <label class="form-label text-uppercase text-white-50 small fw-bold">Select Variant</label>
                                    <select name="variant_id"
                                        class="form-select bg-transparent text-white border-white-50 rounded-pill p-3">
                                        @foreach($product->variants as $variant)
                                            <option value="{{ $variant->id }}">{{ $variant->variant_name }} -
                                                ${{ number_format($variant->price, 2) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Quantity Selector -->
                            <div class="mb-4">
                                <label class="form-label text-uppercase text-white-50 small fw-bold">Quantity</label>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="quantity-selector d-flex align-items-center border border-white-50 rounded-pill p-1"
                                        style="width: 140px;">
                                        <button type="button" class="btn btn-sm text-white border-0 px-3"
                                            onclick="decrementQty()">
                                            <i class="fa-solid fa-minus small"></i>
                                        </button>
                                        <input type="number" name="quantity" id="product-qty" value="1" min="1"
                                            class="form-control bg-transparent border-0 text-center text-white p-0 m-0 shadow-none no-arrows"
                                            readonly>
                                        <button type="button" class="btn btn-sm text-white border-0 px-3"
                                            onclick="incrementQty()">
                                            <i class="fa-solid fa-plus small"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <button type="button" onclick="submitAddToCart(0)"
                                    class="btn btn-outline-light rounded-pill py-3 magnetic-item d-flex justify-content-between align-items-center px-4">
                                    <span>Add to Bag</span>
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </button>
                                <button type="button" onclick="submitAddToCart(1)"
                                    class="btn btn-premium w-100 magnetic-item d-flex justify-content-between align-items-center">
                                    <span>Buy it now</span>
                                    <i class="fa-solid fa-bolt"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Accordion Specs -->
                        <div class="accordion accordion-flush" id="productSpecs">
                            <!-- Optical Specs -->
                            <div class="accordion-item bg-transparent border-bottom border-secondary fade-up">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none ps-0"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                        OPTICAL SPECIFICATIONS
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    data-bs-parent="#productSpecs">
                                    <div class="accordion-body ps-0 text-white-50 small">
                                        <div class="row mb-2">
                                            <div class="col-6">Lens Width:</div>
                                            <div class="col-6 text-white">{{ $product->lens_width ?? '-' }} mm</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">Bridge Width:</div>
                                            <div class="col-6 text-white">{{ $product->bridge_width ?? '-' }} mm</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6">Temple Length:</div>
                                            <div class="col-6 text-white">{{ $product->temple_length ?? '-' }} mm</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">Frame Material:</div>
                                            <div class="col-6 text-white">{{ $product->material ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dimensions -->
                            <div class="accordion-item bg-transparent border-bottom border-secondary fade-up">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed bg-transparent text-white shadow-none ps-0"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                        DIMENSIONS & WEIGHT
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#productSpecs">
                                    <div class="accordion-body ps-0 text-white-50 small">
                                        <div class="row mb-2">
                                            <div class="col-6">Dimensions:</div>
                                            <div class="col-6 text-white">
                                                {{ $product->length }} x {{ $product->width }} x {{ $product->height }}
                                                {{ $product->unit }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">Weight:</div>
                                            <div class="col-6 text-white">{{ $product->weight }}
                                                {{ $product->unit == 'cm' ? 'g' : 'oz' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="row mt-5 pt-5 fade-up">
                <div class="col-12 mb-4">
                    <h3 class="fw-bold">YOU MAY ALSO LIKE</h3>
                </div>
                @foreach($relatedProducts as $related)
                    <div class="col-md-3">
                        <div class="product-card fade-up">
                            <a href="{{ route('product.show', $related->slug) }}" class="text-decoration-none">
                                <div class="card-image-wrapper position-relative rounded-4 overflow-hidden mb-3 bg-dark"
                                    style="height: 250px;">
                                    @php
                                        $relImg = $related->primary_image;
                                        if ($relImg && !Str::startsWith($relImg, 'storage/') && !Str::startsWith($relImg, 'http')) {
                                            $relImg = 'storage/' . $relImg;
                                        }
                                    @endphp
                                    <img src="{{ $related->primary_image ? asset($relImg) : asset('assets/images/placeholder_product.png') }}"
                                        class="w-100 h-100 object-fit-cover transition-transform" alt="{{ $related->name }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                </div>
                                <div class="product-info">
                                    <h6 class="fw-bold text-white mb-1 title-hover">{{ $related->name }}</h6>
                                    <span class="text-white fw-bold small">${{ number_format($related->price, 2) }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .accordion-button::after {
            filter: invert(1);
        }

        .accordion-button:not(.collapsed) {
            color: white;
            box-shadow: none;
        }

        .no-arrows::-webkit-inner-spin-button,
        .no-arrows::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-arrows {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('scripts')
    <script>
        function incrementQty() {
            const input = document.getElementById('product-qty');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQty() {
            const input = document.getElementById('product-qty');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function submitAddToCart(buyNow) {
            document.getElementById('buy-now-input').value = buyNow;
            document.getElementById('add-to-cart-form').submit();
        }
    </script>
@endsection