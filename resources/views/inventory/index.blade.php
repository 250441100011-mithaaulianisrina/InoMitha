@extends('layouts.app')

@section('title', 'Persediaan | InoMitha')
@section('page-title', 'Persediaan')
@section('page-subtitle', 'Pantau dan kelola persediaan produk IntanMitha Collection')

@push('styles')
<style>
    .inventory-page {
        width: 100%;
        max-width: 1220px;
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .inventory-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 205px;
        padding: 34px 36px;
        margin-bottom: 22px;
        border-radius: 24px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 10%,
                rgba(255,255,255,.17),
                transparent 26%
            ),
            linear-gradient(
                135deg,
                #563044 0%,
                #7e3f5c 50%,
                #b65d80 100%
            );
        box-shadow: 0 18px 43px rgba(89,48,68,.16);
    }

    .inventory-hero::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        top: -155px;
        right: 145px;
        border: 34px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .inventory-hero::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -55px;
        bottom: -100px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .hero-content,
    .hero-actions {
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

    .hero-label-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247,212,225,.12);
    }

    .hero-content h1 {
        margin-bottom: 9px;
        font-size: 28px;
    }

    .hero-content p {
        max-width: 600px;
        color: #f1dfe7;
        font-size: 10px;
        line-height: 1.8;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 9px;
    }

    .hero-btn {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 700;
        transition: .2s;
    }

    .hero-btn.secondary {
        border: 1px solid rgba(255,255,255,.21);
        color: #fff;
        background: rgba(255,255,255,.10);
        backdrop-filter: blur(7px);
    }

    .hero-btn.primary {
        border: 1px solid #fff;
        color: #753e58;
        background: #fff;
        box-shadow: 0 8px 20px rgba(64,31,46,.14);
    }

    .hero-btn:hover {
        transform: translateY(-1px);
    }

    /* =========================================================
       SUMMARY
    ========================================================= */
    .inventory-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        position: relative;
        overflow: hidden;
        min-height: 112px;
        padding: 18px;
        border: 1px solid #eee2e7;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(80,46,62,.045);
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 60px;
        right: -24px;
        bottom: -27px;
        border-radius: 50%;
        background: #faf0f4;
    }

    .summary-head {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
    }

    .summary-label {
        color: #9d8792;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .45px;
        text-transform: uppercase;
    }

    .summary-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 13px;
        font-weight: 700;
    }

    .summary-icon.green {
        color: #52765d;
        background: #edf7f0;
    }

    .summary-icon.orange {
        color: #a16b43;
        background: #fbf1e9;
    }

    .summary-icon.red {
        color: #a84f63;
        background: #fcecef;
    }

    .summary-value {
        position: relative;
        z-index: 2;
        color: #5e3d4e;
        font-size: 20px;
        font-weight: 700;
    }

    .summary-note {
        position: relative;
        z-index: 2;
        margin-top: 4px;
        color: #a28e98;
        font-size: 8px;
    }

    /* =========================================================
       TOOLBAR
    ========================================================= */
    .inventory-panel {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 9px 30px rgba(80,46,62,.05);
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 20px 22px;
        border-bottom: 1px solid #f1e7eb;
    }

    .panel-title {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .panel-title-icon {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 15px;
    }

    .panel-title h3 {
        margin-bottom: 3px;
        color: #5f3e4f;
        font-size: 13px;
    }

    .panel-title p {
        color: #a18c96;
        font-size: 8px;
    }

    .history-link {
        min-height: 37px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 12px;
        border: 1px solid #e5d6dd;
        border-radius: 9px;
        color: #79566a;
        background: #fff;
        font-size: 9px;
        font-weight: 700;
        transition: .2s;
    }

    .history-link:hover {
        color: #653d51;
        background: #faf4f7;
    }

    .filter-area {
        padding: 17px 22px;
        border-bottom: 1px solid #f1e8ec;
        background: #fefcfd;
    }

    .filter-form {
        display: grid;
        grid-template-columns: minmax(230px, 1fr) 190px auto;
        gap: 9px;
    }

    .search-wrapper {
        position: relative;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #a18b96;
        font-size: 11px;
        transform: translateY(-50%);
    }

    .filter-control {
        width: 100%;
        min-height: 40px;
        padding: 0 12px;
        border: 1px solid #e8dce1;
        border-radius: 9px;
        outline: none;
        color: #674858;
        background: #fff;
        font-size: 9px;
        transition: .2s;
    }

    .search-wrapper .filter-control {
        padding-left: 35px;
    }

    .filter-control:focus {
        border-color: #c57d99;
        box-shadow: 0 0 0 3px rgba(143,70,103,.06);
    }

    .filter-actions {
        display: flex;
        gap: 7px;
    }

    .filter-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 13px;
        border-radius: 9px;
        font-size: 9px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .filter-btn.apply {
        border: 1px solid #8f4667;
        color: #fff;
        background: #8f4667;
    }

    .filter-btn.reset {
        border: 1px solid #e4d6dc;
        color: #826676;
        background: #fff;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .table-wrapper {
        overflow-x: auto;
    }

    .inventory-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
    }

    .inventory-table th {
        padding: 12px 16px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8590;
        background: #fdfafb;
        font-size: 8px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .45px;
    }

    .inventory-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #f3eaee;
        color: #684858;
        font-size: 9px;
        vertical-align: middle;
    }

    .inventory-table tbody tr {
        transition: .15s;
    }

    .inventory-table tbody tr:hover {
        background: #fefafb;
    }

    .inventory-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-cell {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .product-avatar {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 12px;
        font-weight: 700;
    }

    .product-name {
        display: block;
        margin-bottom: 3px;
        color: #604050;
        font-size: 10px;
        font-weight: 700;
    }

    .product-code {
        color: #a38e98;
        font-size: 8px;
    }

    .category-badge {
        display: inline-flex;
        padding: 6px 9px;
        border-radius: 20px;
        color: #805269;
        background: #f8eaf0;
        font-size: 8px;
        font-weight: 700;
    }

    .stock-number {
        color: #5f3f4f;
        font-size: 12px;
        font-weight: 700;
    }

    .stock-number small {
        color: #a18b96;
        font-size: 8px;
        font-weight: 500;
    }

    .stock-condition {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .stock-condition.safe {
        color: #4e7459;
        background: #eaf5ed;
    }

    .stock-condition.low {
        color: #a16b43;
        background: #fbf1e9;
    }

    .stock-condition.empty {
        color: #a34f61;
        background: #fcecef;
    }

    .condition-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .product-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 8px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .product-status.active {
        color: #4d755b;
        background: #edf7f0;
    }

    .product-status.inactive {
        color: #85727b;
        background: #f1edef;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .row-action {
        min-height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        border: 1px solid #e6d8df;
        border-radius: 8px;
        color: #765469;
        background: #fff;
        font-size: 8px;
        font-weight: 700;
        transition: .2s;
    }

    .row-action:hover {
        color: #fff;
        border-color: #8f4667;
        background: #8f4667;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */
    .empty-state {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        border-radius: 17px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 22px;
    }

    .empty-state h4 {
        margin-bottom: 6px;
        color: #604050;
        font-size: 12px;
    }

    .empty-state p {
        max-width: 430px;
        margin: 0 auto;
        color: #9e8993;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */
    .pagination-area {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 16px 20px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .pagination-info {
        color: #9b8690;
        font-size: 8px;
    }

    .pagination-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-link-custom {
        min-width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 8px;
        border: 1px solid #e6d9df;
        border-radius: 8px;
        color: #79596a;
        background: #fff;
        font-size: 8px;
        font-weight: 700;
    }

    .page-link-custom.active {
        border-color: #8f4667;
        color: #fff;
        background: #8f4667;
    }

    .page-link-custom.disabled {
        opacity: .45;
        pointer-events: none;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 1000px) {
        .inventory-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .inventory-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .hero-actions {
            justify-content: flex-start;
        }

        .filter-form {
            grid-template-columns: 1fr 180px;
        }

        .filter-actions {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 650px) {
        .inventory-hero {
            padding: 27px 23px;
        }

        .hero-actions {
            width: 100%;
        }

        .hero-btn {
            flex: 1;
        }

        .inventory-summary {
            grid-template-columns: 1fr;
        }

        .panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            grid-column: auto;
            flex-direction: column;
        }

        .filter-btn {
            width: 100%;
        }

        .pagination-area {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="inventory-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="inventory-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-label-dot"></span>
                Inventory Management
            </div>

            <h1>Kelola Persediaan</h1>

            <p>
                Pantau ketersediaan produk IntanMitha Collection,
                identifikasi stok yang mulai menipis, serta catat
                setiap aktivitas stok masuk dan stok keluar secara
                terintegrasi.
            </p>

        </div>


        <div class="hero-actions">

            <a
                href="{{ route('inventory.stock-out.create') }}"
                class="hero-btn secondary"
            >
                − Stok Keluar
            </a>

            <a
                href="{{ route('inventory.stock-in.create') }}"
                class="hero-btn primary"
            >
                + Stok Masuk
            </a>

        </div>

    </section>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}
    <section class="inventory-summary">

        <div class="summary-card">

            <div class="summary-head">

                <span class="summary-label">
                    Total Produk
                </span>

                <div class="summary-icon">
                    ▦
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($totalProducts) }}
            </div>

            <div class="summary-note">
                Produk terdaftar
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-head">

                <span class="summary-label">
                    Total Unit Stok
                </span>

                <div class="summary-icon green">
                    ≡
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($totalStock) }}
            </div>

            <div class="summary-note">
                Seluruh unit tersedia
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-head">

                <span class="summary-label">
                    Stok Menipis
                </span>

                <div class="summary-icon orange">
                    !
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($lowStockProducts) }}
            </div>

            <div class="summary-note">
                Produk perlu diperhatikan
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-head">

                <span class="summary-label">
                    Stok Habis
                </span>

                <div class="summary-icon red">
                    0
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($outOfStockProducts) }}
            </div>

            <div class="summary-note">
                Produk tanpa persediaan
            </div>

        </div>

    </section>


    {{-- =====================================================
         INVENTORY TABLE
    ====================================================== --}}
    <section class="inventory-panel">

        <div class="panel-header">

            <div class="panel-title">

                <div class="panel-title-icon">
                    ≡
                </div>

                <div>
                    <h3>Daftar Persediaan Produk</h3>

                    <p>
                        Kondisi stok seluruh produk IntanMitha Collection.
                    </p>
                </div>

            </div>


            <a
                href="{{ route('inventory.history') }}"
                class="history-link"
            >
                ↻ Riwayat Stok
            </a>

        </div>


        {{-- FILTER --}}
        <div class="filter-area">

            <form
                action="{{ route('inventory.index') }}"
                method="GET"
                class="filter-form"
            >

                <div class="search-wrapper">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="filter-control"
                        placeholder="Cari kode, nama, atau kategori produk..."
                    >

                </div>


                <select
                    name="stock_status"
                    class="filter-control"
                >

                    <option value="">
                        Semua Kondisi Stok
                    </option>

                    <option
                        value="safe"
                        {{ $stockStatus === 'safe' ? 'selected' : '' }}
                    >
                        Stok Aman
                    </option>

                    <option
                        value="low"
                        {{ $stockStatus === 'low' ? 'selected' : '' }}
                    >
                        Stok Menipis
                    </option>

                    <option
                        value="out"
                        {{ $stockStatus === 'out' ? 'selected' : '' }}
                    >
                        Stok Habis
                    </option>

                </select>


                <div class="filter-actions">

                    <button
                        type="submit"
                        class="filter-btn apply"
                    >
                        Terapkan
                    </button>

                    <a
                        href="{{ route('inventory.index') }}"
                        class="filter-btn reset"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        @if ($products->count() > 0)

            <div class="table-wrapper">

                <table class="inventory-table">

                    <thead>

                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                            <th>Kondisi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($products as $product)

                            <tr>

                                {{-- PRODUCT --}}
                                <td>

                                    <div class="product-cell">

                                        <div class="product-avatar">
                                            {{ strtoupper(
                                                substr($product->name, 0, 1)
                                            ) }}
                                        </div>

                                        <div>

                                            <span class="product-name">
                                                {{ $product->name }}
                                            </span>

                                            <span class="product-code">
                                                {{ $product->product_code }}
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- CATEGORY --}}
                                <td>

                                    <span class="category-badge">
                                        {{ $product->category->name }}
                                    </span>

                                </td>


                                {{-- STOCK --}}
                                <td>

                                    <span class="stock-number">

                                        {{ number_format($product->stock) }}

                                        <small>unit</small>

                                    </span>

                                </td>


                                {{-- MINIMUM --}}
                                <td>

                                    <span class="stock-number">

                                        {{ number_format(
                                            $product->minimum_stock
                                        ) }}

                                        <small>unit</small>

                                    </span>

                                </td>


                                {{-- CONDITION --}}
                                <td>

                                    @if ($product->stock == 0)

                                        <span class="stock-condition empty">

                                            <span class="condition-dot"></span>

                                            Stok Habis

                                        </span>

                                    @elseif (
                                        $product->stock <=
                                        $product->minimum_stock
                                    )

                                        <span class="stock-condition low">

                                            <span class="condition-dot"></span>

                                            Stok Menipis

                                        </span>

                                    @else

                                        <span class="stock-condition safe">

                                            <span class="condition-dot"></span>

                                            Stok Aman

                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if ($product->is_active)

                                        <span class="product-status active">

                                            <span class="status-dot"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="product-status inactive">

                                            <span class="status-dot"></span>

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <a
                                        href="{{ route(
                                            'products.show',
                                            $product
                                        ) }}"
                                        class="row-action"
                                    >
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- CUSTOM PAGINATION --}}
            @if ($products->hasPages())

                <div class="pagination-area">

                    <div class="pagination-info">

                        Menampilkan
                        {{ $products->firstItem() }}
                        sampai
                        {{ $products->lastItem() }}
                        dari
                        {{ $products->total() }}
                        produk

                    </div>


                    <div class="pagination-buttons">

                        @if ($products->onFirstPage())

                            <span class="page-link-custom disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $products->previousPageUrl() }}"
                                class="page-link-custom"
                            >
                                ‹
                            </a>

                        @endif


                        @foreach (
                            range(
                                1,
                                $products->lastPage()
                            ) as $page
                        )

                            @if (
                                $page == 1 ||
                                $page == $products->lastPage() ||
                                abs($page - $products->currentPage()) <= 1
                            )

                                <a
                                    href="{{ $products->url($page) }}"
                                    class="page-link-custom
                                        {{ $page == $products->currentPage()
                                            ? 'active'
                                            : '' }}"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        @if ($products->hasMorePages())

                            <a
                                href="{{ $products->nextPageUrl() }}"
                                class="page-link-custom"
                            >
                                ›
                            </a>

                        @else

                            <span class="page-link-custom disabled">
                                ›
                            </span>

                        @endif

                    </div>

                </div>

            @endif

        @else

            {{-- EMPTY STATE --}}
            <div class="empty-state">

                <div class="empty-icon">
                    ≡
                </div>

                <h4>Tidak Ada Persediaan Ditemukan</h4>

                <p>
                    Belum ada produk atau tidak ada produk yang sesuai
                    dengan pencarian dan filter persediaan yang dipilih.
                </p>

            </div>

        @endif

    </section>

</div>

@endsection