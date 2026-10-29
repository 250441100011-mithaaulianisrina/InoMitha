<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori produk.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));

        $categories = Category::query()
            ->withCount('products')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalCategories = Category::count();

        $totalProducts = Category::query()
            ->withCount('products')
            ->get()
            ->sum('products_count');

        return view('categories.index', compact(
            'categories',
            'search',
            'totalCategories',
            'totalProducts'
        ));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:categories,name',
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.string' => 'Nama kategori harus berupa teks.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
                'name.unique' => 'Nama kategori sudah digunakan.',

                'description.string' => 'Deskripsi kategori harus berupa teks.',
                'description.max' => 'Deskripsi kategori maksimal 1000 karakter.',
            ]
        );

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori.
     */
    public function show(Category $category)
    {
        $category->load([
            'products' => function ($query) {
                $query->latest();
            },
        ]);

        $totalProducts = $category->products->count();

        $activeProducts = $category->products
            ->where('is_active', true)
            ->count();

        $lowStockProducts = $category->products
            ->filter(function ($product) {
                return $product->stock <= $product->minimum_stock;
            })
            ->count();

        return view('categories.show', compact(
            'category',
            'totalProducts',
            'activeProducts',
            'lowStockProducts'
        ));
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories', 'name')
                        ->ignore($category->id),
                ],
                'description' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.string' => 'Nama kategori harus berupa teks.',
                'name.max' => 'Nama kategori maksimal 255 karakter.',
                'name.unique' => 'Nama kategori sudah digunakan.',

                'description.string' => 'Deskripsi kategori harus berupa teks.',
                'description.max' => 'Deskripsi kategori maksimal 1000 karakter.',
            ]
        );

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih digunakan oleh produk.'
                );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }
}