<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->paginate(10);
        return view('admin.sub_categories.index', compact('subCategories'));
    }

    public function show(SubCategory $subCategory)
    {
        $subCategory->load('category');
        return view('admin.sub_categories.show', compact('subCategory'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->has('status');
        $subCategory->save();

        return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', true)->get();
        return view('admin.sub_categories.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        if($request->name !== $subCategory->name) {
            $subCategory->slug = Str::slug($request->name);
        }
        $subCategory->status = $request->has('status');
        $subCategory->save();

        return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('admin.sub-categories.index')->with('success', 'SubCategory deleted successfully.');
    }
}
