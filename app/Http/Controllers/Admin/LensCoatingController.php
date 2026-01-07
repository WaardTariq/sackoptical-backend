<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LensCoating;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LensCoatingController extends Controller
{
    public function index()
    {
        $coatings = LensCoating::latest()->paginate(10);
        return view('admin.lens_coatings.index', compact('coatings'));
    }

    public function show(LensCoating $lensCoating)
    {
        return view('admin.lens_coatings.show', compact('lensCoating'));
    }

    public function create()
    {
        return view('admin.lens_coatings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $coating = new LensCoating();
        $coating->name = $request->name;
        $coating->slug = Str::slug($request->name);
        $coating->price = $request->price;
        $coating->tax_percentage = $request->tax_percentage ?? 0;
        $coating->description = $request->description;
        $coating->status = $request->has('status');
        $coating->save();

        return redirect()->route('admin.lens-coatings.index')->with('success', 'Coating created.');
    }

    public function edit(LensCoating $lensCoating)
    {
        return view('admin.lens_coatings.edit', compact('lensCoating'));
    }

    public function update(Request $request, LensCoating $lensCoating)
    {
        $request->validate([ 'name' => 'required', 'price' => 'required|numeric' ]);

        $lensCoating->name = $request->name;
        if($request->name !== $lensCoating->name) $lensCoating->slug = Str::slug($request->name);
        $lensCoating->price = $request->price;
        $lensCoating->tax_percentage = $request->tax_percentage;
        $lensCoating->description = $request->description;
        $lensCoating->status = $request->has('status');
        $lensCoating->save();

        return redirect()->route('admin.lens-coatings.index')->with('success', 'Coating updated.');
    }

    public function destroy(LensCoating $lensCoating)
    {
        $lensCoating->delete();
        return redirect()->route('admin.lens-coatings.index')->with('success', 'Coating deleted.');
    }
}
