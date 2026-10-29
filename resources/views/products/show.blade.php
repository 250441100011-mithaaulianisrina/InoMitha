@extends('layouts.app')

@section('title', 'Detail Produk | InoMitha')
@section('page-title', 'Detail Produk')
@section('page-subtitle', 'Informasi lengkap produk IntanMitha Collection')

@push('styles')
<style>
    .product-detail-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */
    .detail-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .detail-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
    }

    .detail-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .detail-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        min-height: 205px;
        padding: 32px 35px;
        margin-bottom: 21px;
        border-radius: 23px;
        color: #ffffff;
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

    .detail-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        top: -140px;
        right: 130px;
        border: 32px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .detail-hero::after {
        content: "";
        position: absolute;
        width: 175px;
        height: 175px;
        right: -50px;
        bottom: -95px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .detail-hero-left,
    .detail-hero-actions {
        position: relative;
        z-index: 2;
    }

    .detail-hero-left {
        display: flex;
        align-items: center;
        gap: 19px;
    }

    .detail-product-avatar {
        width: 76px;
        height: 76px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.22);
        border-radius: 21px;
        color: #ffffff;
        background: rgba(255,255,255,.12);
        backdrop-filter: blur(8px);
        font-size: 29px;
        font-weight: 700;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.1);
    }

    .detail-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        padding: 6px 10px;
        border: 1px solid rgba(255,255,255,.17);
        border-radius: 20px;
        background: rgba(255,255,255,.08);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
    }

    .detail-label-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f7d4e1;
    }

    .detail-hero h1 {
        margin-bottom: 7px;
        font-size: 26px;
        line-height: 1.3;
    }

    .detail-hero-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        color: #efdce4;
        font-size: 9px;
    }

    .hero-meta-divider {
        opacity: .55;
    }

    .detail-hero-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .btn-hero-back,
    .btn-hero-edit {
        min-height: 41px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-hero-back {
        border: 1px solid rgba(255,255,255,.2);
        color: #ffffff;
        background: rgba(255,255,255,.09);
    }

    .btn-hero-back:hover {
        color: #ffffff;
        background: rgba(255,255,255,.15);
    }

    .btn-hero-edit {
        border: 1px solid #ffffff;
        color: #713c55;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(62,29,44,.13);
    }

    .btn-hero-edit:hover {
        color: #713c55;
        transform: translateY(-1px);
    }

    /* =========================================================
       SUMMARY
    ========================================================= */
    .detail-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 21px;
    }

    .detail-summary-card {
        position: relative;
        overflow: hidden;
        min-height: 105px;
        padding: 18px;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80,46,62,.045);
    }

    .summary-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
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
    }

    .summary-icon.green {
        color: #4d755b;
        background: #edf7f0;
    }

    .summary-icon.orange {
        color: #9d6741;
        background: #fbf1e9;
    }

    .summary-icon.blue {
        color: #5b668b;
        background: #f0f1f8;
    }

    .summary-label {
        color: #a18b96;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .summary-value {
        color: #5e3d4d;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.2;
    }

    .summary-value.currency {
        font-size: 15px;
    }

    .summary-note {
        margin-top: 5px;
        color: #a28e98;
        font-size: 8px;
    }

    /* =========================================================
       CONTENT
    ========================================================= */
    .detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.45fr) minmax(270px, .7fr);
        gap: 20px;
        align-items: start;
        margin-bottom: 20px;
    }

    .detail-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 8px 27px rgba(80,46,62,.045);
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 19px 21px;
        border-bottom: 1px solid #f2e8ec;
    }

    .card-header-icon {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 14px;
    }

    .detail-card-header h3 {
        margin-bottom: 3px;
        color: #5e3d4e;
        font-size: 12px;
    }

    .detail-card-header p {
        color: #a18c96;
        font-size: 8px;
    }

    .detail-card-body {
        padding: 21px;
    }

    /* INFORMATION */
    .information-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .information-item {
        padding: 14px 15px;
        border: 1px solid #f0e5e9;
        border-radius: 11px;
        background: #fefcfd;
    }

    .information-label {
        display: block;
        margin-bottom: 6px;
        color: #a18b96;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .35px;
        text-transform: uppercase;
    }

    .information-value {
        color: #624252;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.5;
    }

    .category-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        color: #805269;
        background: #f8eaf0;
        font-size: 8px;
        font-weight: 700;
    }

    .category-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #a85b7a;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .status-pill.active {
        color: #4d755b;
        background: #edf7f0;
    }

    .status-pill.inactive {
        color: #83727b;
        background: #f2eff0;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* STOCK CARD */
    .stock-card-body {
        padding: 22px;
    }

    .stock-main {
        padding: 20px;
        margin-bottom: 15px;
        border: 1px solid #eedfe5;
        border-radius: 14px;
        background:
            linear-gradient(
                145deg,
                #fffafd,
                #f9edf2
            );
        text-align: center;
    }

    .stock-main-label {
        display: block;
        margin-bottom: 7px;
        color: #9c8591;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .stock-main-value {
        margin-bottom: 9px;
        color: #653d51;
        font-size: 31px;
        font-weight: 700;
    }

    .stock-main-value small {
        color: #9e8993;
        font-size: 9px;
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
        color: #a34f61;
        background: #fbecef;
    }

    .stock-condition-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .stock-detail-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f1e7eb;
        font-size: 9px;
    }

    .stock-detail-row:last-child {
        border-bottom: none;
    }

    .stock-detail-label {
        color: #9e8993;
    }

    .stock-detail-value {
        color: #624252;
        font-weight: 700;
        text-align: right;
    }

    .stock-notice {
        margin-top: 16px;
        padding: 12px 13px;
        border: 1px solid #eadbe2;
        border-radius: 10px;
        color: #8e7180;
        background: #fdf8fa;
        font-size: 8px;
        line-height: 1.7;
    }

    /* =========================================================
       STOCK HISTORY
    ========================================================= */
    .history-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 8px 27px rgba(80,46,62,.045);
    }

    .history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 22px;
        border-bottom: 1px solid #f2e8ec;
    }

    .history-header-left {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .history-header-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 14px;
    }

    .history-header h3 {
        margin-bottom: 3px;
        color: #5e3d4e;
        font-size: 12px;
    }

    .history-header p {
        color: #a18c96;
        font-size: 8px;
    }

    .history-limit {
        padding: 6px 9px;
        border-radius: 20px;
        color: #855269;
        background: #f8eaf0;
        font-size: 8px;
        font-weight: 700;
    }

    .history-table-wrapper {
        overflow-x: auto;
    }

    .history-table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
    }

    .history-table th {
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

    .history-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #f4ebef;
        color: #674757;
        font-size: 9px;
        vertical-align: middle;
    }

    .history-table tr:last-child td {
        border-bottom: none;
    }

    .movement-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 8px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .movement-badge.in {
        color: #4d755b;
        background: #edf7f0;
    }

    .movement-badge.out {
        color: #a34f61;
        background: #fceef1;
    }

    .movement-badge.adjustment {
        color: #98673e;
        background: #fbf1e9;
    }

    .movement-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .movement-quantity {
        font-weight: 700;
    }

    .movement-quantity.in {
        color: #4d755b;
    }

    .movement-quantity.out {
        color: #a34f61;
    }

    .movement-quantity.adjustment {
        color: #98673e;
    }

    .history-empty {
        padding: 47px 20px;
        text-align: center;
    }

    .history-empty-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 13px;
        border-radius: 16px;
        color: #94516d;
        background: #f8eaf0;
        font-size: 20px;
    }

    .history-empty h4 {
        margin-bottom: 6px;
        color: #624152;
        font-size: 11px;
    }

    .history-empty p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 1000px) {
        .detail-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .detail-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .detail-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .detail-hero-left {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-hero-actions {
            width: 100%;
        }

        .btn-hero-back,
        .btn-hero-edit {
            flex: 1;
        }

        .detail-summary-grid {
            grid-template-columns: 1fr;
        }

        .information-grid {
            grid-template-columns: 1fr;
        }

        .history-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="product-detail-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}
    <div class="detail-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('products.index') }}">
            Produk
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>
            {{ $product->product_code }}
        </span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="detail-hero">

        <div class="detail-hero-left">

            <div class="detail-product-avatar">
                {{ strtoupper(substr($product->name, 0, 1)) }}
            </div>

            <div>

                <div class="detail-label">
                    <span class="detail-label-dot"></span>
                    Detail Produk
                </div>

                <h1>
                    {{ $product->name }}
                </h1>

                <div class="detail-hero-meta">

                    <span>
                        {{ $product->product_code }}
                    </span>

                    <span class="hero-meta-divider">•</span>

                    <span>
                        {{ $product->category->name }}
                    </span>

                    <span class="hero-meta-divider">•</span>

                    <span>
                        {{ $product->is_active ? 'Produk Aktif' : 'Produk Nonaktif' }}
                    </span>

                </div>

            </div>

        </div>


        <div class="detail-hero-actions">

            <a
                href="{{ route('products.index') }}"
                class="btn-hero-back"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('products.edit', $product) }}"
                class="btn-hero-edit"
            >
                ✎ Edit Produk
            </a>

        </div>

    </section>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}
    <section class="detail-summary-grid">

        {{-- PRICE --}}
        <div class="detail-summary-card">

            <div class="summary-top">

                <span class="summary-label">
                    Harga Produk
                </span>

                <div class="summary-icon">
                    Rp
                </div>

            </div>

            <div class="summary-value currency">
                Rp {{ number_format(
                    $product->price,
                    0,
                    ',',
                    '.'
                ) }}
            </div>

            <div class="summary-note">
                Harga jual saat ini
            </div>

        </div>


        {{-- STOCK --}}
        <div class="detail-summary-card">

            <div class="summary-top">

                <span class="summary-label">
                    Stok Tersedia
                </span>

                <div class="summary-icon orange">
                    ≡
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($product->stock) }}
            </div>

            <div class="summary-note">
                Unit tersedia saat ini
            </div>

        </div>


        {{-- SOLD --}}
        <div class="detail-summary-card">

            <div class="summary-top">

                <span class="summary-label">
                    Total Terjual
                </span>

                <div class="summary-icon green">
                    ✓
                </div>

            </div>

            <div class="summary-value">
                {{ number_format($totalSold) }}
            </div>

            <div class="summary-note">
                Dari transaksi selesai
            </div>

        </div>


        {{-- REVENUE --}}
        <div class="detail-summary-card">

            <div class="summary-top">

                <span class="summary-label">
                    Nilai Penjualan
                </span>

                <div class="summary-icon blue">
                    ◇
                </div>

            </div>

            <div class="summary-value currency">
                Rp {{ number_format(
                    $totalRevenue,
                    0,
                    ',',
                    '.'
                ) }}
            </div>

            <div class="summary-note">
                Akumulasi penjualan produk
            </div>

        </div>

    </section>


    {{-- =====================================================
         MAIN INFORMATION
    ====================================================== --}}
    <div class="detail-layout">

        {{-- PRODUCT INFORMATION --}}
        <section class="detail-card">

            <div class="detail-card-header">

                <div class="card-header-icon">
                    ▦
                </div>

                <div>
                    <h3>Informasi Produk</h3>

                    <p>
                        Informasi utama produk yang tersimpan dalam sistem.
                    </p>
                </div>

            </div>


            <div class="detail-card-body">

                <div class="information-grid">

                    <div class="information-item">

                        <span class="information-label">
                            Kode Produk
                        </span>

                        <div class="information-value">
                            {{ $product->product_code }}
                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Nama Produk
                        </span>

                        <div class="information-value">
                            {{ $product->name }}
                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Kategori
                        </span>

                        <div class="information-value">

                            <span class="category-pill">

                                <span class="category-dot"></span>

                                {{ $product->category->name }}

                            </span>

                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Status
                        </span>

                        <div class="information-value">

                            @if ($product->is_active)

                                <span class="status-pill active">
                                    <span class="status-dot"></span>
                                    Aktif
                                </span>

                            @else

                                <span class="status-pill inactive">
                                    <span class="status-dot"></span>
                                    Nonaktif
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Harga
                        </span>

                        <div class="information-value">
                            Rp {{ number_format(
                                $product->price,
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Minimum Stok
                        </span>

                        <div class="information-value">
                            {{ number_format($product->minimum_stock) }}
                            unit
                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Dibuat
                        </span>

                        <div class="information-value">
                            {{ $product->created_at->format('d/m/Y H:i') }}
                        </div>

                    </div>


                    <div class="information-item">

                        <span class="information-label">
                            Terakhir Diperbarui
                        </span>

                        <div class="information-value">
                            {{ $product->updated_at->format('d/m/Y H:i') }}
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- STOCK INFORMATION --}}
        <section class="detail-card">

            <div class="detail-card-header">

                <div class="card-header-icon">
                    ≡
                </div>

                <div>
                    <h3>Kondisi Persediaan</h3>

                    <p>
                        Ringkasan stok produk saat ini.
                    </p>
                </div>

            </div>


            <div class="stock-card-body">

                <div class="stock-main">

                    <span class="stock-main-label">
                        Stok Saat Ini
                    </span>

                    <div class="stock-main-value">
                        {{ number_format($product->stock) }}
                        <small>unit</small>
                    </div>


                    @if (
                        $product->stock <=
                        $product->minimum_stock
                    )

                        <span class="stock-condition low">

                            <span class="stock-condition-dot"></span>

                            Stok Menipis

                        </span>

                    @else

                        <span class="stock-condition safe">

                            <span class="stock-condition-dot"></span>

                            Stok Aman

                        </span>

                    @endif

                </div>


                <div class="stock-detail-row">

                    <span class="stock-detail-label">
                        Minimum stok
                    </span>

                    <span class="stock-detail-value">
                        {{ number_format($product->minimum_stock) }}
                        unit
                    </span>

                </div>


                <div class="stock-detail-row">

                    <span class="stock-detail-label">
                        Selisih dari minimum
                    </span>

                    <span class="stock-detail-value">

                        @if ($product->stock >= $product->minimum_stock)

                            +{{ number_format(
                                $product->stock -
                                $product->minimum_stock
                            ) }} unit

                        @else

                            -{{ number_format(
                                $product->minimum_stock -
                                $product->stock
                            ) }} unit

                        @endif

                    </span>

                </div>


                <div class="stock-detail-row">

                    <span class="stock-detail-label">
                        Status produk
                    </span>

                    <span class="stock-detail-value">
                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>

                </div>


                <div class="stock-notice">

                    Perubahan jumlah stok nantinya dikelola melalui
                    modul Persediaan agar setiap stok masuk dan keluar
                    memiliki riwayat yang jelas.

                </div>

            </div>

        </section>

    </div>


    {{-- =====================================================
         STOCK MOVEMENT HISTORY
    ====================================================== --}}
    <section class="history-card">

        <div class="history-header">

            <div class="history-header-left">

                <div class="history-header-icon">
                    ↻
                </div>

                <div>

                    <h3>Riwayat Pergerakan Stok</h3>

                    <p>
                        Aktivitas persediaan terbaru untuk produk ini.
                    </p>

                </div>

            </div>

            <span class="history-limit">
                Maks. 10 Riwayat
            </span>

        </div>


        @if ($product->stockMovements->count() > 0)

            <div class="history-table-wrapper">

                <table class="history-table">

                    <thead>

                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Petugas</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($product->stockMovements as $movement)

                            <tr>

                                <td>
                                    {{ $movement->created_at->format('d/m/Y H:i') }}
                                </td>


                                <td>

                                    @if ($movement->movement_type === 'in')

                                        <span class="movement-badge in">

                                            <span class="movement-dot"></span>

                                            Stok Masuk

                                        </span>

                                    @elseif ($movement->movement_type === 'out')

                                        <span class="movement-badge out">

                                            <span class="movement-dot"></span>

                                            Stok Keluar

                                        </span>

                                    @else

                                        <span class="movement-badge adjustment">

                                            <span class="movement-dot"></span>

                                            Penyesuaian

                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if ($movement->movement_type === 'in')

                                        <span class="movement-quantity in">
                                            +{{ number_format($movement->quantity) }}
                                            unit
                                        </span>

                                    @elseif ($movement->movement_type === 'out')

                                        <span class="movement-quantity out">
                                            -{{ number_format($movement->quantity) }}
                                            unit
                                        </span>

                                    @else

                                        <span class="movement-quantity adjustment">
                                            {{ number_format($movement->quantity) }}
                                            unit
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $movement->notes ?: '-' }}
                                </td>


                                <td>
                                    {{ $movement->user?->name ?? '-' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="history-empty">

                <div class="history-empty-icon">
                    ↻
                </div>

                <h4>Belum Ada Riwayat Stok</h4>

                <p>
                    Pergerakan persediaan produk ini belum pernah
                    tercatat dalam sistem.
                </p>

            </div>

        @endif

    </section>

</div>

@endsection