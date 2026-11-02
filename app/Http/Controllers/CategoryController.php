<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('master-data.category.index', compact('categories'));
    }
    
    public function create()
    {
        return view('master-data.category.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:255',
        ]);
    
        Category::create($validated);
    
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
{
    return view('master-data.category.edit', compact('category'));
}

//TUGAS PRAKTIKUM 9
public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'nullable|string',
    ]);

    $category->update($validated);

    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil diperbarui.');
}

public function destroy(Category $category)
{
    if ($category->products()->exists()) {
        return redirect()->route('categories.index')
            ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
    }

    $category->delete();

    return redirect()->route('categories.index')
        ->with('success', 'Kategori berhasil dihapus.');
}


}
