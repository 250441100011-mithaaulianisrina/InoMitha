@extends('layouts.app')

@section('title', 'Tambah Produk | InoMitha')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Tambahkan produk baru IntanMitha Collection')

@push('styles')
<style>
    .product-create-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* BREADCRUMB */
    .product-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .product-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
    }

    .product-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* HERO */
    .product-create-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 25px;
        min-height: 185px;
        padding: 32px 35px;
        margin-bottom: 22px;
        border-radius: 23px;
        color: white;
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

    .product-create-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -135px;
        right: 115px;
        border: 32px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .product-create-hero::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -45px;
        bottom: -85px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .hero-content,
    .hero-decoration {
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
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247,212,225,.12);
    }

    .hero-content h1 {
        margin-bottom: 8px;
        font-size: 27px;
    }

    .hero-content p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 11px;
        line-height: 1.8;
    }

    .hero-decoration {
        width: 76px;
        height: 76px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 22px;
        background: rgba(255,255,255,.11);
        font-size: 30px;
        backdrop-filter: blur(8px);
    }

    /* LAYOUT */
    .product-create-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, .72fr);
        gap: 20px;
        align-items: start;
    }

    .form-card,
    .info-card {
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
        font-size: 18px;
    }

    .form-card-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .form-card-header p {
        color: #a18b96;
        font-size: 10px;
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

    .validation-alert-icon {
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

    /* FORM */
    .form-section {
        margin-bottom: 27px;
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

    .form-group.full {
        grid-column: 1 / -1;
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

    /* PRICE */
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
        display: flex;
        align-items: center;
        gap: 9px;
        min-height: 45px;
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
        cursor: pointer;
        transition: .2s;
    }

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #806575;
        background: #fff;
    }

    .btn-cancel:hover {
        color: #653d51;
        background: #faf4f7;
    }

    .btn-save {
        border: 1px solid #8f4667;
        color: #fff;
        background: linear-gradient(135deg, #8f4667, #aa5577);
        box-shadow: 0 7px 17px rgba(143,70,103,.17);
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143,70,103,.23);
    }

    /* INFO */
    .info-header {
        position: relative;
        overflow: hidden;
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

    .info-item:last-child {
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
        color: #8f4667;
        background: #f8e9ef;
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

    .auto-code-box {
        margin-top: 18px;
        padding: 14px;
        border: 1px dashed #dfcbd4;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .auto-code-box strong {
        display: block;
        margin-bottom: 5px;
        color: #74445a;
        font-size: 9px;
    }

    .auto-code-box p {
        color: #9a828e;
        font-size: 8px;
        line-height: 1.6;
    }

    @media (max-width: 950px) {
        .product-create-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .product-create-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
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

<div class="product-create-page">

    {{-- BREADCRUMB --}}
    <div class="product-breadcrumb">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('products.index') }}">
            Produk & Kategori
        </a>

        <span class="breadcrumb-separator">/</span>
        <span>Tambah Produk</span>
    </div>


    {{-- HERO --}}
    <section class="product-create-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Product Management
            </div>

            <h1>Tambah Produk Baru</h1>

            <p>
                Tambahkan produk IntanMitha Collection beserta kategori,
                harga, stok awal, batas minimum persediaan, dan status
                produk agar dapat dikelola secara terintegrasi.
            </p>

        </div>

        <div class="hero-decoration">
            +
        </div>

    </section>


    <div class="product-create-layout">

        {{-- FORM --}}
        <section class="form-card">

            <div class="form-card-header">

                <div class="form-header-icon">
                    ▦
                </div>

                <div>
                    <h3>Informasi Produk</h3>
                    <p>
                        Lengkapi data produk yang akan ditambahkan.
                    </p>
                </div>

            </div>


            <form
                action="{{ route('products.store') }}"
                method="POST"
            >

                @csrf

                <div class="form-card-body">

                    {{-- VALIDATION --}}
                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-alert-icon">
                                !
                            </div>

                            <div>
                                <h4>Produk belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali data yang dimasukkan
                                    pada kolom di bawah ini.
                                </p>
                            </div>

                        </div>

                    @endif


                    {{-- SECTION 1 --}}
                    <div class="form-section">

                        <div class="form-section-title">
                            <span class="section-number">01</span>
                            Informasi Utama Produk
                        </div>


                        <div class="form-grid">

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
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Contoh: Scrunchie Satin"
                                    maxlength="255"
                                    required
                                    autofocus
                                >

                                @error('name')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

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
                                        Pilih kategori produk
                                    </option>

                                    @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ (string) old('category_id') === (string) $category->id ? 'selected' : '' }}
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
                                        value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="25000"
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

                                <div class="form-help">
                                    Masukkan harga dalam Rupiah tanpa
                                    tanda titik atau koma.
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
                                            {{ old('is_active', '1') == '1' ? 'checked' : '' }}
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
                                            {{ old('is_active') === '0' ? 'checked' : '' }}
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


                    {{-- SECTION 2 --}}
                    <div class="form-section">

                        <div class="form-section-title">
                            <span class="section-number">02</span>
                            Persediaan Awal
                        </div>


                        <div class="form-grid">

                            {{-- STOCK --}}
                            <div class="form-group">

                                <label
                                    for="stock"
                                    class="form-label"
                                >
                                    Stok Awal
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    min="0"
                                    step="1"
                                    required
                                >

                                @error('stock')
                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-help">
                                    Jumlah stok saat produk pertama kali
                                    dimasukkan ke sistem.
                                </div>

                            </div>


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
                                    value="{{ old('minimum_stock', 5) }}"
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
                                    Jika stok mencapai atau berada di bawah
                                    angka ini, produk akan ditandai
                                    sebagai stok menipis.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div class="form-actions">

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
                        ✓ Simpan Produk
                    </button>

                </div>

            </form>

        </section>


        {{-- INFO --}}
        <aside>

            <section class="info-card">

                <div class="info-header">
                    <h3>Informasi Produk</h3>

                    <p>
                        Data produk akan digunakan oleh modul
                        persediaan, transaksi, laporan, dan analisis AI.
                    </p>
                </div>


                <div class="info-body">

                    <div class="info-item">

                        <div class="info-number">01</div>

                        <div>
                            <h4>Kode Produk Otomatis</h4>

                            <p>
                                Kode produk dibuat otomatis oleh sistem,
                                sehingga tidak perlu dimasukkan secara manual.
                            </p>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">02</div>

                        <div>
                            <h4>Stok Awal Tercatat</h4>

                            <p>
                                Jika stok awal lebih dari 0, sistem juga
                                mencatatnya sebagai riwayat stok masuk.
                            </p>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">03</div>

                        <div>
                            <h4>Minimum Stok</h4>

                            <p>
                                Minimum stok membantu sistem mengenali
                                produk yang perlu segera ditambah persediaannya.
                            </p>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">04</div>

                        <div>
                            <h4>Status Produk</h4>

                            <p>
                                Produk aktif nantinya dapat digunakan
                                dalam transaksi penjualan.
                            </p>
                        </div>

                    </div>


                    <div class="auto-code-box">

                        <strong>Contoh kode otomatis</strong>

                        <p>
                            Produk pertama akan mendapatkan kode
                            PROD001, kemudian PROD002, PROD003,
                            dan seterusnya.
                        </p>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection