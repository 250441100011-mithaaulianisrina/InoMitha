@extends('layouts.app')

@section('title', 'Detail Kategori | InoMitha')
@section('page-title', 'Detail Kategori')
@section('page-subtitle', 'Informasi kategori dan produk IntanMitha Collection')

@push('styles')
<style>
    .category-detail-page {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .category-detail-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .category-detail-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .category-detail-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-divider {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .category-detail-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 205px;
        padding: 34px 37px;
        margin-bottom: 21px;
        border-radius: 24px;
        color: #ffffff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255, 255, 255, 0.17),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #573246 0%,
                #80405d 50%,
                #b55c7f 100%
            );
        box-shadow: 0 17px 45px rgba(84, 45, 64, 0.16);
    }

    .category-detail-hero::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        top: -145px;
        right: 115px;
        border: 34px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .category-detail-hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: -45px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.065);
    }

    .category-detail-profile {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 21px;
    }

    .category-detail-avatar {
        width: 80px;
        height: 80px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.20);
        border-radius: 23px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: inset 0 0 0 5px rgba(255, 255, 255, 0.035);
        font-size: 29px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .category-detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, 0.17);
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .category-detail-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f7d6e2;
        box-shadow: 0 0 0 4px rgba(247, 214, 226, 0.11);
    }

    .category-detail-title {
        margin-bottom: 7px;
        font-size: 26px;
        line-height: 1.3;
    }

    .category-detail-code {
        color: #efdce5;
        font-size: 10px;
        letter-spacing: 0.6px;
    }

    .category-detail-actions {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .category-detail-button {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .category-detail-button.back {
        border: 1px solid rgba(255, 255, 255, 0.20);
        color: #ffffff;
        background: rgba(255, 255, 255, 0.09);
    }

    .category-detail-button.back:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
    }

    .category-detail-button.edit {
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #6e3a52;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(59, 26, 42, 0.12);
    }

    .category-detail-button.edit:hover {
        color: #6e3a52;
        transform: translateY(-2px);
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .category-detail-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 21px;
    }

    .category-detail-summary-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 15px;
        min-height: 100px;
        padding: 19px;
        border: 1px solid #eee3e8;
        border-radius: 17px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, 0.045);
    }

    .category-detail-summary-card::after {
        content: "";
        position: absolute;
        width: 75px;
        height: 75px;
        right: -31px;
        bottom: -36px;
        border-radius: 50%;
        background: #fbf1f5;
    }

    .category-detail-summary-icon {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 17px;
    }

    .category-detail-summary-content {
        position: relative;
        z-index: 2;
    }

    .category-detail-summary-label {
        display: block;
        margin-bottom: 6px;
        color: #9e8993;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .category-detail-summary-value {
        color: #583748;
        font-size: 20px;
        font-weight: 700;
    }

    /* =========================================================
       CONTENT GRID
    ========================================================= */

    .category-detail-grid {
        display: grid;
        grid-template-columns: minmax(270px, 0.72fr) minmax(0, 1.55fr);
        gap: 20px;
        align-items: start;
    }

    .category-detail-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    .category-detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 19px 21px;
        border-bottom: 1px solid #f2e8ec;
    }

    .category-detail-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .category-detail-heading-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 15px;
    }

    .category-detail-heading h3 {
        margin-bottom: 4px;
        color: #5c394b;
        font-size: 13px;
    }

    .category-detail-heading p {
        color: #a08b95;
        font-size: 9px;
    }

    .category-detail-card-body {
        padding: 21px;
    }

    /* =========================================================
       CATEGORY INFORMATION
    ========================================================= */

    .category-info-list {
        display: flex;
        flex-direction: column;
    }

    .category-info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f2e9ed;
    }

    .category-info-item:first-child {
        padding-top: 0;
    }

    .category-info-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .category-info-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #98607a;
        background: #faf0f4;
        font-size: 12px;
    }

    .category-info-content {
        min-width: 0;
    }

    .category-info-label {
        display: block;
        margin-bottom: 5px;
        color: #a18c96;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .category-info-value {
        color: #644454;
        font-size: 10px;
        font-weight: 600;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    .category-info-description {
        font-weight: 400;
    }

    .category-info-empty {
        color: #ad9ba4;
        font-weight: 400;
        font-style: italic;
    }

    /* =========================================================
       INFO NOTE
    ========================================================= */

    .category-detail-note {
        position: relative;
        overflow: hidden;
        margin-top: 17px;
        padding: 17px;
        border-radius: 14px;
        color: #ffffff;
        background: linear-gradient(135deg, #694054, #92516d);
    }

    .category-detail-note::after {
        content: "◇";
        position: absolute;
        right: 7px;
        bottom: -35px;
        color: rgba(255, 255, 255, 0.07);
        font-size: 95px;
    }

    .category-detail-note-label {
        position: relative;
        z-index: 2;
        display: block;
        margin-bottom: 7px;
        color: #f4dce6;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .category-detail-note p {
        position: relative;
        z-index: 2;
        color: #f1e1e8;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       PRODUCT TABLE
    ========================================================= */

    .category-product-count {
        padding: 6px 9px;
        border-radius: 20px;
        color: #875269;
        background: #f7e9ef;
        font-size: 8px;
        font-weight: 700;
    }

    .category-product-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .category-product-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .category-product-table thead {
        background: #fdfafb;
    }

    .category-product-table th {
        padding: 12px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9b8490;
        font-size: 8px;
        font-weight: 700;
        text-align: left;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .category-product-table td {
        padding: 14px;
        border-bottom: 1px solid #f3eaee;
        color: #674757;
        font-size: 9px;
        vertical-align: middle;
    }

    .category-product-table tbody tr:last-child td {
        border-bottom: none;
    }

    .category-product-table tbody tr:hover {
        background: #fefafb;
    }

    .product-code {
        color: #9d8792;
        font-size: 8px;
    }

    .product-name {
        margin-bottom: 3px;
        color: #623e50;
        font-size: 10px;
        font-weight: 700;
    }

    .product-price {
        color: #674757;
        font-weight: 700;
    }

    .stock-badge,
    .product-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .stock-safe {
        color: #497158;
        background: #edf7f0;
    }

    .stock-low {
        color: #a14d5e;
        background: #fceef1;
    }

    .status-active {
        color: #497158;
        background: #edf7f0;
    }

    .status-inactive {
        color: #85757c;
        background: #f2eff0;
    }

    .badge-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       EMPTY PRODUCT STATE
    ========================================================= */

    .category-product-empty {
        padding: 52px 22px;
        text-align: center;
    }

    .category-product-empty-icon {
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        border: 1px solid #efdee5;
        border-radius: 18px;
        color: #995571;
        background: #f9ecf1;
        font-size: 24px;
    }

    .category-product-empty h4 {
        margin-bottom: 7px;
        color: #624152;
        font-size: 12px;
    }

    .category-product-empty p {
        max-width: 410px;
        margin: auto;
        color: #9f8994;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {
        .category-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 800px) {
        .category-detail-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .category-detail-actions {
            width: 100%;
        }

        .category-detail-button {
            flex: 1;
        }

        .category-detail-summary {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .category-detail-hero {
            padding: 27px 23px;
        }

        .category-detail-profile {
            align-items: flex-start;
            flex-direction: column;
        }

        .category-detail-avatar {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            font-size: 24px;
        }

        .category-detail-title {
            font-size: 22px;
        }

        .category-detail-actions {
            flex-direction: column;
        }

        .category-detail-button {
            width: 100%;
        }

        .category-detail-summary {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush


@section('content')

<div class="category-detail-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="category-detail-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-divider">/</span>

        <a href="{{ route('categories.index') }}">
            Produk & Kategori
        </a>

        <span class="breadcrumb-divider">/</span>

        <span>
            {{ $category->name }}
        </span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="category-detail-hero">

        <div class="category-detail-profile">

            <div class="category-detail-avatar">
                {{ strtoupper(substr($category->name, 0, 1)) }}
            </div>

            <div>

                <div class="category-detail-badge">
                    <span class="category-detail-badge-dot"></span>
                    Product Category
                </div>

                <h1 class="category-detail-title">
                    {{ $category->name }}
                </h1>

                <div class="category-detail-code">
                    CATEGORY #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                    · IntanMitha Collection
                </div>

            </div>

        </div>


        <div class="category-detail-actions">

            <a
                href="{{ route('categories.index') }}"
                class="category-detail-button back"
            >
                ←
                Daftar Kategori
            </a>

            <a
                href="{{ route('categories.edit', $category) }}"
                class="category-detail-button edit"
            >
                ✎
                Edit Kategori
            </a>

        </div>

    </section>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <section class="category-detail-summary">

        <div class="category-detail-summary-card">

            <div class="category-detail-summary-icon">
                ▦
            </div>

            <div class="category-detail-summary-content">

                <span class="category-detail-summary-label">
                    Total Produk
                </span>

                <div class="category-detail-summary-value">
                    {{ number_format($totalProducts) }}
                </div>

            </div>

        </div>


        <div class="category-detail-summary-card">

            <div class="category-detail-summary-icon">
                ✓
            </div>

            <div class="category-detail-summary-content">

                <span class="category-detail-summary-label">
                    Produk Aktif
                </span>

                <div class="category-detail-summary-value">
                    {{ number_format($activeProducts) }}
                </div>

            </div>

        </div>


        <div class="category-detail-summary-card">

            <div class="category-detail-summary-icon">
                !
            </div>

            <div class="category-detail-summary-content">

                <span class="category-detail-summary-label">
                    Stok Menipis
                </span>

                <div class="category-detail-summary-value">
                    {{ number_format($lowStockProducts) }}
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         DETAIL GRID
    ====================================================== --}}

    <section class="category-detail-grid">

        {{-- =================================================
             CATEGORY INFORMATION
        ================================================== --}}

        <div class="category-detail-card">

            <div class="category-detail-card-header">

                <div class="category-detail-heading">

                    <div class="category-detail-heading-icon">
                        ◇
                    </div>

                    <div>
                        <h3>Informasi Kategori</h3>
                        <p>Detail pengelompokan produk.</p>
                    </div>

                </div>

            </div>


            <div class="category-detail-card-body">

                <div class="category-info-list">

                    <div class="category-info-item">

                        <div class="category-info-icon">
                            #
                        </div>

                        <div class="category-info-content">

                            <span class="category-info-label">
                                ID Kategori
                            </span>

                            <div class="category-info-value">
                                CATEGORY #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                            </div>

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-icon">
                            ◇
                        </div>

                        <div class="category-info-content">

                            <span class="category-info-label">
                                Nama Kategori
                            </span>

                            <div class="category-info-value">
                                {{ $category->name }}
                            </div>

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-icon">
                            ≡
                        </div>

                        <div class="category-info-content">

                            <span class="category-info-label">
                                Deskripsi
                            </span>

                            @if ($category->description)

                                <div class="category-info-value category-info-description">
                                    {{ $category->description }}
                                </div>

                            @else

                                <div class="category-info-empty">
                                    Belum ada deskripsi kategori.
                                </div>

                            @endif

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-icon">
                            ◷
                        </div>

                        <div class="category-info-content">

                            <span class="category-info-label">
                                Dibuat
                            </span>

                            <div class="category-info-value">
                                {{ $category->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-icon">
                            ↻
                        </div>

                        <div class="category-info-content">

                            <span class="category-info-label">
                                Terakhir Diperbarui
                            </span>

                            <div class="category-info-value">
                                {{ $category->updated_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="category-detail-note">

                    <span class="category-detail-note-label">
                        Product Management
                    </span>

                    <p>
                        Kategori membantu InoMitha mengelompokkan
                        produk sehingga pengelolaan katalog,
                        persediaan, penjualan, dan analisis produk
                        dapat dilakukan dengan lebih terstruktur.
                    </p>

                </div>

            </div>

        </div>


        {{-- =================================================
             PRODUCTS
        ================================================== --}}

        <div class="category-detail-card">

            <div class="category-detail-card-header">

                <div class="category-detail-heading">

                    <div class="category-detail-heading-icon">
                        ▦
                    </div>

                    <div>
                        <h3>Produk dalam Kategori</h3>
                        <p>
                            Daftar produk yang terhubung dengan kategori ini.
                        </p>
                    </div>

                </div>

                <span class="category-product-count">
                    {{ number_format($totalProducts) }}
                    Produk
                </span>

            </div>


            @if ($category->products->count() > 0)

                <div class="category-product-table-wrapper">

                    <table class="category-product-table">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>


                        <tbody>

                            @foreach ($category->products as $product)

                                <tr>

                                    <td>

                                        <div class="product-name">
                                            {{ $product->name }}
                                        </div>

                                        <div class="product-code">
                                            {{ $product->product_code }}
                                        </div>

                                    </td>


                                    <td>

                                        <span class="product-price">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>

                                    </td>


                                    <td>

                                        @if ($product->stock <= $product->minimum_stock)

                                            <span class="stock-badge stock-low">

                                                <span class="badge-dot"></span>

                                                {{ number_format($product->stock) }}
                                                unit

                                            </span>

                                        @else

                                            <span class="stock-badge stock-safe">

                                                <span class="badge-dot"></span>

                                                {{ number_format($product->stock) }}
                                                unit

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if ($product->is_active)

                                            <span class="product-status status-active">

                                                <span class="badge-dot"></span>

                                                Aktif

                                            </span>

                                        @else

                                            <span class="product-status status-inactive">

                                                <span class="badge-dot"></span>

                                                Nonaktif

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="category-product-empty">

                    <div class="category-product-empty-icon">
                        ▦
                    </div>

                    <h4>Belum Ada Produk</h4>

                    <p>
                        Belum ada produk yang terhubung dengan kategori
                        {{ $category->name }}. Produk akan muncul di sini
                        setelah modul Produk InoMitha mulai digunakan.
                    </p>

                </div>

            @endif

        </div>

    </section>

</div>

@endsection