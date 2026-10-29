@extends('layouts.app')

@section('title', 'Edit Produk | InoMitha')
@section('page-title', 'Edit Produk')
@section('page-subtitle', 'Perbarui informasi produk IntanMitha Collection')

@push('styles')
<style>
    .product-edit-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    .edit-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .edit-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
    }

    .edit-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* HERO */
    .edit-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
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

    .edit-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -135px;
        right: 115px;
        border: 32px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .edit-hero::after {
        content: "";
        position: absolute;
        width: 165px;
        height: 165px;
        right: -45px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .edit-hero-left,
    .edit-hero-code {
        position: relative;
        z-index: 2;
    }

    .edit-hero-left {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .product-avatar {
        width: 70px;
        height: 70px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 20px;
        background: rgba(255,255,255,.11);
        font-size: 27px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        padding: 6px 10px;
        border: 1px solid rgba(255,255,255,.17);
        border-radius: 20px;
        background: rgba(255,255,255,.08);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .hero-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f7d4e1;
    }

    .edit-hero h1 {
        margin-bottom: 7px;
        font-size: 26px;
    }

    .edit-hero p {
        color: #efdde4;
        font-size: 10px;
        line-height: 1.7;
    }

    .edit-hero-code {
        min-width: 125px;
        padding: 14px 17px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 13px;
        background: rgba(255,255,255,.10);
        text-align: center;
        backdrop-filter: blur(8px);
    }

    .edit-hero-code span {
        display: block;
        margin-bottom: 5px;
        color: #e9d4dd;
        font-size: 7px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .edit-hero-code strong {
        font-size: 13px;
        letter-spacing: .5px;
    }

    /* LAYOUT */
    .edit-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, .72fr);
        gap: 20px;
        align-items: start;
    }

    .edit-form-card,
    .edit-side-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 9px 30px rgba(80,46,62,.05);
    }

    .form-card-header {
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
        color: #8f4667;
        background: #f8e9ef;
        font-size: 17px;
    }

    .form-card-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .form-card-header p {
        color: #a18b96;
        font-size: 9px;
    }

    .form-card-body {
        padding: 25px 23px;
    }

    /* VALIDATION */
    .validation-alert {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f0d5dc;
        border-radius: 11px;
        color: #854455;
        background: #fff4f6;
    }

    .validation-icon {
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

    .validation-alert h4 {
        margin-bottom: 4px;
        font-size: 10px;
    }

    .validation-alert p {
        color: #a36877;
        font-size: 9px;
        line-height: 1.6;
    }

    /* SECTIONS */
    .form-section {
        margin-bottom: 28px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-grid .form-group {
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
    .form-select {
        width: 100%;
        min-height: 44px;
        padding: 0 13px;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        outline: none;
        color: #604050;
        background: #fefcfd;
        font-size: 10px;
        transition: .2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #c47c98;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(143,70,103,.07);
    }

    .form-control.readonly {
        color: #8e7883;
        background: #f7f3f5;
        cursor: not-allowed;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
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

    .price-wrapper {
        position: relative;
    }

    .price-prefix {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #8f687a;
        font-size: 10px;
        font-weight: 700;
        transform: translateY(-50%);
    }

    .price-wrapper .form-control {
        padding-left: 36px;
    }

    /* STOCK LOCK */
    .stock-lock-box {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #eadce2;
        border-radius: 12px;
        background: #fdf9fb;
    }

    .stock-lock-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f6e5ec;
        font-size: 17px;
    }

    .stock-lock-content {
        flex: 1;
    }

    .stock-lock-content h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .stock-lock-content p {
        color: #9c8791;
        font-size: 8px;
        line-height: 1.6;
    }

    .current-stock {
        flex-shrink: 0;
        text-align: right;
    }

    .current-stock span {
        display: block;
        margin-bottom: 3px;
        color: #a18b96;
        font-size: 7px;
        text-transform: uppercase;
    }

    .current-stock strong {
        color: #663e52;
        font-size: 17px;
    }

    .current-stock small {
        color: #9e8993;
        font-size: 8px;
    }

    /* STATUS */
    .status-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 9px;
    }

    .status-option input {
        display: none;
    }

    .status-option label {
        min-height: 45px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        color: #826878;
        background: #fefcfd;
        font-size: 9px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .status-option input:checked + label {
        border-color: #b96d8b;
        color: #78425b;
        background: #faedf2;
        box-shadow: 0 0 0 3px rgba(143,70,103,.05);
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #b5a7ae;
    }

    .status-option.active .status-indicator {
        background: #62906f;
    }

    /* ACTION */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .form-actions-right {
        display: flex;
        gap: 8px;
    }

    .btn-detail,
    .btn-cancel,
    .btn-save {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 15px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-detail {
        border: 1px solid #eadde3;
        color: #765469;
        background: #fff;
    }

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #806575;
        background: #fff;
    }

    .btn-save {
        border: 1px solid #8f4667;
        color: #fff;
        background: linear-gradient(135deg, #8f4667, #aa5577);
        box-shadow: 0 7px 17px rgba(143,70,103,.17);
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143,70,103,.23);
    }

    /* SIDE */
    .side-header {
        padding: 21px;
        color: #fff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .side-header h3 {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .side-header p {
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .side-body {
        padding: 20px;
    }

    .product-mini-profile {
        padding-bottom: 18px;
        margin-bottom: 18px;
        border-bottom: 1px solid #f1e7eb;
        text-align: center;
    }

    .mini-avatar {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 11px;
        border: 1px solid #ecdbe3;
        border-radius: 16px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 21px;
        font-weight: 700;
    }

    .product-mini-profile h4 {
        margin-bottom: 4px;
        color: #614050;
        font-size: 11px;
    }

    .product-mini-profile p {
        color: #a18b96;
        font-size: 8px;
    }

    .side-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px solid #f3eaed;
        font-size: 9px;
    }

    .side-row:last-of-type {
        border-bottom: none;
    }

    .side-label {
        color: #9d8792;
    }

    .side-value {
        color: #624252;
        font-weight: 700;
        text-align: right;
    }

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        font-size: 7px;
        font-weight: 700;
    }

    .stock-status.safe {
        color: #4d755b;
        background: #edf7f0;
    }

    .stock-status.low {
        color: #a34f61;
        background: #fceef1;
    }

    .stock-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .side-notice {
        margin-top: 17px;
        padding: 12px;
        border: 1px solid #eadbe2;
        border-radius: 10px;
        color: #8e7180;
        background: #fdf8fa;
        font-size: 8px;
        line-height: 1.7;
    }

    @media (max-width: 950px) {
        .edit-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .edit-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .edit-hero-left {
            align-items: flex-start;
            flex-direction: column;
        }

        .edit-hero-code {
            width: 100%;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .stock-lock-box {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .current-stock {
            width: 100%;
            text-align: left;
        }

        .form-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .form-actions-right {
            flex-direction: column;
        }

        .btn-detail,
        .btn-cancel,
        .btn-save {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="product-edit-page">

    {{-- BREADCRUMB --}}
    <div class="edit-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('products.index') }}">
            Produk
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('products.show', $product) }}">
            {{ $product->product_code }}
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Edit</span>

    </div>


    {{-- HERO --}}
    <section class="edit-hero">

        <div class="edit-hero-left">

            <div class="product-avatar">
                {{ strtoupper(substr($product->name, 0, 1)) }}
            </div>

            <div>

                <div class="hero-label">
                    <span class="hero-dot"></span>
                    Edit Product
                </div>

                <h1>
                    Edit {{ $product->name }}
                </h1>

                <p>
                    Perbarui informasi produk tanpa mengubah
                    riwayat persediaan yang sudah tersimpan.
                </p>

            </div>

        </div>


        <div class="edit-hero-code">

            <span>Kode Produk</span>

            <strong>
                {{ $product->product_code }}
            </strong>

        </div>

    </section>


    <div class="edit-layout">

        {{-- FORM --}}
        <section class="edit-form-card">

            <div class="form-card-header">

                <div class="form-header-icon">
                    ✎
                </div>

                <div>
                    <h3>Perbarui Informasi Produk</h3>

                    <p>
                        Sesuaikan data produk yang ingin diperbarui.
                    </p>
                </div>

            </div>


            <form
                action="{{ route('products.update', $product) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                {{-- Kode tetap dikirim ke controller tetapi tidak
                     dapat diedit oleh pengguna. --}}
                <input
                    type="hidden"
                    name="product_code"
                    value="{{ $product->product_code }}"
                >


                <div class="form-card-body">

                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-icon">
                                !
                            </div>

                            <div>

                                <h4>Perubahan belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali data pada kolom
                                    yang ditandai.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- SECTION 1 --}}
                    <div class="form-section">

                        <div class="form-section-title">
                            <span class="section-number">01</span>
                            Informasi Utama
                        </div>


                        <div class="form-grid">

                            {{-- CODE --}}
                            <div class="form-group">

                                <label class="form-label">
                                    Kode Produk
                                </label>

                                <input
                                    type="text"
                                    class="form-control readonly"
                                    value="{{ $product->product_code }}"
                                    readonly
                                >

                                <div class="form-help">
                                    Kode produk dibuat otomatis dan
                                    tidak dapat diubah.
                                </div>

                            </div>


                            {{-- CATEGORY --}}
                            <div class="form-group">

                                <label
                                    for="category_id"
                                    class="form-label"
                                >
                                    Kategori
                                    <span class="required">*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Pilih kategori
                                    </option>

                                    @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ (string) old(
                                                'category_id',
                                                $product->category_id
                                            ) === (string) $category->id
                                                ? 'selected'
                                                : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('category_id')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- NAME --}}
                            <div class="form-group">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Nama Produk
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    maxlength="255"
                                    required
                                >

                                @error('name')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PRICE --}}
                            <div class="form-group">

                                <label
                                    for="price"
                                    class="form-label"
                                >
                                    Harga Produk
                                    <span class="required">*</span>
                                </label>

                                <div class="price-wrapper">

                                    <span class="price-prefix">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="price"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        min="0"
                                        step="1"
                                        required
                                    >

                                </div>

                                @error('price')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- SECTION 2 --}}
                    <div class="form-section">

                        <div class="form-section-title">
                            <span class="section-number">02</span>
                            Persediaan & Status
                        </div>


                        {{-- STOCK LOCK --}}
                        <div
                            class="stock-lock-box"
                            style="margin-bottom: 18px;"
                        >

                            <div class="stock-lock-icon">
                                ≡
                            </div>

                            <div class="stock-lock-content">

                                <h4>
                                    Stok Tidak Diedit dari Halaman Ini
                                </h4>

                                <p>
                                    Perubahan jumlah stok akan dilakukan
                                    melalui modul Persediaan agar setiap
                                    stok masuk dan keluar tercatat
                                    dalam riwayat sistem.
                                </p>

                            </div>

                            <div class="current-stock">

                                <span>Stok Saat Ini</span>

                                <strong>
                                    {{ number_format($product->stock) }}
                                </strong>

                                <small>unit</small>

                            </div>

                        </div>


                        <div class="form-grid">

                            {{-- MINIMUM STOCK --}}
                            <div class="form-group">

                                <label
                                    for="minimum_stock"
                                    class="form-label"
                                >
                                    Minimum Stok
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="minimum_stock"
                                    name="minimum_stock"
                                    value="{{ old(
                                        'minimum_stock',
                                        $product->minimum_stock
                                    ) }}"
                                    class="form-control @error('minimum_stock') is-invalid @enderror"
                                    min="0"
                                    step="1"
                                    required
                                >

                                @error('minimum_stock')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-help">
                                    Produk ditandai stok menipis apabila
                                    stok berada pada atau di bawah
                                    nilai ini.
                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="form-group">

                                <label class="form-label">
                                    Status Produk
                                    <span class="required">*</span>
                                </label>


                                <div class="status-options">

                                    <div class="status-option active">

                                        <input
                                            type="radio"
                                            id="status_active"
                                            name="is_active"
                                            value="1"
                                            {{ old(
                                                'is_active',
                                                $product->is_active ? '1' : '0'
                                            ) == '1' ? 'checked' : '' }}
                                        >

                                        <label for="status_active">

                                            <span class="status-indicator"></span>

                                            Aktif

                                        </label>

                                    </div>


                                    <div class="status-option">

                                        <input
                                            type="radio"
                                            id="status_inactive"
                                            name="is_active"
                                            value="0"
                                            {{ old(
                                                'is_active',
                                                $product->is_active ? '1' : '0'
                                            ) == '0' ? 'checked' : '' }}
                                        >

                                        <label for="status_inactive">

                                            <span class="status-indicator"></span>

                                            Nonaktif

                                        </label>

                                    </div>

                                </div>

                                @error('is_active')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div class="form-actions">

                    <a
                        href="{{ route('products.show', $product) }}"
                        class="btn-detail"
                    >
                        ◉ Lihat Detail
                    </a>


                    <div class="form-actions-right">

                        <a
                            href="{{ route('products.index') }}"
                            class="btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-save"
                        >
                            ✓ Simpan Perubahan
                        </button>

                    </div>

                </div>

            </form>

        </section>


        {{-- SIDE INFORMATION --}}
        <aside>

            <section class="edit-side-card">

                <div class="side-header">

                    <h3>Produk Saat Ini</h3>

                    <p>
                        Ringkasan data sebelum perubahan disimpan.
                    </p>

                </div>


                <div class="side-body">

                    <div class="product-mini-profile">

                        <div class="mini-avatar">
                            {{ strtoupper(substr($product->name, 0, 1)) }}
                        </div>

                        <h4>
                            {{ $product->name }}
                        </h4>

                        <p>
                            {{ $product->product_code }}
                        </p>

                    </div>


                    <div class="side-row">

                        <span class="side-label">
                            Kategori
                        </span>

                        <span class="side-value">
                            {{ $product->category->name }}
                        </span>

                    </div>


                    <div class="side-row">

                        <span class="side-label">
                            Harga
                        </span>

                        <span class="side-value">
                            Rp {{ number_format(
                                $product->price,
                                0,
                                ',',
                                '.'
                            ) }}
                        </span>

                    </div>


                    <div class="side-row">

                        <span class="side-label">
                            Stok
                        </span>

                        <span class="side-value">
                            {{ number_format($product->stock) }}
                            unit
                        </span>

                    </div>


                    <div class="side-row">

                        <span class="side-label">
                            Minimum
                        </span>

                        <span class="side-value">
                            {{ number_format($product->minimum_stock) }}
                            unit
                        </span>

                    </div>


                    <div class="side-row">

                        <span class="side-label">
                            Kondisi
                        </span>

                        <span class="side-value">

                            @if (
                                $product->stock <=
                                $product->minimum_stock
                            )

                                <span class="stock-status low">

                                    <span class="stock-dot"></span>

                                    Menipis

                                </span>

                            @else

                                <span class="stock-status safe">

                                    <span class="stock-dot"></span>

                                    Aman

                                </span>

                            @endif

                        </span>

                    </div>


                    <div class="side-notice">

                        <strong>Catatan:</strong><br>

                        Jika produk sudah tidak dijual, ubah status
                        menjadi <b>Nonaktif</b> daripada menghapusnya.
                        Dengan begitu riwayat transaksi dan laporan
                        tetap tersimpan dengan baik.

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection