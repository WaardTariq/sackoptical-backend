<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\CentralLogics\Helpers;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        // return $categories;
        return view('admin.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $category->image = Helpers::customUpload('categories', $request->file('image'));
        }

        $category->is_featured = $request->has('is_featured');
        $category->status = $request->has('status');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->name !== $category->name) {
            $category->slug = Str::slug($request->name);
        }
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            // Extract old filename from path (handle both formats: just filename or full path)
            $oldFile = $category->image;
            if ($oldFile) {
                // If stored as full path like "storage/categories/filename.png", extract just "filename.png"
                if (strpos($oldFile, '/') !== false) {
                    $oldFile = basename($oldFile);
                }
            }

            // Use Helpers::customUpdate which handles old file deletion and returns just filename
            $category->image = Helpers::customUpdate('categories', $request->file('image'), $oldFile);
        }

        $category->is_featured = $request->has('is_featured');
        $category->status = $request->has('status');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
