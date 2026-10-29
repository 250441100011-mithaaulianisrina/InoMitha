<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class HistoricalSalesSeeder extends Seeder
{
    /**
     * Jumlah transaksi historis yang akan dibuat.
     */
    private const TOTAL_SALES = 120;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi Data Dasar
        |--------------------------------------------------------------------------
        */

        $userId = DB::table('users')
            ->orderBy('id')
            ->value('id');

        if (!$userId) {
            throw new RuntimeException(
                'HistoricalSalesSeeder membutuhkan minimal satu user.'
            );
        }

        $customerIds = DB::table('customers')
            ->whereBetween(
                'customer_code',
                ['CUST001', 'CUST035']
            )
            ->orderBy('customer_code')
            ->pluck('id')
            ->values();

        if ($customerIds->isEmpty()) {
            throw new RuntimeException(
                'Customer belum tersedia. Jalankan CustomerSeeder terlebih dahulu.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Produk yang Digunakan
        |--------------------------------------------------------------------------
        |
        | Hanya produk dari katalog seed IntanMitha yang digunakan.
        |
        */

        $products = DB::table('products')
            ->where(function ($query) {
                $query
                    ->where('product_code', 'like', 'AR%')
                    ->orWhere('product_code', 'like', 'PJ%')
                    ->orWhere('product_code', 'like', 'TD%')
                    ->orWhere('product_code', 'like', 'AW%')
                    ->orWhere('product_code', 'like', 'BW%')
                    ->orWhere('product_code', 'like', 'DO%')
                    ->orWhere('product_code', 'like', 'HS%')
                    ->orWhere('product_code', 'like', 'OW%')
                    ->orWhere('product_code', 'like', 'FA%')
                    ->orWhere('product_code', 'like', 'FW%');
            })
            ->where('is_active', true)
            ->orderBy('product_code')
            ->get();

        if ($products->isEmpty()) {
            throw new RuntimeException(
                'Produk belum tersedia. Jalankan InoMithaStoreSeeder terlebih dahulu.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Bersihkan Histori Seeder Lama
        |--------------------------------------------------------------------------
        |
        | Bagian ini hanya menghapus transaksi yang memang dibuat oleh
        | HistoricalSalesSeeder, yaitu invoice dengan prefix HIST.
        |
        | Transaksi manual dari website tidak ikut terhapus.
        |
        */

        DB::transaction(function () {

            $historicalSaleIds = DB::table('sales')
                ->where(
                    'invoice_number',
                    'like',
                    'HIST-INV-%'
                )
                ->pluck('id');

            if ($historicalSaleIds->isNotEmpty()) {

                DB::table('stock_movements')
                    ->whereIn(
                        'sale_id',
                        $historicalSaleIds
                    )
                    ->delete();

                DB::table('sale_items')
                    ->whereIn(
                        'sale_id',
                        $historicalSaleIds
                    )
                    ->delete();

                DB::table('sales')
                    ->whereIn(
                        'id',
                        $historicalSaleIds
                    )
                    ->delete();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Periode Histori
        |--------------------------------------------------------------------------
        |
        | Jumlah transaksi tiap bulan sengaja tidak sama agar grafik
        | penjualan terlihat lebih natural.
        |
        */

        $monthlyTargets = [
            '2026-04' => 14,
            '2026-05' => 17,
            '2026-06' => 18,
            '2026-07' => 20,
            '2026-08' => 23,
            '2026-09' => 28,
        ];

        /*
        |--------------------------------------------------------------------------
        | Produk Unggulan
        |--------------------------------------------------------------------------
        |
        | Produk berikut sengaja memiliki bobot lebih tinggi agar terdapat
        | best seller yang dapat dianalisis pada laporan dan AI.
        |
        */

        $popularProductCodes = [
            'AR003',
            'PJ003',
            'TD002',
            'AW001',
            'BW004',
            'DO005',
            'HS001',
            'HS003',
            'HS012',
            'OW003',
            'FA005',
            'FA008',
            'FA015',
            'FW006',
            'FW009',
        ];

        /*
        |--------------------------------------------------------------------------
        | Produk Slow Moving
        |--------------------------------------------------------------------------
        |
        | Produk ini tetap dapat terjual, tetapi peluangnya lebih kecil.
        |
        */

        $slowMovingProductCodes = [
            'PJ015',
            'TD015',
            'AW015',
            'BW015',
            'DO018',
            'HS022',
            'OW013',
            'FA019',
            'FW017',
        ];

        /*
        |--------------------------------------------------------------------------
        | Pool Produk Berbobot
        |--------------------------------------------------------------------------
        */

        $weightedProductPool = [];

        foreach ($products as $product) {

            $weight = 3;

            if (
                in_array(
                    $product->product_code,
                    $popularProductCodes,
                    true
                )
            ) {
                $weight = 8;
            }

            if (
                in_array(
                    $product->product_code,
                    $slowMovingProductCodes,
                    true
                )
            ) {
                $weight = 1;
            }

            for ($i = 0; $i < $weight; $i++) {
                $weightedProductPool[] = $product;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Random Seed
        |--------------------------------------------------------------------------
        |
        | Dibuat tetap agar ketika seeder dijalankan ulang,
        | pola data historis tetap konsisten.
        |
        */

        mt_srand(20261009);

        $globalTransactionNumber = 1;

        /*
        |--------------------------------------------------------------------------
        | Buat Transaksi
        |--------------------------------------------------------------------------
        */

        foreach (
            $monthlyTargets as
            $yearMonth => $transactionCount
        ) {

            [$year, $month] = array_map(
                'intval',
                explode('-', $yearMonth)
            );

            $daysInMonth = Carbon::create(
                $year,
                $month,
                1
            )->daysInMonth;

            for (
                $transactionIndex = 1;
                $transactionIndex <= $transactionCount;
                $transactionIndex++
            ) {

                /*
                |--------------------------------------------------------------------------
                | Tanggal Transaksi
                |--------------------------------------------------------------------------
                */

                $day = mt_rand(
                    1,
                    $daysInMonth
                );

                $hour = mt_rand(
                    9,
                    20
                );

                $minuteOptions = [
                    0,
                    5,
                    10,
                    15,
                    20,
                    25,
                    30,
                    35,
                    40,
                    45,
                    50,
                    55,
                ];

                $minute =
                    $minuteOptions[
                        array_rand(
                            $minuteOptions
                        )
                    ];

                $saleDate = Carbon::create(
                    $year,
                    $month,
                    $day,
                    $hour,
                    $minute,
                    0
                );

                /*
                |--------------------------------------------------------------------------
                | Customer
                |--------------------------------------------------------------------------
                |
                | Sekitar 12% transaksi dibuat sebagai pembeli umum.
                |
                | Customer awal memiliki peluang sedikit lebih tinggi muncul
                | kembali sehingga terdapat pelanggan berulang.
                |
                */

                $customerId = null;

                if (mt_rand(1, 100) > 12) {

                    $customerPool = [];

                    foreach (
                        $customerIds as
                        $index => $id
                    ) {

                        $weight =
                            $index < 10
                                ? 4
                                : (
                                    $index < 20
                                        ? 2
                                        : 1
                                );

                        for (
                            $i = 0;
                            $i < $weight;
                            $i++
                        ) {
                            $customerPool[] =
                                $id;
                        }
                    }

                    $customerId =
                        $customerPool[
                            array_rand(
                                $customerPool
                            )
                        ];
                }

                /*
                |--------------------------------------------------------------------------
                | Jumlah Jenis Produk
                |--------------------------------------------------------------------------
                |
                | Mayoritas transaksi berisi 1-3 jenis produk.
                | Sesekali terdapat transaksi 4-5 jenis produk.
                |
                */

                $itemRoll =
                    mt_rand(
                        1,
                        100
                    );

                if ($itemRoll <= 25) {
                    $itemCount = 1;
                } elseif ($itemRoll <= 60) {
                    $itemCount = 2;
                } elseif ($itemRoll <= 85) {
                    $itemCount = 3;
                } elseif ($itemRoll <= 96) {
                    $itemCount = 4;
                } else {
                    $itemCount = 5;
                }

                /*
                |--------------------------------------------------------------------------
                | Pilih Produk Tanpa Duplikasi
                |--------------------------------------------------------------------------
                */

                $selectedProducts = [];

                $attempts = 0;

                while (
                    count($selectedProducts) <
                    $itemCount
                ) {

                    $attempts++;

                    if ($attempts > 500) {
                        throw new RuntimeException(
                            'Gagal memilih produk untuk transaksi historis.'
                        );
                    }

                    $candidate =
                        $weightedProductPool[
                            array_rand(
                                $weightedProductPool
                            )
                        ];

                    $selectedProducts[
                        $candidate->id
                    ] = $candidate;
                }

                /*
                |--------------------------------------------------------------------------
                | Nomor Invoice Historis
                |--------------------------------------------------------------------------
                |
                | Prefix HIST membedakan data seeder dari transaksi manual.
                |
                */

                $invoiceNumber =
                    'HIST-INV-'
                    . $saleDate->format('Ymd')
                    . '-'
                    . str_pad(
                        $globalTransactionNumber,
                        4,
                        '0',
                        STR_PAD_LEFT
                    );

                /*
                |--------------------------------------------------------------------------
                | Simpan Transaksi
                |--------------------------------------------------------------------------
                */

                DB::transaction(
                    function () use (
                        $invoiceNumber,
                        $customerId,
                        $userId,
                        $saleDate,
                        $selectedProducts
                    ) {

                        $saleId = DB::table('sales')
                            ->insertGetId([
                                'invoice_number' =>
                                    $invoiceNumber,

                                'customer_id' =>
                                    $customerId,

                                'user_id' =>
                                    $userId,

                                'sale_date' =>
                                    $saleDate,

                                'total_amount' =>
                                    0,

                                'status' =>
                                    'completed',

                                'created_at' =>
                                    $saleDate,

                                'updated_at' =>
                                    $saleDate,
                            ]);

                        $grandTotal = 0;

                        foreach (
                            $selectedProducts as
                            $product
                        ) {

                            /*
                            |--------------------------------------------------------------------------
                            | Quantity
                            |--------------------------------------------------------------------------
                            |
                            | Sebagian besar pembelian 1 unit.
                            |
                            */

                            $quantityRoll =
                                mt_rand(
                                    1,
                                    100
                                );

                            if ($quantityRoll <= 78) {
                                $quantity = 1;
                            } elseif (
                                $quantityRoll <= 96
                            ) {
                                $quantity = 2;
                            } else {
                                $quantity = 3;
                            }

                            $unitPrice =
                                (float)
                                $product->price;

                            $subtotal =
                                $unitPrice *
                                $quantity;

                            /*
                            |--------------------------------------------------------------------------
                            | Detail Penjualan
                            |--------------------------------------------------------------------------
                            */

                            DB::table('sale_items')
                                ->insert([
                                    'sale_id' =>
                                        $saleId,

                                    'product_id' =>
                                        $product->id,

                                    'quantity' =>
                                        $quantity,

                                    'unit_price' =>
                                        $unitPrice,

                                    'subtotal' =>
                                        $subtotal,

                                    'created_at' =>
                                        $saleDate,

                                    'updated_at' =>
                                        $saleDate,
                                ]);

                            /*
                            |--------------------------------------------------------------------------
                            | Riwayat Stok Keluar
                            |--------------------------------------------------------------------------
                            |
                            | Stok produk TIDAK dikurangi di sini.
                            | products.stock dianggap sebagai saldo stok saat ini.
                            |
                            */

                            DB::table(
                                'stock_movements'
                            )->insert([
                                'product_id' =>
                                    $product->id,

                                'user_id' =>
                                    $userId,

                                'sale_id' =>
                                    $saleId,

                                'movement_type' =>
                                    'out',

                                'quantity' =>
                                    $quantity,

                                'notes' =>
                                    'Penjualan '
                                    . $invoiceNumber,

                                'created_at' =>
                                    $saleDate,

                                'updated_at' =>
                                    $saleDate,
                            ]);

                            $grandTotal +=
                                $subtotal;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Update Total
                        |--------------------------------------------------------------------------
                        */

                        DB::table('sales')
                            ->where(
                                'id',
                                $saleId
                            )
                            ->update([
                                'total_amount' =>
                                    $grandTotal,

                                'updated_at' =>
                                    $saleDate,
                            ]);
                    }
                );

                $globalTransactionNumber++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Informasi Terminal
        |--------------------------------------------------------------------------
        */

        $this->command?->info(
            self::TOTAL_SALES
            . ' transaksi historis berhasil dibuat.'
        );

        $this->command?->info(
            'Stok produk saat ini tidak diubah.'
        );
    }
}