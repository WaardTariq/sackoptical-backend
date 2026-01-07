@extends('frontend.layouts.master')

@section('title', 'Login - Sacks Optical')

@section('content')

    <!-- Login Section -->
    <section class="min-vh-100 d-flex align-items-center justify-content-center bg-black section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="text-center mb-5 fade-up">
                        <h2 class="fw-bold text-white mb-2">WELCOME BACK</h2>
                        <p class="text-white-50">Please enter your details to sign in.</p>
                    </div>

                    <div class="login-wrapper p-4 p-md-5 rounded-4 fade-up bg-dark border border-secondary border-opacity-25"
                        style="background: rgba(255, 255, 255, 0.03) !important;">
                        <form action="{{ route('login.submit') }}" method="POST">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger bg-danger bg-opacity-10 border-danger border-opacity-25 text-danger small mb-4">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control bg-transparent text-white border-secondary py-3 @error('email') is-invalid @enderror" required>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Password</label>
                                <input type="password" name="password"
                                    class="form-control bg-transparent text-white border-secondary py-3" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input bg-transparent border-secondary" type="checkbox"
                                        id="remember">
                                    <label class="form-check-label text-white-50 small" for="remember">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="text-white-50 small text-decoration-none hover-white">Forgot
                                    password?</a>
                            </div>

                            <button type="submit" class="btn-premium w-100 magnetic-item mb-4">SIGN IN</button>

                            <div class="text-center">
                                <p class="text-white-50 small mb-0">Don't have an account? <a href="{{ route('register') }}"
                                        class="text-white text-decoration-none hover-white fw-bold">Create account</a></p>
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