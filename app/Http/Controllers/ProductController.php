<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $categoryId = $request->input('category');
        $status = $request->input('status');
        $stockStatus = $request->input('stock_status');

        $products = Product::query()
            ->with('category')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('product_code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when(
                $status === 'active',
                fn ($query) => $query->where('is_active', true)
            )
            ->when(
                $status === 'inactive',
                fn ($query) => $query->where('is_active', false)
            )
            ->when(
                $stockStatus === 'low',
                fn ($query) => $query->whereColumn(
                    'stock',
                    '<=',
                    'minimum_stock'
                )
            )
            ->when(
                $stockStatus === 'safe',
                fn ($query) => $query->whereColumn(
                    'stock',
                    '>',
                    'minimum_stock'
                )
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        $totalProducts = Product::count();

        $activeProducts = Product::where('is_active', true)->count();

        $lowStockProducts = Product::query()
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->count();

        $totalStock = Product::sum('stock');

        return view('products.index', compact(
            'products',
            'categories',
            'search',
            'categoryId',
            'status',
            'stockStatus',
            'totalProducts',
            'activeProducts',
            'lowStockProducts',
            'totalStock'
        ));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category_id' => [
                    'required',
                    'exists:categories,id',
                ],
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'price' => [
                    'required',
                    'numeric',
                    'min:0',
                    'max:9999999999.99',
                ],
                'stock' => [
                    'required',
                    'integer',
                    'min:0',
                ],
                'minimum_stock' => [
                    'required',
                    'integer',
                    'min:0',
                ],
                'is_active' => [
                    'required',
                    'boolean',
                ],
            ],
            [
                'category_id.required' => 'Kategori produk wajib dipilih.',
                'category_id.exists' => 'Kategori produk tidak valid.',

                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 255 karakter.',

                'price.required' => 'Harga produk wajib diisi.',
                'price.numeric' => 'Harga produk harus berupa angka.',
                'price.min' => 'Harga produk tidak boleh kurang dari 0.',
                'price.max' => 'Harga produk terlalu besar.',

                'stock.required' => 'Stok awal produk wajib diisi.',
                'stock.integer' => 'Stok awal harus berupa bilangan bulat.',
                'stock.min' => 'Stok awal tidak boleh kurang dari 0.',

                'minimum_stock.required' => 'Minimum stok wajib diisi.',
                'minimum_stock.integer' => 'Minimum stok harus berupa bilangan bulat.',
                'minimum_stock.min' => 'Minimum stok tidak boleh kurang dari 0.',

                'is_active.required' => 'Status produk wajib dipilih.',
                'is_active.boolean' => 'Status produk tidak valid.',
            ]
        );

        DB::transaction(function () use ($validated) {

            $initialStock = (int) $validated['stock'];

            $product = Product::create([
                'category_id' => $validated['category_id'],
                'product_code' => $this->generateProductCode(),
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $initialStock,
                'minimum_stock' => $validated['minimum_stock'],
                'is_active' => $validated['is_active'],
            ]);

            /*
             * Jika produk mempunyai stok awal, catat juga
             * sebagai riwayat persediaan.
             */
            if ($initialStock > 0) {
                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'sale_id' => null,
                    'movement_type' => 'in',
                    'quantity' => $initialStock,
                    'notes' => 'Stok awal produk.',
                ]);
            }
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail produk.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'stockMovements' => function ($query) {
                $query->with('user')
                    ->latest()
                    ->limit(10);
            },
        ]);

        $totalSold = $product->saleItems()
            ->whereHas('sale', function ($query) {
                $query->where('status', 'completed');
            })
            ->sum('quantity');

        $totalRevenue = $product->saleItems()
            ->whereHas('sale', function ($query) {
                $query->where('status', 'completed');
            })
            ->sum('subtotal');

        return view('products.show', compact(
            'product',
            'totalSold',
            'totalRevenue'
        ));
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    /**
     * Memperbarui informasi produk.
     *
     * Stok tidak diubah dari halaman edit produk.
     * Perubahan stok nantinya dilakukan melalui
     * modul Persediaan agar riwayat stok tetap tercatat.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'product_code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'product_code')
                        ->ignore($product->id),
                ],
                'category_id' => [
                    'required',
                    'exists:categories,id',
                ],
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'price' => [
                    'required',
                    'numeric',
                    'min:0',
                    'max:9999999999.99',
                ],
                'minimum_stock' => [
                    'required',
                    'integer',
                    'min:0',
                ],
                'is_active' => [
                    'required',
                    'boolean',
                ],
            ],
            [
                'product_code.required' => 'Kode produk wajib diisi.',
                'product_code.string' => 'Kode produk harus berupa teks.',
                'product_code.max' => 'Kode produk maksimal 255 karakter.',
                'product_code.unique' => 'Kode produk sudah digunakan.',

                'category_id.required' => 'Kategori produk wajib dipilih.',
                'category_id.exists' => 'Kategori produk tidak valid.',

                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 255 karakter.',

                'price.required' => 'Harga produk wajib diisi.',
                'price.numeric' => 'Harga produk harus berupa angka.',
                'price.min' => 'Harga produk tidak boleh kurang dari 0.',
                'price.max' => 'Harga produk terlalu besar.',

                'minimum_stock.required' => 'Minimum stok wajib diisi.',
                'minimum_stock.integer' => 'Minimum stok harus berupa bilangan bulat.',
                'minimum_stock.min' => 'Minimum stok tidak boleh kurang dari 0.',

                'is_active.required' => 'Status produk wajib dipilih.',
                'is_active.boolean' => 'Status produk tidak valid.',
            ]
        );

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk.
     */
    public function destroy(Product $product)
    {
        /*
         * Produk yang sudah mempunyai riwayat transaksi
         * tidak boleh dihapus karena merupakan data historis.
         */
        if ($product->saleItems()->exists()) {
            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi penjualan.'
                );
        }

        DB::transaction(function () use ($product) {

            /*
             * Stock movement produk dihapus terlebih dahulu.
             * Ini hanya dilakukan untuk produk yang belum pernah
             * digunakan dalam transaksi penjualan.
             */
            $product->stockMovements()->delete();

            $product->delete();
        });

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Membuat kode produk otomatis.
     *
     * Contoh:
     * PROD001
     * PROD002
     * PROD003
     */
    private function generateProductCode(): string
    {
        $lastProduct = Product::query()
            ->where('product_code', 'like', 'PROD%')
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;

        if ($lastProduct) {
            $lastNumber = (int) preg_replace(
                '/[^0-9]/',
                '',
                $lastProduct->product_code
            );

            $nextNumber = $lastNumber + 1;
        }

        do {
            $productCode = 'PROD' . str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );

            $exists = Product::where(
                'product_code',
                $productCode
            )->exists();

            $nextNumber++;
        } while ($exists);

        return $productCode;
    }
}