<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "category_name" => "required|string",
            "description" => "required|string",
            "status" => "required|string",
        ]);

        Category::create($data);

        return to_route("category.index")->with("success", "Category created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            "category_name" => "required|string",
            "description" => "required|string",
            "status" => "required|string",
        ]);

        $category->update($data);

        return to_route("category.show", $category)->with("success", "Category updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route("category.index")->with("success", "Category deleted successfully!");
    }
}
