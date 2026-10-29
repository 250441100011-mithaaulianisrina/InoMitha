@extends('layouts.app')

@section('title', 'Dashboard | InoMitha')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan bisnis IntanMitha Collection')

@push('styles')
<style>
    .dashboard-page {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 30px;
        min-height: 190px;
        margin-bottom: 22px;
        padding: 30px 32px;
        border-radius: 24px;
        color: #fff;
        background:
            radial-gradient(
                circle at 85% 15%,
                rgba(255, 255, 255, .15),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #553044 0%,
                #7d405c 48%,
                #b45c80 100%
            );
        box-shadow: 0 18px 42px rgba(88, 47, 67, .16);
    }

    .dashboard-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        right: 85px;
        top: -150px;
        border: 32px solid rgba(255, 255, 255, .05);
        border-radius: 50%;
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -45px;
        bottom: -85px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .05);
    }

    .hero-content,
    .hero-summary {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 12px;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, .18);
        border-radius: 30px;
        background: rgba(255, 255, 255, .08);
        font-size: 7px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .hero-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f4d7e2;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, .07);
    }

    .hero-content h1 {
        margin: 0 0 9px;
        font-size: 26px;
        line-height: 1.3;
    }

    .hero-content p {
        max-width: 610px;
        margin: 0;
        color: #f1e1e7;
        font-size: 9px;
        line-height: 1.75;
    }

    .hero-summary {
        min-width: 230px;
        padding: 18px;
        border: 1px solid rgba(255, 255, 255, .16);
        border-radius: 17px;
        background: rgba(255, 255, 255, .09);
        backdrop-filter: blur(8px);
    }

    .hero-summary-label {
        display: block;
        margin-bottom: 8px;
        color: #ecdce3;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .hero-summary-value {
        display: block;
        margin-bottom: 7px;
        font-size: 21px;
        font-weight: 800;
    }

    .hero-summary-note {
        color: #ecdce3;
        font-size: 7px;
        line-height: 1.6;
    }

    /* =========================================================
       SECTION HEADING
    ========================================================= */

    .section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 15px;
        margin: 0 0 13px;
    }

    .section-heading h2 {
        margin: 0 0 4px;
        color: #604050;
        font-size: 13px;
    }

    .section-heading p {
        margin: 0;
        color: #a08b95;
        font-size: 7px;
        line-height: 1.5;
    }

    .section-link {
        color: #8f4667;
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .section-link:hover {
        text-decoration: underline;
    }

    /* =========================================================
       MAIN STATISTICS
    ========================================================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 13px;
        margin-bottom: 22px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        min-height: 128px;
        padding: 18px;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, .04);
        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(80, 46, 62, .075);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 78px;
        height: 78px;
        right: -30px;
        bottom: -37px;
        border-radius: 50%;
        background: #fbf1f5;
    }

    .stat-top {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 14px;
    }

    .stat-icon {
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #faedf2;
        font-size: 11px;
        font-weight: 800;
    }

    .stat-tag {
        color: #af98a3;
        font-size: 6px;
        font-weight: 700;
        letter-spacing: .45px;
        text-transform: uppercase;
    }

    .stat-value {
        position: relative;
        z-index: 2;
        display: block;
        margin-bottom: 5px;
        color: #604050;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.2;
    }

    .stat-label {
        position: relative;
        z-index: 2;
        display: block;
        color: #a08b95;
        font-size: 7px;
        line-height: 1.5;
    }

    /* =========================================================
       CHART + STOCK OVERVIEW
    ========================================================= */

    .analytics-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(280px, .75fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .dashboard-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, .04);
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 17px 19px;
        border-bottom: 1px solid #f0e6ea;
    }

    .card-header h3 {
        margin: 0 0 4px;
        color: #604050;
        font-size: 11px;
    }

    .card-header p {
        margin: 0;
        color: #a08c95;
        font-size: 7px;
        line-height: 1.5;
    }

    .card-badge {
        flex-shrink: 0;
        padding: 5px 8px;
        border-radius: 20px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 7px;
        font-weight: 700;
    }

    .chart-container {
        position: relative;
        min-height: 310px;
        padding: 20px 18px 16px;
    }

    .chart-container canvas {
        width: 100% !important;
        height: 270px !important;
    }

    .stock-overview {
        padding: 16px;
    }

    .stock-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 13px 14px;
        margin-bottom: 9px;
        border: 1px solid #eee5e9;
        border-radius: 12px;
        background: #fefcfd;
    }

    .stock-box:last-child {
        margin-bottom: 0;
    }

    .stock-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stock-indicator {
        width: 9px;
        height: 9px;
        flex-shrink: 0;
        border-radius: 50%;
    }

    .indicator-safe {
        background: #77a886;
    }

    .indicator-low {
        background: #d2a152;
    }

    .indicator-out {
        background: #c66779;
    }

    .stock-label {
        display: block;
        margin-bottom: 2px;
        color: #735866;
        font-size: 8px;
        font-weight: 700;
    }

    .stock-note {
        display: block;
        color: #aa969f;
        font-size: 6px;
        line-height: 1.4;
    }

    .stock-number {
        color: #624353;
        font-size: 17px;
        font-weight: 800;
    }

    .stock-footer {
        padding: 0 16px 16px;
    }

    .stock-link {
        min-height: 35px;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e3d4db;
        border-radius: 9px;
        color: #8f4667;
        background: #fff;
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .stock-link:hover {
        border-color: #bc829b;
        background: #fff9fb;
    }

    /* =========================================================
       TABLES
    ========================================================= */

    .business-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 22px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        min-width: 530px;
        border-collapse: collapse;
    }

    .dashboard-table th {
        padding: 11px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8791;
        background: #fdfafb;
        font-size: 6px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .dashboard-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #f2e9ed;
        color: #725767;
        font-size: 7px;
        vertical-align: middle;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }

    .dashboard-table tbody tr:hover {
        background: #fffafb;
    }

    .rank-badge {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 7px;
        font-weight: 800;
    }

    .primary-text {
        display: block;
        margin-bottom: 3px;
        color: #624353;
        font-size: 8px;
        font-weight: 700;
    }

    .secondary-text {
        display: block;
        color: #aa969f;
        font-size: 6px;
    }

    .money-text {
        color: #684858;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       STOCK ATTENTION
    ========================================================= */

    .stock-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        font-size: 6px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-low {
        color: #946920;
        background: #fff4dc;
    }

    .status-out {
        color: #a04b5d;
        background: #fde9ed;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       RECENT TRANSACTIONS
    ========================================================= */

    .recent-section {
        margin-bottom: 22px;
    }

    .transaction-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        font-size: 6px;
        font-weight: 700;
    }

    .transaction-completed {
        color: #527b5d;
        background: #eaf5ed;
    }

    .transaction-cancelled {
        color: #a04b5d;
        background: #fde9ed;
    }

    .detail-link {
        color: #8f4667;
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
    }

    .detail-link:hover {
        text-decoration: underline;
    }

    /* =========================================================
    AI BUSINESS ASSISTANT
    ========================================================= */

    .dashboard-ai-card {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: auto minmax(0, 1fr) auto;
        align-items: center;
        gap: 18px;
        padding: 22px 24px;
        margin-bottom: 5px;
        border: 1px solid #eadce3;
        border-radius: 18px;
        background:
            radial-gradient(
                circle at 92% 10%,
                rgba(143, 70, 103, 0.07),
                transparent 28%
            ),
            linear-gradient(
                135deg,
                #ffffff 0%,
                #fdf8fa 55%,
                #faf0f4 100%
            );
        box-shadow: 0 8px 27px rgba(80, 46, 62, 0.055);
    }

    .dashboard-ai-decoration {
        position: absolute;
        width: 150px;
        height: 150px;
        right: -65px;
        top: -75px;
        border: 24px solid rgba(143, 70, 103, 0.035);
        border-radius: 50%;
        pointer-events: none;
    }

    .dashboard-ai-icon {
        position: relative;
        z-index: 2;
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 1px solid #ead6df;
        border-radius: 16px;
        color: #ffffff;
        background:
            linear-gradient(
                135deg,
                #744058,
                #a65377
            );
        box-shadow: 0 9px 22px rgba(115, 61, 86, 0.18);
        font-size: 20px;
    }

    .dashboard-ai-content {
        position: relative;
        z-index: 2;
        min-width: 0;
    }

    .dashboard-ai-label {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 6px;
        padding: 4px 8px;
        border: 1px solid #efdde5;
        border-radius: 20px;
        color: #8f4667;
        background: #fbf0f4;
        font-size: 6px;
        font-weight: 800;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .dashboard-ai-label-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #ad5c80;
    }

    .dashboard-ai-content h3 {
        margin: 0 0 6px;
        color: #5e3d4d;
        font-size: 13px;
    }

    .dashboard-ai-content p {
        max-width: 700px;
        margin: 0;
        color: #927b86;
        font-size: 7px;
        line-height: 1.75;
    }

    .dashboard-ai-features {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .dashboard-ai-feature {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border: 1px solid #eee0e6;
        border-radius: 7px;
        color: #7f6572;
        background: rgba(255, 255, 255, 0.75);
        font-size: 6px;
        font-weight: 700;
    }

    .dashboard-ai-feature::before {
        content: "✓";
        color: #9c5575;
        font-weight: 800;
    }

    .dashboard-ai-action {
        position: relative;
        z-index: 2;
        min-width: 125px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 6px;
    }

    .dashboard-ai-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 10px;
        border: 1px solid #ead8e0;
        border-radius: 9px;
        color: #7c4b62;
        background: #ffffff;
        font-size: 7px;
        font-weight: 700;
        white-space: nowrap;
    }

    .dashboard-ai-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #c38aa3;
    }

    .dashboard-ai-note {
        color: #ad98a2;
        font-size: 6px;
        text-align: right;
    }

    .dashboard-ai-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 34px;
        padding: 0 12px;
        border: 1px solid #8f4667;
        border-radius: 9px;
        color: #ffffff;
        background: linear-gradient(
            135deg,
            #744058,
            #a65377
        );
        box-shadow: 0 6px 15px rgba(115, 61, 86, 0.14);
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .dashboard-ai-button:hover {
        transform: translateY(-1px);
        color: #ffffff;
        background: linear-gradient(
            135deg,
            #65364d,
            #914564
        );
        box-shadow: 0 9px 18px rgba(115, 61, 86, 0.20);
    }

    .dashboard-ai-button span {
        font-size: 12px;
        line-height: 1;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 35px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        border-radius: 13px;
        color: #9a6780;
        background: #faedf2;
        font-size: 16px;
    }

    .empty-state h4 {
        margin: 0 0 5px;
        color: #674958;
        font-size: 9px;
    }

    .empty-state p {
        max-width: 310px;
        margin: 0 auto;
        color: #a08c95;
        font-size: 7px;
        line-height: 1.7;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .analytics-grid,
        .business-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .dashboard-ai-card {
            grid-template-columns: 1fr;
            align-items: flex-start;
        }

        .dashboard-ai-button {
            width: 100%;
        }

        .dashboard-ai-status {
            width: 100%;
            justify-content: center;
        }

        .dashboard-ai-note {
            width: 100%;
            text-align: center;
        }

        .dashboard-ai-icon {
            width: 48px;
            height: 48px;
        }

        .dashboard-ai-action {
            width: 100%;
            align-items: flex-start;
        }

        .dashboard-ai-note {
            text-align: left;
        }

        .hero-summary {
            width: 100%;
            min-width: 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .section-heading {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="dashboard-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="dashboard-hero">

        <div class="hero-content">

            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Business Overview
            </div>

            <h1>
                Selamat datang, {{ auth()->user()->name }}!
            </h1>

            <p>
                Pantau aktivitas penjualan, kondisi persediaan,
                pelanggan, dan performa produk IntanMitha Collection
                melalui satu dashboard bisnis yang terintegrasi.
            </p>

        </div>


        <div class="hero-summary">

            <span class="hero-summary-label">
                Penjualan Hari Ini
            </span>

            <strong class="hero-summary-value">
                Rp{{ number_format(
                    (float) $todaySales,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="hero-summary-note">
                {{ number_format(
                    $todayTransactions,
                    0,
                    ',',
                    '.'
                ) }}
                transaksi berhasil hari ini
            </span>

        </div>

    </section>


    {{-- =====================================================
         RINGKASAN BISNIS
    ====================================================== --}}
    <div class="section-heading">

        <div>
            <h2>Ringkasan Bisnis</h2>

            <p>
                Data utama bisnis berdasarkan transaksi
                dan data yang tersimpan di InoMitha.
            </p>
        </div>

        <a
            href="{{ route('reports.index') }}"
            class="section-link"
        >
            Lihat Laporan Lengkap
        </a>

    </div>


    <div class="stats-grid">

        {{-- TOTAL PENJUALAN --}}
        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    Rp
                </div>

                <span class="stat-tag">
                    Revenue
                </span>

            </div>

            <strong class="stat-value">
                Rp{{ number_format(
                    (float) $totalSales,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="stat-label">
                Total penjualan dari seluruh transaksi selesai.
            </span>

        </article>


        {{-- TOTAL TRANSAKSI --}}
        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    #
                </div>

                <span class="stat-tag">
                    Transaction
                </span>

            </div>

            <strong class="stat-value">
                {{ number_format(
                    $totalTransactions,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="stat-label">
                Total transaksi penjualan yang berhasil.
            </span>

        </article>


        {{-- TOTAL PELANGGAN --}}
        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    ♙
                </div>

                <span class="stat-tag">
                    Customer
                </span>

            </div>

            <strong class="stat-value">
                {{ number_format(
                    $totalCustomers,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="stat-label">
                Pelanggan yang telah terdaftar di sistem.
            </span>

        </article>


        {{-- PRODUK AKTIF --}}
        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    ◇
                </div>

                <span class="stat-tag">
                    Product
                </span>

            </div>

            <strong class="stat-value">
                {{ number_format(
                    $activeProducts,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="stat-label">
                Produk yang saat ini berstatus aktif.
            </span>

        </article>

    </div>


    {{-- =====================================================
         GRAFIK + KONDISI STOK
    ====================================================== --}}
    <div class="analytics-grid">

        {{-- GRAFIK --}}
        <section class="dashboard-card">

                <div class="card-header">

                    <div>
                        <h3>Tren Penjualan</h3>

                        <p>
                            Pendapatan dari transaksi selesai
                            selama 6 bulan terakhir.
                        </p>
                    </div>

                    <span class="card-badge">
                        6 Bulan
                    </span>

                </div>

            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>

        </section>


        {{-- STOCK OVERVIEW --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>
                    <h3>Kondisi Persediaan</h3>

                    <p>
                        Status stok seluruh produk aktif.
                    </p>
                </div>

                <span class="card-badge">
                    Live Stock
                </span>

            </div>


            <div class="stock-overview">

                {{-- AMAN --}}
                <div class="stock-box">

                    <div class="stock-left">

                        <span
                            class="stock-indicator indicator-safe"
                        ></span>

                        <div>
                            <span class="stock-label">
                                Stok Aman
                            </span>

                            <span class="stock-note">
                                Di atas stok minimum
                            </span>
                        </div>

                    </div>

                    <strong class="stock-number">
                        {{ $safeStockCount }}
                    </strong>

                </div>


                {{-- MENIPIS --}}
                <div class="stock-box">

                    <div class="stock-left">

                        <span
                            class="stock-indicator indicator-low"
                        ></span>

                        <div>
                            <span class="stock-label">
                                Stok Menipis
                            </span>

                            <span class="stock-note">
                                Masih tersedia, perlu perhatian
                            </span>
                        </div>

                    </div>

                    <strong class="stock-number">
                        {{ $lowStockCount }}
                    </strong>

                </div>


                {{-- HABIS --}}
                <div class="stock-box">

                    <div class="stock-left">

                        <span
                            class="stock-indicator indicator-out"
                        ></span>

                        <div>
                            <span class="stock-label">
                                Stok Habis
                            </span>

                            <span class="stock-note">
                                Stok produk sama dengan nol
                            </span>
                        </div>

                    </div>

                    <strong class="stock-number">
                        {{ $outOfStockCount }}
                    </strong>

                </div>

            </div>


            <div class="stock-footer">

                <a
                    href="{{ route('inventory.index') }}"
                    class="stock-link"
                >
                    Kelola Persediaan
                </a>

            </div>

        </section>

    </div>


    {{-- =====================================================
         PRODUK TERLARIS + STOK PERLU PERHATIAN
    ====================================================== --}}
    <div class="business-grid">

        {{-- PRODUK TERLARIS --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>
                    <h3>Produk Terlaris</h3>

                    <p>
                        Produk dengan jumlah penjualan tertinggi.
                    </p>
                </div>

                <span class="card-badge">
                    Top 5
                </span>

            </div>


            @if ($bestSellingProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="dashboard-table">

                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Produk</th>
                                <th>Terjual</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($bestSellingProducts as $index => $item)

                                <tr>

                                    <td>
                                        <span class="rank-badge">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    <td>

                                        <span class="primary-text">
                                            {{ $item->product?->name ?? 'Produk Tidak Tersedia' }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $item->product?->category?->name ?? '-' }}
                                        </span>

                                    </td>

                                    <td>
                                        <strong>
                                            {{ number_format(
                                                $item->total_quantity,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>
                                        item
                                    </td>

                                    <td>
                                        <span class="money-text">
                                            Rp{{ number_format(
                                                (float) $item->total_revenue,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ◇
                    </div>

                    <h4>Belum Ada Produk Terlaris</h4>

                    <p>
                        Data akan muncul setelah terdapat
                        transaksi penjualan yang berhasil.
                    </p>

                </div>

            @endif

        </section>


        {{-- STOK PERLU PERHATIAN --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>
                    <h3>Stok Perlu Perhatian</h3>

                    <p>
                        Produk dengan stok menipis atau habis.
                    </p>
                </div>

                <span class="card-badge">
                    Maks. 5
                </span>

            </div>


            @if ($stockAttentionProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="dashboard-table">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Minimum</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($stockAttentionProducts as $product)

                                <tr>

                                    <td>

                                        <span class="primary-text">
                                            {{ $product->name }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $product->category?->name ?? '-' }}
                                            ·
                                            {{ $product->product_code }}
                                        </span>

                                    </td>

                                    <td>
                                        <strong>
                                            {{ $product->stock }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $product->minimum_stock }}
                                    </td>

                                    <td>

                                        @if ($product->stock == 0)

                                            <span class="stock-status status-out">

                                                <span class="status-dot"></span>

                                                Stok Habis

                                            </span>

                                        @else

                                            <span class="stock-status status-low">

                                                <span class="status-dot"></span>

                                                Stok Menipis

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h4>Semua Stok Aman</h4>

                    <p>
                        Tidak ada produk aktif dengan stok
                        menipis maupun stok habis.
                    </p>

                </div>

            @endif

        </section>

    </div>


    {{-- =====================================================
         TRANSAKSI TERBARU
    ====================================================== --}}
    <section class="recent-section">

        <div class="section-heading">

            <div>
                <h2>Transaksi Terbaru</h2>

                <p>
                    Aktivitas transaksi penjualan terbaru
                    yang tersimpan di InoMitha.
                </p>
            </div>

            <a
                href="{{ route('sales.index') }}"
                class="section-link"
            >
                Lihat Semua Transaksi
            </a>

        </div>


        <section class="dashboard-card">

            @if ($recentSales->isNotEmpty())

                <div class="table-wrapper">

                    <table class="dashboard-table">

                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Item</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($recentSales as $sale)

                                <tr>

                                    <td>
                                        <span class="primary-text">
                                            {{ $sale->invoice_number }}
                                        </span>
                                    </td>

                                    <td>

                                        <span class="primary-text">
                                            {{ $sale->sale_date->format('d M Y') }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $sale->sale_date->format('H:i') }} WIB
                                        </span>

                                    </td>

                                    <td>

                                        <span class="primary-text">
                                            {{ $sale->customer?->name ?? 'Pelanggan Umum' }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $sale->customer?->customer_code ?? 'Non-Member' }}
                                        </span>

                                    </td>

                                    <td>
                                        {{ $sale->items_count }}
                                        jenis
                                    </td>

                                    <td>

                                        <span class="money-text">
                                            Rp{{ number_format(
                                                (float) $sale->total_amount,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>

                                    </td>

                                    <td>

                                        @if ($sale->status === 'completed')

                                            <span
                                                class="transaction-status transaction-completed"
                                            >
                                                <span class="status-dot"></span>
                                                Selesai
                                            </span>

                                        @else

                                            <span
                                                class="transaction-status transaction-cancelled"
                                            >
                                                <span class="status-dot"></span>
                                                Dibatalkan
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('sales.show', $sale) }}"
                                            class="detail-link"
                                        >
                                            Lihat Detail
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ▤
                    </div>

                    <h4>Belum Ada Transaksi</h4>

                    <p>
                        Transaksi terbaru akan muncul setelah
                        terdapat transaksi penjualan.
                    </p>

                </div>

            @endif

        </section>

    </section>


    {{-- =====================================================
        AI BUSINESS ASSISTANT
    ====================================================== --}}
    <section class="dashboard-ai-card">

        <div class="dashboard-ai-decoration"></div>


        <div class="dashboard-ai-icon">
            ✦
        </div>


        <div class="dashboard-ai-content">

            <span class="dashboard-ai-label">

                <span class="dashboard-ai-label-dot"></span>

                Artificial Intelligence

            </span>


            <h3>
                AI Business Assistant
            </h3>


            <p>
                Asisten bisnis cerdas InoMitha yang dirancang untuk
                membantu membaca kondisi bisnis dan memberikan
                rekomendasi berdasarkan data IntanMitha Collection.
            </p>


            <div class="dashboard-ai-features">

                <span class="dashboard-ai-feature">
                    Analisis Penjualan
                </span>

                <span class="dashboard-ai-feature">
                    Ide Promosi
                </span>

                <span class="dashboard-ai-feature">
                    Rekomendasi Stok
                </span>

            </div>

        </div>

        <div class="dashboard-ai-action">

            <span class="dashboard-ai-status">

                <span class="dashboard-ai-status-dot"></span>

                Gemini AI Aktif

            </span>

            <a
                href="{{ route('ai.index') }}"
                class="dashboard-ai-button"
            >
                Buka AI Assistant
                <span>›</span>
            </a>

            <span class="dashboard-ai-note">
                Powered by Gemini AI
            </span>

        </div>

    </section>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const chartElement = document.getElementById('salesChart');

        if (!chartElement) {
            return;
        }

        const chartLabels = @json($chartLabels);
        const chartSales = @json($chartSales);
        const chartTransactions = @json($chartTransactions);

        const context = chartElement.getContext('2d');

        const gradient = context.createLinearGradient(
            0,
            0,
            0,
            270
        );

        gradient.addColorStop(
            0,
            'rgba(143, 70, 103, 0.25)'
        );

        gradient.addColorStop(
            1,
            'rgba(143, 70, 103, 0.01)'
        );


        new Chart(context, {

            type: 'line',

            data: {

                labels: chartLabels,

                datasets: [
                    {
                        label: 'Penjualan',

                        data: chartSales,

                        borderColor: '#8f4667',

                        backgroundColor: gradient,

                        fill: true,

                        borderWidth: 2,

                        pointRadius: 3,

                        pointHoverRadius: 5,

                        pointBackgroundColor: '#8f4667',

                        pointBorderColor: '#ffffff',

                        pointBorderWidth: 2,

                        tension: 0.38
                    }
                ]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        backgroundColor: '#604050',

                        titleColor: '#ffffff',

                        bodyColor: '#ffffff',

                        padding: 10,

                        displayColors: false,

                        callbacks: {

                            label: function (context) {

                                const value =
                                    Number(context.raw || 0);

                                const transactionCount =
                                    chartTransactions[
                                        context.dataIndex
                                    ] ?? 0;

                                return [
                                    'Penjualan: Rp' +
                                    value.toLocaleString('id-ID'),

                                    'Transaksi: ' +
                                    transactionCount
                                ];
                            }

                        }

                    }

                },

                scales: {

                    x: {

                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#a08b95',
                            font: {
                                size: 9
                            }
                        }

                    },

                    y: {

                        beginAtZero: true,

                        border: {
                            display: false
                        },

                        grid: {
                            color: 'rgba(143, 70, 103, 0.07)'
                        },

                        ticks: {

                            color: '#a08b95',

                            font: {
                                size: 9
                            },

                            callback: function (value) {

                                if (value >= 1000000) {
                                    return 'Rp' +
                                        (value / 1000000) +
                                        ' jt';
                                }

                                if (value >= 1000) {
                                    return 'Rp' +
                                        (value / 1000) +
                                        ' rb';
                                }

                                return 'Rp' + value;
                            }

                        }

                    }

                }

            }

        });

    });
</script>

@endpush