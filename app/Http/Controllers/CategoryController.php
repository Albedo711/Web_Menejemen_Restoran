<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori
        $categories = Category::all();
    
        // Mengirimkan data kategori ke view 'category'
        return view('category', compact('categories')); // pastikan 'categories' di sini sesuai dengan nama variabel
    }

    public function destroy($id)
{
    // Temukan kategori berdasarkan ID
    $category = Category::findOrFail($id);

    // Hapus kategori
    $category->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('home')->with('success', 'Category deleted successfully!');
}


    // Menampilkan form untuk membuat kategori
    public function create()
    {
        return view('posts.create_category');
    }

    // Menyimpan kategori ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Menyimpan kategori ke database
        Category::create([
            'category_name' => $request->category_name,
        ]);

        // Redirect ke halaman form create dengan pesan sukses
        return redirect()->route('categories.create')->with('success', 'Category created successfully!');
    }
}
