<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product-categories.index', [
            'categories' => ProductCategory::all(),
            'title' => 'Product Categories'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product-categories.create', [
            'title' => 'Create New Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:product_categories',
            'slug' => 'required|unique:product_categories'
        ]);

        ProductCategory::create($validatedData);

        return redirect('/admin/product-categories')->with('success', 'New category has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', [
            'title' => 'Edit Category',
            'category' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $rules = [
            'name' => 'required|unique:product_categories',
            'slug' => 'required|unique:product_categories'
        ];

        $validatedData = $request->validate($rules);

        ProductCategory::where('id', $productCategory->id)
            ->update($validatedData);

        return redirect('/admin/product-categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        ProductCategory::destroy($productCategory->id);

        return redirect('/admin/product-categories')->with('success', 'Category has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
