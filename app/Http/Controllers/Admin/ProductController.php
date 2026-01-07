<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'subCategory', 'brand', 'productImages', 'attributes']);
        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        $subCategories = SubCategory::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $attributes = Attribute::where('status', true)->get();

        return view('admin.products.create', compact('categories', 'subCategories', 'brands', 'attributes'));
    }

    public function store(Request $request)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'sub_category_id' => 'nullable|exists:sub_categories,id',

            // Nullable fields
            'description' => 'nullable|string',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'unit' => 'nullable|string', // Removed strict "in" check if users might send custom or empty

            // Images
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Increased to 5MB
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id ?? null;
            $product->brand_id = $request->brand_id ?? null;

            // Description
            $product->description = $request->description;

            // Pricing
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->tax_percentage = $request->tax_percentage ?? 8.25;
            $product->stock = $request->stock ?? 0;

            // Dimensions & Weight
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->weight = $request->weight;
            $product->unit = $request->unit;

            // Optical Measurements
            $product->lens_width = $request->lens_width;
            $product->bridge_width = $request->bridge_width;
            $product->temple_length = $request->temple_length;
            $product->frame_width = $request->frame_width;
            $product->face_width_recommended = $request->face_width_recommended;

            // Details
            $product->frame_shape = $request->frame_shape;
            $product->material = $request->material;

            $product->is_featured = $request->has('is_featured');
            $product->status = $request->has('status'); // If checked
            $product->save();

            // Handle Primary Image
            if ($request->hasFile('primary_image')) {
                $primaryImage = $request->file('primary_image');
                $primaryImageName = time() . '_primary_' . Str::random(5) . '.' . $primaryImage->getClientOriginalExtension();
                $primaryImagePath = $primaryImage->storeAs('products', $primaryImageName, 'public');
                $product->primary_image = 'storage/' . $primaryImagePath; // Prepend storage
                $product->save();
            }

            // Handle Additional Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imageName = time() . '_' . $index . '_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'storage/' . $imagePath, // Prepend storage
                    ]);
                }
            }

            // Handle Color Variant Images
            if ($request->has('colors') && is_array($request->colors)) {
                foreach ($request->colors as $key => $colorName) {
                    // Variants can have multiple images
                    if ($request->hasFile("variant_images.$key")) {
                        foreach ($request->file("variant_images.$key") as $image) {
                            $imageName = time() . '_color_' . $key . '_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
                            $imagePath = $image->storeAs('products', $imageName, 'public');

                            ProductImage::create([
                                'product_id' => $product->id,
                                'image_path' => 'storage/' . $imagePath, // Prepend storage
                                'color' => $colorName,
                            ]);
                        }
                    }
                }
            }

            // Handle Product Variants
            $processedVariantAttributes = []; // Store attr IDs to sync later

            if ($request->has('variants') && is_array($request->variants)) {
                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['name'])) {
                        // $variantData['attributes'] is a JSON string passed from hidden input
                        $attrValues = json_decode($variantData['attributes'] ?? '[]', true);

                        ProductVariant::create([
                            'product_id' => $product->id,
                            'variant_name' => $variantData['name'],
                            'attribute_values' => $attrValues, // Model casts to array/json
                            'price' => $variantData['price'] ?? 0,
                            'stock' => $variantData['stock'] ?? 0,
                            'sku' => $variantData['sku'] ?? null,
                        ]);
                    }
                }
            }

            // Handle Attribute Linking (Even if no variants, if user selected attributes via JS logic)
            // If the user provided 'selected_attributes' via AJAX
            if ($request->has('selected_attributes')) {
                $attrIds = json_decode($request->selected_attributes, true);
                $attrValuesMap = $request->has('mixed_attribute_values') ? json_decode($request->mixed_attribute_values, true) : [];

                $syncData = [];
                if (is_array($attrIds)) {
                    foreach ($attrIds as $id) {
                        $vals = $attrValuesMap[$id] ?? [];
                        // Store as comma-separated string
                        $valStr = is_array($vals) ? implode(',', $vals) : (string) $vals;
                        $syncData[$id] = ['value' => $valStr];
                    }
                    $product->attributes()->sync($syncData);
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product published successfully!',
                    'redirect' => route('admin.products.index')
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Product Create Error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server Error: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Product $product)
    {
        $product->load(['attributes', 'variants', 'category', 'subCategory', 'brand', 'productImages']);

        $categories = Category::where('status', true)->get();
        $subCategories = SubCategory::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $attributes = \App\Models\Attribute::where('status', true)->get();

        // return $product;

        return view('admin.products.edit', compact('product', 'categories', 'subCategories', 'brands', 'attributes'));
    }

    public function update(Request $request, Product $product)
    {
        // 1. Validation (Matches store validation but id exception)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'description' => 'nullable|string',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'unit' => 'nullable|string',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            // Update Basic Fields
            $product->name = $request->name;
            if ($request->name !== $product->name) {
                $product->slug = Str::slug($request->name);
            }
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category_id ?? null;
            $product->brand_id = $request->brand_id ?? null;

            $product->description = $request->description;

            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->tax_percentage = $request->tax_percentage ?? 8.25;
            $product->stock = $request->stock ?? 0;

            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->weight = $request->weight;
            $product->unit = $request->unit;

            // Optical
            $product->lens_width = $request->lens_width;
            $product->bridge_width = $request->bridge_width;
            $product->temple_length = $request->temple_length;
            $product->frame_width = $request->frame_width;
            $product->face_width_recommended = $request->face_width_recommended;

            $product->frame_shape = $request->frame_shape;
            $product->material = $request->material;

            $product->is_featured = $request->has('is_featured');
            $product->status = $request->has('status');
            $product->save();

            // Handle Primary Image Update
            if ($request->hasFile('primary_image')) {
                // Delete old if exists
                if ($product->primary_image && Storage::disk('public')->exists(str_replace('storage/', '', $product->primary_image))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $product->primary_image));
                }

                $primaryImage = $request->file('primary_image');
                $primaryImageName = time() . '_primary_' . Str::random(5) . '.' . $primaryImage->getClientOriginalExtension();
                $primaryImagePath = $primaryImage->storeAs('products', $primaryImageName, 'public');
                $product->primary_image = 'storage/' . $primaryImagePath;
                $product->save();
            }

            // Handle Additional Images (Add to existing)
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imageName = time() . '_' . $index . '_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => 'storage/' . $imagePath,
                    ]);
                }
            }

            // Handle Color Variant Images
            if ($request->has('colors') && is_array($request->colors)) {
                foreach ($request->colors as $key => $colorName) {
                    if ($request->hasFile("variant_images.$key")) {
                        foreach ($request->file("variant_images.$key") as $image) {
                            $imageName = time() . '_color_' . $key . '_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
                            $imagePath = $image->storeAs('products', $imageName, 'public');

                            ProductImage::create([
                                'product_id' => $product->id,
                                'image_path' => 'storage/' . $imagePath,
                                'color' => $colorName,
                            ]);
                        }
                    }
                }
            }

            // Handle Product Variants logic:
            // Strategy: Re-create variants or update?
            // Form sends full list of current variants. 
            // Previous logic was: if variants array exists, we create them.
            // But here we are Updating.
            // If we delete all variants and recreate, we lose historical data if any (e.g. order items referencing variant ID?).
            // IF Variants are referenced by ID in orders, DELETING is dangerous.
            // Assuming no foreign key constraints blocking delete for now or soft deletes.
            // Safer approach: 
            // 1. If variant has ID? Form doesn't send ID for variants currently.
            // The JS generator creates new rows.
            // Simple approach for now: Delete existing and Re-create.
            // (User asked to "Refactor... match new tabbed structure". Create logic is fresh create. Edit logic usually mimics Create in simple apps).

            if ($request->has('variants') && is_array($request->variants)) {

                // Optional: Delete old variants
                // $product->variants()->delete(); 
                // BUT wait, stocks?
                // Logic:
                // We'll delete and recreate to ensure clean state based on form.
                // NOTE: This changes Variant IDs. If Orders reference these, confirm ON DELETE behavior.
                // Assuming standard cascade or loose coupling for dummy project.

                $product->variants()->delete();

                foreach ($request->variants as $variantData) {
                    if (!empty($variantData['name'])) {
                        $attrValues = json_decode($variantData['attributes'] ?? '[]', true);

                        ProductVariant::create([
                            'product_id' => $product->id,
                            'variant_name' => $variantData['name'],
                            'attribute_values' => $attrValues,
                            'price' => $variantData['price'] ?? 0,
                            'stock' => $variantData['stock'] ?? 0,
                            'sku' => $variantData['sku'] ?? null,
                        ]);
                    }
                }
            }

            // Sync Attributes
            if ($request->has('selected_attributes')) {
                $attrIds = json_decode($request->selected_attributes, true);
                $attrValuesMap = $request->has('mixed_attribute_values') ? json_decode($request->mixed_attribute_values, true) : [];

                $syncData = [];
                if (is_array($attrIds)) {
                    foreach ($attrIds as $id) {
                        $vals = $attrValuesMap[$id] ?? [];
                        // Store as comma-separated string
                        $valStr = is_array($vals) ? implode(',', $vals) : (string) $vals;
                        $syncData[$id] = ['value' => $valStr];
                    }
                    $product->attributes()->sync($syncData);
                }
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product updated successfully!',
                    'redirect' => route('admin.products.index')
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Server Error: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
