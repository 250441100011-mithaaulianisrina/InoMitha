<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index(Request $request)
    {
        $search = trim(
            (string) $request->input('search')
        );

        /*
        |--------------------------------------------------------------------------
        | Daftar Pelanggan
        |--------------------------------------------------------------------------
        |
        | Jumlah transaksi pelanggan hanya menghitung transaksi
        | yang berstatus completed.
        |
        */

        $customers = Customer::query()
            ->withCount([
                'sales as completed_sales_count'
                    => function ($query) {
                        $query->where(
                            'status',
                            'completed'
                        );
                    },
            ])
            ->when(
                $search,
                function ($query) use ($search) {

                    $query->where(
                        function ($query) use ($search) {

                            $query
                                ->where(
                                    'customer_code',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'phone',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'email',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Total Pelanggan
        |--------------------------------------------------------------------------
        */

        $totalCustomers = Customer::query()
            ->count();


        return view(
            'customers.index',
            compact(
                'customers',
                'search',
                'totalCustomers'
            )
        );
    }


    /**
     * Menampilkan form tambah pelanggan.
     */
    public function create()
    {
        return view(
            'customers.create'
        );
    }


    /**
     * Menyimpan pelanggan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'phone' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'email' => [
                    'nullable',
                    'email',
                    'max:255',
                ],

                'address' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'name.required' =>
                    'Nama pelanggan wajib diisi.',

                'name.string' =>
                    'Nama pelanggan harus berupa teks.',

                'name.max' =>
                    'Nama pelanggan maksimal 255 karakter.',

                'phone.string' =>
                    'Nomor telepon harus berupa teks.',

                'phone.max' =>
                    'Nomor telepon maksimal 30 karakter.',

                'email.email' =>
                    'Format email pelanggan tidak valid.',

                'email.max' =>
                    'Email pelanggan maksimal 255 karakter.',

                'address.string' =>
                    'Alamat harus berupa teks.',

                'address.max' =>
                    'Alamat maksimal 1000 karakter.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Generate Kode Pelanggan
        |--------------------------------------------------------------------------
        */

        $validated['customer_code'] =
            $this->generateCustomerCode();


        /*
        |--------------------------------------------------------------------------
        | Simpan Pelanggan
        |--------------------------------------------------------------------------
        */

        Customer::create(
            $validated
        );


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Data pelanggan berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail pelanggan dan riwayat transaksi.
     */
    public function show(Customer $customer)
    {
        /*
        |--------------------------------------------------------------------------
        | Riwayat Transaksi
        |--------------------------------------------------------------------------
        |
        | Seluruh transaksi tetap ditampilkan pada riwayat pelanggan,
        | termasuk transaksi completed maupun cancelled.
        |
        */

        $customer->load([
            'sales' => function ($query) {

                $query
                    ->withCount('items')
                    ->latest('sale_date');
            },
        ]);


        /*
        |--------------------------------------------------------------------------
        | Statistik Pelanggan
        |--------------------------------------------------------------------------
        |
        | Statistik hanya menghitung transaksi completed.
        |
        */

        $completedSales = $customer->sales
            ->where(
                'status',
                'completed'
            );


        $totalTransactions =
            $completedSales->count();


        $totalPurchases =
            $completedSales->sum(
                'total_amount'
            );


        /*
        |--------------------------------------------------------------------------
        | Rata-rata Nilai Transaksi
        |--------------------------------------------------------------------------
        */

        $averagePurchase =
            $totalTransactions > 0
                ? $totalPurchases / $totalTransactions
                : 0;


        return view(
            'customers.show',
            compact(
                'customer',
                'totalTransactions',
                'totalPurchases',
                'averagePurchase'
            )
        );
    }


    /**
     * Menampilkan form edit pelanggan.
     */
    public function edit(Customer $customer)
    {
        return view(
            'customers.edit',
            compact('customer')
        );
    }


    /**
     * Memperbarui data pelanggan.
     */
    public function update(
        Request $request,
        Customer $customer
    ) {
        $validated = $request->validate(
            [
                'customer_code' => [
                    'required',
                    'string',
                    'max:255',

                    Rule::unique(
                        'customers',
                        'customer_code'
                    )->ignore(
                        $customer->id
                    ),
                ],

                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'phone' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'email' => [
                    'nullable',
                    'email',
                    'max:255',
                ],

                'address' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],
            ],
            [
                'customer_code.required' =>
                    'Kode pelanggan wajib diisi.',

                'customer_code.unique' =>
                    'Kode pelanggan sudah digunakan.',

                'customer_code.max' =>
                    'Kode pelanggan maksimal 255 karakter.',

                'name.required' =>
                    'Nama pelanggan wajib diisi.',

                'name.string' =>
                    'Nama pelanggan harus berupa teks.',

                'name.max' =>
                    'Nama pelanggan maksimal 255 karakter.',

                'phone.string' =>
                    'Nomor telepon harus berupa teks.',

                'phone.max' =>
                    'Nomor telepon maksimal 30 karakter.',

                'email.email' =>
                    'Format email pelanggan tidak valid.',

                'email.max' =>
                    'Email pelanggan maksimal 255 karakter.',

                'address.string' =>
                    'Alamat harus berupa teks.',

                'address.max' =>
                    'Alamat maksimal 1000 karakter.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Update Pelanggan
        |--------------------------------------------------------------------------
        */

        $customer->update(
            $validated
        );


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Data pelanggan berhasil diperbarui.'
            );
    }


    /**
     * Menghapus pelanggan.
     */
    public function destroy(Customer $customer)
    {
        /*
        |--------------------------------------------------------------------------
        | Hapus Pelanggan
        |--------------------------------------------------------------------------
        |
        | Berdasarkan struktur database InoMitha, customer_id pada sales
        | menggunakan nullOnDelete. Karena itu transaksi lama tetap
        | tersimpan dan berubah menjadi transaksi tanpa pelanggan.
        |
        */

        $customer->delete();


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Data pelanggan berhasil dihapus.'
            );
    }


    /**
     * Membuat kode pelanggan otomatis.
     *
     * Contoh:
     * CUST001
     * CUST002
     * CUST003
     */
    private function generateCustomerCode(): string
    {
        /*
        |--------------------------------------------------------------------------
        | Cari Nomor Pelanggan Terbesar
        |--------------------------------------------------------------------------
        |
        | Seluruh kode dengan format CUST akan diperiksa agar kode baru
        | tidak bergantung pada urutan ID database.
        |
        */

        $customerCodes = Customer::query()
            ->where(
                'customer_code',
                'like',
                'CUST%'
            )
            ->pluck(
                'customer_code'
            );


        $highestNumber = 0;


        foreach ($customerCodes as $code) {

            /*
             * Hanya kode dengan format CUST + angka
             * yang digunakan dalam perhitungan.
             */
            if (
                preg_match(
                    '/^CUST(\d+)$/',
                    $code,
                    $matches
                )
            ) {

                $number =
                    (int) $matches[1];

                if (
                    $number >
                    $highestNumber
                ) {

                    $highestNumber =
                        $number;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Nomor Berikutnya
        |--------------------------------------------------------------------------
        */

        $nextNumber =
            $highestNumber + 1;


        /*
        |--------------------------------------------------------------------------
        | Pastikan Kode Belum Digunakan
        |--------------------------------------------------------------------------
        */

        do {

            $customerCode =
                'CUST'
                . str_pad(
                    $nextNumber,
                    3,
                    '0',
                    STR_PAD_LEFT
                );


            $exists = Customer::query()
                ->where(
                    'customer_code',
                    $customerCode
                )
                ->exists();


            $nextNumber++;

        } while ($exists);


        return $customerCode;
    }
}