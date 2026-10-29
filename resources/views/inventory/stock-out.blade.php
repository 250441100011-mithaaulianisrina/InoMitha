@extends('layouts.app')

@section('title', 'Stok Keluar | InoMitha')
@section('page-title', 'Stok Keluar')
@section('page-subtitle', 'Catat pengurangan persediaan produk IntanMitha Collection')

@push('styles')
<style>
    .stock-out-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* BREADCRUMB */
    .stock-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .stock-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        text-decoration: none;
    }

    .stock-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* HERO */
    .stock-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 25px;
        min-height: 190px;
        padding: 32px 35px;
        margin-bottom: 22px;
        border-radius: 23px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255,255,255,.16),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #583247 0%,
                #81405e 52%,
                #b65d80 100%
            );
        box-shadow: 0 17px 42px rgba(89,48,68,.16);
    }

    .stock-hero::before {
        content: "";
        position: absolute;
        width: 215px;
        height: 215px;
        top: -140px;
        right: 115px;
        border: 32px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .stock-hero::after {
        content: "";
        position: absolute;
        width: 165px;
        height: 165px;
        right: -45px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .hero-content,
    .hero-icon {
        position: relative;
        z-index: 2;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 30px;
        background: rgba(255,255,255,.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f6d4dc;
        box-shadow: 0 0 0 4px rgba(246,212,220,.12);
    }

    .hero-content h1 {
        margin-bottom: 8px;
        font-size: 27px;
    }

    .hero-content p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 10px;
        line-height: 1.8;
    }

    .hero-icon {
        width: 76px;
        height: 76px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 22px;
        background: rgba(255,255,255,.11);
        font-size: 34px;
        font-weight: 300;
        backdrop-filter: blur(8px);
    }

    /* LAYOUT */
    .stock-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(270px, .72fr);
        gap: 20px;
        align-items: start;
    }

    .stock-form-card,
    .stock-info-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 9px 30px rgba(80,46,62,.05);
    }

    /* FORM HEADER */
    .form-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .form-header-icon {
        width: 41px;
        height: 41px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #a34f61;
        background: #fcecef;
        font-size: 20px;
        font-weight: 700;
    }

    .form-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .form-header p {
        color: #a18b96;
        font-size: 9px;
    }

    .form-body {
        padding: 25px 23px;
    }

    /* ALERT */
    .validation-alert,
    .session-error-alert {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f0d5dc;
        border-radius: 11px;
        color: #854455;
        background: #fff4f6;
    }

    .alert-icon {
        width: 31px;
        height: 31px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #fff;
        background: #aa5368;
        font-size: 13px;
        font-weight: 700;
    }

    .validation-alert h4,
    .session-error-alert h4 {
        margin-bottom: 4px;
        font-size: 10px;
    }

    .validation-alert p,
    .session-error-alert p {
        color: #a36877;
        font-size: 9px;
        line-height: 1.6;
    }

    /* EMPTY */
    .empty-product-alert {
        margin-bottom: 22px;
        padding: 16px;
        border: 1px solid #ead9df;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .empty-product-alert strong {
        display: block;
        margin-bottom: 6px;
        color: #74465a;
        font-size: 10px;
    }

    .empty-product-alert p {
        margin-bottom: 11px;
        color: #9b8490;
        font-size: 9px;
        line-height: 1.7;
    }

    .empty-product-alert a {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        padding: 0 11px;
        border-radius: 8px;
        color: #fff;
        background: #8f4667;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
    }

    /* FORM */
    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 19px;
        color: #664253;
        font-size: 11px;
        font-weight: 700;
    }

    .section-number {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        color: #fff;
        background: #8f4667;
        font-size: 9px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        color: #684757;
        font-size: 10px;
        font-weight: 700;
    }

    .required {
        color: #bd5c75;
    }

    .form-control,
    .form-select,
    .form-textarea {
        width: 100%;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        outline: none;
        color: #604050;
        background: #fefcfd;
        font-family: inherit;
        font-size: 10px;
        transition: .2s;
    }

    .form-control,
    .form-select {
        min-height: 45px;
        padding: 0 13px;
    }

    .form-textarea {
        min-height: 110px;
        padding: 12px 13px;
        line-height: 1.7;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #c47c98;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(143,70,103,.07);
    }

    .form-control.is-invalid,
    .form-select.is-invalid,
    .form-textarea.is-invalid {
        border-color: #d77b8d;
        background: #fffafb;
    }

    .form-help {
        margin-top: 6px;
        color: #a6929c;
        font-size: 8px;
        line-height: 1.6;
    }

    .error-message {
        margin-top: 6px;
        color: #b54d63;
        font-size: 9px;
        font-weight: 600;
    }

    /* PRODUCT PREVIEW */
    .product-preview {
        display: none;
        margin-top: 11px;
        padding: 14px;
        border: 1px solid #e8dce1;
        border-radius: 11px;
        background: #fdf9fb;
    }

    .product-preview.show {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .preview-avatar {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f5e5ec;
        font-size: 14px;
        font-weight: 700;
    }

    .preview-content {
        flex: 1;
    }

    .preview-content strong {
        display: block;
        margin-bottom: 4px;
        color: #604050;
        font-size: 9px;
    }

    .preview-content span {
        color: #9b8690;
        font-size: 8px;
    }

    .preview-stock {
        text-align: right;
    }

    .preview-stock span {
        display: block;
        margin-bottom: 3px;
        color: #a08a95;
        font-size: 7px;
        text-transform: uppercase;
    }

    .preview-stock strong {
        color: #5e3d4e;
        font-size: 15px;
    }

    .preview-stock small {
        color: #9e8993;
        font-size: 8px;
    }

    /* QUANTITY */
    .quantity-box {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 150px;
        gap: 12px;
        align-items: stretch;
    }

    .quantity-result {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 13px;
        border: 1px solid #ecd9de;
        border-radius: 10px;
        background: #fff7f8;
    }

    .quantity-result span {
        margin-bottom: 4px;
        color: #a37883;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .quantity-result strong {
        color: #9a4e60;
        font-size: 14px;
    }

    .quantity-result.safe {
        border-color: #dcecdf;
        background: #f2f9f4;
    }

    .quantity-result.safe span {
        color: #76907d;
    }

    .quantity-result.safe strong {
        color: #4e7459;
    }

    .quantity-result.warning {
        border-color: #f0dfc9;
        background: #fdf7f0;
    }

    .quantity-result.warning span {
        color: #a27b54;
    }

    .quantity-result.warning strong {
        color: #99643e;
    }

    .quantity-result.danger {
        border-color: #efcfd6;
        background: #fff3f5;
    }

    .quantity-result.danger span,
    .quantity-result.danger strong {
        color: #a34f61;
    }

    .stock-warning {
        display: none;
        margin-top: 8px;
        padding: 10px 12px;
        border: 1px solid #efcfd6;
        border-radius: 9px;
        color: #a34f61;
        background: #fff4f6;
        font-size: 8px;
        font-weight: 600;
        line-height: 1.6;
    }

    .stock-warning.show {
        display: block;
    }

    /* ACTION */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .btn-cancel,
    .btn-save {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 16px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #806575;
        background: #fff;
    }

    .btn-save {
        border: 1px solid #a34f61;
        color: #fff;
        background: linear-gradient(135deg, #a34f61, #bb6375);
        box-shadow: 0 7px 17px rgba(163,79,97,.17);
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(163,79,97,.23);
    }

    .btn-save:disabled {
        opacity: .5;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* INFO */
    .info-header {
        padding: 21px;
        color: #fff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .info-header h3 {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .info-header p {
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .info-body {
        padding: 20px;
    }

    .info-item {
        display: flex;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .info-item:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-number {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #a34f61;
        background: #fcecef;
        font-size: 9px;
        font-weight: 700;
    }

    .info-item h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .info-item p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.6;
    }

    .important-box {
        margin-top: 18px;
        padding: 14px;
        border: 1px dashed #dfcbd4;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .important-box strong {
        display: block;
        margin-bottom: 6px;
        color: #74445a;
        font-size: 9px;
    }

    .important-box p {
        color: #927985;
        font-size: 8px;
        line-height: 1.8;
    }

    @media (max-width: 950px) {
        .stock-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .stock-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .quantity-box {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-save {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="stock-out-page">

    {{-- BREADCRUMB --}}
    <div class="stock-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('inventory.index') }}">
            Persediaan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Stok Keluar</span>

    </div>


    {{-- HERO --}}
    <section class="stock-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Inventory • Stock Out
            </div>

            <h1>Catat Stok Keluar</h1>

            <p>
                Catat pengurangan persediaan di luar transaksi penjualan,
                seperti produk rusak, hilang, sampel, atau kebutuhan
                operasional lainnya. Setiap perubahan akan tersimpan
                dalam riwayat persediaan.
            </p>

        </div>

        <div class="hero-icon">
            −
        </div>

    </section>


    <div class="stock-layout">

        {{-- FORM --}}
        <section class="stock-form-card">

            <div class="form-header">

                <div class="form-header-icon">
                    −
                </div>

                <div>

                    <h3>Form Stok Keluar</h3>

                    <p>
                        Pilih produk dan tentukan jumlah stok yang dikeluarkan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('inventory.stock-out.store') }}"
                method="POST"
                id="stockOutForm"
            >

                @csrf


                <div class="form-body">

                    {{-- SESSION ERROR --}}
                    @if (session('error'))

                        <div class="session-error-alert">

                            <div class="alert-icon">
                                !
                            </div>

                            <div>

                                <h4>Stok tidak dapat diproses</h4>

                                <p>
                                    {{ session('error') }}
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- VALIDATION --}}
                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="alert-icon">
                                !
                            </div>

                            <div>

                                <h4>Data belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali produk, jumlah,
                                    dan alasan stok keluar.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- EMPTY --}}
                    @if ($products->isEmpty())

                        <div class="empty-product-alert">

                            <strong>
                                Tidak Ada Produk yang Dapat Dipilih
                            </strong>

                            <p>
                                Stok keluar hanya dapat dilakukan pada
                                produk aktif yang masih memiliki stok.
                            </p>

                            <a href="{{ route('inventory.index') }}">
                                Kembali ke Persediaan
                            </a>

                        </div>

                    @endif


                    <div class="form-section-title">

                        <span class="section-number">
                            01
                        </span>

                        Informasi Stok Keluar

                    </div>


                    {{-- PRODUCT --}}
                    <div class="form-group">

                        <label
                            for="product_id"
                            class="form-label"
                        >
                            Produk
                            <span class="required">*</span>
                        </label>


                        <select
                            id="product_id"
                            name="product_id"
                            class="form-select @error('product_id') is-invalid @enderror"
                            {{ $products->isEmpty() ? 'disabled' : '' }}
                            required
                        >

                            <option value="">
                                Pilih produk
                            </option>


                            @foreach ($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-code="{{ $product->product_code }}"
                                    data-category="{{ $product->category->name }}"
                                    data-stock="{{ $product->stock }}"
                                    data-minimum="{{ $product->minimum_stock }}"
                                    {{ (string) old('product_id') ===
                                        (string) $product->id
                                        ? 'selected'
                                        : '' }}
                                >
                                    {{ $product->product_code }}
                                    -
                                    {{ $product->name }}
                                    ({{ $product->stock }} unit)
                                </option>

                            @endforeach

                        </select>


                        @error('product_id')

                            <div class="error-message">
                                ! {{ $message }}
                            </div>

                        @enderror


                        {{-- PREVIEW --}}
                        <div
                            class="product-preview"
                            id="productPreview"
                        >

                            <div
                                class="preview-avatar"
                                id="previewAvatar"
                            >
                                P
                            </div>


                            <div class="preview-content">

                                <strong id="previewName">
                                    -
                                </strong>

                                <span id="previewMeta">
                                    -
                                </span>

                            </div>


                            <div class="preview-stock">

                                <span>Stok Tersedia</span>

                                <strong id="previewStock">
                                    0
                                </strong>

                                <small>unit</small>

                            </div>

                        </div>

                    </div>


                    {{-- QUANTITY --}}
                    <div class="form-group">

                        <label
                            for="quantity"
                            class="form-label"
                        >
                            Jumlah Stok Keluar
                            <span class="required">*</span>
                        </label>


                        <div class="quantity-box">

                            <div>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="{{ old('quantity') }}"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    min="1"
                                    step="1"
                                    placeholder="Contoh: 2"
                                    {{ $products->isEmpty() ? 'disabled' : '' }}
                                    required
                                >


                                @error('quantity')

                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div
                                class="quantity-result"
                                id="quantityResult"
                            >

                                <span>
                                    Perkiraan Sisa Stok
                                </span>

                                <strong id="remainingStock">
                                    -
                                </strong>

                            </div>

                        </div>


                        <div
                            class="stock-warning"
                            id="stockWarning"
                        >
                            Jumlah stok keluar melebihi stok yang tersedia.
                        </div>


                        <div class="form-help">
                            Sistem tidak mengizinkan stok menjadi negatif.
                        </div>

                    </div>


                    {{-- NOTES --}}
                    <div class="form-group">

                        <label
                            for="notes"
                            class="form-label"
                        >
                            Alasan / Keterangan
                            <span class="required">*</span>
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            class="form-textarea @error('notes') is-invalid @enderror"
                            maxlength="1000"
                            placeholder="Contoh: 2 produk rusak saat pemeriksaan persediaan."
                            {{ $products->isEmpty() ? 'disabled' : '' }}
                            required
                        >{{ old('notes') }}</textarea>


                        @error('notes')

                            <div class="error-message">
                                ! {{ $message }}
                            </div>

                        @enderror


                        <div class="form-help">
                            Jelaskan alasan stok dikeluarkan agar
                            riwayat persediaan dapat ditelusuri dengan jelas.
                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div class="form-actions">

                    <a
                        href="{{ route('inventory.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn-save"
                        id="submitButton"
                        {{ $products->isEmpty() ? 'disabled' : '' }}
                    >
                        − Simpan Stok Keluar
                    </button>

                </div>

            </form>

        </section>


        {{-- INFO --}}
        <aside>

            <section class="stock-info-card">

                <div class="info-header">

                    <h3>Ketentuan Stok Keluar</h3>

                    <p>
                        Pengurangan stok manual digunakan untuk
                        kebutuhan selain transaksi penjualan.
                    </p>

                </div>


                <div class="info-body">

                    <div class="info-item">

                        <div class="info-number">
                            01
                        </div>

                        <div>

                            <h4>Stok Harus Tersedia</h4>

                            <p>
                                Jumlah yang dikeluarkan tidak boleh
                                lebih besar daripada stok produk
                                yang tersedia.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">
                            02
                        </div>

                        <div>

                            <h4>Alasan Wajib Dicatat</h4>

                            <p>
                                Jelaskan penyebab stok keluar, misalnya
                                produk rusak, hilang, atau digunakan
                                untuk sampel.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">
                            03
                        </div>

                        <div>

                            <h4>Riwayat Tersimpan</h4>

                            <p>
                                Sistem menyimpan jumlah, waktu,
                                produk, alasan, dan pengguna yang
                                melakukan pengurangan stok.
                            </p>

                        </div>

                    </div>


                    <div class="important-box">

                        <strong>
                            Penting
                        </strong>

                        <p>
                            Stok yang berkurang karena transaksi
                            penjualan nantinya diproses otomatis
                            melalui modul Penjualan. Form ini khusus
                            untuk stok keluar manual di luar penjualan.
                        </p>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const productSelect =
            document.getElementById('product_id');

        const quantityInput =
            document.getElementById('quantity');

        const preview =
            document.getElementById('productPreview');

        const previewAvatar =
            document.getElementById('previewAvatar');

        const previewName =
            document.getElementById('previewName');

        const previewMeta =
            document.getElementById('previewMeta');

        const previewStock =
            document.getElementById('previewStock');

        const remainingStock =
            document.getElementById('remainingStock');

        const quantityResult =
            document.getElementById('quantityResult');

        const stockWarning =
            document.getElementById('stockWarning');

        const submitButton =
            document.getElementById('submitButton');


        if (!productSelect || !quantityInput) {
            return;
        }


        function getSelectedProduct() {

            const option =
                productSelect.options[
                    productSelect.selectedIndex
                ];

            if (!option || !option.value) {
                return null;
            }

            return {
                option: option,
                name: option.dataset.name || '',
                code: option.dataset.code || '',
                category: option.dataset.category || '',
                stock: parseInt(
                    option.dataset.stock || '0',
                    10
                ),
                minimum: parseInt(
                    option.dataset.minimum || '0',
                    10
                )
            };
        }


        function updatePreview() {

            const product =
                getSelectedProduct();

            if (!product) {

                preview.classList.remove('show');

                previewStock.textContent = '0';

                remainingStock.textContent = '-';

                stockWarning.classList.remove('show');

                quantityResult.className =
                    'quantity-result';

                if (submitButton) {
                    submitButton.disabled = false;
                }

                return;
            }


            preview.classList.add('show');

            previewAvatar.textContent =
                product.name
                    ? product.name.charAt(0).toUpperCase()
                    : 'P';

            previewName.textContent =
                product.name;

            previewMeta.textContent =
                product.code
                + ' • '
                + product.category;

            previewStock.textContent =
                product.stock.toLocaleString('id-ID');


            /*
             * HTML max membantu mencegah pengguna memasukkan
             * jumlah lebih besar dari stok melalui browser.
             * Validasi utama tetap dilakukan kembali di server.
             */
            quantityInput.max =
                product.stock;


            updateRemainingStock();
        }


        function updateRemainingStock() {

            const product =
                getSelectedProduct();

            if (!product) {

                remainingStock.textContent = '-';

                stockWarning.classList.remove('show');

                quantityResult.className =
                    'quantity-result';

                return;
            }


            const quantity =
                parseInt(
                    quantityInput.value || '0',
                    10
                );


            if (
                !quantityInput.value ||
                quantity < 1
            ) {

                remainingStock.textContent =
                    product.stock.toLocaleString('id-ID')
                    + ' unit';

                stockWarning.classList.remove('show');

                quantityResult.className =
                    'quantity-result safe';

                if (submitButton) {
                    submitButton.disabled = false;
                }

                return;
            }


            const remaining =
                product.stock - quantity;


            if (quantity > product.stock) {

                remainingStock.textContent =
                    'Tidak valid';

                quantityResult.className =
                    'quantity-result danger';

                stockWarning.classList.add('show');

                if (submitButton) {
                    submitButton.disabled = true;
                }

                return;
            }


            stockWarning.classList.remove('show');

            remainingStock.textContent =
                remaining.toLocaleString('id-ID')
                + ' unit';


            if (remaining === 0) {

                quantityResult.className =
                    'quantity-result danger';

            } else if (
                remaining <= product.minimum
            ) {

                quantityResult.className =
                    'quantity-result warning';

            } else {

                quantityResult.className =
                    'quantity-result safe';

            }


            if (submitButton) {
                submitButton.disabled = false;
            }
        }


        productSelect.addEventListener(
            'change',
            updatePreview
        );


        quantityInput.addEventListener(
            'input',
            updateRemainingStock
        );


        updatePreview();

    });
</script>
@endpush