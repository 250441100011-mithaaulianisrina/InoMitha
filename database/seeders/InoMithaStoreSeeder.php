<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InoMithaStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | KATEGORI INTANMITHA COLLECTION
        |--------------------------------------------------------------------------
        */

        $categories = [

            [
                'name' => 'Aksesoris Rambut',
                'description' => 'Koleksi aksesoris rambut wanita untuk melengkapi penampilan sehari-hari maupun acara khusus, mulai dari jepit rambut, claw clip, scrunchie, headband, hingga berbagai aksesoris rambut dengan desain modern dan feminin.',
            ],

            [
                'name' => 'Perhiasan & Jewelry',
                'description' => 'Koleksi perhiasan dan jewelry wanita dengan berbagai pilihan model yang elegan dan modern, seperti kalung, gelang, cincin, anting, serta aksesoris pelengkap lainnya untuk menunjang berbagai gaya penampilan.',
            ],

            [
                'name' => 'Tas & Dompet',
                'description' => 'Berbagai pilihan tas dan dompet wanita untuk kebutuhan sehari-hari, kuliah, bekerja, bepergian, maupun acara tertentu, dengan pilihan model praktis, modern, dan mudah dipadukan dengan berbagai outfit.',
            ],

            [
                'name' => 'Atasan Wanita',
                'description' => 'Koleksi atasan wanita dengan berbagai pilihan model seperti blouse, kemeja, knitwear, tunik, dan basic top yang nyaman digunakan serta cocok untuk gaya kasual, semi formal, maupun aktivitas sehari-hari.',
            ],

            [
                'name' => 'Bawahan Wanita',
                'description' => 'Koleksi bawahan wanita yang terdiri dari celana, rok, kulot, dan berbagai model lainnya dengan desain nyaman dan fleksibel untuk digunakan dalam berbagai aktivitas serta mudah dipadukan dengan koleksi atasan.',
            ],

            [
                'name' => 'Dress & One Piece',
                'description' => 'Koleksi dress dan pakaian one piece wanita dengan desain feminin dan modern untuk berbagai kebutuhan, mulai dari kegiatan santai, acara keluarga, kegiatan formal, hingga berbagai kesempatan khusus.',
            ],

            [
                'name' => 'Hijab & Scarf',
                'description' => 'Koleksi hijab dan scarf dengan beragam bahan, warna, motif, serta model yang nyaman digunakan untuk aktivitas sehari-hari maupun acara khusus dan dapat dipadukan dengan berbagai koleksi fashion.',
            ],

            [
                'name' => 'Outerwear',
                'description' => 'Koleksi pakaian luar wanita seperti cardigan, blazer, jaket, dan berbagai outer lainnya yang dirancang untuk melengkapi outfit sekaligus memberikan pilihan gaya layering yang modern dan nyaman.',
            ],

            [
                'name' => 'Fashion Accessories',
                'description' => 'Berbagai aksesoris fashion pelengkap seperti belt, kacamata, bros, strap, dan item pendukung lainnya yang dapat memberikan sentuhan tambahan pada penampilan serta melengkapi berbagai gaya berpakaian.',
            ],

            [
                'name' => 'Footwear',
                'description' => 'Koleksi alas kaki wanita dengan berbagai pilihan seperti sandal, flat shoes, sneakers, heels, dan model lainnya yang mengutamakan kenyamanan sekaligus mendukung penampilan untuk berbagai aktivitas.',
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | SIMPAN KATEGORI
        |--------------------------------------------------------------------------
        */

        foreach ($categories as $category) {

            $existingCategory = DB::table('categories')
                ->where('name', $category['name'])
                ->first();

            DB::table('categories')->updateOrInsert(
                [
                    'name' => $category['name'],
                ],
                [
                    'description' => $category['description'],

                    'created_at' => $existingCategory
                        ? $existingCategory->created_at
                        : now(),

                    'updated_at' => now(),
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PRODUK - AKSESORIS RAMBUT
        |--------------------------------------------------------------------------
        */

        $hairAccessoryProducts = [

            [
                'product_code' => 'AR001',
                'name' => 'Pearl Blossom Hair Clip',
                'price' => 28000,
                'stock' => 24,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR002',
                'name' => 'Classic Matte Claw Clip',
                'price' => 22000,
                'stock' => 18,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR003',
                'name' => 'Satin Scrunchie Premium',
                'price' => 18000,
                'stock' => 32,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR004',
                'name' => 'Velvet Bow Hair Tie',
                'price' => 25000,
                'stock' => 14,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR005',
                'name' => 'Elegant Pearl Headband',
                'price' => 45000,
                'stock' => 9,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR006',
                'name' => 'Minimalist Metal Hair Pin',
                'price' => 20000,
                'stock' => 4,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR007',
                'name' => 'Floral Korean Hair Clip',
                'price' => 32000,
                'stock' => 11,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR008',
                'name' => 'Pastel Mini Claw Clip Set',
                'price' => 30000,
                'stock' => 20,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR009',
                'name' => 'Ribbon French Barrette',
                'price' => 35000,
                'stock' => 7,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR010',
                'name' => 'Crystal Butterfly Hair Clip',
                'price' => 38000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR011',
                'name' => 'Soft Knit Wide Headband',
                'price' => 27000,
                'stock' => 0,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'AR012',
                'name' => 'Daisy Hair Pin Set',
                'price' => 24000,
                'stock' => 16,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Aksesoris Rambut',
            $hairAccessoryProducts
        );


        /*
        |--------------------------------------------------------------------------
        | PRODUK - PERHIASAN & JEWELRY
        |--------------------------------------------------------------------------
        */

        $jewelryProducts = [

            [
                'product_code' => 'PJ001',
                'name' => 'Aurora Pearl Necklace',
                'price' => 68000,
                'stock' => 17,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ002',
                'name' => 'Celeste Layered Necklace',
                'price' => 75000,
                'stock' => 13,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ003',
                'name' => 'Luna Minimalist Necklace',
                'price' => 52000,
                'stock' => 25,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ004',
                'name' => 'Roselle Crystal Bracelet',
                'price' => 48000,
                'stock' => 19,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ005',
                'name' => 'Serena Charm Bracelet',
                'price' => 55000,
                'stock' => 10,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ006',
                'name' => 'Amour Heart Bracelet',
                'price' => 46000,
                'stock' => 4,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ007',
                'name' => 'Elara Pearl Drop Earrings',
                'price' => 42000,
                'stock' => 21,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ008',
                'name' => 'Stella Crystal Hoop Earrings',
                'price' => 49000,
                'stock' => 12,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ009',
                'name' => 'Belle Mini Hoop Earrings',
                'price' => 35000,
                'stock' => 28,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ010',
                'name' => 'Camellia Flower Earrings',
                'price' => 45000,
                'stock' => 6,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ011',
                'name' => 'Aurelia Adjustable Ring',
                'price' => 39000,
                'stock' => 15,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ012',
                'name' => 'Evelyn Crystal Ring',
                'price' => 44000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ013',
                'name' => 'Fleur Pearl Ring',
                'price' => 41000,
                'stock' => 9,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ014',
                'name' => 'Adeline Jewelry Set',
                'price' => 115000,
                'stock' => 7,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

            [
                'product_code' => 'PJ015',
                'name' => 'Valencia Crystal Jewelry Set',
                'price' => 135000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Perhiasan & Jewelry',
            $jewelryProducts
        );


        /*
        |--------------------------------------------------------------------------
        | PRODUK - TAS & DOMPET
        |--------------------------------------------------------------------------
        */

        $bagWalletProducts = [

            [
                'product_code' => 'TD001',
                'name' => 'Amelia Classic Shoulder Bag',
                'price' => 149000,
                'stock' => 18,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD002',
                'name' => 'Camille Mini Sling Bag',
                'price' => 119000,
                'stock' => 23,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD003',
                'name' => 'Claire Everyday Tote Bag',
                'price' => 139000,
                'stock' => 16,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD004',
                'name' => 'Aurelia Structured Handbag',
                'price' => 189000,
                'stock' => 12,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD005',
                'name' => 'Rosalie Quilted Chain Bag',
                'price' => 179000,
                'stock' => 9,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD006',
                'name' => 'Elise Casual Hobo Bag',
                'price' => 159000,
                'stock' => 4,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD007',
                'name' => 'Nadine Canvas Campus Tote',
                'price' => 89000,
                'stock' => 27,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD008',
                'name' => 'Sienna Compact Backpack',
                'price' => 169000,
                'stock' => 14,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD009',
                'name' => 'Belle Mini Bucket Bag',
                'price' => 129000,
                'stock' => 7,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD010',
                'name' => 'Luna Soft Crossbody Bag',
                'price' => 125000,
                'stock' => 5,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD011',
                'name' => 'Sophia Long Wallet',
                'price' => 79000,
                'stock' => 20,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD012',
                'name' => 'Mirelle Compact Wallet',
                'price' => 59000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD013',
                'name' => 'Elora Card Holder',
                'price' => 39000,
                'stock' => 31,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD014',
                'name' => 'Florence Multipurpose Pouch',
                'price' => 49000,
                'stock' => 11,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'TD015',
                'name' => 'Vivienne Premium Handbag',
                'price' => 249000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Tas & Dompet',
            $bagWalletProducts
        );


        /*
        |--------------------------------------------------------------------------
        | PRODUK - ATASAN WANITA
        |--------------------------------------------------------------------------
        */

        $womenTopProducts = [

            [
                'product_code' => 'AW001',
                'name' => 'Alina Basic Cotton Shirt',
                'price' => 89000,
                'stock' => 26,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW002',
                'name' => 'Camille Soft Blouse',
                'price' => 109000,
                'stock' => 21,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW003',
                'name' => 'Elora Korean Oversize Shirt',
                'price' => 119000,
                'stock' => 18,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW004',
                'name' => 'Luna Ribbed Knit Top',
                'price' => 99000,
                'stock' => 15,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW005',
                'name' => 'Rosalie Puff Sleeve Blouse',
                'price' => 125000,
                'stock' => 12,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW006',
                'name' => 'Aurelia Pleated Blouse',
                'price' => 129000,
                'stock' => 8,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW007',
                'name' => 'Sienna Casual Tunic',
                'price' => 139000,
                'stock' => 17,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW008',
                'name' => 'Nadine Linen Shirt',
                'price' => 135000,
                'stock' => 10,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW009',
                'name' => 'Belle Knit Collar Top',
                'price' => 105000,
                'stock' => 5,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW010',
                'name' => 'Mirelle Ruffle Blouse',
                'price' => 115000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW011',
                'name' => 'Claire Striped Casual Shirt',
                'price' => 98000,
                'stock' => 22,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW012',
                'name' => 'Florence Satin Blouse',
                'price' => 149000,
                'stock' => 7,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW013',
                'name' => 'Amelia Minimalist Crop Shirt',
                'price' => 95000,
                'stock' => 14,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW014',
                'name' => 'Serena Premium Lace Blouse',
                'price' => 165000,
                'stock' => 4,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'AW015',
                'name' => 'Vivienne Signature Blouse',
                'price' => 179000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Atasan Wanita',
            $womenTopProducts
        );


        /*
        |--------------------------------------------------------------------------
        | PRODUK - BAWAHAN WANITA
        |--------------------------------------------------------------------------
        */

        $womenBottomProducts = [

            [
                'product_code' => 'BW001',
                'name' => 'Alina High Waist Trousers',
                'price' => 139000,
                'stock' => 24,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW002',
                'name' => 'Camille Wide Leg Pants',
                'price' => 145000,
                'stock' => 19,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW003',
                'name' => 'Elora Straight Cut Jeans',
                'price' => 169000,
                'stock' => 16,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW004',
                'name' => 'Luna Pleated Midi Skirt',
                'price' => 125000,
                'stock' => 21,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW005',
                'name' => 'Rosalie Korean Culotte',
                'price' => 129000,
                'stock' => 13,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW006',
                'name' => 'Aurelia Formal Trousers',
                'price' => 159000,
                'stock' => 9,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW007',
                'name' => 'Sienna A-Line Midi Skirt',
                'price' => 119000,
                'stock' => 18,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW008',
                'name' => 'Nadine Linen Culotte',
                'price' => 135000,
                'stock' => 7,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW009',
                'name' => 'Belle Relaxed Denim Jeans',
                'price' => 175000,
                'stock' => 5,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW010',
                'name' => 'Mirelle Soft Pleated Skirt',
                'price' => 129000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW011',
                'name' => 'Claire Everyday Cargo Pants',
                'price' => 149000,
                'stock' => 20,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW012',
                'name' => 'Florence Satin Midi Skirt',
                'price' => 155000,
                'stock' => 11,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW013',
                'name' => 'Amelia Flare Pants',
                'price' => 142000,
                'stock' => 15,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW014',
                'name' => 'Serena Premium Palazzo Pants',
                'price' => 185000,
                'stock' => 4,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'BW015',
                'name' => 'Vivienne Signature Maxi Skirt',
                'price' => 195000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Bawahan Wanita',
            $womenBottomProducts
        );


        /*
        |--------------------------------------------------------------------------
        | PRODUK - DRESS & ONE PIECE
        |--------------------------------------------------------------------------
        */

        $dressProducts = [

            [
                'product_code' => 'DO001',
                'name' => 'Amelia Everyday Midi Dress',
                'price' => 169000,
                'stock' => 37,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO002',
                'name' => 'Rosalie Floral Midi Dress',
                'price' => 189000,
                'stock' => 23,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO003',
                'name' => 'Elora Linen Shirt Dress',
                'price' => 179000,
                'stock' => 31,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO004',
                'name' => 'Camille Pleated Maxi Dress',
                'price' => 219000,
                'stock' => 14,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO005',
                'name' => 'Luna Knit Casual Dress',
                'price' => 159000,
                'stock' => 42,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO006',
                'name' => 'Aurelia Puff Sleeve Dress',
                'price' => 205000,
                'stock' => 11,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO007',
                'name' => 'Sienna Belted Shirt Dress',
                'price' => 195000,
                'stock' => 26,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO008',
                'name' => 'Nadine Minimalist Jumpsuit',
                'price' => 199000,
                'stock' => 18,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO009',
                'name' => 'Belle Soft Tiered Dress',
                'price' => 185000,
                'stock' => 8,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO010',
                'name' => 'Claire Denim Overall Dress',
                'price' => 175000,
                'stock' => 29,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO011',
                'name' => 'Mirelle Ruffle Maxi Dress',
                'price' => 229000,
                'stock' => 6,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO012',
                'name' => 'Florence Satin Evening Dress',
                'price' => 279000,
                'stock' => 4,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO013',
                'name' => 'Adeline Square Neck Dress',
                'price' => 215000,
                'stock' => 16,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO014',
                'name' => 'Serena Lace Midi Dress',
                'price' => 259000,
                'stock' => 2,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO015',
                'name' => 'Celeste Elegant Wrap Dress',
                'price' => 239000,
                'stock' => 13,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO016',
                'name' => 'Aurora Chiffon Maxi Dress',
                'price' => 249000,
                'stock' => 1,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO017',
                'name' => 'Valencia Premium Jumpsuit',
                'price' => 289000,
                'stock' => 9,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

            [
                'product_code' => 'DO018',
                'name' => 'Vivienne Signature Formal Dress',
                'price' => 329000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Dress & One Piece',
            $dressProducts
        );

                /*
        |--------------------------------------------------------------------------
        | PRODUK - HIJAB & SCARF
        |--------------------------------------------------------------------------
        */

        $hijabScarfProducts = [

            [
                'product_code' => 'HS001',
                'name' => 'Aira Voal Basic Square',
                'price' => 45000,
                'stock' => 58,
                'minimum_stock' => 12,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS002',
                'name' => 'Naura Premium Voal Hijab',
                'price' => 59000,
                'stock' => 43,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS003',
                'name' => 'Aluna Paris Premium Square',
                'price' => 39000,
                'stock' => 67,
                'minimum_stock' => 15,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS004',
                'name' => 'Safira Ultrafine Voal',
                'price' => 65000,
                'stock' => 34,
                'minimum_stock' => 9,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS005',
                'name' => 'Livia Cotton Voal Square',
                'price' => 49000,
                'stock' => 27,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS006',
                'name' => 'Zahra Ceruty Pashmina',
                'price' => 55000,
                'stock' => 39,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS007',
                'name' => 'Alesha Chiffon Pashmina',
                'price' => 52000,
                'stock' => 21,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS008',
                'name' => 'Kayla Crinkle Pashmina',
                'price' => 48000,
                'stock' => 46,
                'minimum_stock' => 11,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS009',
                'name' => 'Nayla Jersey Pashmina',
                'price' => 62000,
                'stock' => 32,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS010',
                'name' => 'Amara Silk Pashmina',
                'price' => 79000,
                'stock' => 17,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS011',
                'name' => 'Elina Pleated Pashmina',
                'price' => 58000,
                'stock' => 25,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS012',
                'name' => 'Kiara Instant Daily Hijab',
                'price' => 69000,
                'stock' => 51,
                'minimum_stock' => 12,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS013',
                'name' => 'Hana Sport Instant Hijab',
                'price' => 72000,
                'stock' => 36,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS014',
                'name' => 'Ameera Layer Instant Hijab',
                'price' => 85000,
                'stock' => 14,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS015',
                'name' => 'Lareina Motif Voal Scarf',
                'price' => 89000,
                'stock' => 19,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS016',
                'name' => 'Camellia Floral Scarf',
                'price' => 95000,
                'stock' => 11,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS017',
                'name' => 'Serena Monogram Scarf',
                'price' => 105000,
                'stock' => 8,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS018',
                'name' => 'Aurelia Satin Silk Scarf',
                'price' => 115000,
                'stock' => 6,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS019',
                'name' => 'Celeste Signature Scarf',
                'price' => 125000,
                'stock' => 4,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS020',
                'name' => 'Rosalie Luxe Printed Scarf',
                'price' => 119000,
                'stock' => 2,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS021',
                'name' => 'Florence Premium Silk Scarf',
                'price' => 139000,
                'stock' => 1,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'HS022',
                'name' => 'Vivienne Limited Edition Scarf',
                'price' => 159000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Hijab & Scarf',
            $hijabScarfProducts
        );

                /*
        |--------------------------------------------------------------------------
        | PRODUK - OUTERWEAR
        |--------------------------------------------------------------------------
        */

        $outerwearProducts = [

            [
                'product_code' => 'OW001',
                'name' => 'Elora Soft Knit Cardigan',
                'price' => 149000,
                'stock' => 28,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW002',
                'name' => 'Aurelia Classic Blazer',
                'price' => 239000,
                'stock' => 17,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW003',
                'name' => 'Luna Oversized Cardigan',
                'price' => 165000,
                'stock' => 34,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW004',
                'name' => 'Nadine Casual Denim Jacket',
                'price' => 219000,
                'stock' => 12,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW005',
                'name' => 'Camille Cropped Knit Cardigan',
                'price' => 139000,
                'stock' => 23,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW006',
                'name' => 'Sienna Lightweight Bomber Jacket',
                'price' => 229000,
                'stock' => 9,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW007',
                'name' => 'Rosalie Longline Cardigan',
                'price' => 179000,
                'stock' => 19,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW008',
                'name' => 'Claire Minimalist Vest',
                'price' => 129000,
                'stock' => 7,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW009',
                'name' => 'Florence Tailored Blazer',
                'price' => 259000,
                'stock' => 5,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW010',
                'name' => 'Amelia Casual Zip Jacket',
                'price' => 199000,
                'stock' => 16,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW011',
                'name' => 'Serena Premium Tweed Jacket',
                'price' => 289000,
                'stock' => 3,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW012',
                'name' => 'Celeste Elegant Trench Coat',
                'price' => 329000,
                'stock' => 1,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

            [
                'product_code' => 'OW013',
                'name' => 'Vivienne Signature Wool Coat',
                'price' => 389000,
                'stock' => 0,
                'minimum_stock' => 2,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Outerwear',
            $outerwearProducts
        );

                /*
        |--------------------------------------------------------------------------
        | PRODUK - FASHION ACCESSORIES
        |--------------------------------------------------------------------------
        */

        $fashionAccessoryProducts = [

            [
                'product_code' => 'FA001',
                'name' => 'Amelia Classic Leather Belt',
                'price' => 69000,
                'stock' => 38,
                'minimum_stock' => 9,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA002',
                'name' => 'Luna Minimalist Buckle Belt',
                'price' => 59000,
                'stock' => 27,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA003',
                'name' => 'Aurelia Slim Waist Belt',
                'price' => 65000,
                'stock' => 19,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA004',
                'name' => 'Rosalie Pearl Waist Belt',
                'price' => 79000,
                'stock' => 11,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA005',
                'name' => 'Celeste Oval Sunglasses',
                'price' => 85000,
                'stock' => 42,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA006',
                'name' => 'Nadine Retro Square Sunglasses',
                'price' => 89000,
                'stock' => 31,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA007',
                'name' => 'Sienna Cat Eye Sunglasses',
                'price' => 95000,
                'stock' => 16,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA008',
                'name' => 'Camellia Pearl Brooch',
                'price' => 39000,
                'stock' => 53,
                'minimum_stock' => 12,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA009',
                'name' => 'Fleur Crystal Brooch',
                'price' => 45000,
                'stock' => 24,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA010',
                'name' => 'Elora Ribbon Brooch',
                'price' => 35000,
                'stock' => 8,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA011',
                'name' => 'Belle Pearl Scarf Ring',
                'price' => 32000,
                'stock' => 47,
                'minimum_stock' => 10,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA012',
                'name' => 'Serena Crystal Scarf Ring',
                'price' => 42000,
                'stock' => 14,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA013',
                'name' => 'Daisy Flower Bag Charm',
                'price' => 38000,
                'stock' => 36,
                'minimum_stock' => 9,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA014',
                'name' => 'Mirelle Pearl Bag Charm',
                'price' => 49000,
                'stock' => 21,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA015',
                'name' => 'Claire Ribbon Keychain',
                'price' => 29000,
                'stock' => 62,
                'minimum_stock' => 15,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA016',
                'name' => 'Florence Pearl Eyewear Chain',
                'price' => 55000,
                'stock' => 7,
                'minimum_stock' => 9,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA017',
                'name' => 'Adeline Vintage Collar Pin',
                'price' => 52000,
                'stock' => 3,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA018',
                'name' => 'Valencia Premium Chain Belt',
                'price' => 119000,
                'stock' => 1,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'FA019',
                'name' => 'Vivienne Signature Brooch',
                'price' => 129000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Fashion Accessories',
            $fashionAccessoryProducts
        );

                /*
        |--------------------------------------------------------------------------
        | PRODUK - FOOTWEAR
        |--------------------------------------------------------------------------
        */

        $footwearProducts = [

            [
                'product_code' => 'FW001',
                'name' => 'Amelia Classic Ballet Flats',
                'price' => 129000,
                'stock' => 32,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW002',
                'name' => 'Elora Square Toe Flats',
                'price' => 139000,
                'stock' => 21,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW003',
                'name' => 'Belle Ribbon Mary Jane Flats',
                'price' => 149000,
                'stock' => 27,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW004',
                'name' => 'Claire Classic Penny Loafers',
                'price' => 179000,
                'stock' => 18,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW005',
                'name' => 'Aurelia Chunky Loafers',
                'price' => 199000,
                'stock' => 13,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW006',
                'name' => 'Luna Everyday Sneakers',
                'price' => 219000,
                'stock' => 39,
                'minimum_stock' => 9,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW007',
                'name' => 'Nadine Retro Casual Sneakers',
                'price' => 239000,
                'stock' => 24,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW008',
                'name' => 'Sienna Platform Sneakers',
                'price' => 259000,
                'stock' => 16,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW009',
                'name' => 'Daisy Casual Strap Sandals',
                'price' => 99000,
                'stock' => 46,
                'minimum_stock' => 11,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW010',
                'name' => 'Camille Minimalist Slide Sandals',
                'price' => 109000,
                'stock' => 8,
                'minimum_stock' => 8,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW011',
                'name' => 'Rosalie Braided Sandals',
                'price' => 119000,
                'stock' => 29,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW012',
                'name' => 'Mirelle Pointed Toe Mules',
                'price' => 159000,
                'stock' => 11,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW013',
                'name' => 'Florence Kitten Heels',
                'price' => 189000,
                'stock' => 6,
                'minimum_stock' => 7,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW014',
                'name' => 'Serena Block Heels',
                'price' => 209000,
                'stock' => 4,
                'minimum_stock' => 6,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW015',
                'name' => 'Celeste Pearl Strap Heels',
                'price' => 229000,
                'stock' => 2,
                'minimum_stock' => 5,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW016',
                'name' => 'Valencia Premium Platform Heels',
                'price' => 279000,
                'stock' => 1,
                'minimum_stock' => 4,
                'is_active' => true,
            ],

            [
                'product_code' => 'FW017',
                'name' => 'Vivienne Signature Heels',
                'price' => 319000,
                'stock' => 0,
                'minimum_stock' => 3,
                'is_active' => true,
            ],

        ];

        $this->seedProducts(
            'Footwear',
            $footwearProducts
        );

    }


    /**
     * Menyimpan kumpulan produk berdasarkan kategori.
     */
    private function seedProducts(
        string $categoryName,
        array $products
    ): void {

        $categoryId = DB::table('categories')
            ->where('name', $categoryName)
            ->value('id');


        if (!$categoryId) {
            return;
        }


        foreach ($products as $product) {

            $existingProduct = DB::table('products')
                ->where(
                    'product_code',
                    $product['product_code']
                )
                ->first();


            DB::table('products')->updateOrInsert(

                [
                    'product_code' =>
                        $product['product_code'],
                ],

                [
                    'category_id' =>
                        $categoryId,

                    'name' =>
                        $product['name'],

                    'price' =>
                        $product['price'],

                    'stock' =>
                        $product['stock'],

                    'minimum_stock' =>
                        $product['minimum_stock'],

                    'is_active' =>
                        $product['is_active'],

                    'created_at' =>
                        $existingProduct
                            ? $existingProduct->created_at
                            : now(),

                    'updated_at' =>
                        now(),
                ]

            );

        }
    }
}