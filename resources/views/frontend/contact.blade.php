@extends('frontend.layouts.master')

@section('title', 'Contact Us - Sacks Optical')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden d-flex align-items-center"
        style="height: 50vh; background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);">
        <div class="container position-relative text-center" style="z-index: 1;">
            <h1 class="display-2 fw-bold text-white mb-4 fade-up">
                GET IN <span class="text-outline" style="color: transparent; -webkit-text-stroke: 2px white;">TOUCH</span>
            </h1>
            <p class="lead text-white-50 mb-0 mx-auto fade-up" style="max-width: 600px; font-weight: 300;">
                We're here to help you find your perfect pair
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="section-padding bg-black">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-7 fade-up">
                    <div class="contact-form-wrapper p-5 rounded-4"
                        style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1);">
                        <h3 class="fw-bold mb-4">Send us a Message</h3>

                        @if(session('success'))
                            <div class="alert alert-success bg-transparent text-white border-white mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Your
                                            Name</label>
                                        <input type="text" name="name"
                                            class="form-control bg-transparent text-white border-secondary py-3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Email
                                            Address</label>
                                        <input type="email" name="email"
                                            class="form-control bg-transparent text-white border-secondary py-3" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label
                                            class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Subject</label>
                                        <input type="text" name="subject"
                                            class="form-control bg-transparent text-white border-secondary py-3" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label
                                            class="text-white-50 mb-2 small text-uppercase letter-spacing-1">Message</label>
                                        <textarea name="message" rows="5"
                                            class="form-control bg-transparent text-white border-secondary py-3"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn-premium w-100 magnetic-item">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-5 fade-up">
                    <div class="ps-lg-5">
                        <div class="info-item mb-5">
                            <h4 class="fw-bold mb-3">Visit Us</h4>
                            <p class="text-white-50 mb-1">123 Optical Avenue</p>
                            <p class="text-white-50">New York, NY 10012</p>
                        </div>

                        <div class="info-item mb-5">
                            <h4 class="fw-bold mb-3">Contact</h4>
                            <p class="text-white-50 mb-1"><a href="mailto:hello@sacksoptical.com"
                                    class="text-white-50 text-decoration-none hover-white">hello@sacksoptical.com</a></p>
                            <p class="text-white-50"><a href="tel:+12125550123"
                                    class="text-white-50 text-decoration-none hover-white">+1 (212) 555-0123</a></p>
                        </div>

                        <div class="info-item mb-5">
                            <h4 class="fw-bold mb-3">Hours</h4>
                            <ul class="list-unstyled text-white-50">
                                <li class="mb-2 d-flex justify-content-between">
                                    <span>Monday - Friday</span>
                                    <span>10:00 AM - 7:00 PM</span>
                                </li>
                                <li class="mb-2 d-flex justify-content-between">
                                    <span>Saturday</span>
                                    <span>11:00 AM - 6:00 PM</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Sunday</span>
                                    <span>Closed</span>
                                </li>
                            </ul>
                        </div>

                        <div class="map-container rounded-4 overflow-hidden mt-5"
                            style="height: 250px; filter: grayscale(100%) invert(90%);">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a197cf75843%3A0x8a62c57dd5451c80!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2s!4v1560000000000!5m2!1sen!2s"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
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