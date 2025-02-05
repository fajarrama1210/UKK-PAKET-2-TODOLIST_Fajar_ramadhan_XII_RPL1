<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchKeyword = $request->input('search_keyword');

        $categories = Category::when($searchKeyword, function ($query, $searchKeyword) {
            return $query->where('name', 'LIKE', '%' . $searchKeyword . '%');
        })->paginate(10);

        return view('admin.category.list', compact('categories'));
    }
    public function indexUser(Request $request)
    {
        $searchKeyword = $request->input('search_keyword');

        $categories = Category::when($searchKeyword, function ($query, $searchKeyword) {
            return $query->where('name', 'LIKE', '%' . $searchKeyword . '%');
        })->paginate(10);

        return view('user.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        // Redirect ke halaman list dengan pesan sukses
        return redirect()->route('admin.category.list')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        // Redirect ke halaman list dengan pesan sukses
        return redirect()->route('admin.category.list')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $taskCount = \App\Models\Task::where('category_id', $category->id)->count();

        if ($taskCount > 0) {
            // Mengirimkan pesan error dengan session, bukan withErrors
            return redirect()->route('admin.category.list')->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan di task');
        }

        $category->delete();
        return redirect()->route('admin.category.list')->with('success', 'Kategori berhasil dihapus');
    }
}
