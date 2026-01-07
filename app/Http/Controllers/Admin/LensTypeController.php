<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LensType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LensTypeController extends Controller
{
    public function index()
    {
        $lensTypes = LensType::latest()->paginate(10);
        return view('admin.lens_types.index', compact('lensTypes'));
    }

    public function show(LensType $lensType)
    {
        return view('admin.lens_types.show', compact('lensType'));
    }

    public function create()
    {
        return view('admin.lens_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_modifier' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $lensType = new LensType();
        $lensType->name = $request->name;
        $lensType->slug = Str::slug($request->name);
        $lensType->price_modifier = $request->price_modifier;

        if ($request->hasFile('image')) {
            $imageValue = $request->file('image');
            $imageName = time() . '_lens_' . Str::random(5) . '.' . $imageValue->getClientOriginalExtension();
            $path = $imageValue->storeAs('lenses', $imageName, 'public');
            $lensType->image = 'storage/' . $path;
        }

        $lensType->description = $request->description;
        $lensType->status = $request->has('status');
        $lensType->save();

        return redirect()->route('admin.lens-types.index')->with('success', 'Lens Type created.');
    }

    public function edit(LensType $lensType)
    {
        return view('admin.lens_types.edit', compact('lensType'));
    }

    public function update(Request $request, LensType $lensType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_modifier' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->name !== $lensType->name) {
            $lensType->slug = Str::slug($request->name);
        }
        $lensType->name = $request->name;
        $lensType->price_modifier = $request->price_modifier;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($lensType->image && \Illuminate\Support\Facades\Storage::disk('public')->exists(str_replace('storage/', '', $lensType->image))) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('storage/', '', $lensType->image));
            }

            $imageValue = $request->file('image');
            $imageName = time() . '_lens_' . Str::random(5) . '.' . $imageValue->getClientOriginalExtension();
            $path = $imageValue->storeAs('lenses', $imageName, 'public');
            $lensType->image = 'storage/' . $path;
        }

        $lensType->description = $request->description;
        $lensType->status = $request->has('status');
        $lensType->save();

        return redirect()->route('admin.lens-types.index')->with('success', 'Lens Type updated.');
    }

    public function destroy(LensType $lensType)
    {
        $lensType->delete();
        return redirect()->route('admin.lens-types.index')->with('success', 'Lens Type deleted.');
    }
}
