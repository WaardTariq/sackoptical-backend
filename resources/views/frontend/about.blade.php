@extends('frontend.layouts.master')

@section('title', 'About Us - Sacks Optical')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden d-flex align-items-center"
        style="height: 60vh; background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);">
        <div class="container position-relative text-center" style="z-index: 1;">
            <h1 class="display-2 fw-bold text-white mb-4 fade-up">
                ABOUT <span class="text-outline" style="color: transparent; -webkit-text-stroke: 2px white;">SACKS
                    OPTICAL</span>
            </h1>
            <p class="lead text-white-50 mb-0 mx-auto fade-up" style="max-width: 700px; font-weight: 300;">
                Crafting extraordinary eyewear experiences since the beginning
            </p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="section-padding bg-black">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 fade-up">
                    <div class="text-reveal-wrapper" style="overflow: hidden;">
                        <h2 class="display-4 fw-bold mb-4 text-reveal">OUR STORY</h2>
                    </div>
                    <div class="separator bg-white mb-4" style="width: 100px; height: 2px;"></div>
                    <p class="text-white-50 mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                        Sacks Optical was founded with a singular vision: to revolutionize the eyewear industry by combining
                        cutting-edge technology with timeless design. What started as a small boutique has grown into a
                        trusted name for those who demand excellence.
                    </p>
                    <p class="text-white-50 mb-0" style="font-size: 1.1rem; line-height: 1.8;">
                        Every frame we create tells a story of precision, passion, and perfection. We believe that eyewear
                        is not just a necessity—it's an expression of who you are.
                    </p>
                </div>
                <div class="col-lg-6 fade-up">
                    <div class="parallax-image-container rounded-4 overflow-hidden" style="height: 500px;">
                        <img src="{{ asset('assets/images/craftsmanship.png') }}" class="w-100 h-100 object-fit-cover"
                            alt="Our Story" onerror="this.src='https://placehold.co/600x600/111/fff?text=Our+Story'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="section-padding" style="background: #0a0a0a;">
        <div class="container">
            <div class="text-center mb-5 fade-up">
                <h2 class="display-4 fw-bold mb-3">OUR VALUES</h2>
                <p class="text-white-50 mx-auto" style="max-width: 600px;">The principles that guide everything we do</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 fade-up">
                    <div class="value-card p-5 rounded-4 h-100"
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s;">
                        <div class="icon-wrapper mb-4"
                            style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-gem" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">QUALITY</h4>
                        <p class="text-white-50 mb-0">We never compromise on quality. Every product undergoes rigorous
                            testing to ensure it meets our exacting standards.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fade-up">
                    <div class="value-card p-5 rounded-4 h-100"
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s;">
                        <div class="icon-wrapper mb-4"
                            style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-lightbulb" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">INNOVATION</h4>
                        <p class="text-white-50 mb-0">We constantly push boundaries, exploring new materials, technologies,
                            and designs to stay ahead of the curve.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 fade-up">
                    <div class="value-card p-5 rounded-4 h-100"
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); transition: all 0.3s;">
                        <div class="icon-wrapper mb-4"
                            style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-heart" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">CARE</h4>
                        <p class="text-white-50 mb-0">Your vision and satisfaction are our top priorities. We're committed
                            to providing exceptional service at every touchpoint.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding bg-black text-center">
        <div class="container fade-up">
            <h2 class="display-3 fw-bold mb-4">READY TO EXPERIENCE<br>THE DIFFERENCE?</h2>
            <p class="text-white-50 mb-5 mx-auto" style="max-width: 600px; font-size: 1.1rem;">
                Discover our collection of premium eyewear designed for those who see the world differently.
            </p>
            <a href="{{ route('shop.index') }}" class="btn-premium magnetic-item">EXPLORE COLLECTION</a>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        .value-card:hover {
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            transform: translateY(-10px);
        }

        .text-reveal-wrapper {
            overflow: hidden;
        }
    </style>
@endsection