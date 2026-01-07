@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-dark mb-4">Settings</h4>
    <div class="row">
        <div class="col-md-3">
             <div class="card card-premium">
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action fw-bold active">General</a>
                    <a href="{{ route('admin.settings.business') }}" class="list-group-item list-group-item-action">Business Info</a>
                    <a href="#" class="list-group-item list-group-item-action">Appearance</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-premium p-4">
                <h5 class="fw-bold mb-4">General Settings</h5>
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Site Title</label>
                        <input type="text" name="site_title" class="form-control" value="Sacks Optical">
                    </div>
                     <div class="mb-3 form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="maintenance_mode">
                        <label class="form-check-label">Maintenance Mode</label>
                    </div>
                    <button class="btn btn-gold rounded-pill px-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
