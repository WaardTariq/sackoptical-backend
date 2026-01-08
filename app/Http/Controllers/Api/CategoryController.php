<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories with optional filters.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Filter by status (only active by default)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', true);
        }

        // Filter featured categories
        if ($request->has('featured') && $request->featured == '1') {
            $query->where('is_featured', true);
        }

        // Include subcategories if requested
        if ($request->has('with_subcategories') && $request->with_subcategories == '1') {
            $query->with(['subCategories' => function ($q) {
                $q->where('status', true);
            }]);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $categories = $query->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Categories retrieved successfully',
            'data' => [
                'categories' => $categories->items(),
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ]
            ]
        ], 200);
    }

    /**
     * Get a single category by ID or slug.
     */
    public function show(Request $request, $identifier)
    {
        $category = Category::where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->first();

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }

        // Load subcategories if requested
        if ($request->has('with_subcategories') && $request->with_subcategories == '1') {
            $category->load(['subCategories' => function ($q) {
                $q->where('status', true);
            }]);
        }

        // Load products count if requested
        if ($request->has('with_products_count') && $request->with_products_count == '1') {
            $category->loadCount('products');
        }

        return response()->json([
            'status' => true,
            'message' => 'Category retrieved successfully',
            'data' => [
                'category' => $category
            ]
        ], 200);
    }

    /**
     * Get featured categories.
     */
    public function featured()
    {
        $categories = Category::where('status', true)
            ->where('is_featured', true)
            ->with(['subCategories' => function ($q) {
                $q->where('status', true);
            }])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Featured categories retrieved successfully',
            'data' => [
                'categories' => $categories
            ]
        ], 200);
    }

    /**
     * Get all subcategories.
     */
    public function subcategories(Request $request)
    {
        $query = SubCategory::with('category');

        // Filter by category_id
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status (only active by default)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', true);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $subCategories = $query->latest()->paginate($perPage);

        return response()->json([
            'status' => true,
            'message' => 'Subcategories retrieved successfully',
            'data' => [
                'subcategories' => $subCategories->items(),
                'pagination' => [
                    'current_page' => $subCategories->currentPage(),
                    'last_page' => $subCategories->lastPage(),
                    'per_page' => $subCategories->perPage(),
                    'total' => $subCategories->total(),
                ]
            ]
        ], 200);
    }

    /**
     * Get a single subcategory by ID or slug.
     */
    public function showSubcategory(Request $request, $identifier)
    {
        $subCategory = SubCategory::where('id', $identifier)
            ->orWhere('slug', $identifier)
            ->with('category')
            ->first();

        if (!$subCategory) {
            return response()->json([
                'status' => false,
                'message' => 'Subcategory not found'
            ], 404);
        }

        // Load products count if requested
        if ($request->has('with_products_count') && $request->with_products_count == '1') {
            $subCategory->loadCount('products');
        }

        return response()->json([
            'status' => true,
            'message' => 'Subcategory retrieved successfully',
            'data' => [
                'subcategory' => $subCategory
            ]
        ], 200);
    }

    /**
     * Get subcategories by category ID or slug.
     */
    public function subcategoriesByCategory(Request $request, $categoryIdentifier)
    {
        $category = Category::where('id', $categoryIdentifier)
            ->orWhere('slug', $categoryIdentifier)
            ->first();

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $query = $category->subCategories();

        // Filter by status (only active by default)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        } else {
            $query->where('status', true);
        }

        $subCategories = $query->latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Subcategories retrieved successfully',
            'data' => [
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                ],
                'subcategories' => $subCategories
            ]
        ], 200);
    }
}
