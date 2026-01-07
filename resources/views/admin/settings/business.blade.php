@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold text-dark mb-4">Settings</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-premium">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.settings.index') }}"
                            class="list-group-item list-group-item-action">General</a>
                        <a href="{{ route('admin.settings.business') }}"
                            class="list-group-item list-group-item-action fw-bold active">Business Info</a>
                        <a href="#" class="list-group-item list-group-item-action">Appearance</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-premium p-4">
                    <h5 class="fw-bold mb-4">Business Information</h5>
                    <form action="{{ route('admin.settings.business.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $business->company_name ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Company Email</label>
                                <input type="email" name="company_email" class="form-control"
                                    value="{{ $business->company_email ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" name="company_phone" class="form-control"
                                    value="{{ $business->company_phone ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Currency</label>
                                <input type="text" name="currency" class="form-control"
                                    value="{{ $business->currency ?? 'USD' }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea name="company_address" class="form-control"
                                    rows="3">{{ $business->company_address ?? '' }}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-gold rounded-pill px-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection