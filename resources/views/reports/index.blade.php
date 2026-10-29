@extends('layouts.app')

@section('title', 'Laporan | InoMitha')
@section('page-title', 'Laporan')
@section('page-subtitle', 'Ringkasan dan analisis bisnis IntanMitha Collection')

@push('styles')
<style>
    .report-page {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .report-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 30px 32px;
        margin-bottom: 20px;
        border-radius: 22px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 10%,
                rgba(255,255,255,.15),
                transparent 24%
            ),
            linear-gradient(
                135deg,
                #553044 0%,
                #7d405c 50%,
                #b45c80 100%
            );
        box-shadow: 0 17px 40px rgba(89,48,68,.15);
    }

    .report-hero::before {
        content: "";
        position: absolute;
        width: 185px;
        height: 185px;
        right: 90px;
        top: -125px;
        border: 30px solid rgba(255,255,255,.05);
        border-radius: 50%;
    }

    .report-hero::after {
        content: "";
        position: absolute;
        width: 140px;
        height: 140px;
        right: -35px;
        bottom: -75px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
    }

    .hero-content,
    .hero-actions {
        position: relative;
        z-index: 2;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        padding: 6px 10px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 30px;
        background: rgba(255,255,255,.08);
        font-size: 7px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .hero-eyebrow-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f5dbe5;
    }

    .hero-content h1 {
        margin: 0 0 8px;
        font-size: 25px;
        line-height: 1.3;
    }

    .hero-content p {
        max-width: 650px;
        margin: 0;
        color: #f0dfe6;
        font-size: 9px;
        line-height: 1.75;
    }

    .hero-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }

    .hero-button {
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 10px;
        color: #fff;
        background: rgba(255,255,255,.11);
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .hero-button:hover {
        background: rgba(255,255,255,.19);
    }

    /* =========================================================
       FILTER
    ========================================================= */
    .filter-card {
        margin-bottom: 18px;
        padding: 18px 20px;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 6px 22px rgba(80,46,62,.035);
    }

    .filter-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 14px;
    }

    .filter-title h3 {
        margin: 0 0 4px;
        color: #624353;
        font-size: 11px;
    }

    .filter-title p {
        margin: 0;
        color: #a08c95;
        font-size: 7px;
    }

    .period-badge {
        padding: 6px 9px;
        border-radius: 20px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 7px;
        font-weight: 700;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 1fr 1fr auto auto;
        gap: 10px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        margin-bottom: 6px;
        color: #816b76;
        font-size: 7px;
        font-weight: 700;
    }

    .filter-control {
        width: 100%;
        min-height: 38px;
        padding: 0 11px;
        border: 1px solid #e3d7dd;
        border-radius: 9px;
        outline: none;
        color: #654b58;
        background: #fff;
        font-family: inherit;
        font-size: 8px;
        transition: .2s;
    }

    .filter-control:focus {
        border-color: #b97894;
        box-shadow: 0 0 0 3px rgba(185,120,148,.09);
    }

    .btn {
        min-height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 14px;
        border-radius: 9px;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .btn-primary {
        border: 1px solid #8f4667;
        color: #fff;
        background: #8f4667;
    }

    .btn-primary:hover {
        background: #743952;
    }

    .btn-secondary {
        border: 1px solid #e1d3da;
        color: #765d69;
        background: #fff;
    }

    .btn-secondary:hover {
        border-color: #c899ad;
        color: #8f4667;
    }

    /* =========================================================
       STATISTICS
    ========================================================= */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 13px;
        margin-bottom: 18px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        padding: 18px;
        border: 1px solid #eee2e7;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 7px 24px rgba(80,46,62,.04);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        right: -27px;
        bottom: -32px;
        border-radius: 50%;
        background: #faf0f4;
    }

    .stat-top {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 13px;
    }

    .stat-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #faedf2;
        font-size: 13px;
        font-weight: 700;
    }

    .stat-tag {
        color: #af98a3;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
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
       SECTION HEADER
    ========================================================= */
    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
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

    /* =========================================================
       COMMON CARD
    ========================================================= */
    .report-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(80,46,62,.04);
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

    .card-tag {
        flex-shrink: 0;
        padding: 5px 8px;
        border-radius: 20px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 7px;
        font-weight: 700;
    }

    /* =========================================================
       BUSINESS INSIGHTS
    ========================================================= */
    .insight-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 22px;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .table-wrapper {
        overflow-x: auto;
    }

    .report-table {
        width: 100%;
        min-width: 620px;
        border-collapse: collapse;
    }

    .report-table th {
        padding: 11px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8791;
        background: #fdfafb;
        font-size: 7px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .report-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #f2e9ed;
        color: #725767;
        font-size: 8px;
        vertical-align: middle;
    }

    .report-table tbody tr:last-child td {
        border-bottom: none;
    }

    .report-table tbody tr:hover {
        background: #fffafb;
    }

    .rank-badge {
        width: 25px;
        height: 25px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 8px;
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
        font-size: 7px;
    }

    .money-text {
        color: #684858;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       STOCK SECTION
    ========================================================= */
    .stock-section {
        margin-bottom: 22px;
    }

    .stock-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 11px;
        margin-bottom: 15px;
    }

    .stock-summary {
        padding: 15px;
        border: 1px solid #eee2e7;
        border-radius: 13px;
        background: #fff;
    }

    .stock-summary-label {
        display: block;
        margin-bottom: 7px;
        color: #9e8993;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .stock-summary-value {
        display: block;
        margin-bottom: 4px;
        color: #624353;
        font-size: 17px;
        font-weight: 800;
    }

    .stock-summary-note {
        color: #ac98a1;
        font-size: 7px;
        line-height: 1.4;
    }

    .stock-safe {
        border-top: 3px solid #80ad8e;
    }

    .stock-low {
        border-top: 3px solid #d4a75e;
    }

    .stock-out {
        border-top: 3px solid #c66d7e;
    }

    .stock-total {
        border-top: 3px solid #9d6680;
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

    .status-low {
        color: #9a6d26;
        background: #fff5df;
    }

    .status-out {
        color: #a04c5e;
        background: #fde9ed;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       RECENT SALES
    ========================================================= */
    .recent-section {
        margin-bottom: 20px;
    }

    .status-completed {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        color: #527b5d;
        background: #eaf5ed;
        font-size: 7px;
        font-weight: 700;
    }

    .detail-link {
        color: #8f4667;
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
    }

    .detail-link:hover {
        text-decoration: underline;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */
    .empty-state {
        padding: 35px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        border-radius: 13px;
        color: #9a6780;
        background: #faedf2;
        font-size: 17px;
    }

    .empty-state h4 {
        margin: 0 0 5px;
        color: #674958;
        font-size: 10px;
    }

    .empty-state p {
        max-width: 330px;
        margin: 0 auto;
        color: #a08c95;
        font-size: 7px;
        line-height: 1.7;
    }

    /* =========================================================
       FOOT NOTE
    ========================================================= */
    .report-footnote {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 13px 15px;
        border: 1px solid #eadde3;
        border-radius: 12px;
        color: #8e7581;
        background: #fdf9fb;
        font-size: 7px;
        line-height: 1.7;
    }

    .footnote-icon {
        width: 24px;
        height: 24px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #8f4667;
        background: #f5e5eb;
        font-weight: 800;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 1050px) {
        .stats-grid,
        .stock-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .insight-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .report-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 24px 21px;
        }

        .hero-actions {
            width: 100%;
        }

        .hero-button {
            flex: 1;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .stats-grid,
        .stock-summary-grid {
            grid-template-columns: 1fr;
        }

        .filter-top,
        .section-heading {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    /* =========================================================
       PRINT
    ========================================================= */
    @media print {
        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        body {
            background: #fff !important;
        }

        .sidebar,
        .topbar,
        .filter-card,
        .hero-actions,
        .report-footnote {
            display: none !important;
        }

        .main-content,
        .content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        .report-page {
            max-width: none;
        }

        .report-hero {
            padding: 18px;
            margin-bottom: 14px;
            color: #000;
            background: #fff !important;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        .report-hero::before,
        .report-hero::after {
            display: none;
        }

        .hero-eyebrow,
        .hero-content p {
            color: #555;
        }

        .stats-grid,
        .stock-summary-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .stat-card,
        .report-card,
        .stock-summary {
            box-shadow: none;
            break-inside: avoid;
        }

        .insight-grid {
            grid-template-columns: 1fr 1fr;
        }

        .report-table th,
        .report-table td {
            padding: 7px;
        }
    }
</style>
@endpush


@section('content')

<div class="report-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="report-hero">

        <div class="hero-content">

            <div class="hero-eyebrow">
                <span class="hero-eyebrow-dot"></span>
                Business Report
            </div>

            <h1>
                Laporan IntanMitha Collection
            </h1>

            <p>
                Pantau performa penjualan, produk terlaris,
                pelanggan utama, dan kondisi persediaan
                dalam satu laporan bisnis yang terintegrasi.
            </p>

        </div>

        <div class="hero-actions">

            <button
                type="button"
                class="hero-button"
                onclick="window.print()"
            >
                Cetak Laporan
            </button>

        </div>

    </section>


    {{-- =====================================================
         FILTER PERIODE
    ====================================================== --}}
    <section class="filter-card">

        <div class="filter-top">

            <div class="filter-title">

                <h3>
                    Filter Periode Laporan
                </h3>

                <p>
                    Pilih rentang tanggal untuk melihat laporan
                    penjualan pada periode tertentu.
                </p>

            </div>

            <span class="period-badge">
                @if ($dateFrom && $dateTo)

                    {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}

                @elseif ($dateFrom)

                    Mulai
                    {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}

                @elseif ($dateTo)

                    Sampai
                    {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}

                @else

                    Semua Periode

                @endif
            </span>

        </div>


        <form
            action="{{ route('reports.index') }}"
            method="GET"
            class="filter-form"
        >

            <div class="filter-group">

                <label for="date_from">
                    Tanggal Mulai
                </label>

                <input
                    type="date"
                    name="date_from"
                    id="date_from"
                    class="filter-control"
                    value="{{ $dateFrom }}"
                >

            </div>


            <div class="filter-group">

                <label for="date_to">
                    Tanggal Akhir
                </label>

                <input
                    type="date"
                    name="date_to"
                    id="date_to"
                    class="filter-control"
                    value="{{ $dateTo }}"
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Terapkan Filter
            </button>


            <a
                href="{{ route('reports.index') }}"
                class="btn btn-secondary"
            >
                Reset
            </a>

        </form>

    </section>


    {{-- =====================================================
         STATISTIK PENJUALAN
    ====================================================== --}}
    <div class="stats-grid">

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
                Total penjualan berhasil pada periode laporan.
            </span>

        </article>


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
                {{ number_format($totalTransactions, 0, ',', '.') }}
            </strong>

            <span class="stat-label">
                Jumlah transaksi dengan status selesai.
            </span>

        </article>


        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    Ø
                </div>

                <span class="stat-tag">
                    Average
                </span>

            </div>

            <strong class="stat-value">
                Rp{{ number_format(
                    (float) $averageTransaction,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="stat-label">
                Rata-rata nilai dari setiap transaksi berhasil.
            </span>

        </article>


        <article class="stat-card">

            <div class="stat-top">

                <div class="stat-icon">
                    ×
                </div>

                <span class="stat-tag">
                    Item Sold
                </span>

            </div>

            <strong class="stat-value">
                {{ number_format($totalItemsSold, 0, ',', '.') }}
            </strong>

            <span class="stat-label">
                Total unit produk yang berhasil terjual.
            </span>

        </article>

    </div>


    {{-- =====================================================
         BUSINESS PERFORMANCE
    ====================================================== --}}
    <div class="section-heading">

        <div>

            <h2>
                Performa Bisnis
            </h2>

            <p>
                Ringkasan produk dan pelanggan dengan performa
                terbaik berdasarkan transaksi yang berhasil.
            </p>

        </div>

    </div>


    <div class="insight-grid">

        {{-- PRODUK TERLARIS --}}
        <section class="report-card">

            <div class="card-header">

                <div>

                    <h3>
                        Produk Terlaris
                    </h3>

                    <p>
                        Lima produk dengan jumlah penjualan tertinggi.
                    </p>

                </div>

                <span class="card-tag">
                    Top 5
                </span>

            </div>


            @if ($bestSellingProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="report-table">

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
                                            ·
                                            {{ $item->product?->product_code ?? '-' }}
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

                    <h4>
                        Belum Ada Data Penjualan
                    </h4>

                    <p>
                        Produk terlaris akan muncul setelah terdapat
                        transaksi penjualan yang berhasil pada periode ini.
                    </p>

                </div>

            @endif

        </section>


        {{-- PELANGGAN TERATAS --}}
        <section class="report-card">

            <div class="card-header">

                <div>

                    <h3>
                        Pelanggan Teratas
                    </h3>

                    <p>
                        Pelanggan dengan total pembelian terbesar.
                    </p>

                </div>

                <span class="card-tag">
                    Top 5
                </span>

            </div>


            @if ($topCustomers->isNotEmpty())

                <div class="table-wrapper">

                    <table class="report-table">

                        <thead>

                            <tr>
                                <th>Rank</th>
                                <th>Pelanggan</th>
                                <th>Transaksi</th>
                                <th>Total Belanja</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($topCustomers as $index => $customer)

                                <tr>

                                    <td>
                                        <span class="rank-badge">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>


                                    <td>

                                        <span class="primary-text">
                                            {{ $customer->name }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $customer->customer_code }}
                                        </span>

                                    </td>


                                    <td>
                                        <strong>
                                            {{ number_format(
                                                $customer->completed_transactions_count,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </strong>
                                    </td>


                                    <td>
                                        <span class="money-text">
                                            Rp{{ number_format(
                                                (float) ($customer->completed_sales_total ?? 0),
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
                        ♙
                    </div>

                    <h4>
                        Belum Ada Pelanggan Teratas
                    </h4>

                    <p>
                        Data pelanggan akan muncul setelah pelanggan
                        terdaftar melakukan transaksi yang berhasil.
                    </p>

                </div>

            @endif

        </section>

    </div>


    {{-- =====================================================
         PERSEDIAAN
    ====================================================== --}}
    <section class="stock-section">

        <div class="section-heading">

            <div>

                <h2>
                    Kondisi Persediaan
                </h2>

                <p>
                    Kondisi stok produk aktif IntanMitha Collection
                    berdasarkan persediaan saat ini.
                </p>

            </div>

        </div>


        <div class="stock-summary-grid">

            <article class="stock-summary stock-total">

                <span class="stock-summary-label">
                    Produk Aktif
                </span>

                <strong class="stock-summary-value">
                    {{ number_format($totalProducts, 0, ',', '.') }}
                </strong>

                <span class="stock-summary-note">
                    Total produk aktif yang dikelola.
                </span>

            </article>


            <article class="stock-summary stock-safe">

                <span class="stock-summary-label">
                    Stok Aman
                </span>

                <strong class="stock-summary-value">
                    {{ number_format($safeStockProducts, 0, ',', '.') }}
                </strong>

                <span class="stock-summary-note">
                    Stok berada di atas batas minimum.
                </span>

            </article>


            <article class="stock-summary stock-low">

                <span class="stock-summary-label">
                    Stok Menipis
                </span>

                <strong class="stock-summary-value">
                    {{ number_format($lowStockProducts, 0, ',', '.') }}
                </strong>

                <span class="stock-summary-note">
                    Stok masih tersedia tetapi perlu diperhatikan.
                </span>

            </article>


            <article class="stock-summary stock-out">

                <span class="stock-summary-label">
                    Stok Habis
                </span>

                <strong class="stock-summary-value">
                    {{ number_format($outOfStockProducts, 0, ',', '.') }}
                </strong>

                <span class="stock-summary-note">
                    Produk dengan jumlah stok sama dengan nol.
                </span>

            </article>

        </div>


        <section class="report-card">

            <div class="card-header">

                <div>

                    <h3>
                        Produk yang Perlu Perhatian
                    </h3>

                    <p>
                        Produk dengan stok menipis atau stok habis.
                    </p>

                </div>

                <span class="card-tag">
                    Maks. 10 Produk
                </span>

            </div>


            @if ($stockAttentionProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="report-table">

                        <thead>

                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Stok Saat Ini</th>
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
                                            {{ $product->product_code }}
                                        </span>

                                    </td>


                                    <td>
                                        {{ $product->category?->name ?? '-' }}
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

                    <h4>
                        Kondisi Stok Aman
                    </h4>

                    <p>
                        Saat ini tidak ada produk aktif dengan
                        stok menipis maupun stok habis.
                    </p>

                </div>

            @endif

        </section>

    </section>


    {{-- =====================================================
         TRANSAKSI TERBARU
    ====================================================== --}}
    <section class="recent-section">

        <div class="section-heading">

            <div>

                <h2>
                    Transaksi Terbaru
                </h2>

                <p>
                    Lima transaksi berhasil terbaru
                    pada periode laporan yang dipilih.
                </p>

            </div>

        </div>


        <section class="report-card">

            @if ($recentSales->isNotEmpty())

                <div class="table-wrapper">

                    <table class="report-table">

                        <thead>

                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
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

                                        <span class="status-completed">
                                            <span class="status-dot"></span>
                                            Selesai
                                        </span>

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

                    <h4>
                        Tidak Ada Transaksi
                    </h4>

                    <p>
                        Belum terdapat transaksi penjualan berhasil
                        pada periode laporan yang dipilih.
                    </p>

                </div>

            @endif

        </section>

    </section>


    {{-- =====================================================
         CATATAN
    ====================================================== --}}
    <div class="report-footnote">

        <div class="footnote-icon">
            i
        </div>

        <div>
            Data penjualan dalam laporan hanya menghitung transaksi
            dengan status <strong>Selesai</strong>. Transaksi yang telah
            dibatalkan tetap tersimpan pada riwayat transaksi, tetapi
            tidak dimasukkan ke total penjualan, jumlah transaksi,
            produk terlaris, maupun pelanggan teratas. Kondisi
            persediaan menunjukkan stok aktual saat laporan dibuka.
        </div>

    </div>

</div>

@endsection