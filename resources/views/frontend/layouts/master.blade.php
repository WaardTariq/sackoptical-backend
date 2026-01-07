<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sacks Optical - Extraordinary Eyewear')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend-style.css') }}">
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @yield('styles')
</head>

<body class="loading">

    <!-- Custom Cursor -->
    <div class="cursor-dot"></div>
    <div class="cursor-circle"></div>

    <!-- Page Loader -->
    <div class="page-loader">
        <div class="loader-text">SACKS OPTICAL</div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
        <div class="container-fluid px-5">
            <a class="navbar-brand magnetic-item" href="{{ route('home') }}">
                SACKS OPTICAL
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link magnetic-item" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link magnetic-item" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link magnetic-item" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link magnetic-item" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-4">
                    <button type="button" class="nav-icon magnetic-item bg-transparent border-0 text-white"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa-solid fa-search"></i>
                    </button>
                    @auth
                        <div class="dropdown">
                            <button class="nav-icon magnetic-item bg-transparent border-0 text-white dropdown-toggle"
                                type="button" data-bs-toggle="dropdown">
                                <i class="fa-regular fa-user"></i>
                                <span class="small ms-1 d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark bg-black border-secondary">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.orders') }}">Orders</a></li>
                                <li>
                                    <hr class="dropdown-divider border-secondary">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-icon magnetic-item"><i class="fa-regular fa-user"></i></a>
                    @endauth
                    <a href="{{ route('cart.index') }}" class="nav-icon magnetic-item position-relative">
                        <i class="fa-solid fa-shopping-bag"></i>
                        <span class="cart-badge">{{ count(session('cart', [])) }}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen bg-black">
            <div class="modal-content bg-transparent border-0">
                <div class="container h-100 d-flex flex-column justify-content-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-5"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                    <form action="{{ route('shop.index') }}" method="GET" class="w-100">
                        <div class="position-relative">
                            <input type="text" name="search"
                                class="form-control bg-transparent border-0 border-bottom border-secondary text-white display-4 fw-bold py-4"
                                placeholder="Search products..." autofocus>
                            <button type="submit"
                                class="position-absolute end-0 top-50 translate-middle-y btn bg-transparent border-0 text-white fs-2">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="text-white-50 mb-4">Quick Links</p>
                        <div class="d-flex gap-4 justify-content-center">
                            <a href="{{ route('shop.index') }}"
                                class="text-white text-decoration-none magnetic-item">All Products</a>
                            <a href="#" class="text-white text-decoration-none magnetic-item">Sunglasses</a>
                            <a href="#" class="text-white text-decoration-none magnetic-item">Eyeglasses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main id="smooth-wrapper">
        <div id="smooth-content">
            @yield('content')

            <!-- Footer -->
            <footer class="site-footer section-padding bg-black text-white">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-4">
                            <h3 class="footer-logo mb-4">SACKS OPTICAL</h3>
                            <p class="text-white-50">Premium eyewear crafted for those who see the world differently.
                                Experience the extraordinary.</p>
                        </div>
                        <div class="col-lg-2 col-6">
                            <h5 class="footer-title">Shop</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="#" class="magnetic-item">Eyeglasses</a></li>
                                <li><a href="#" class="magnetic-item">Sunglasses</a></li>
                                <li><a href="#" class="magnetic-item">New Arrivals</a></li>
                                <li><a href="#" class="magnetic-item">Best Sellers</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-6">
                            <h5 class="footer-title">Help</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="#" class="magnetic-item">Shipping & Returns</a></li>
                                <li><a href="#" class="magnetic-item">FAQ</a></li>
                                <li><a href="#" class="magnetic-item">Contact Us</a></li>
                                <li><a href="#" class="magnetic-item">Track Order</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="footer-title">Newsletter</h5>
                            <div class="newsletter-form mt-4">
                                <form class="d-flex border-bottom border-secondary pb-2">
                                    <input type="email"
                                        class="form-control bg-transparent border-0 text-white shadow-none ps-0"
                                        placeholder="Enter your email">
                                    <button class="btn text-white magnetic-item">Subscribe</button>
                                </form>
                            </div>
                            <div class="social-links mt-4 d-flex gap-3">
                                <a href="#" class="magnetic-item"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="magnetic-item"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="magnetic-item"><i class="fa-brands fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 pt-5 border-top border-secondary">
                        <div class="col-md-6 text-white-50 small">
                            &copy; 2025 Sacks Optical. All rights reserved.
                        </div>
                        <div class="col-md-6 text-md-end text-white-50 small">
                            <a href="#" class="text-white-50 me-3">Privacy Policy</a>
                            <a href="#" class="text-white-50">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Swiper Slider -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="{{ asset('assets/js/frontend-animations.js') }}"></script>
    @yield('scripts')
</body>

</html>