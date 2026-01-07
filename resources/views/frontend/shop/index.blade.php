@extends('frontend.layouts.master')

@section('content')

    <div class="shop-page section-padding">
        <div class="container">
            <div class="row g-5">
                <!-- Sidebar Filters -->
                <div class="col-lg-3">
                    <div class="sidebar sticky-top" style="top: 100px;">
                        <div class="filter-section mb-5 fade-up">
                            <h5 class="fw-bold mb-3 text-uppercase letter-spacing-1">Categories</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="{{ route('shop.index') }}"
                                        class="text-decoration-none magnetic-item {{ !request()->category ? 'text-white fw-bold' : 'text-white-50' }}">All
                                        Products</a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="mb-2">
                                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                            class="text-decoration-none magnetic-item {{ request()->category == $category->slug ? 'text-white fw-bold' : 'text-white-50' }}">
                                            {{ $category->name }}
                                            <span class="small ms-1 opacity-50">({{ $category->products_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="filter-section mb-5 fade-up">
                            <h5 class="fw-bold mb-3 text-uppercase letter-spacing-1">Sort By</h5>
                            <div class="d-grid gap-2">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                                    class="btn btn-sm btn-outline-light text-start {{ request()->sort == 'newest' ? 'active' : '' }}">Newest
                                    Arrivals</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}"
                                    class="btn btn-sm btn-outline-light text-start {{ request()->sort == 'price_low' ? 'active' : '' }}">Price:
                                    Low to High</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}"
                                    class="btn btn-sm btn-outline-light text-start {{ request()->sort == 'price_high' ? 'active' : '' }}">Price:
                                    High to Low</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4 fade-up">
                        <h2 class="fw-bold mb-0">SHOP ALL</h2>
                        <span class="text-white-50">{{ $products->total() }} Products</span>
                    </div>

                    <div class="row g-4">
                        @forelse($products as $product)
                            <div class="col-md-4 mb-4">
                                <div class="product-card fade-up">
                                    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                                        <div class="card-image-wrapper position-relative rounded-4 overflow-hidden mb-3 bg-dark"
                                            style="height: 300px;">
                                            <!-- Primary Image -->
                                            @php
                                                $primaryImage = $product->primary_image;
                                                if ($primaryImage && !Str::startsWith($primaryImage, 'storage/') && !Str::startsWith($primaryImage, 'http')) {
                                                    $primaryImage = 'storage/' . $primaryImage;
                                                }
                                            @endphp
                                            <img src="{{ $product->primary_image ? asset($primaryImage) : asset('assets/images/placeholder_product.png') }}"
                                                class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 primary-img"
                                                alt="{{ $product->name }}"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">

                                            <!-- Secondary Image (Hover) -->
                                            @if($product->images->count() > 0)
                                                @php
                                                    $secImage = $product->images->first()->image_path;
                                                    if ($secImage && !Str::startsWith($secImage, 'storage/') && !Str::startsWith($secImage, 'http')) {
                                                        $secImage = 'storage/' . $secImage;
                                                    }
                                                @endphp
                                                <img src="{{ asset($secImage) }}"
                                                    class="w-100 h-100 object-fit-cover position-absolute top-0 start-0 secondary-img"
                                                    style="opacity: 0; transition: opacity 0.4s ease;" alt="{{ $product->name }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                            @endif

                                            <!-- Badge -->
                                            @if($product->stock < 5)
                                                <span
                                                    class="position-absolute top-0 start-0 m-3 badge bg-white text-black rounded-pill">Low
                                                    Stock</span>
                                            @endif

                                            <!-- Quick View -->
                                            <div class="quick-view-btn position-absolute bottom-0 start-0 w-100 p-3 text-center"
                                                style="transform: translateY(100%); transition: transform 0.3s ease;">
                                                <button
                                                    class="btn btn-sm btn-light rounded-pill w-100 fw-bold magnetic-item">View
                                                    Product</button>
                                            </div>
                                        </div>
                                        <div class="product-info text-center">
                                            <h5 class="fw-bold text-white mb-1 title-hover">{{ $product->name }}</h5>
                                            <p class="text-white-50 small mb-2">{{ $product->category->name }}</p>
                                            <span
                                                class="text-white fw-bold d-block">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5 fade-up">
                                <h4 class="text-white-50">No products found.</h4>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 fade-up">
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <style>
        .card-image-wrapper:hover .secondary-img {
            opacity: 1;
        }

        .card-image-wrapper:hover .quick-view-btn {
            transform: translateY(0);
        }

        .product-card:hover .title-hover {
            color: var(--secondary-color) !important;
        }

        .btn-outline-light.active {
            background-color: white;
            color: black;
        }
    </style>
@endsection