<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class HistoricalStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $userId = DB::table('users')
            ->orderBy('id')
            ->value('id');

        if (!$userId) {
            throw new RuntimeException(
                'HistoricalStockSeeder membutuhkan minimal satu user.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUK KATALOG INTANMITHA
        |--------------------------------------------------------------------------
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
        | HAPUS HISTORI RESTOCK SEEDER LAMA
        |--------------------------------------------------------------------------
        |
        | Hanya movement yang memiliki penanda [HIST-RESTOCK]
        | yang dihapus.
        |
        | Riwayat stok manual dari website dan riwayat penjualan
        | tidak akan ikut terhapus.
        |
        */

        DB::table('stock_movements')
            ->where(
                'notes',
                'like',
                '[HIST-RESTOCK]%'
            )
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | PERIODE RESTOCK
        |--------------------------------------------------------------------------
        |
        | Jumlah kegiatan restock dibuat berbeda setiap bulan.
        |
        */

        $monthlyRestockTargets = [
            '2026-04' => 18,
            '2026-05' => 21,
            '2026-06' => 20,
            '2026-07' => 24,
            '2026-08' => 27,
            '2026-09' => 31,
        ];


        /*
        |--------------------------------------------------------------------------
        | PRODUK DENGAN RESTOCK LEBIH SERING
        |--------------------------------------------------------------------------
        |
        | Produk populer dari histori penjualan diberi bobot lebih besar.
        |
        */

        $frequentRestockCodes = [
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
        | PRODUK DENGAN RESTOCK LEBIH JARANG
        |--------------------------------------------------------------------------
        */

        $rareRestockCodes = [
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
        | MEMBUAT POOL PRODUK BERBOBOT
        |--------------------------------------------------------------------------
        */

        $weightedProductPool = [];

        foreach ($products as $product) {

            $weight = 3;

            if (
                in_array(
                    $product->product_code,
                    $frequentRestockCodes,
                    true
                )
            ) {
                $weight = 7;
            }

            if (
                in_array(
                    $product->product_code,
                    $rareRestockCodes,
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
        | RANDOM SEED
        |--------------------------------------------------------------------------
        |
        | Nilai tetap supaya pola histori konsisten jika dijalankan ulang.
        |
        */

        mt_srand(20261010);

        $restockNumber = 1;


        /*
        |--------------------------------------------------------------------------
        | MEMBUAT HISTORI RESTOCK
        |--------------------------------------------------------------------------
        */

        foreach (
            $monthlyRestockTargets as
            $yearMonth => $restockCount
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
                $index = 1;
                $index <= $restockCount;
                $index++
            ) {

                /*
                |--------------------------------------------------------------------------
                | PILIH PRODUK
                |--------------------------------------------------------------------------
                */

                $product =
                    $weightedProductPool[
                        array_rand(
                            $weightedProductPool
                        )
                    ];


                /*
                |--------------------------------------------------------------------------
                | TANGGAL RESTOCK
                |--------------------------------------------------------------------------
                */

                $day = mt_rand(
                    1,
                    $daysInMonth
                );

                /*
                 * Restock umumnya dilakukan pada jam operasional.
                 */
                $hour = mt_rand(
                    8,
                    16
                );

                $minuteOptions = [
                    0,
                    10,
                    15,
                    20,
                    30,
                    40,
                    45,
                    50,
                ];

                $minute =
                    $minuteOptions[
                        array_rand(
                            $minuteOptions
                        )
                    ];

                $movementDate = Carbon::create(
                    $year,
                    $month,
                    $day,
                    $hour,
                    $minute,
                    0
                );


                /*
                |--------------------------------------------------------------------------
                | JUMLAH RESTOCK
                |--------------------------------------------------------------------------
                |
                | Mayoritas restock 10-30 unit.
                | Sesekali terdapat restock lebih kecil atau lebih besar.
                |
                */

                $quantityRoll = mt_rand(
                    1,
                    100
                );

                if ($quantityRoll <= 12) {

                    $quantity = mt_rand(
                        5,
                        9
                    );

                } elseif ($quantityRoll <= 72) {

                    $quantity = mt_rand(
                        10,
                        25
                    );

                } elseif ($quantityRoll <= 94) {

                    $quantity = mt_rand(
                        26,
                        40
                    );

                } else {

                    $quantity = mt_rand(
                        41,
                        60
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | VARIASI KETERANGAN
                |--------------------------------------------------------------------------
                */

                $noteOptions = [
                    'Restock rutin dari pemasok.',
                    'Penambahan stok untuk kebutuhan penjualan.',
                    'Restock produk dari pemasok utama.',
                    'Penambahan persediaan berdasarkan kebutuhan stok.',
                    'Restock berkala untuk menjaga ketersediaan produk.',
                    'Penerimaan stok baru dari pemasok.',
                ];

                $note =
                    $noteOptions[
                        array_rand(
                            $noteOptions
                        )
                    ];


                /*
                |--------------------------------------------------------------------------
                | SIMPAN STOCK MOVEMENT
                |--------------------------------------------------------------------------
                |
                | products.stock TIDAK ditambahkan.
                |
                | Data ini merupakan histori masa lalu, sedangkan
                | products.stock adalah saldo stok saat ini.
                |
                */

                DB::table('stock_movements')
                    ->insert([
                        'product_id' =>
                            $product->id,

                        'user_id' =>
                            $userId,

                        'sale_id' =>
                            null,

                        'movement_type' =>
                            'in',

                        'quantity' =>
                            $quantity,

                        'notes' =>
                            '[HIST-RESTOCK] '
                            . $note,

                        'created_at' =>
                            $movementDate,

                        'updated_at' =>
                            $movementDate,
                    ]);


                $restockNumber++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | INFORMASI TERMINAL
        |--------------------------------------------------------------------------
        */

        $totalRestocks =
            array_sum(
                $monthlyRestockTargets
            );

        $this->command?->info(
            $totalRestocks
            . ' histori restock berhasil dibuat.'
        );

        $this->command?->info(
            'Saldo stok produk saat ini tidak diubah.'
        );
    }
}