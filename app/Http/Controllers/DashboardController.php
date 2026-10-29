<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama InoMitha.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ringkasan Utama
        |--------------------------------------------------------------------------
        |
        | Hanya transaksi dengan status completed yang dihitung
        | sebagai transaksi dan pendapatan yang berhasil.
        |
        */

        $totalSales = Sale::query()
            ->where('status', 'completed')
            ->sum('total_amount');

        $totalTransactions = Sale::query()
            ->where('status', 'completed')
            ->count();

        $totalCustomers = Customer::query()
            ->count();

        $activeProducts = Product::query()
            ->where('is_active', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Ringkasan Hari Ini
        |--------------------------------------------------------------------------
        |
        | Hanya transaksi completed pada tanggal hari ini
        | yang dihitung.
        |
        */

        $todaySales = Sale::query()
            ->where('status', 'completed')
            ->whereDate(
                'sale_date',
                today()
            )
            ->sum('total_amount');

        $todayTransactions = Sale::query()
            ->where('status', 'completed')
            ->whereDate(
                'sale_date',
                today()
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Kondisi Persediaan
        |--------------------------------------------------------------------------
        |
        | Aturan status stok InoMitha:
        |
        | Stok Aman:
        | stock > minimum_stock
        |
        | Stok Menipis:
        | stock > 0 AND stock <= minimum_stock
        |
        | Stok Habis:
        | stock = 0
        |
        */

        $safeStockCount = Product::query()
            ->where('is_active', true)
            ->whereColumn(
                'stock',
                '>',
                'minimum_stock'
            )
            ->count();

        $lowStockCount = Product::query()
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

        $outOfStockCount = Product::query()
            ->where('is_active', true)
            ->where(
                'stock',
                0
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Produk dengan Stok Menipis / Habis
        |--------------------------------------------------------------------------
        |
        | Dashboard hanya menampilkan maksimal 5 produk
        | yang paling membutuhkan perhatian.
        |
        */

        $stockAttentionProducts = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->where(function ($query) {

                $query
                    ->where(
                        'stock',
                        0
                    )
                    ->orWhere(function ($subQuery) {

                        $subQuery
                            ->where(
                                'stock',
                                '>',
                                0
                            )
                            ->whereColumn(
                                'stock',
                                '<=',
                                'minimum_stock'
                            );

                    });

            })
            ->orderBy('stock')
            ->orderBy('name')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        |
        | Produk terlaris dihitung berdasarkan jumlah unit yang
        | terjual dari transaksi dengan status completed.
        |
        | Transaksi cancelled tidak ikut dihitung.
        |
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
            ->whereHas(
                'sale',
                function ($query) {

                    $query->where(
                        'status',
                        'completed'
                    );

                }
            )
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Grafik Penjualan 6 Bulan Terakhir
        |--------------------------------------------------------------------------
        |
        | Grafik menampilkan total pendapatan dan jumlah transaksi
        | completed pada masing-masing bulan.
        |
        | Periode selalu mengikuti bulan saat aplikasi digunakan.
        | Bulan yang tidak memiliki transaksi tetap ditampilkan
        | dengan nilai 0.
        |
        */

        $chartLabels = [];
        $chartSales = [];
        $chartTransactions = [];

        for ($i = 5; $i >= 0; $i--) {

            $month = Carbon::today()
                ->startOfMonth()
                ->subMonths($i);

            /*
             * Label bulan untuk sumbu X grafik.
             *
             * Contoh:
             * Mei 2026
             * Jun 2026
             * Jul 2026
             */
            $chartLabels[] =
                $month->translatedFormat('M Y');


            /*
             * Total pendapatan pada bulan tersebut.
             */
            $chartSales[] = (float) Sale::query()
                ->where(
                    'status',
                    'completed'
                )
                ->whereYear(
                    'sale_date',
                    $month->year
                )
                ->whereMonth(
                    'sale_date',
                    $month->month
                )
                ->sum('total_amount');


            /*
             * Jumlah transaksi completed pada bulan tersebut.
             *
             * Data ini digunakan pada tooltip grafik.
             */
            $chartTransactions[] = Sale::query()
                ->where(
                    'status',
                    'completed'
                )
                ->whereYear(
                    'sale_date',
                    $month->year
                )
                ->whereMonth(
                    'sale_date',
                    $month->month
                )
                ->count();
        }


        /*
        |--------------------------------------------------------------------------
        | Transaksi Terbaru
        |--------------------------------------------------------------------------
        |
        | Semua status transaksi ditampilkan di bagian ini.
        |
        | Transaksi completed maupun cancelled tetap ditampilkan
        | karena bagian ini berfungsi sebagai aktivitas transaksi
        | terbaru, bukan perhitungan pendapatan.
        |
        */

        $recentSales = Sale::query()
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
        | Kirim Data ke Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(
                'totalSales',
                'totalTransactions',
                'totalCustomers',
                'activeProducts',
                'todaySales',
                'todayTransactions',
                'safeStockCount',
                'lowStockCount',
                'outOfStockCount',
                'stockAttentionProducts',
                'bestSellingProducts',
                'chartLabels',
                'chartSales',
                'chartTransactions',
                'recentSales'
            )
        );
    }
}