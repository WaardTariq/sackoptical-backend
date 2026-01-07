@extends('frontend.layouts.master')

@section('content')

    <!-- Hero Slider Section -->
    <section class="hero-section position-relative overflow-hidden bg-black" style="height: 100vh;">
        @if($sliders->count() > 0)
            <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators mb-5">
                    @foreach($sliders as $key => $slider)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}"
                            class="{{ $loop->first ? 'active' : '' }}"
                            aria-current="{{ $loop->first ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner h-100">
                    @foreach($sliders as $slider)
                        <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">
                            <!-- Background Image -->
                            <div class="position-absolute top-0 start-0 w-100 h-100">
                                @php
                                    $img = $slider->image;
                                    if ($img && !Str::startsWith($img, 'storage/') && !Str::startsWith($img, 'http')) {
                                        $img = 'storage/' . $img;
                                    }
                                @endphp
                                <img src="{{ asset($img) }}" class="w-100 h-100 object-fit-cover opacity-60"
                                    alt="{{ $slider->title }}">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-50"
                                    style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);">
                                </div>
                            </div>

                            <!-- Content -->
                            <div
                                class="carousel-caption h-100 d-flex flex-column justify-content-center pb-5 {{ $slider->text_alignment === 'left' ? 'align-items-start text-start container' : ($slider->text_alignment === 'right' ? 'align-items-end text-end container' : 'align-items-center text-center') }}">
                                <div
                                    class="row w-100 align-items-center {{ $slider->text_alignment === 'right' ? 'flex-row-reverse' : '' }}">
                                    <!-- Text Column -->
                                    <div class="{{ $slider->secondary_image ? 'col-lg-6' : 'col-12' }}">
                                        <div style="max-width: {{ $slider->secondary_image ? '100%' : '900px' }};"
                                            class="{{ $slider->text_alignment === 'left' ? 'me-auto' : ($slider->text_alignment === 'right' ? 'ms-auto' : 'mx-auto') }}">
                                            @if($slider->title)
                                                <h1 class="display-1 fw-bold text-white mb-4 hero-title text-uppercase"
                                                    style="font-size: {{ $slider->secondary_image ? '3.5rem' : '5rem' }}; letter-spacing: -2px;">
                                                    {{ $slider->title }}
                                                </h1>
                                            @endif
                                            @if($slider->subtitle)
                                                <p class="text-white text-uppercase letter-spacing-3 mb-3 fade-up"
                                                    style="animation-delay: 0.2s;">{{ $slider->subtitle }}</p>
                                            @endif
                                            @if($slider->link && $slider->button_text)
                                                <div class="mt-4 fade-up" style="animation-delay: 0.6s;">
                                                    <a href="{{ $slider->link }}"
                                                        class="btn-premium magnetic-item">{{ $slider->button_text }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Secondary Image Column -->
                                    @if($slider->secondary_image)
                                        <div class="col-lg-6 d-none d-lg-block">
                                            @php
                                                $secImg = $slider->secondary_image;
                                                if ($secImg && !Str::startsWith($secImg, 'storage/') && !Str::startsWith($secImg, 'http')) {
                                                    $secImg = 'storage/' . $secImg;
                                                }
                                            @endphp
                                            <div class="fade-up" style="animation-delay: 0.4s;">
                                                <img src="{{ asset($secImg) }}" alt="Feature" class="img-fluid object-fit-contain"
                                                    style="max-height: 500px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.5));">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <!-- Fallback Static Hero -->
            <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="z-index: 0;">
                <img src="{{ asset('assets/images/hero_bg.png') }}" class="w-100 h-100 object-fit-cover opacity-50"
                    alt="Sacks Optical Hero">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-25"></div>
            </div>
            <div class="container position-relative text-center h-100 d-flex flex-column justify-content-center"
                style="z-index: 1;">
                <h1 class="display-1 fw-bold text-white mb-4 hero-title" style="font-size: 5rem; letter-spacing: -2px;">
                    <span class="d-block">VISIONARY</span>
                    <span class="d-block text-outline"
                        style="color: transparent; -webkit-text-stroke: 2px white;">AESTHETICS</span>
                </h1>
                <p class="lead text-white-50 mb-5 mx-auto fade-up" style="max-width: 600px; font-weight: 300;">
                    Premium eyewear crafted for those who see the world differently.
                </p>
                <div class="fade-up">
                    <a href="{{ route('shop.index') }}" class="btn-premium magnetic-item">Explore Collection</a>
                </div>
            </div>
        @endif

        <!-- Scroll Indicator -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-5 text-white text-center fade-up"
            style="z-index: 10;">
            <span class="d-block small text-uppercase letter-spacing-2 mb-2">Scroll</span>
            <i class="fa-solid fa-arrow-down bounce-animation"></i>
        </div>
    </section>

    <!-- Infinite Marquee Section -->
    <section class="marquee-section bg-gold py-3 overflow-hidden">
        <div class="marquee-content d-flex">
            <div class="marquee-track d-flex align-items-center">
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Premium Eyewear</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Handcrafted Excellence</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Global Shipping</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Luxury Design</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <!-- Duplicate for seamless loop -->
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Premium Eyewear</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Handcrafted Excellence</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Global Shipping</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">Luxury Design</span>
                <span class="text-black fw-bold text-uppercase mx-5 h4 mb-0">•</span>
            </div>
        </div>
    </section>

    <!-- Featured Categories (3D Tilt) -->
    <section class="section-padding bg-black position-relative">
        <div class="container">
            <div class="text-center mb-5 fade-up">
                <h2 class="display-5 fw-bold text-white mb-2">CURATED COLLECTIONS</h2>
                <div class="separator-center bg-gold mx-auto" style="width: 60px; height: 3px;"></div>
            </div>

            <div class="collections-slider-wrapper position-relative fade-up">
                <div class="swiper collectionsSlider">
                    <div class="swiper-wrapper">
                        @foreach($categories as $category)
                            <div class="swiper-slide mb-5">
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                                    class="text-decoration-none d-block">
                                    <div class="category-card tilt-card position-relative overflow-hidden rounded-4"
                                        style="height: 400px; background: #111;">
                                        @php
                                            $catImg = $category->image;
                                            if ($catImg && !Str::startsWith($catImg, 'storage/') && !Str::startsWith($catImg, 'http')) {
                                                $catImg = 'storage/' . $catImg;
                                            }
                                        @endphp
                                        <img src="{{ $catImg ? asset($catImg) : asset('assets/images/placeholder_product.png') }}"
                                            class="w-100 h-100 object-fit-cover opacity-50 transition-transform"
                                            style="transition: all 0.6s ease;" alt="{{ $category->name }}"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-black">
                                            <h3 class="fw-bold mb-1 text-white">{{ $category->name }}</h3>
                                            <span class="small text-uppercase text-white-50 letter-spacing-1">View Collection <i
                                                    class="fa-solid fa-arrow-right ms-2"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Slider Pagination -->
                    <div class="swiper-pagination mt-4 position-relative"></div>
                </div>

                <!-- Slider Navigation -->
                <div class="swiper-button-next text-white d-none d-lg-flex" style="right: -60px;"></div>
                <div class="swiper-button-prev text-white d-none d-lg-flex" style="left: -60px;"></div>
            </div>
        </div>
    </section>

    <!-- Split Feature Section (The Sacks Standard) -->
    <section class="section-padding position-relative bg-dark overflow-hidden">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 order-lg-1">
                    <div class="position-relative ps-lg-5">
                        <div class="position-absolute top-0 start-0 translate-middle-y ms-3 mt-3 d-none d-lg-block">
                            <img src="{{ asset('assets/images/icon_quality.png') }}" style="width: 80px; opacity: 0.1;"
                                alt="">
                        </div>
                        <h2 class="display-4 fw-bold text-white mb-4 text-reveal">THE SACKS<br><span
                                class="text-gold">STANDARD</span></h2>
                        <p class="text-white-50 mb-4 fade-up lead">
                            We don't just sell eyewear; we curate experiences. Our frames are chemically bonded with premium
                            acetate, hand-polished to perfection, and fitted with precision lenses.
                        </p>
                        <ul class="list-unstyled text-white-50 mb-5 fade-up">
                            <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-check text-gold me-3"></i>
                                Italian Mazucchelli Acetate</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-check text-gold me-3"></i>
                                5-Barrel German Hinges</li>
                            <li class="mb-3 d-flex align-items-center"><i class="fa-solid fa-check text-gold me-3"></i>
                                Anti-Reflective Coating</li>
                        </ul>
                        <div class="fade-up">
                            <a href="{{ route('about') }}" class="btn-outline-gold">Our Story</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2">
                    <div class="parallax-image-container rounded-4 overflow-hidden fade-up shadow-lg position-relative">
                        <img src="{{ asset('assets/images/craftsmanship.png') }}" class="w-100 object-fit-cover"
                            style="height: 600px;" alt="Craftsmanship">
                        <div class="position-absolute bottom-0 end-0 bg-gold text-black p-4 rounded-top-start">
                            <div class="fw-bold h2 mb-0">100%</div>
                            <div class="small text-uppercase fw-bold">Handmade</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual Break Section -->
    <section class="position-relative py-5 overflow-hidden d-flex align-items-center justify-content-center"
        style="height: 60vh;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: -1;">
            <img src="{{ asset('assets/images/lifestyle_large.jpg') }}"
                class="w-100 h-100 object-fit-cover opacity-40 parallax-bg-scroll" alt="Lifestyle">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-black opacity-40"></div>
        </div>
        <div class="container text-center position-relative z-1">
            <div class="box-outline border border-white border-opacity-25 p-5 d-inline-block fade-up backdrop-blur-sm">
                <h2 class="display-3 fw-bold text-white mb-3">EXPERIENCE CLARITY</h2>
                <p class="lead text-white-50 mb-4">See the world through a new lens.</p>
                <a href="{{ route('shop.index') }}"
                    class="btn btn-light rounded-pill px-5 py-3 fw-bold text-uppercase letter-spacing-2">Shop Now</a>
            </div>
        </div>
    </section>

    <!-- New Arrivals (Carousel) -->
    <section class="section-padding overflow-hidden position-relative bg-black">
        <div class="container mb-5 fade-up">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h2 class="fw-bold mb-0 text-white">NEW ARRIVALS</h2>
                    <p class="text-white-50 mb-0">Latest additions to our premium collection</p>
                </div>
                <a href="{{ route('shop.index') }}" class="text-gold text-decoration-none magnetic-item fw-bold">View All <i
                        class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>

        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach($newArrivals->take(3) as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product-card carousel-card-animated fade-up">
                            <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
                                <div class="card-image-wrapper position-relative rounded-4 overflow-hidden mb-3 bg-dark"
                                    style="height: 450px;">
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

                                    @if($product->stock < 5)
                                        <span class="position-absolute top-0 start-0 m-3 badge bg-white text-black rounded-pill">Low
                                            Stock</span>
                                    @endif
                                </div>
                                <div class="product-info text-center">
                                    <h5 class="fw-bold text-white mb-1 title-hover">{{ $product->name }}</h5>
                                    <p class="text-white-50 small mb-2">{{ $product->category->name ?? 'Eyewear' }}</p>
                                    <span class="text-white fw-bold">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Reviews Section (Dynamic) -->
    <section class="section-padding bg-dark position-relative">
        <div class="container text-center mb-5 fade-up">
            <h6 class="text-gold text-uppercase letter-spacing-2 mb-2">Testimonials</h6>
            <h2 class="display-5 fw-bold text-white">WHAT THEY SAY</h2>
        </div>

        <div class="container">
            <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse($reviews as $key => $review)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <div class="mb-4 text-gold">
                                        @for($i = 0; $i < $review->rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </div>
                                    <h3 class="fw-light fst-italic text-white mb-4">
                                        "{{ $review->comment ?? 'Excellent quality and service.' }}"</h3>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center fw-bold text-white fs-5"
                                            style="width: 50px; height: 50px;">
                                            {{ strtoupper(substr($review->user->name ?? 'Guest', 0, 1)) }}
                                        </div>
                                        <div class="text-start">
                                            <h6 class="fw-bold text-white mb-0">{{ $review->user->name ?? 'Guest' }}</h6>
                                            <small class="text-white-50">Verified Customer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Static Fallback if no reviews -->
                        <div class="carousel-item active">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 text-center">
                                    <div class="mb-4 text-gold"><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                    <h3 class="fw-light fst-italic text-white mb-4">"The best optical store I have ever visited.
                                        The collection is simply stunning."</h3>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <div class="rounded-circle bg-white text-black d-flex align-items-center justify-content-center fw-bold fs-5"
                                            style="width: 50px; height: 50px;">J</div>
                                        <div class="text-start">
                                            <h6 class="fw-bold text-white mb-0">James Doe</h6>
                                            <small class="text-white-50">Verified Customer</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        /* Marquee Animation */
        .marquee-track {
            animation: marquee 30s linear infinite;
            white-space: nowrap;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Hero Carousel Customization */
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            margin: 0 6px;
        }

        .carousel-indicators button.active {
            background-color: #ffffff;
            border-color: #ffffff;
        }

        /* General Styles */
        .text-gold {
            color: #ffffff !important;
        }

        .bg-gold {
            background-color: #ffffff !important;
        }

        .btn-premium {
            background: #ffffff;
            color: black;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-premium:hover {
            background: black;
            color: white;
            border: 1px solid white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
        }

        .btn-outline-gold {
            border: 2px solid #ffffff;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-outline-gold:hover {
            background: #ffffff;
            color: black;
        }

        .bounce-animation {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        /* Product Card Hover Effects */
        .card-image-wrapper:hover .secondary-img {
            opacity: 1;
        }

        .category-card:hover img {
            transform: scale(1.1);
            opacity: 0.8 !important;
        }

        .title-hover {
            transition: color 0.3s;
        }

        .product-card:hover .title-hover {
            color: #ffffff !important;
            text-decoration: underline;
        }

        /* Existing Animations preserved */
        .carousel-card-animated {
            opacity: 0;
            transform: translateY(50px) scale(0.95);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .carousel-card-animated.animate-in {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .rounded-top-start {
            border-top-left-radius: 20px;
        }

        .backdrop-blur-sm {
            backdrop-filter: blur(5px);
        }

        /* Swiper Custom Theme */
        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.3) !important;
            opacity: 1 !important;
            width: 10px;
            height: 10px;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #ffffff !important;
            width: 25px;
            border-radius: 5px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px;
            font-weight: bold;
        }

        .collections-slider-wrapper {
            padding: 0 40px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animate items on scroll
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        // handling 'fade-up' custom class if widely used
                        if (entry.target.classList.contains('fade-up')) {
                            // Assuming you have CSS for .fade-up.show or similar, 
                            // or rely on the simple class addition 
                            entry.target.style.opacity = 1;
                            entry.target.style.transform = 'translateY(0)';
                        }
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.carousel-card-animated, .fade-up').forEach(el => observer.observe(el));

            // 3D Tilt Effect
            const tiltCards = document.querySelectorAll('.tilt-card');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 20;
                    const rotateY = (centerX - x) / 20;

                    if (window.gsap) {
                        gsap.to(card, {
                            rotationX: rotateX,
                            rotationY: rotateY,
                            duration: 0.5,
                            ease: "power2.out"
                        });
                    }
                });

                card.addEventListener('mouseleave', () => {
                    if (window.gsap) {
                        gsap.to(card, {
                            rotationX: 0,
                            rotationY: 0,
                            duration: 0.5,
                            ease: "power2.out"
                        });
                    }
                });
            });

            // Initialize Collections Slider
            new Swiper(".collectionsSlider", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
@endsection