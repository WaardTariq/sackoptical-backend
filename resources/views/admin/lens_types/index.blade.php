@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Lens Types</h4>
            <a href="{{ route('admin.lens-types.create') }}" class="btn btn-gold rounded-pill px-4"><i
                    class="fa-solid fa-plus me-2"></i> Add New</a>
        </div>
        <div class="card card-premium">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price Modifier</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lensTypes as $lens)
                            <tr>
                                <td>
                                    @php
                                        $lensImg = $lens->image;
                                        if ($lensImg && !Str::startsWith($lensImg, 'storage/') && !Str::startsWith($lensImg, 'http')) {
                                            $lensImg = 'storage/' . $lensImg;
                                        }
                                    @endphp
                                    <img src="{{ $lens->image ? asset($lensImg) : asset('assets/images/placeholder_product.png') }}"
                                        class="rounded" style="width: 50px; height: 50px; object-fit: cover;"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                </td>
                                <td class="fw-bold">{{ $lens->name }}</td>
                                <td>+${{ number_format($lens->price_modifier, 2) }}</td>
                                <td>{!! $lens->status ? '<span class="status-badge status-success">Active</span>' : '<span class="status-badge status-danger">Inactive</span>' !!}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.lens-types.show', $lens->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.lens-types.edit', $lens->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.lens-types.destroy', $lens->id) }}" method="POST"
                                            onsubmit="return confirm('Delete?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light border text-danger"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">{{ $lensTypes->links() }}</div>
        </div>
    </div>
@endsection