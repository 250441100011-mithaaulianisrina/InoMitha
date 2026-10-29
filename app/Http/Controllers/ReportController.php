<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan bisnis.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Filter Periode
        |--------------------------------------------------------------------------
        */
        $dateFrom = $request->input('date_from', '');
        $dateTo = $request->input('date_to', '');

        /*
        |--------------------------------------------------------------------------
        | Query Dasar Penjualan
        |--------------------------------------------------------------------------
        |
        | Hanya transaksi completed yang dihitung sebagai penjualan.
        | Transaksi cancelled tetap tersimpan sebagai riwayat,
        | tetapi tidak masuk ke laporan penjualan berhasil.
        |
        */
        $salesQuery = Sale::query()
            ->where('status', 'completed');

        if ($dateFrom !== '') {
            $salesQuery->whereDate(
                'sale_date',
                '>=',
                $dateFrom
            );
        }

        if ($dateTo !== '') {
            $salesQuery->whereDate(
                'sale_date',
                '<=',
                $dateTo
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Ringkasan Penjualan
        |--------------------------------------------------------------------------
        */
        $totalSales = (clone $salesQuery)
            ->sum('total_amount');

        $totalTransactions = (clone $salesQuery)
            ->count();

        $averageTransaction = $totalTransactions > 0
            ? $totalSales / $totalTransactions
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Total Item Terjual
        |--------------------------------------------------------------------------
        */
        $totalItemsSold = SaleItem::query()
            ->whereHas('sale', function ($query) use (
                $dateFrom,
                $dateTo
            ) {
                $query->where(
                    'status',
                    'completed'
                );

                if ($dateFrom !== '') {
                    $query->whereDate(
                        'sale_date',
                        '>=',
                        $dateFrom
                    );
                }

                if ($dateTo !== '') {
                    $query->whereDate(
                        'sale_date',
                        '<=',
                        $dateTo
                    );
                }
            })
            ->sum('quantity');

        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        */
        $bestSellingProducts = SaleItem::query()
            ->selectRaw(
                '
                product_id,
                SUM(quantity) as total_quantity,
                SUM(subtotal) as total_revenue
                '
            )
            ->with([
                'product.category',
            ])
            ->whereHas('sale', function ($query) use (
                $dateFrom,
                $dateTo
            ) {
                $query->where(
                    'status',
                    'completed'
                );

                if ($dateFrom !== '') {
                    $query->whereDate(
                        'sale_date',
                        '>=',
                        $dateFrom
                    );
                }

                if ($dateTo !== '') {
                    $query->whereDate(
                        'sale_date',
                        '<=',
                        $dateTo
                    );
                }
            })
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Pelanggan Teratas
        |--------------------------------------------------------------------------
        |
        | Hanya pelanggan yang terdaftar yang ditampilkan.
        | Transaksi Pelanggan Umum tidak masuk ranking pelanggan.
        |
        */
        $topCustomers = Customer::query()
            ->whereHas('sales', function ($query) use (
                $dateFrom,
                $dateTo
            ) {
                $query->where(
                    'status',
                    'completed'
                );

                if ($dateFrom !== '') {
                    $query->whereDate(
                        'sale_date',
                        '>=',
                        $dateFrom
                    );
                }

                if ($dateTo !== '') {
                    $query->whereDate(
                        'sale_date',
                        '<=',
                        $dateTo
                    );
                }
            })
            ->withCount([
                'sales as completed_transactions_count'
                    => function ($query) use (
                        $dateFrom,
                        $dateTo
                    ) {
                        $query->where(
                            'status',
                            'completed'
                        );

                        if ($dateFrom !== '') {
                            $query->whereDate(
                                'sale_date',
                                '>=',
                                $dateFrom
                            );
                        }

                        if ($dateTo !== '') {
                            $query->whereDate(
                                'sale_date',
                                '<=',
                                $dateTo
                            );
                        }
                    },
            ])
            ->withSum([
                'sales as completed_sales_total'
                    => function ($query) use (
                        $dateFrom,
                        $dateTo
                    ) {
                        $query->where(
                            'status',
                            'completed'
                        );

                        if ($dateFrom !== '') {
                            $query->whereDate(
                                'sale_date',
                                '>=',
                                $dateFrom
                            );
                        }

                        if ($dateTo !== '') {
                            $query->whereDate(
                                'sale_date',
                                '<=',
                                $dateTo
                            );
                        }
                    },
            ], 'total_amount')
            ->orderByDesc('completed_sales_total')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Kondisi Persediaan Saat Ini
        |--------------------------------------------------------------------------
        |
        | Aturan status stok InoMitha:
        |
        | Aman:
        | stock > minimum_stock
        |
        | Menipis:
        | stock > 0 AND stock <= minimum_stock
        |
        | Habis:
        | stock = 0
        |
        */
        $totalProducts = Product::query()
            ->where('is_active', true)
            ->count();

        $safeStockProducts = Product::query()
            ->where('is_active', true)
            ->whereColumn(
                'stock',
                '>',
                'minimum_stock'
            )
            ->count();

        $lowStockProducts = Product::query()
            ->where('is_active', true)
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

        $outOfStockProducts = Product::query()
            ->where('is_active', true)
            ->where(
                'stock',
                0
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Daftar Produk yang Perlu Perhatian
        |--------------------------------------------------------------------------
        */
        $stockAttentionProducts = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where(function ($query) {
                $query
                    ->where('stock', 0)
                    ->orWhere(function ($subQuery) {
                        $subQuery
                            ->where('stock', '>', 0)
                            ->whereColumn(
                                'stock',
                                '<=',
                                'minimum_stock'
                            );
                    });
            })
            ->orderBy('stock')
            ->orderBy('name')
            ->limit(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Transaksi Terbaru pada Periode Laporan
        |--------------------------------------------------------------------------
        */
        $recentSales = (clone $salesQuery)
            ->with([
                'customer',
                'user',
            ])
            ->withCount('items')
            ->latest('sale_date')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Kirim Data ke View
        |--------------------------------------------------------------------------
        */
        return view(
            'reports.index',
            compact(
                'dateFrom',
                'dateTo',
                'totalSales',
                'totalTransactions',
                'averageTransaction',
                'totalItemsSold',
                'bestSellingProducts',
                'topCustomers',
                'totalProducts',
                'safeStockProducts',
                'lowStockProducts',
                'outOfStockProducts',
                'stockAttentionProducts',
                'recentSales'
            )
        );
    }
}