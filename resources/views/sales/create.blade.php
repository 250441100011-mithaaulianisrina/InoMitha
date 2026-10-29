@extends('layouts.app')

@section('title', 'Transaksi Baru | InoMitha')
@section('page-title', 'Transaksi Baru')
@section('page-subtitle', 'Catat transaksi penjualan baru IntanMitha Collection')

@push('styles')
<style>
    .sale-create-page {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    .sale-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .sale-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        text-decoration: none;
    }

    .sale-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .create-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 30px 34px;
        margin-bottom: 22px;
        border-radius: 23px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 18%,
                rgba(255,255,255,.15),
                transparent 24%
            ),
            linear-gradient(
                135deg,
                #553044 0%,
                #80415e 53%,
                #b75f82 100%
            );
        box-shadow: 0 18px 43px rgba(89,48,68,.15);
    }

    .create-hero::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: 90px;
        top: -120px;
        border: 30px solid rgba(255,255,255,.05);
        border-radius: 50%;
    }

    .create-hero::after {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        right: -40px;
        bottom: -75px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .hero-copy,
    .invoice-preview {
        position: relative;
        z-index: 2;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 11px;
        padding: 6px 10px;
        border: 1px solid rgba(255,255,255,.17);
        border-radius: 30px;
        background: rgba(255,255,255,.08);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .hero-label-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f8dce6;
    }

    .hero-copy h1 {
        margin-bottom: 8px;
        font-size: 25px;
    }

    .hero-copy p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 9px;
        line-height: 1.8;
    }

    .invoice-preview {
        min-width: 185px;
        padding: 14px 16px;
        border: 1px solid rgba(255,255,255,.17);
        border-radius: 13px;
        background: rgba(255,255,255,.1);
        backdrop-filter: blur(5px);
    }

    .invoice-preview span {
        display: block;
        margin-bottom: 5px;
        color: #eedce4;
        font-size: 7px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .invoice-preview strong {
        display: block;
        font-size: 11px;
        letter-spacing: .2px;
    }

    /* =========================================================
       ERROR
    ========================================================= */
    .error-box {
        margin-bottom: 18px;
        padding: 15px 17px;
        border: 1px solid #f0cdd5;
        border-radius: 13px;
        color: #91485a;
        background: #fff3f5;
    }

    .error-box strong {
        display: block;
        margin-bottom: 7px;
        font-size: 9px;
    }

    .error-box ul {
        margin: 0;
        padding-left: 17px;
    }

    .error-box li {
        margin: 4px 0;
        font-size: 8px;
        line-height: 1.5;
    }

    /* =========================================================
       LAYOUT
    ========================================================= */
    .sale-form-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 285px;
        gap: 18px;
        align-items: start;
    }

    .form-main {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(80,46,62,.045);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 18px 20px;
        border-bottom: 1px solid #f1e7eb;
    }

    .card-header-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 12px;
        font-weight: 700;
    }

    .card-header h3,
    .product-card-title h3 {
        margin-bottom: 3px;
        color: #604050;
        font-size: 12px;
    }

    .card-header p,
    .product-card-title p {
        color: #a08b95;
        font-size: 8px;
        line-height: 1.5;
    }

    .card-body {
        padding: 20px;
    }

    /* =========================================================
       FORM
    ========================================================= */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .form-group {
        min-width: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        color: #69495a;
        font-size: 8px;
        font-weight: 700;
    }

    .required {
        color: #bd5c76;
    }

    .form-control {
        width: 100%;
        min-height: 43px;
        padding: 0 12px;
        border: 1px solid #e5d8de;
        border-radius: 10px;
        outline: none;
        color: #644656;
        background: #fff;
        font-family: inherit;
        font-size: 9px;
        transition: .2s;
    }

    .form-control:focus {
        border-color: #bf7895;
        box-shadow: 0 0 0 3px rgba(143,70,103,.07);
    }

    .form-help {
        display: block;
        margin-top: 6px;
        color: #a9959e;
        font-size: 7px;
        line-height: 1.5;
    }

    /* =========================================================
       PRODUCTS
    ========================================================= */
    .product-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid #f1e7eb;
    }

    .product-card-title {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .btn-add-product {
        min-height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 11px;
        border: 1px solid #8f4667;
        border-radius: 9px;
        color: #8f4667;
        background: #fff;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .btn-add-product:hover {
        color: #fff;
        background: #8f4667;
    }

    .products-body {
        padding: 0 20px 20px;
    }

    .product-table-wrapper {
        overflow-x: auto;
    }

    .product-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .product-table th {
        padding: 12px 8px;
        border-bottom: 1px solid #eee3e8;
        color: #9b858f;
        background: #fdfafb;
        font-size: 7px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .product-table td {
        padding: 11px 8px;
        border-bottom: 1px solid #f3eaee;
        vertical-align: middle;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-select {
        min-width: 230px;
    }

    .qty-input {
        width: 75px;
        min-height: 39px;
        padding: 0 9px;
        border: 1px solid #e5d8de;
        border-radius: 9px;
        outline: none;
        color: #654757;
        font-family: inherit;
        font-size: 9px;
        text-align: center;
    }

    .qty-input:focus {
        border-color: #bf7895;
        box-shadow: 0 0 0 3px rgba(143,70,103,.06);
    }

    .product-meta {
        display: block;
        margin-top: 4px;
        color: #aa969f;
        font-size: 7px;
    }

    .price-text,
    .subtotal-text {
        color: #654555;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .stock-text {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        padding: 5px 7px;
        border-radius: 7px;
        color: #587461;
        background: #edf6ef;
        font-size: 8px;
        font-weight: 700;
        white-space: nowrap;
    }

    .stock-text.warning {
        color: #a36346;
        background: #fbf0e8;
    }

    .stock-text.danger {
        color: #a64d60;
        background: #fbecef;
    }

    .btn-remove {
        width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #efd9df;
        border-radius: 8px;
        color: #b3566d;
        background: #fff6f8;
        font-family: inherit;
        font-size: 12px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-remove:hover {
        color: #fff;
        background: #b3566d;
    }

    .row-warning {
        display: none;
        margin-top: 5px;
        color: #b04e62;
        font-size: 7px;
        font-weight: 600;
    }

    .row-warning.show {
        display: block;
    }

    /* =========================================================
       CHECKOUT
    ========================================================= */
    .summary-sidebar {
        position: sticky;
        top: 92px;
    }

    .checkout-card {
        overflow: hidden;
        border: 1px solid #e9dce2;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(80,46,62,.06);
    }

    .checkout-header {
        padding: 19px 20px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #684056,
            #9b506f
        );
    }

    .checkout-header span {
        display: block;
        margin-bottom: 5px;
        color: #ead9e1;
        font-size: 7px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .checkout-header h3 {
        font-size: 13px;
    }

    .checkout-body {
        padding: 18px 20px;
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px dashed #eadfe4;
    }

    .summary-row span {
        color: #9b8790;
        font-size: 8px;
    }

    .summary-row strong {
        color: #674758;
        font-size: 9px;
    }

    .summary-total {
        margin-top: 14px;
        padding: 15px;
        border-radius: 12px;
        background: #faf1f5;
    }

    .summary-total span {
        display: block;
        margin-bottom: 5px;
        color: #9a7285;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .summary-total strong {
        display: block;
        color: #713f57;
        font-size: 20px;
        line-height: 1.2;
    }

    .checkout-note {
        margin-top: 13px;
        color: #a18c96;
        font-size: 7px;
        line-height: 1.7;
    }

    .checkout-actions {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 0 20px 20px;
    }

    .btn-submit {
        width: 100%;
        min-height: 43px;
        border: none;
        border-radius: 10px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #78405b,
            #a65476
        );
        box-shadow: 0 8px 18px rgba(143,70,103,.16);
        font-family: inherit;
        font-size: 9px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(143,70,103,.21);
    }

    .btn-submit:disabled {
        opacity: .55;
        cursor: not-allowed;
        transform: none;
    }

    .btn-cancel {
        width: 100%;
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e3d6dc;
        border-radius: 10px;
        color: #7c6070;
        background: #fff;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
    }

    .security-note {
        display: flex;
        gap: 8px;
        margin-top: 14px;
        padding: 11px;
        border-radius: 10px;
        color: #7b6670;
        background: #f8f4f6;
        font-size: 7px;
        line-height: 1.6;
    }

    .security-icon {
        flex-shrink: 0;
        color: #8f4667;
        font-weight: 700;
    }

    .no-product-box {
        padding: 30px 20px;
        text-align: center;
        color: #8d7782;
    }

    .no-product-box strong {
        display: block;
        margin-bottom: 6px;
        color: #684858;
        font-size: 10px;
    }

    .no-product-box p {
        font-size: 8px;
        line-height: 1.6;
    }

    @media (max-width: 1000px) {
        .sale-form-layout {
            grid-template-columns: 1fr;
        }

        .summary-sidebar {
            position: static;
        }
    }

    @media (max-width: 700px) {
        .create-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 25px 22px;
        }

        .invoice-preview {
            width: 100%;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .product-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-add-product {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="sale-create-page">

    <div class="sale-breadcrumb">
        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('sales.index') }}">
            Transaksi Penjualan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Transaksi Baru</span>
    </div>


    <section class="create-hero">

        <div class="hero-copy">

            <div class="hero-label">
                <span class="hero-label-dot"></span>
                New Sales Transaction
            </div>

            <h1>Buat Transaksi Baru</h1>

            <p>
                Pilih pelanggan dan produk yang dibeli.
                Sistem akan menghitung total transaksi serta
                memperbarui stok produk secara otomatis setelah
                transaksi berhasil disimpan.
            </p>

        </div>


        <div class="invoice-preview">

            <span>Nomor Invoice</span>

            <strong>
                {{ $invoicePreview }}
            </strong>

        </div>

    </section>


    @if ($errors->any())

        <div class="error-box">

            <strong>
                Transaksi belum dapat disimpan:
            </strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form
        action="{{ route('sales.store') }}"
        method="POST"
        id="saleForm"
    >

        @csrf

        <div class="sale-form-layout">

            <div class="form-main">

                {{-- INFORMASI TRANSAKSI --}}
                <section class="form-card">

                    <div class="card-header">

                        <div class="card-header-icon">
                            01
                        </div>

                        <div>
                            <h3>Informasi Transaksi</h3>

                            <p>
                                Tentukan pelanggan dan waktu transaksi.
                            </p>
                        </div>

                    </div>


                    <div class="card-body">

                        <div class="form-grid">

                            <div class="form-group">

                                <label
                                    for="customer_id"
                                    class="form-label"
                                >
                                    Pelanggan
                                </label>

                                <select
                                    name="customer_id"
                                    id="customer_id"
                                    class="form-control"
                                >

                                    <option value="">
                                        Pelanggan Umum / Non-Member
                                    </option>

                                    @foreach ($customers as $customer)

                                        <option
                                            value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                        >
                                            {{ $customer->customer_code }}
                                            -
                                            {{ $customer->name }}
                                        </option>

                                    @endforeach

                                </select>

                                <span class="form-help">
                                    Pelanggan boleh dikosongkan untuk
                                    transaksi non-member.
                                </span>

                            </div>


                            <div class="form-group">

                                <label
                                    for="sale_date"
                                    class="form-label"
                                >
                                    Tanggal & Waktu
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="datetime-local"
                                    name="sale_date"
                                    id="sale_date"
                                    class="form-control"
                                    value="{{ old('sale_date', now()->format('Y-m-d\TH:i')) }}"
                                    required
                                >

                                <span class="form-help">
                                    Waktu transaksi dapat disesuaikan
                                    jika diperlukan.
                                </span>

                            </div>

                        </div>

                    </div>

                </section>


                {{-- PRODUK --}}
                <section class="form-card">

                    <div class="product-card-header">

                        <div class="product-card-title">

                            <div class="card-header-icon">
                                02
                            </div>

                            <div>
                                <h3>Produk yang Dibeli</h3>

                                <p>
                                    Tambahkan satu atau beberapa produk
                                    ke dalam transaksi.
                                </p>
                            </div>

                        </div>


                        @if ($products->count() > 0)

                            <button
                                type="button"
                                class="btn-add-product"
                                id="addProductButton"
                            >
                                + Tambah Produk
                            </button>

                        @endif

                    </div>


                    @if ($products->count() > 0)

                        <div class="products-body">

                            <div class="product-table-wrapper">

                                <table class="product-table">

                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="productRows">
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    @else

                        <div class="no-product-box">

                            <strong>
                                Tidak Ada Produk yang Dapat Dijual
                            </strong>

                            <p>
                                Belum ada produk aktif dengan stok
                                tersedia. Tambahkan stok produk terlebih
                                dahulu melalui menu Persediaan.
                            </p>

                        </div>

                    @endif

                </section>

            </div>


            {{-- RINGKASAN --}}
            <aside class="summary-sidebar">

                <div class="checkout-card">

                    <div class="checkout-header">
                        <span>Transaction Summary</span>
                        <h3>Ringkasan Transaksi</h3>
                    </div>


                    <div class="checkout-body">

                        <div class="summary-row">
                            <span>Jenis Produk</span>
                            <strong id="summaryProductCount">0</strong>
                        </div>

                        <div class="summary-row">
                            <span>Total Item</span>
                            <strong id="summaryItemCount">0</strong>
                        </div>


                        <div class="summary-total">
                            <span>Total Pembayaran</span>
                            <strong id="grandTotal">Rp0</strong>
                        </div>


                        <p class="checkout-note">
                            Harga final akan diverifikasi kembali
                            oleh sistem berdasarkan harga produk
                            yang tersimpan di database.
                        </p>


                        <div class="security-note">

                            <span class="security-icon">✓</span>

                            <span>
                                Setelah transaksi disimpan, stok setiap
                                produk akan berkurang dan tercatat pada
                                riwayat persediaan.
                            </span>

                        </div>

                    </div>


                    <div class="checkout-actions">

                        <button
                            type="submit"
                            class="btn-submit"
                            id="submitButton"
                            {{ $products->count() === 0 ? 'disabled' : '' }}
                        >
                            Simpan Transaksi
                        </button>


                        <a
                            href="{{ route('sales.index') }}"
                            class="btn-cancel"
                        >
                            Batal
                        </a>

                    </div>

                </div>

            </aside>

        </div>

    </form>

</div>

@endsection


@push('scripts')

@if ($products->count() > 0)

@php
    $productsForJs = $products->map(function ($product) {
        return [
            'id' => $product->id,
            'code' => $product->product_code,
            'name' => $product->name,
            'category' => $product->category
                ? $product->category->name
                : 'Tanpa Kategori',
            'price' => (float) $product->price,
            'stock' => (int) $product->stock,
            'minimum_stock' => (int) $product->minimum_stock,
        ];
    })->values();

    $oldProductsForJs = old('products', []);
@endphp

<script>
    const products = @json($productsForJs);
    const oldProducts = @json($oldProductsForJs);

    const productRows =
        document.getElementById('productRows');

    const addProductButton =
        document.getElementById('addProductButton');

    const grandTotalElement =
        document.getElementById('grandTotal');

    const summaryProductCount =
        document.getElementById('summaryProductCount');

    const summaryItemCount =
        document.getElementById('summaryItemCount');

    const submitButton =
        document.getElementById('submitButton');

    const saleForm =
        document.getElementById('saleForm');

    let rowIndex = 0;


    /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

    function formatRupiah(value) {
        return new Intl.NumberFormat(
            'id-ID',
            {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }
        ).format(value);
    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {
        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUCT OPTIONS
    |--------------------------------------------------------------------------
    */

    function buildProductOptions(selectedId = '') {

        let options =
            '<option value="">Pilih produk...</option>';

        products.forEach(function (product) {

            const selected =
                String(product.id) === String(selectedId)
                    ? 'selected'
                    : '';

            options += `
                <option
                    value="${product.id}"
                    ${selected}
                >
                    ${escapeHtml(product.code)} - ${escapeHtml(product.name)}
                </option>
            `;
        });

        return options;
    }


    /*
    |--------------------------------------------------------------------------
    | CARI PRODUK
    |--------------------------------------------------------------------------
    */

    function findProduct(productId) {

        return products.find(function (product) {
            return String(product.id) === String(productId);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH BARIS PRODUK
    |--------------------------------------------------------------------------
    */

    function addProductRow(
        selectedProductId = '',
        quantity = 1
    ) {

        const currentIndex = rowIndex++;

        const row =
            document.createElement('tr');

        row.classList.add('product-row');

        row.innerHTML = `
            <td>

                <select
                    name="products[${currentIndex}][product_id]"
                    class="form-control product-select"
                    required
                >
                    ${buildProductOptions(selectedProductId)}
                </select>

                <span class="product-meta">
                    Pilih produk yang dibeli
                </span>

                <span class="row-warning">
                    Jumlah melebihi stok yang tersedia.
                </span>

            </td>

            <td>
                <span class="price-text">
                    Rp0
                </span>
            </td>

            <td>
                <span class="stock-text">
                    -
                </span>
            </td>

            <td>

                <input
                    type="number"
                    name="products[${currentIndex}][quantity]"
                    class="qty-input"
                    value="${quantity}"
                    min="1"
                    step="1"
                    required
                >

            </td>

            <td>
                <span class="subtotal-text">
                    Rp0
                </span>
            </td>

            <td>

                <button
                    type="button"
                    class="btn-remove"
                    title="Hapus produk"
                >
                    ×
                </button>

            </td>
        `;

        productRows.appendChild(row);

        const select =
            row.querySelector('.product-select');

        const quantityInput =
            row.querySelector('.qty-input');

        const removeButton =
            row.querySelector('.btn-remove');


        select.addEventListener(
            'change',
            function () {
                updateRow(row);
            }
        );


        quantityInput.addEventListener(
            'input',
            function () {

                if (
                    quantityInput.value !== '' &&
                    Number(quantityInput.value) < 1
                ) {
                    quantityInput.value = 1;
                }

                updateRow(row);
            }
        );


        removeButton.addEventListener(
            'click',
            function () {

                row.remove();

                const remainingRows =
                    productRows.querySelectorAll(
                        '.product-row'
                    );

                if (remainingRows.length === 0) {
                    addProductRow();
                }

                updateSummary();
            }
        );


        updateRow(row);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BARIS PRODUK
    |--------------------------------------------------------------------------
    */

    function updateRow(row) {

        const select =
            row.querySelector('.product-select');

        const quantityInput =
            row.querySelector('.qty-input');

        const priceElement =
            row.querySelector('.price-text');

        const stockElement =
            row.querySelector('.stock-text');

        const subtotalElement =
            row.querySelector('.subtotal-text');

        const warningElement =
            row.querySelector('.row-warning');

        const metaElement =
            row.querySelector('.product-meta');


        const product =
            findProduct(select.value);


        if (!product) {

            priceElement.textContent = 'Rp0';

            stockElement.textContent = '-';

            stockElement.className =
                'stock-text';

            subtotalElement.textContent =
                'Rp0';

            warningElement.classList.remove(
                'show'
            );

            metaElement.textContent =
                'Pilih produk yang dibeli';

            updateSummary();

            return;
        }


        let quantity =
            Number(quantityInput.value);

        if (
            !Number.isInteger(quantity) ||
            quantity < 1
        ) {
            quantity = 1;
        }


        const subtotal =
            product.price * quantity;


        priceElement.textContent =
            formatRupiah(product.price);


        stockElement.textContent =
            product.stock + ' unit';


        stockElement.className =
            'stock-text';


        /*
         * STATUS STOK:
         *
         * Aman:
         * stock > minimum_stock
         *
         * Menipis:
         * stock > 0 && stock <= minimum_stock
         *
         * Habis:
         * stock === 0
         */

        if (product.stock === 0) {

            stockElement.classList.add(
                'danger'
            );

        } else if (
            product.stock > 0 &&
            product.stock <= product.minimum_stock
        ) {

            stockElement.classList.add(
                'warning'
            );
        }


        subtotalElement.textContent =
            formatRupiah(subtotal);


        metaElement.textContent =
            product.category;


        if (quantity > product.stock) {

            warningElement.classList.add(
                'show'
            );

            row.dataset.stockInvalid =
                'true';

        } else {

            warningElement.classList.remove(
                'show'
            );

            row.dataset.stockInvalid =
                'false';
        }


        updateSummary();
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE RINGKASAN
    |--------------------------------------------------------------------------
    */

    function updateSummary() {

        const rows =
            productRows.querySelectorAll(
                '.product-row'
            );


        let selectedProductCount = 0;
        let totalItem = 0;
        let grandTotal = 0;
        let hasInvalidStock = false;


        rows.forEach(function (row) {

            const select =
                row.querySelector(
                    '.product-select'
                );

            const quantityInput =
                row.querySelector(
                    '.qty-input'
                );

            const product =
                findProduct(select.value);


            if (!product) {
                return;
            }


            let quantity =
                Number(quantityInput.value);

            if (
                !Number.isInteger(quantity) ||
                quantity < 1
            ) {
                quantity = 1;
            }


            selectedProductCount++;

            totalItem += quantity;

            grandTotal +=
                product.price * quantity;


            if (quantity > product.stock) {
                hasInvalidStock = true;
            }

        });


        summaryProductCount.textContent =
            selectedProductCount;

        summaryItemCount.textContent =
            totalItem;

        grandTotalElement.textContent =
            formatRupiah(grandTotal);


        submitButton.disabled =
            selectedProductCount === 0 ||
            hasInvalidStock;
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH PRODUK
    |--------------------------------------------------------------------------
    */

    addProductButton.addEventListener(
        'click',
        function () {
            addProductRow();
        }
    );


    /*
    |--------------------------------------------------------------------------
    | OLD INPUT
    |--------------------------------------------------------------------------
    */

    if (
        Array.isArray(oldProducts) &&
        oldProducts.length > 0
    ) {

        oldProducts.forEach(function (item) {

            addProductRow(
                item.product_id ?? '',
                item.quantity ?? 1
            );

        });

    } else {

        addProductRow();
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDASI SEBELUM SUBMIT
    |--------------------------------------------------------------------------
    */

    saleForm.addEventListener(
        'submit',
        function (event) {

            const rows =
                productRows.querySelectorAll(
                    '.product-row'
                );


            let selectedCount = 0;
            let invalidStock = false;


            rows.forEach(function (row) {

                const select =
                    row.querySelector(
                        '.product-select'
                    );

                const quantityInput =
                    row.querySelector(
                        '.qty-input'
                    );

                const product =
                    findProduct(select.value);


                if (!product) {
                    return;
                }


                selectedCount++;


                const quantity =
                    Number(quantityInput.value);


                if (
                    !Number.isInteger(quantity) ||
                    quantity < 1 ||
                    quantity > product.stock
                ) {
                    invalidStock = true;
                }

            });


            if (selectedCount === 0) {

                event.preventDefault();

                alert(
                    'Pilih minimal satu produk sebelum menyimpan transaksi.'
                );

                return;
            }


            if (invalidStock) {

                event.preventDefault();

                alert(
                    'Periksa kembali jumlah produk. Ada jumlah pembelian yang melebihi stok tersedia.'
                );

                return;
            }


            submitButton.disabled = true;

            submitButton.textContent =
                'Menyimpan Transaksi...';
        }
    );

</script>

@endif

@endpush