<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Menampilkan halaman utama persediaan.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search'));
        $stockStatus = $request->input('stock_status');

        $products = Product::query()
            ->with('category')

            // Pencarian produk
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where(
                        'product_code',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhereHas(
                        'category',
                        function ($query) use ($search) {
                            $query->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );
                        }
                    );
                });
            })

            /*
            |--------------------------------------------------------------------------
            | Filter Kondisi Stok
            |--------------------------------------------------------------------------
            |
            | Stok Aman:
            | stock > minimum_stock
            |
            | Stok Menipis:
            | stock > 0 DAN stock <= minimum_stock
            |
            | Stok Habis:
            | stock = 0
            |
            */

            // Stok aman
            ->when(
                $stockStatus === 'safe',
                function ($query) {
                    $query->whereColumn(
                        'stock',
                        '>',
                        'minimum_stock'
                    );
                }
            )

            // Stok menipis
            ->when(
                $stockStatus === 'low',
                function ($query) {
                    $query->where(
                        'stock',
                        '>',
                        0
                    )
                    ->whereColumn(
                        'stock',
                        '<=',
                        'minimum_stock'
                    );
                }
            )

            // Stok habis
            ->when(
                $stockStatus === 'out',
                function ($query) {
                    $query->where(
                        'stock',
                        0
                    );
                }
            )

            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Ringkasan Persediaan
        |--------------------------------------------------------------------------
        */

        // Jumlah seluruh produk
        $totalProducts = Product::count();

        // Total seluruh unit stok
        $totalStock = Product::sum('stock');

        /*
         * Stok menipis hanya menghitung produk
         * yang stoknya masih lebih dari 0,
         * tetapi sudah mencapai atau berada
         * di bawah minimum stok.
         */
        $lowStockProducts = Product::query()
            ->where(
                'stock',
                '>',
                0
            )
            ->whereColumn(
                'stock',
                '<=',
                'minimum_stock'
            )
            ->count();

        /*
         * Stok habis hanya menghitung produk
         * yang benar-benar memiliki stok 0.
         */
        $outOfStockProducts = Product::query()
            ->where(
                'stock',
                0
            )
            ->count();


        return view(
            'inventory.index',
            compact(
                'products',
                'search',
                'stockStatus',
                'totalProducts',
                'totalStock',
                'lowStockProducts',
                'outOfStockProducts'
            )
        );
    }


    /**
     * Menampilkan form stok masuk.
     */
    public function createStockIn()
    {
        $products = Product::query()
            ->with('category')
            ->where(
                'is_active',
                true
            )
            ->orderBy('name')
            ->get();

        return view(
            'inventory.stock-in',
            compact('products')
        );
    }


    /**
     * Menyimpan stok masuk.
     */
    public function storeStockIn(Request $request)
    {
        $validated = $request->validate(
            [
                'product_id' => [
                    'required',
                    'exists:products,id',
                ],

                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'notes' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'product_id.required' =>
                    'Produk wajib dipilih.',

                'product_id.exists' =>
                    'Produk yang dipilih tidak valid.',

                'quantity.required' =>
                    'Jumlah stok masuk wajib diisi.',

                'quantity.integer' =>
                    'Jumlah stok harus berupa bilangan bulat.',

                'quantity.min' =>
                    'Jumlah stok masuk minimal 1 unit.',

                'notes.string' =>
                    'Keterangan harus berupa teks.',

                'notes.max' =>
                    'Keterangan maksimal 1000 karakter.',
            ]
        );


        DB::transaction(function () use ($validated) {

            /*
             * Produk dikunci selama transaksi berlangsung
             * agar perubahan stok lebih aman jika terdapat
             * beberapa proses pada waktu yang hampir bersamaan.
             */
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail(
                    $validated['product_id']
                );

            $quantity =
                (int) $validated['quantity'];


            /*
             * Menambahkan stok produk.
             */
            $product->increment(
                'stock',
                $quantity
            );


            /*
             * Mencatat riwayat stok masuk.
             */
            StockMovement::create([
                'product_id' =>
                    $product->id,

                'user_id' =>
                    auth()->id(),

                'sale_id' =>
                    null,

                'movement_type' =>
                    'in',

                'quantity' =>
                    $quantity,

                'notes' =>
                    $validated['notes']
                    ?: 'Penambahan stok melalui modul Persediaan.',
            ]);
        });


        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                'Stok produk berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan form stok keluar manual.
     */
    public function createStockOut()
    {
        /*
         * Hanya produk aktif yang masih memiliki
         * stok yang dapat dipilih.
         */
        $products = Product::query()
            ->with('category')
            ->where(
                'is_active',
                true
            )
            ->where(
                'stock',
                '>',
                0
            )
            ->orderBy('name')
            ->get();


        return view(
            'inventory.stock-out',
            compact('products')
        );
    }


    /**
     * Menyimpan stok keluar manual.
     */
    public function storeStockOut(Request $request)
    {
        $validated = $request->validate(
            [
                'product_id' => [
                    'required',
                    'exists:products,id',
                ],

                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'notes' => [
                    'required',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'product_id.required' =>
                    'Produk wajib dipilih.',

                'product_id.exists' =>
                    'Produk yang dipilih tidak valid.',

                'quantity.required' =>
                    'Jumlah stok keluar wajib diisi.',

                'quantity.integer' =>
                    'Jumlah stok harus berupa bilangan bulat.',

                'quantity.min' =>
                    'Jumlah stok keluar minimal 1 unit.',

                'notes.required' =>
                    'Alasan stok keluar wajib diisi.',

                'notes.string' =>
                    'Keterangan harus berupa teks.',

                'notes.max' =>
                    'Keterangan maksimal 1000 karakter.',
            ]
        );


        $errorMessage = null;


        DB::transaction(
            function () use (
                $validated,
                &$errorMessage
            ) {

                /*
                 * Mengunci data produk selama proses
                 * pengurangan stok.
                 */
                $product = Product::query()
                    ->lockForUpdate()
                    ->findOrFail(
                        $validated['product_id']
                    );

                $quantity =
                    (int) $validated['quantity'];


                /*
                 * Stok keluar tidak boleh lebih besar
                 * daripada stok yang tersedia.
                 */
                if ($quantity > $product->stock) {

                    $errorMessage =
                        'Stok keluar tidak dapat diproses karena jumlah melebihi stok yang tersedia.';

                    return;
                }


                /*
                 * Mengurangi stok produk.
                 */
                $product->decrement(
                    'stock',
                    $quantity
                );


                /*
                 * Mencatat riwayat stok keluar.
                 *
                 * Quantity tetap disimpan sebagai angka
                 * positif karena arah pergerakan stok
                 * ditentukan oleh movement_type = out.
                 */
                StockMovement::create([
                    'product_id' =>
                        $product->id,

                    'user_id' =>
                        auth()->id(),

                    'sale_id' =>
                        null,

                    'movement_type' =>
                        'out',

                    'quantity' =>
                        $quantity,

                    'notes' =>
                        $validated['notes'],
                ]);
            }
        );


        /*
         * Jika stok tidak mencukupi,
         * pengguna dikembalikan ke form.
         */
        if ($errorMessage) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $errorMessage
                );
        }


        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                'Stok keluar berhasil dicatat.'
            );
    }


    /**
     * Menampilkan seluruh riwayat pergerakan stok.
     */
    public function history(Request $request)
    {
        $search =
            trim(
                (string) $request->input('search')
            );

        $type =
            $request->input('type');


        $movements = StockMovement::query()

            ->with([
                'product.category',
                'user',
                'sale',
            ])

            /*
             * Pencarian berdasarkan kode produk,
             * nama produk, atau keterangan.
             */
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        function ($query) use ($search) {

                            $query->whereHas(
                                'product',
                                function ($query) use ($search) {

                                    $query->where(
                                        'product_code',
                                        'like',
                                        "%{$search}%"
                                    )
                                    ->orWhere(
                                        'name',
                                        'like',
                                        "%{$search}%"
                                    );
                                }
                            )
                            ->orWhere(
                                'notes',
                                'like',
                                "%{$search}%"
                            );
                        }
                    );
                }
            )

            /*
             * Filter jenis pergerakan stok:
             * in  = stok masuk
             * out = stok keluar
             */
            ->when(
                $type,
                function ($query) use ($type) {

                    $query->where(
                        'movement_type',
                        $type
                    );
                }
            )

            ->latest()
            ->paginate(15)
            ->withQueryString();


        return view(
            'inventory.history',
            compact(
                'movements',
                'search',
                'type'
            )
        );
    }
}