<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_brand_' . Str::random(5) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('brands', $logoName, 'public');
            $brand->logo = 'storage/' . $path;
        }

        $brand->status = $request->has('status'); // toggle
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->name = $request->name;
        if ($request->name !== $brand->name) {
            $brand->slug = Str::slug($request->name);
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($brand->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $brand->logo))) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $brand->logo));
            }

            $logo = $request->file('logo');
            $logoName = time() . '_brand_' . Str::random(5) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('brands', $logoName, 'public');
            $brand->logo = 'storage/' . $path;
        }

        $brand->status = $request->has('status');
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
