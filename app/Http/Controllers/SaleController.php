<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    /**
     * Menampilkan daftar transaksi penjualan.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Nilai Filter
        |--------------------------------------------------------------------------
        |
        | Semua variabel dibuat dari awal supaya selalu tersedia
        | di halaman sales.index, meskipun filter belum digunakan.
        |
        */
        $search = $request->input('search', '');
        $status = $request->input('status', '');
        $dateFrom = $request->input('date_from', '');
        $dateTo = $request->input('date_to', '');

        /*
        |--------------------------------------------------------------------------
        | Query Utama
        |--------------------------------------------------------------------------
        */
        $query = Sale::query()
            ->with([
                'customer',
                'user',
            ])
            ->withCount('items');

        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */
        if ($search !== '') {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'invoice_number',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'customer',
                    function ($customerQuery) use ($search) {

                        $customerQuery
                            ->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'customer_code',
                                'like',
                                "%{$search}%"
                            );

                    }
                )

                ->orWhereHas(
                    'user',
                    function ($userQuery) use ($search) {

                        $userQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    }
                );

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */
        if ($status !== '') {

            $query->where(
                'status',
                $status
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal Mulai
        |--------------------------------------------------------------------------
        */
        if ($dateFrom !== '') {

            $query->whereDate(
                'sale_date',
                '>=',
                $dateFrom
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal Akhir
        |--------------------------------------------------------------------------
        */
        if ($dateTo !== '') {

            $query->whereDate(
                'sale_date',
                '<=',
                $dateTo
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Daftar Transaksi
        |--------------------------------------------------------------------------
        */
        $sales = $query
            ->latest('sale_date')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistik Semua Penjualan Berhasil
        |--------------------------------------------------------------------------
        |
        | Transaksi dengan status cancelled tidak dihitung sebagai
        | transaksi penjualan yang berhasil.
        |
        */
        $totalTransactions = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->count();

        $totalSales = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->sum('total_amount');

        /*
        |--------------------------------------------------------------------------
        | Statistik Penjualan Hari Ini
        |--------------------------------------------------------------------------
        */
        $todayTransactions = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->whereDate(
                'sale_date',
                today()
            )
            ->count();

        $todaySales = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->whereDate(
                'sale_date',
                today()
            )
            ->sum('total_amount');

        /*
        |--------------------------------------------------------------------------
        | Kirim Semua Data ke View
        |--------------------------------------------------------------------------
        */
        return view(
            'sales.index',
            compact(
                'sales',
                'totalTransactions',
                'totalSales',
                'todayTransactions',
                'todaySales',
                'search',
                'status',
                'dateFrom',
                'dateTo'
            )
        );
    }


    /**
     * Menampilkan form transaksi baru.
     */
    public function create()
    {
        $customers = Customer::query()
            ->orderBy('name')
            ->get();

        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->get();

        $invoicePreview =
            $this->generateInvoiceNumber();

        return view(
            'sales.create',
            compact(
                'customers',
                'products',
                'invoicePreview'
            )
        );
    }


    /**
     * Menyimpan transaksi penjualan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'customer_id' => [
                    'nullable',
                    'exists:customers,id',
                ],

                'sale_date' => [
                    'required',
                    'date',
                ],

                'products' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'products.*.product_id' => [
                    'required',
                    'exists:products,id',
                ],

                'products.*.quantity' => [
                    'required',
                    'integer',
                    'min:1',
                ],
            ],
            [
                'sale_date.required' =>
                    'Tanggal transaksi wajib diisi.',

                'sale_date.date' =>
                    'Tanggal transaksi tidak valid.',

                'products.required' =>
                    'Minimal satu produk harus dipilih.',

                'products.array' =>
                    'Data produk tidak valid.',

                'products.min' =>
                    'Minimal satu produk harus dipilih.',

                'products.*.product_id.required' =>
                    'Produk wajib dipilih.',

                'products.*.product_id.exists' =>
                    'Produk yang dipilih tidak ditemukan.',

                'products.*.quantity.required' =>
                    'Jumlah produk wajib diisi.',

                'products.*.quantity.integer' =>
                    'Jumlah produk harus berupa angka bulat.',

                'products.*.quantity.min' =>
                    'Jumlah produk minimal 1.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Gabungkan produk yang sama
        |--------------------------------------------------------------------------
        |
        | Ini menjadi pengamanan tambahan apabila produk yang sama
        | dikirim lebih dari satu kali dari frontend.
        |
        */
        $items = collect($validated['products'])
            ->groupBy('product_id')
            ->map(function ($group, $productId) {
                return [
                    'product_id' => (int) $productId,
                    'quantity' => (int) $group->sum('quantity'),
                ];
            })
            ->values();

        $sale = DB::transaction(
            function () use (
                $validated,
                $items
            ) {
                /*
                |--------------------------------------------------------------------------
                | Buat transaksi
                |--------------------------------------------------------------------------
                */
                $sale = Sale::create([
                    'invoice_number' =>
                        $this->generateInvoiceNumber(),

                    'customer_id' =>
                        $validated['customer_id'] ?? null,

                    'user_id' =>
                        auth()->id(),

                    'sale_date' =>
                        $validated['sale_date'],

                    'total_amount' =>
                        0,

                    'status' =>
                        'completed',
                ]);

                $grandTotal = 0;

                /*
                |--------------------------------------------------------------------------
                | Proses setiap produk
                |--------------------------------------------------------------------------
                */
                foreach ($items as $item) {
                    $product = Product::query()
                        ->lockForUpdate()
                        ->findOrFail(
                            $item['product_id']
                        );

                    /*
                    |--------------------------------------------------------------------------
                    | Pastikan produk masih aktif
                    |--------------------------------------------------------------------------
                    */
                    if (!$product->is_active) {
                        throw ValidationException::withMessages([
                            'products' =>
                                "Produk {$product->name} sedang tidak aktif.",
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Pastikan stok mencukupi
                    |--------------------------------------------------------------------------
                    */
                    if (
                        $item['quantity'] >
                        $product->stock
                    ) {
                        throw ValidationException::withMessages([
                            'products' =>
                                "Stok produk {$product->name} tidak mencukupi. "
                                . "Stok tersedia: {$product->stock}.",
                        ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Harga harus diambil dari database
                    |--------------------------------------------------------------------------
                    */
                    $unitPrice =
                        (float) $product->price;

                    $subtotal =
                        $unitPrice *
                        $item['quantity'];

                    /*
                    |--------------------------------------------------------------------------
                    | Simpan detail transaksi
                    |--------------------------------------------------------------------------
                    */
                    SaleItem::create([
                        'sale_id' =>
                            $sale->id,

                        'product_id' =>
                            $product->id,

                        'quantity' =>
                            $item['quantity'],

                        'unit_price' =>
                            $unitPrice,

                        'subtotal' =>
                            $subtotal,
                    ]);

                    /*
                    |--------------------------------------------------------------------------
                    | Kurangi stok
                    |--------------------------------------------------------------------------
                    */
                    $product->decrement(
                        'stock',
                        $item['quantity']
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Catat stok keluar
                    |--------------------------------------------------------------------------
                    */
                    StockMovement::create([
                        'product_id' =>
                            $product->id,

                        'user_id' =>
                            auth()->id(),

                        'sale_id' =>
                            $sale->id,

                        'movement_type' =>
                            'out',

                        'quantity' =>
                            $item['quantity'],

                        'notes' =>
                            'Penjualan '
                            . $sale->invoice_number,
                    ]);

                    $grandTotal +=
                        $subtotal;
                }

                /*
                |--------------------------------------------------------------------------
                | Simpan total transaksi
                |--------------------------------------------------------------------------
                */
                $sale->update([
                    'total_amount' =>
                        $grandTotal,
                ]);

                return $sale;
            }
        );

        return redirect()
            ->route(
                'sales.show',
                $sale
            )
            ->with(
                'success',
                'Transaksi berhasil disimpan.'
            );
    }


    /**
     * Menampilkan detail transaksi.
     */
    public function show(Sale $sale)
    {
        $sale->load([
            'customer',
            'user',
            'items.product.category',
        ]);

        return view(
            'sales.show',
            compact('sale')
        );
    }


    /**
     * Membatalkan transaksi penjualan.
     *
     * Transaksi tidak dihapus. Status diubah menjadi cancelled
     * dan seluruh stok produk dikembalikan.
     *
     * Method ini mendukung:
     * - request biasa dengan redirect
     * - request Fetch/AJAX dengan JSON
     */
    public function cancel(
        Request $request,
        Sale $sale
    ) {
        /*
        |--------------------------------------------------------------------------
        | Cegah pembatalan berulang
        |--------------------------------------------------------------------------
        */
        if ($sale->status === 'cancelled') {

            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' =>
                            'Transaksi ini sudah dibatalkan sebelumnya.',
                    ],
                    422
                );
            }

            return redirect()
                ->route(
                    'sales.show',
                    $sale
                )
                ->with(
                    'error',
                    'Transaksi ini sudah dibatalkan sebelumnya.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Hanya transaksi completed yang dapat dibatalkan
        |--------------------------------------------------------------------------
        */
        if ($sale->status !== 'completed') {

            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' =>
                            'Status transaksi tidak dapat dibatalkan.',
                    ],
                    422
                );
            }

            return redirect()
                ->route(
                    'sales.show',
                    $sale
                )
                ->with(
                    'error',
                    'Status transaksi tidak dapat dibatalkan.'
                );
        }


        DB::transaction(
            function () use ($sale) {

                /*
                |--------------------------------------------------------------------------
                | Kunci transaksi
                |--------------------------------------------------------------------------
                |
                | Kita baca ulang transaksi menggunakan lockForUpdate()
                | agar lebih aman apabila ada dua request yang datang
                | hampir bersamaan.
                |
                */
                $lockedSale = Sale::query()
                    ->lockForUpdate()
                    ->findOrFail($sale->id);

                /*
                |--------------------------------------------------------------------------
                | Cek status lagi setelah row dikunci
                |--------------------------------------------------------------------------
                */
                if (
                    $lockedSale->status !==
                    'completed'
                ) {
                    throw ValidationException::withMessages([
                        'sale' =>
                            'Transaksi sudah dibatalkan atau tidak dapat dibatalkan.',
                    ]);
                }


                $lockedSale->load('items');


                /*
                |--------------------------------------------------------------------------
                | Kembalikan stok
                |--------------------------------------------------------------------------
                */
                foreach (
                    $lockedSale->items
                    as $item
                ) {
                    $product = Product::query()
                        ->lockForUpdate()
                        ->findOrFail(
                            $item->product_id
                        );


                    $product->increment(
                        'stock',
                        $item->quantity
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Catat stok masuk akibat pembatalan
                    |--------------------------------------------------------------------------
                    */
                    StockMovement::create([
                        'product_id' =>
                            $product->id,

                        'user_id' =>
                            auth()->id(),

                        'sale_id' =>
                            $lockedSale->id,

                        'movement_type' =>
                            'in',

                        'quantity' =>
                            $item->quantity,

                        'notes' =>
                            'Pengembalian stok karena pembatalan transaksi '
                            . $lockedSale->invoice_number,
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | Ubah status transaksi
                |--------------------------------------------------------------------------
                */
                $lockedSale->update([
                    'status' =>
                        'cancelled',
                ]);
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Respons untuk Fetch/AJAX
        |--------------------------------------------------------------------------
        */
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,

                'message' =>
                    'Transaksi berhasil dibatalkan dan stok produk telah dikembalikan.',

                'status' =>
                    'cancelled',

                'status_label' =>
                    'Dibatalkan',

                'invoice_number' =>
                    $sale->invoice_number,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Fallback apabila JavaScript tidak digunakan
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route(
                'sales.show',
                $sale
            )
            ->with(
                'success',
                'Transaksi berhasil dibatalkan dan stok produk telah dikembalikan.'
            );
    }


    /**
     * Membuat nomor invoice otomatis.
     *
     * Format:
     * INV-YYYYMMDD-001
     */
    private function generateInvoiceNumber()
    {
        $date =
            now()->format('Ymd');

        $prefix =
            'INV-' . $date . '-';

        $latestSale = Sale::query()
            ->where(
                'invoice_number',
                'like',
                $prefix . '%'
            )
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;

        if ($latestSale) {
            $lastNumber =
                (int) substr(
                    $latestSale->invoice_number,
                    -3
                );

            $nextNumber =
                $lastNumber + 1;
        }

        do {
            $invoiceNumber =
                $prefix
                . str_pad(
                    $nextNumber,
                    3,
                    '0',
                    STR_PAD_LEFT
                );

            $exists = Sale::where(
                'invoice_number',
                $invoiceNumber
            )->exists();

            $nextNumber++;
        } while ($exists);

        return $invoiceNumber;
    }
}