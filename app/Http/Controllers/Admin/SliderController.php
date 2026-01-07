<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'secondary_image' => 'nullable|image|mimes:png,webp|max:2048', // PNG/WebP preferred for transparency
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:50',
            'link' => 'nullable|string|max:255',
            'text_alignment' => 'required|in:left,center,right',
            'sort_order' => 'nullable|integer',
        ]);

        $input = $request->except(['image', 'secondary_image']);
        $input['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_slider_bg_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('sliders', $imageName, 'public');
            $input['image'] = 'storage/' . $path;
        }

        if ($request->hasFile('secondary_image')) {
            $image = $request->file('secondary_image');
            $imageName = time() . '_slider_sec_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('sliders', $imageName, 'public');
            $input['secondary_image'] = 'storage/' . $path;
        }

        Slider::create($input);

        return redirect()->route('admin.sliders.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'secondary_image' => 'nullable|image|mimes:png,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:50',
            'link' => 'nullable|string|max:255',
            'text_alignment' => 'required|in:left,center,right',
            'sort_order' => 'nullable|integer',
        ]);

        $input = $request->except(['image', 'secondary_image']);
        $input['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            if ($slider->image && Storage::disk('public')->exists(str_replace('storage/', '', $slider->image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $slider->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_slider_bg_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('sliders', $imageName, 'public');
            $input['image'] = 'storage/' . $path;
        }

        if ($request->hasFile('secondary_image')) {
            if ($slider->secondary_image && Storage::disk('public')->exists(str_replace('storage/', '', $slider->secondary_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $slider->secondary_image));
            }
            $image = $request->file('secondary_image');
            $imageName = time() . '_slider_sec_' . Str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('sliders', $imageName, 'public');
            $input['secondary_image'] = 'storage/' . $path;
        }

        $slider->update($input);

        return redirect()->route('admin.sliders.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && Storage::disk('public')->exists(str_replace('storage/', '', $slider->image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $slider->image));
        }
        if ($slider->secondary_image && Storage::disk('public')->exists(str_replace('storage/', '', $slider->secondary_image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $slider->secondary_image));
        }

        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Banner deleted successfully.');
    }
}
