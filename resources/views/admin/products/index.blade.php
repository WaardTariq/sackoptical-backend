@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Products</h4>
            <a href="{{ route('admin.products.create') }}" class="btn btn-gold rounded-pill px-4">
                <i class="fa-solid fa-plus me-2"></i> Add New Product
            </a>
        </div>

        <div class="card card-premium">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>#{{ $product->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @php
                                            $prodImg = $product->primary_image;
                                            if (!$prodImg && $product->images->where('is_primary', true)->first()) {
                                                $prodImg = $product->images->where('is_primary', true)->first()->image_path;
                                            }

                                            if ($prodImg && !Str::startsWith($prodImg, 'storage/') && !Str::startsWith($prodImg, 'http')) {
                                                $prodImg = 'storage/' . $prodImg;
                                            }
                                        @endphp
                                        @if($prodImg)
                                            <img src="{{ asset($prodImg) }}" width="40" height="40" class="rounded object-fit-cover"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_product.png') }}';">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width:40px;height:40px;"><i class="fa-solid fa-glasses text-muted"></i></div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $product->name }}</div>
                                            <div class="small text-muted">{{ $product->brand->name ?? 'No Brand' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="fw-bold">${{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->stock < 10) <span class="text-danger fw-bold">{{ $product->stock }}</span>
                                    @else {{ $product->stock }} @endif
                                </td>
                                <td>{!! $product->status ? '<span class="status-badge status-success">Active</span>' : '<span class="status-badge status-danger">Inactive</span>' !!}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-light border"><i class="fa-solid fa-pen"></i></a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
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
            <div class="p-4">{{ $products->links() }}</div>
        </div>
    </div>
@endsection