@extends('frontend.layouts.master')

@section('title', 'My Profile - Sacks Optical')

@section('content')
    <section class="profile-page section-padding pt-5 min-vh-100">
        <div class="container">
            <div class="row g-5">
                <!-- Profile Sidebar -->
                <div class="col-lg-4">
                    <div class="profile-card p-4 rounded-4 bg-dark border border-secondary border-opacity-25 fade-up">
                        <div class="text-center mb-4">
                            <div class="avatar-large mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-premium text-white display-4"
                                style="width: 100px; height: 100px;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                            <p class="text-white-50 small mb-0">{{ $user->email }}</p>
                        </div>

                        <div class="nav div-group flex-column gap-2">
                            <a href="{{ route('profile.index') }}"
                                class="btn btn-premium w-100 text-start d-flex align-items-center gap-3">
                                <i class="fa-solid fa-user"></i> My Profile
                            </a>
                            <a href="{{ route('profile.orders') }}"
                                class="btn btn-outline-light w-100 text-start d-flex align-items-center gap-3 border-secondary border-opacity-25">
                                <i class="fa-solid fa-shopping-bag"></i> My Orders
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit"
                                    class="btn btn-outline-danger w-100 text-start d-flex align-items-center gap-3 border-danger border-opacity-25">
                                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Content -->
                <div class="col-lg-8">
                    <div class="profile-content fade-up">
                        <h2 class="fw-bold mb-4">PERSONAL INFORMATION</h2>

                        @if(session('success'))
                            <div
                                class="alert alert-success bg-success bg-opacity-10 border-success border-opacity-25 text-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="form-wrapper p-4 p-md-5 rounded-4 bg-dark border border-secondary border-opacity-25">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Full
                                            Name</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="form-control bg-transparent text-white border-secondary py-3 @error('name') is-invalid @enderror"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Email
                                            Address</label>
                                        <input type="email" value="{{ $user->email }}"
                                            class="form-control bg-transparent text-white-50 border-secondary py-3"
                                            disabled>
                                        <div class="form-text text-white-50 small">Email cannot be changed.</div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Phone
                                            Number</label>
                                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                            class="form-control bg-transparent text-white border-secondary py-3 @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn-premium px-5 magnetic-item">SAVE CHANGES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection