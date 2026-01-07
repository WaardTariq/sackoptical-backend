@extends('frontend.layouts.master')

@section('title', 'Create Account - Sacks Optical')

@section('content')

    <!-- Register Section -->
    <section class="min-vh-100 d-flex align-items-center justify-content-center bg-black section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="text-center mb-5 fade-up">
                        <h2 class="fw-bold text-white mb-2">CREATE ACCOUNT</h2>
                        <p class="text-white-50">Join us for an exclusive experience.</p>
                    </div>

                    <div class="login-wrapper p-4 p-md-5 rounded-4 fade-up bg-dark border border-secondary border-opacity-25"
                        style="background: rgba(255, 255, 255, 0.03) !important;">
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Full Name</label>
                                <input type="text" name="name"
                                    class="form-control bg-transparent text-white border-secondary py-3" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Email
                                    Address</label>
                                <input type="email" name="email"
                                    class="form-control bg-transparent text-white border-secondary py-3" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Password</label>
                                <input type="password" name="password"
                                    class="form-control bg-transparent text-white border-secondary py-3" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Confirm
                                    Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control bg-transparent text-white border-secondary py-3" required>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input bg-transparent border-secondary" type="checkbox" id="terms"
                                    required>
                                <label class="form-check-label text-white-50 small" for="terms">
                                    I agree to the <a href="#" class="text-white text-decoration-none hover-white">Terms of
                                        Service</a> & <a href="#"
                                        class="text-white text-decoration-none hover-white">Privacy Policy</a>
                                </label>
                            </div>

                            <button type="submit" class="btn-premium w-100 magnetic-item mb-4">CREATE ACCOUNT</button>

                            <div class="text-center">
                                <p class="text-white-50 small mb-0">Already have an account? <a href="{{ route('login') }}"
                                        class="text-white text-decoration-none hover-white fw-bold">Sign in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: white;
            color: white;
            box-shadow: none;
        }

        .hover-white:hover {
            color: white !important;
            transition: color 0.3s;
        }
    </style>
@endsection