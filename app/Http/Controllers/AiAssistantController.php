<?php

namespace App\Http\Controllers;

use App\Models\AiRecommendation;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiAssistantController extends Controller
{
    /**
     * Menampilkan halaman utama AI Business Assistant.
     */
    public function index()
    {
        $businessData = $this->getBusinessData();

        $recommendationHistory = AiRecommendation::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->limit(5)
            ->get();

        return view(
            'ai.index',
            array_merge(
                $businessData,
                [
                    'recommendationHistory' =>
                        $recommendationHistory,
                ]
            )
        );
    }


    /**
     * Menampilkan kembali hasil analisis AI
     * yang tersimpan di riwayat.
     */
    public function show(
        AiRecommendation $aiRecommendation
    ) {
        /*
        |--------------------------------------------------------------------------
        | Keamanan Riwayat
        |--------------------------------------------------------------------------
        */

        if (
            $aiRecommendation->user_id
            !== auth()->id()
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Data Bisnis Terbaru
        |--------------------------------------------------------------------------
        */

        $businessData =
            $this->getBusinessData();


        /*
        |--------------------------------------------------------------------------
        | Riwayat Rekomendasi
        |--------------------------------------------------------------------------
        */

        $recommendationHistory =
            AiRecommendation::query()
                ->where(
                    'user_id',
                    auth()->id()
                )
                ->latest()
                ->limit(5)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Menampilkan Halaman
        |--------------------------------------------------------------------------
        */

        return view(
            'ai.index',
            array_merge(
                $businessData,
                [
                    'recommendationHistory' =>
                        $recommendationHistory,

                    'selectedRecommendation' =>
                        $aiRecommendation,
                ]
            )
        );
    }


    /**
     * Memproses analisis bisnis
     * menggunakan Gemini AI.
     */
    public function analyze(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'analysis_type' => [
                    'required',
                    'in:sales_analysis,promotion,inventory',
                ],
            ],
            [
                'analysis_type.required' =>
                    'Silakan pilih jenis analisis.',

                'analysis_type.in' =>
                    'Jenis analisis yang dipilih tidak valid.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Konfigurasi Gemini
        |--------------------------------------------------------------------------
        */

        $apiKey =
            config('services.gemini.api_key');

        $model = config(
            'services.gemini.model',
            'gemini-3.5-flash-lite'
        );


        if (empty($apiKey)) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Gemini API Key belum dikonfigurasi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Mengambil Data Bisnis
        |--------------------------------------------------------------------------
        */

        $businessData =
            $this->getBusinessData();


        /*
        |--------------------------------------------------------------------------
        | Membuat Ringkasan Data
        |--------------------------------------------------------------------------
        |
        | Data pribadi pelanggan tidak dikirim ke Gemini.
        | Gemini hanya menerima data agregat pelanggan.
        |
        */

        $businessSummary =
            $this->buildBusinessSummary(
                $businessData
            );


        /*
        |--------------------------------------------------------------------------
        | Membuat Prompt
        |--------------------------------------------------------------------------
        */

        $prompt =
            $this->buildPrompt(
                $validated['analysis_type'],
                $businessSummary
            );


        /*
        |--------------------------------------------------------------------------
        | Mengirim Permintaan ke Gemini
        |--------------------------------------------------------------------------
        */

        try {

            $response = Http::timeout(60)
                ->acceptJson()
                ->withHeaders([
                    'x-goog-api-key' =>
                        $apiKey,
                ])
                ->post(
                    'https://generativelanguage.googleapis.com/v1beta/models/'
                    . $model
                    . ':generateContent',
                    [
                        'contents' => [
                            [
                                'role' => 'user',

                                'parts' => [
                                    [
                                        'text' =>
                                            $prompt,
                                    ],
                                ],
                            ],
                        ],

                        'generationConfig' => [
                            'temperature' => 0.5,
                            'maxOutputTokens' => 3072,
                        ],
                    ]
                );


            /*
            |--------------------------------------------------------------------------
            | Jika Gemini Mengembalikan Error
            |--------------------------------------------------------------------------
            */

            if ($response->failed()) {

                Log::error(
                    'Gemini API Error',
                    [
                        'status' =>
                            $response->status(),

                        'body' =>
                            $response->json(),
                    ]
                );


                $message = match (
                    $response->status()
                ) {

                    400 =>
                        'Permintaan ke Gemini tidak dapat diproses.',

                    401 =>
                        'Gemini API Key tidak valid.',

                    403 =>
                        'Akses Gemini API ditolak. Periksa API Key dan project Google AI Studio.',

                    404 =>
                        'Model Gemini yang digunakan tidak tersedia.',

                    429 =>
                        'Batas penggunaan Gemini sementara tercapai. Silakan coba kembali beberapa saat lagi.',

                    default =>
                        'Gemini sedang tidak dapat memproses analisis. Silakan coba kembali.',

                };


                return back()
                    ->withInput()
                    ->with(
                        'error',
                        $message
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Mengambil Teks Jawaban Gemini
            |--------------------------------------------------------------------------
            */

            $result = collect(
                $response->json(
                    'candidates.0.content.parts',
                    []
                )
            )
                ->pluck('text')
                ->filter()
                ->implode("\n");


            /*
            |--------------------------------------------------------------------------
            | Memastikan Gemini Memberikan Jawaban
            |--------------------------------------------------------------------------
            */

            if (blank($result)) {

                Log::warning(
                    'Gemini returned empty response',
                    [
                        'response' =>
                            $response->json(),
                    ]
                );


                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Gemini belum memberikan hasil analisis. Silakan coba kembali.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Menyimpan Riwayat AI
            |--------------------------------------------------------------------------
            |
            | Periode menunjukkan enam bulan data tren
            | yang digunakan sebagai salah satu dasar analisis.
            |
            */

            $recommendation =
                AiRecommendation::create([
                    'user_id' =>
                        auth()->id(),

                    'type' =>
                        $validated['analysis_type'],

                    'period_start' =>
                        $businessData['periodStart']
                            ->toDateString(),

                    'period_end' =>
                        $businessData['periodEnd']
                            ->toDateString(),

                    'input_summary' =>
                        $businessSummary,

                    'result' =>
                        $result,
                ]);


            /*
            |--------------------------------------------------------------------------
            | Kembali ke Halaman AI
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('ai.index')
                ->with(
                    'success',
                    'Analisis AI berhasil dibuat.'
                )
                ->with(
                    'ai_result',
                    $result
                )
                ->with(
                    'ai_type',
                    $validated['analysis_type']
                )
                ->with(
                    'ai_recommendation_id',
                    $recommendation->id
                );

        } catch (\Throwable $exception) {

            Log::error(
                'Gemini Connection Error',
                [
                    'message' =>
                        $exception->getMessage(),
                ]
            );


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Tidak dapat terhubung ke Gemini. Periksa koneksi internet dan coba kembali.'
                );
        }
    }


    /**
     * Mengambil data bisnis yang digunakan
     * oleh AI Business Assistant.
     */
    private function getBusinessData(): array
    {
        /*
        |--------------------------------------------------------------------------
        | Ringkasan Penjualan Keseluruhan
        |--------------------------------------------------------------------------
        */

        $totalSales = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->sum(
                'total_amount'
            );


        $totalTransactions = Sale::query()
            ->where(
                'status',
                'completed'
            )
            ->count();


        $averageTransaction =
            $totalTransactions > 0
                ? $totalSales / $totalTransactions
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Produk Aktif
        |--------------------------------------------------------------------------
        */

        $activeProducts =
            Product::query()
                ->where(
                    'is_active',
                    true
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Data Pelanggan Agregat
        |--------------------------------------------------------------------------
        |
        | Tidak ada nama, email, telepon, atau alamat
        | pelanggan yang dikirim ke Gemini.
        |
        */

        $totalCustomers =
            Customer::query()
                ->count();


        $customersWithCompletedSales =
            Customer::query()
                ->whereHas(
                    'sales',
                    function ($query) {

                        $query->where(
                            'status',
                            'completed'
                        );

                    }
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Kondisi Stok Saat Ini
        |--------------------------------------------------------------------------
        */

        $safeStockCount =
            Product::query()
                ->where(
                    'is_active',
                    true
                )
                ->whereColumn(
                    'stock',
                    '>',
                    'minimum_stock'
                )
                ->count();


        $lowStockCount =
            Product::query()
                ->where(
                    'is_active',
                    true
                )
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


        $outOfStockCount =
            Product::query()
                ->where(
                    'is_active',
                    true
                )
                ->where(
                    'stock',
                    0
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        */

        $bestSellingProducts =
            SaleItem::query()
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
                ->groupBy(
                    'product_id'
                )
                ->orderByDesc(
                    'total_quantity'
                )
                ->limit(5)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Produk dengan Penjualan Rendah
        |--------------------------------------------------------------------------
        |
        | Produk aktif yang pernah terjual diurutkan dari
        | jumlah penjualan paling sedikit.
        |
        | Produk yang sama sekali belum pernah terjual
        | ditangani secara terpisah.
        |
        */

        $lowSellingProducts =
            SaleItem::query()
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
                ->whereHas(
                    'product',
                    function ($query) {

                        $query->where(
                            'is_active',
                            true
                        );

                    }
                )
                ->groupBy(
                    'product_id'
                )
                ->orderBy(
                    'total_quantity'
                )
                ->orderBy(
                    'total_revenue'
                )
                ->limit(5)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Produk yang Belum Pernah Terjual
        |--------------------------------------------------------------------------
        */

        $neverSoldProducts =
            Product::query()
                ->with('category')
                ->where(
                    'is_active',
                    true
                )
                ->whereDoesntHave(
                    'saleItems',
                    function ($query) {

                        $query->whereHas(
                            'sale',
                            function ($saleQuery) {

                                $saleQuery->where(
                                    'status',
                                    'completed'
                                );

                            }
                        );

                    }
                )
                ->orderBy('name')
                ->limit(5)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Produk yang Membutuhkan Perhatian Stok
        |--------------------------------------------------------------------------
        */

        $stockAttentionProducts =
            Product::query()
                ->with('category')
                ->where(
                    'is_active',
                    true
                )
                ->where(
                    function ($query) {

                        $query
                            ->where(
                                'stock',
                                0
                            )
                            ->orWhere(
                                function (
                                    $subQuery
                                ) {

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
                                }
                            );
                    }
                )
                ->withSum(
                    [
                        'saleItems as completed_quantity_sold'
                            => function ($query) {

                                $query->whereHas(
                                    'sale',
                                    function (
                                        $saleQuery
                                    ) {

                                        $saleQuery
                                            ->where(
                                                'status',
                                                'completed'
                                            );
                                    }
                                );
                            },
                    ],
                    'quantity'
                )
                ->orderBy('stock')
                ->orderBy('name')
                ->limit(10)
                ->get();


        /*
        |--------------------------------------------------------------------------
        | Periode Tren 6 Bulan
        |--------------------------------------------------------------------------
        */

        $periodEnd =
            Carbon::today()
                ->endOfMonth();


        $periodStart =
            Carbon::today()
                ->startOfMonth()
                ->subMonths(5);


        /*
        |--------------------------------------------------------------------------
        | Tren Penjualan 6 Bulan
        |--------------------------------------------------------------------------
        */

        $monthlySalesTrend = collect();


        for ($i = 5; $i >= 0; $i--) {

            $month =
                Carbon::today()
                    ->startOfMonth()
                    ->subMonths($i);


            $monthlySales =
                Sale::query()
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
                    ->sum(
                        'total_amount'
                    );


            $monthlyTransactions =
                Sale::query()
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


            $monthlySalesTrend->push([
                'month' =>
                    $month->translatedFormat(
                        'F Y'
                    ),

                'sales' =>
                    (float) $monthlySales,

                'transactions' =>
                    $monthlyTransactions,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Penjualan 30 Hari Terakhir
        |--------------------------------------------------------------------------
        */

        $salesLast30Days =
            Sale::query()
                ->where(
                    'status',
                    'completed'
                )
                ->where(
                    'sale_date',
                    '>=',
                    now()->subDays(30)
                )
                ->sum(
                    'total_amount'
                );


        $transactionsLast30Days =
            Sale::query()
                ->where(
                    'status',
                    'completed'
                )
                ->where(
                    'sale_date',
                    '>=',
                    now()->subDays(30)
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return [
            'totalSales' =>
                $totalSales,

            'totalTransactions' =>
                $totalTransactions,

            'averageTransaction' =>
                $averageTransaction,

            'activeProducts' =>
                $activeProducts,

            'totalCustomers' =>
                $totalCustomers,

            'customersWithCompletedSales' =>
                $customersWithCompletedSales,

            'safeStockCount' =>
                $safeStockCount,

            'lowStockCount' =>
                $lowStockCount,

            'outOfStockCount' =>
                $outOfStockCount,

            'bestSellingProducts' =>
                $bestSellingProducts,

            'lowSellingProducts' =>
                $lowSellingProducts,

            'neverSoldProducts' =>
                $neverSoldProducts,

            'stockAttentionProducts' =>
                $stockAttentionProducts,

            'monthlySalesTrend' =>
                $monthlySalesTrend,

            'salesLast30Days' =>
                $salesLast30Days,

            'transactionsLast30Days' =>
                $transactionsLast30Days,

            'periodStart' =>
                $periodStart,

            'periodEnd' =>
                $periodEnd,
        ];
    }


    /**
     * Mengubah data bisnis menjadi ringkasan teks
     * yang aman untuk dikirim ke Gemini.
     */
    private function buildBusinessSummary(
        array $businessData
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Tren Penjualan
        |--------------------------------------------------------------------------
        */

        $monthlyTrendText =
            $businessData['monthlySalesTrend']
                ->map(
                    function ($month) {

                        return sprintf(
                            '- %s: penjualan Rp%s, %d transaksi',
                            $month['month'],
                            number_format(
                                $month['sales'],
                                0,
                                ',',
                                '.'
                            ),
                            $month['transactions']
                        );
                    }
                )
                ->implode("\n");


        /*
        |--------------------------------------------------------------------------
        | Produk Terlaris
        |--------------------------------------------------------------------------
        */

        $bestSellingText =
            $businessData['bestSellingProducts']
                ->map(
                    function ($item) {

                        $productName =
                            $item->product?->name
                            ?? 'Produk tidak tersedia';

                        $categoryName =
                            $item->product?->category?->name
                            ?? 'Tanpa kategori';


                        return sprintf(
                            '- %s (%s): %d item terjual, pendapatan Rp%s',
                            $productName,
                            $categoryName,
                            $item->total_quantity,
                            number_format(
                                (float) $item->total_revenue,
                                0,
                                ',',
                                '.'
                            )
                        );
                    }
                )
                ->implode("\n");


        if (blank($bestSellingText)) {

            $bestSellingText =
                '- Belum ada data produk terjual.';
        }


        /*
        |--------------------------------------------------------------------------
        | Produk dengan Penjualan Rendah
        |--------------------------------------------------------------------------
        */

        $lowSellingText =
            $businessData['lowSellingProducts']
                ->map(
                    function ($item) {

                        $productName =
                            $item->product?->name
                            ?? 'Produk tidak tersedia';

                        $categoryName =
                            $item->product?->category?->name
                            ?? 'Tanpa kategori';


                        return sprintf(
                            '- %s (%s): %d item terjual, pendapatan Rp%s',
                            $productName,
                            $categoryName,
                            $item->total_quantity,
                            number_format(
                                (float) $item->total_revenue,
                                0,
                                ',',
                                '.'
                            )
                        );
                    }
                )
                ->implode("\n");


        if (blank($lowSellingText)) {

            $lowSellingText =
                '- Belum ada data produk dengan penjualan rendah.';
        }


        /*
        |--------------------------------------------------------------------------
        | Produk yang Belum Pernah Terjual
        |--------------------------------------------------------------------------
        */

        $neverSoldText =
            $businessData['neverSoldProducts']
                ->map(
                    function ($product) {

                        $categoryName =
                            $product->category?->name
                            ?? 'Tanpa kategori';


                        return sprintf(
                            '- %s (%s): belum memiliki transaksi penjualan selesai',
                            $product->name,
                            $categoryName
                        );
                    }
                )
                ->implode("\n");


        if (blank($neverSoldText)) {

            $neverSoldText =
                '- Semua produk aktif yang dianalisis memiliki riwayat penjualan.';
        }


        /*
        |--------------------------------------------------------------------------
        | Produk dengan Stok Perlu Perhatian
        |--------------------------------------------------------------------------
        */

        $stockAttentionText =
            $businessData['stockAttentionProducts']
                ->map(
                    function ($product) {

                        $status =
                            $product->stock == 0
                                ? 'Habis'
                                : 'Menipis';

                        $soldQuantity =
                            (int) (
                                $product
                                    ->completed_quantity_sold
                                ?? 0
                            );


                        return sprintf(
                            '- %s (%s): stok %d, minimum %d, status %s, total terjual %d item',
                            $product->name,
                            $product->category?->name
                                ?? 'Tanpa kategori',
                            $product->stock,
                            $product->minimum_stock,
                            $status,
                            $soldQuantity
                        );
                    }
                )
                ->implode("\n");


        if (blank($stockAttentionText)) {

            $stockAttentionText =
                '- Tidak ada produk dengan stok menipis atau habis.';
        }


        /*
        |--------------------------------------------------------------------------
        | Ringkasan Lengkap
        |--------------------------------------------------------------------------
        */

        return
            "RINGKASAN DATA BISNIS INTANMITHA COLLECTION\n\n"

            . "CATATAN DATA:\n"
            . "- Seluruh data penjualan di bawah hanya menghitung transaksi dengan status selesai.\n"
            . "- Transaksi yang dibatalkan tidak dihitung dalam omzet, jumlah transaksi, atau performa produk.\n"
            . "- Stok merupakan kondisi persediaan aktual saat analisis dibuat.\n"
            . "- Data pelanggan yang digunakan hanya berupa jumlah agregat dan tidak memuat data pribadi.\n\n"


            . "RINGKASAN UMUM:\n"

            . "- Total penjualan selesai: Rp"
            . number_format(
                (float) $businessData['totalSales'],
                0,
                ',',
                '.'
            )
            . "\n"

            . "- Total transaksi selesai: "
            . number_format(
                $businessData['totalTransactions'],
                0,
                ',',
                '.'
            )
            . "\n"

            . "- Rata-rata nilai transaksi: Rp"
            . number_format(
                (float) $businessData['averageTransaction'],
                0,
                ',',
                '.'
            )
            . "\n"

            . "- Produk aktif: "
            . $businessData['activeProducts']
            . "\n"

            . "- Pelanggan terdaftar: "
            . $businessData['totalCustomers']
            . "\n"

            . "- Pelanggan yang pernah memiliki transaksi selesai: "
            . $businessData['customersWithCompletedSales']
            . "\n\n"


            . "TREN PENJUALAN 6 BULAN TERAKHIR:\n"
            . $monthlyTrendText
            . "\n\n"


            . "PENJUALAN 30 HARI TERAKHIR:\n"

            . "- Total penjualan: Rp"
            . number_format(
                (float) $businessData['salesLast30Days'],
                0,
                ',',
                '.'
            )
            . "\n"

            . "- Jumlah transaksi: "
            . $businessData['transactionsLast30Days']
            . "\n\n"


            . "KONDISI PERSEDIAAN SAAT INI:\n"

            . "- Stok aman: "
            . $businessData['safeStockCount']
            . " produk\n"

            . "- Stok menipis: "
            . $businessData['lowStockCount']
            . " produk\n"

            . "- Stok habis: "
            . $businessData['outOfStockCount']
            . " produk\n\n"


            . "PRODUK TERLARIS:\n"
            . $bestSellingText
            . "\n\n"


            . "PRODUK DENGAN PENJUALAN RENDAH:\n"
            . $lowSellingText
            . "\n\n"


            . "PRODUK YANG BELUM PERNAH TERJUAL:\n"
            . $neverSoldText
            . "\n\n"


            . "PRODUK YANG MEMBUTUHKAN PERHATIAN STOK:\n"
            . $stockAttentionText;
    }


    /**
     * Membuat prompt sesuai jenis analisis
     * yang dipilih pengguna.
     */
private function buildPrompt(
    string $analysisType,
    string $businessSummary
): string {

    /*
    |--------------------------------------------------------------------------
    | Instruksi Dasar
    |--------------------------------------------------------------------------
    */

    $baseInstruction = <<<PROMPT
Anda adalah AI Business Assistant untuk aplikasi InoMitha,
sebuah sistem informasi bisnis pada simulasi toko aksesoris
dan fashion bernama IntanMitha Collection.

Tugas Anda adalah membantu administrator memahami data bisnis
dan memberikan rekomendasi yang realistis berdasarkan data
yang diberikan.

Gunakan Bahasa Indonesia yang:
- jelas,
- natural,
- profesional tetapi mudah dipahami,
- tidak terlalu kaku,
- ringkas tetapi tetap memberikan alasan yang berguna.

ATURAN PENTING:
1. Gunakan hanya data yang diberikan.
2. Jangan mengarang angka, produk, transaksi, tren, atau fakta baru.
3. Bedakan data penjualan historis dengan kondisi stok saat ini.
4. Jangan menyimpulkan bahwa stok saat ini disebabkan oleh penjualan
   apabila hubungan tersebut tidak dapat dibuktikan dari data.
5. Jika data belum cukup untuk mengambil kesimpulan tertentu,
   jelaskan bahwa datanya masih terbatas.
6. Jangan meminta atau menebak data pribadi pelanggan.
7. Jangan menyatakan prediksi sebagai kepastian.
8. Gunakan Rupiah untuk nilai uang.
9. Berikan rekomendasi yang dapat diterapkan pada bisnis kecil.
10. Jangan menggunakan tabel Markdown.
11. Gunakan judul dan poin-poin agar hasil mudah dibaca.
12. Produk dengan penjualan rendah tidak otomatis berarti buruk.
    Gunakan data tersebut hanya sebagai bahan evaluasi.
13. Produk yang belum pernah terjual tidak otomatis harus diberi
    diskon atau dihentikan tanpa data pendukung tambahan.
14. Jangan menyatakan terjadi kenaikan atau penurunan berdasarkan
    bulan berjalan yang belum selesai dibandingkan dengan bulan penuh.
15. Data 30 hari terakhir tidak boleh disebut mengalami kenaikan
    atau penurunan apabila tidak tersedia data periode 30 hari
    sebelumnya sebagai pembanding yang setara.
16. Untuk membaca tren, prioritaskan perbandingan antarbulan penuh
    yang tersedia. Bulan berjalan hanya boleh dijelaskan sebagai
    kondisi sementara.
17. Jangan membuat hubungan sebab-akibat yang tidak dapat dibuktikan
    oleh data yang diberikan.

DATA BISNIS:

{$businessSummary}

PROMPT;


    /*
    |--------------------------------------------------------------------------
    | Analisis Penjualan
    |--------------------------------------------------------------------------
    */

    if ($analysisType === 'sales_analysis') {

        return $baseInstruction . <<<PROMPT


TUGAS:
Lakukan analisis penjualan IntanMitha Collection.

Susun jawaban dengan format:

ANALISIS PENJUALAN

1. Ringkasan Kondisi Penjualan
Jelaskan kondisi penjualan berdasarkan total penjualan,
jumlah transaksi, rata-rata transaksi, data 30 hari terakhir,
dan tren enam bulan yang tersedia.

2. Tren Penjualan
Jelaskan perubahan penjualan dan jumlah transaksi antarbulan.

Untuk menyimpulkan kenaikan atau penurunan tren, gunakan
perbandingan antarbulan penuh yang tersedia.

Apabila bulan terakhir merupakan bulan berjalan yang belum
selesai, jangan membandingkannya secara langsung dengan bulan
penuh sebelumnya dan jangan menyebutnya sebagai penurunan
atau kenaikan tren.

Data 30 hari terakhir hanya boleh dijelaskan sebagai kondisi
30 hari terakhir dan bukan sebagai kenaikan atau penurunan
apabila tidak tersedia periode pembanding yang setara.

3. Produk dengan Performa Terbaik
Jelaskan produk yang memiliki performa paling baik berdasarkan
jumlah terjual dan pendapatan yang tersedia.

4. Produk yang Perlu Dievaluasi
Gunakan data produk dengan penjualan rendah dan produk yang
belum pernah terjual sebagai bahan evaluasi. Jangan langsung
menyatakan produk tersebut gagal.

5. Insight Pelanggan
Gunakan hanya jumlah pelanggan terdaftar dan jumlah pelanggan
yang pernah memiliki transaksi selesai. Jangan membuat profil
atau karakteristik pelanggan yang tidak tersedia.

6. Rekomendasi Bisnis
Berikan 3 sampai 5 tindakan yang realistis untuk meningkatkan
atau mempertahankan performa penjualan.

7. Kesimpulan
Berikan kesimpulan singkat mengenai kondisi bisnis berdasarkan
data yang tersedia.

Jangan membuat data yang tidak tersedia.
PROMPT;
    }


    /*
    |--------------------------------------------------------------------------
    | Ide Promosi
    |--------------------------------------------------------------------------
    */

    if ($analysisType === 'promotion') {

        return $baseInstruction . <<<PROMPT


TUGAS:
Buat rekomendasi promosi untuk IntanMitha Collection berdasarkan
data penjualan, performa produk, kondisi stok, dan tren yang
tersedia.

Susun jawaban dengan format:

REKOMENDASI PROMOSI

1. Dasar Rekomendasi
Jelaskan kondisi data yang menjadi dasar rekomendasi promosi.

Jika membahas tren penjualan, gunakan hanya perbandingan
antarbulan penuh yang tersedia.

Jangan menyebut bulan berjalan sebagai bukti terjadinya
penurunan atau kenaikan dibandingkan bulan penuh sebelumnya.

Jangan menyebut data 30 hari terakhir mengalami penurunan
atau kenaikan apabila tidak tersedia data 30 hari sebelumnya
sebagai pembanding.

2. Produk yang Layak Diprioritaskan
Tentukan produk yang berpotensi diprioritaskan dalam promosi.

Pertimbangkan performa penjualan dan kondisi stok agar produk
dengan stok kritis tidak direkomendasikan secara sembarangan.

Produk terlaris dengan stok aman dapat dipertimbangkan sebagai
kandidat promosi apabila didukung oleh data yang tersedia.

3. Produk yang Perlu Dievaluasi
Gunakan produk dengan penjualan rendah atau belum pernah
terjual sebagai kandidat evaluasi promosi.

Jangan menganggap bahwa rendahnya penjualan pasti disebabkan
oleh kurangnya promosi.

4. Ide Promosi
Berikan 3 sampai 5 ide promosi yang realistis untuk toko
aksesoris dan fashion.

Untuk setiap ide, jelaskan:
- konsep promosi,
- produk yang dapat dilibatkan jika didukung data,
- tujuan promosi,
- alasan rekomendasi.

5. Hal yang Perlu Diperhatikan
Jelaskan risiko sederhana, terutama apabila stok produk
terlalu sedikit untuk dipromosikan.

Jangan merekomendasikan promosi agresif terhadap produk
dengan stok habis atau menipis tanpa mempertimbangkan
ketersediaannya terlebih dahulu.

6. Prioritas Utama
Pilih rekomendasi promosi yang paling layak dilakukan terlebih
dahulu dan jelaskan alasannya berdasarkan data.

Jangan membuat persentase diskon, harga baru, target demografis,
karakteristik pelanggan, atau penyebab perubahan penjualan
yang tidak tersedia dalam data.
PROMPT;
    }


    /*
    |--------------------------------------------------------------------------
    | Rekomendasi Persediaan
    |--------------------------------------------------------------------------
    */

    return $baseInstruction . <<<PROMPT


TUGAS:
Analisis kondisi persediaan IntanMitha Collection dan berikan
rekomendasi stok berdasarkan data yang tersedia.

Susun jawaban dengan format:

REKOMENDASI PERSEDIAAN

1. Ringkasan Kondisi Stok
Jelaskan jumlah produk yang stoknya aman, menipis, dan habis.

2. Produk Prioritas Restock
Identifikasi produk yang sebaiknya mendapat perhatian terlebih
dahulu berdasarkan stok saat ini, minimum stok, dan total
penjualan produk yang tersedia.

Produk dengan stok habis atau menipis serta memiliki riwayat
penjualan yang kuat dapat memperoleh perhatian lebih tinggi.

Namun, jangan menyatakan bahwa penjualan merupakan penyebab
langsung stok berkurang karena hubungan tersebut tidak dapat
dibuktikan dari data yang tersedia.

3. Tingkat Prioritas
Kelompokkan rekomendasi menjadi:
- Prioritas Tinggi
- Prioritas Sedang
- Pemantauan

Gunakan prinsip berikut:
- Prioritas Tinggi terutama untuk stok habis yang memiliki
  riwayat penjualan dan membutuhkan evaluasi pengadaan segera.
- Prioritas Sedang dapat mencakup produk stok menipis atau
  produk stok habis yang masih memerlukan evaluasi lebih lanjut.
- Pemantauan terutama untuk produk yang stoknya masih aman.

Jangan menyamakan produk stok menipis dengan produk stok aman
dalam tingkat perhatian apabila kondisinya berbeda.

4. Rekomendasi Tindakan
Berikan tindakan praktis untuk pengelolaan persediaan.

Utamakan pengecekan stok, evaluasi pengadaan, pemantauan
produk menipis, dan pemeliharaan ketersediaan produk.

5. Kesimpulan
Jelaskan fokus utama yang sebaiknya dilakukan administrator.

PENTING:
Jangan menentukan jumlah pembelian atau restock secara pasti.

Data yang tersedia belum merupakan ledger persediaan lengkap
yang dapat digunakan untuk menghitung kebutuhan pembelian
secara akurat.

Jangan menghitung stok sekarang dari selisih data penjualan
dan data restock historis.
PROMPT;
}
}