<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::latest()->paginate(10);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show', compact('attribute'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->slug = Str::slug($request->name);
        $attribute->values = null;
        $attribute->status = $request->has('status');
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute created successfully.');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attribute->name = $request->name;
        if($request->name !== $attribute->name) {
            $attribute->slug = Str::slug($request->name);
        }
        $attribute->values = null;
        $attribute->status = $request->has('status');
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute updated successfully.');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.attributes.index')->with('success', 'Attribute deleted successfully.');
    }
}
