@extends('layouts.app')

@section('title', 'Transaksi Penjualan | InoMitha')
@section('page-title', 'Transaksi Penjualan')
@section('page-subtitle', 'Kelola seluruh transaksi penjualan IntanMitha Collection')

@push('styles')
<style>
    .sales-page {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */
    .sales-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .sales-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        text-decoration: none;
    }

    .sales-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .sales-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 28px;
        min-height: 200px;
        padding: 34px 36px;
        margin-bottom: 22px;
        border-radius: 24px;
        color: #fff;
        background:
            radial-gradient(
                circle at 87% 13%,
                rgba(255,255,255,.17),
                transparent 24%
            ),
            linear-gradient(
                135deg,
                #553044 0%,
                #7f3f5c 50%,
                #b85f82 100%
            );
        box-shadow: 0 18px 43px rgba(89,48,68,.16);
    }

    .sales-hero::before {
        content: "";
        position: absolute;
        width: 225px;
        height: 225px;
        top: -150px;
        right: 145px;
        border: 34px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .sales-hero::after {
        content: "";
        position: absolute;
        width: 175px;
        height: 175px;
        right: -50px;
        bottom: -95px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .hero-content,
    .hero-action {
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
        background: #f7d5e1;
        box-shadow: 0 0 0 4px rgba(247,213,225,.12);
    }

    .hero-content h1 {
        margin-bottom: 9px;
        font-size: 28px;
    }

    .hero-content p {
        max-width: 620px;
        color: #f2e0e8;
        font-size: 10px;
        line-height: 1.8;
    }

    .btn-new-sale {
        min-height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 17px;
        border: 1px solid rgba(255,255,255,.7);
        border-radius: 11px;
        color: #743d57;
        background: #fff;
        box-shadow: 0 8px 20px rgba(58,25,42,.12);
        font-size: 9px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-new-sale:hover {
        transform: translateY(-2px);
        box-shadow: 0 11px 24px rgba(58,25,42,.17);
    }

    .btn-plus {
        width: 23px;
        height: 23px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        color: #fff;
        background: #8f4667;
        font-size: 14px;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */
    .sales-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 22px;
    }

    .summary-card {
        position: relative;
        overflow: hidden;
        min-height: 115px;
        padding: 18px;
        border: 1px solid #eee2e7;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 8px 26px rgba(80,46,62,.045);
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 70px;
        height: 70px;
        top: -30px;
        right: -25px;
        border-radius: 50%;
        background: #faf1f5;
    }

    .summary-top {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 13px;
    }

    .summary-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
    }

    .summary-icon.sales {
        color: #8f4667;
        background: #f8e9ef;
    }

    .summary-icon.transaction {
        color: #66517f;
        background: #f0edf7;
    }

    .summary-icon.today {
        color: #557b60;
        background: #edf7f0;
    }

    .summary-icon.today-transaction {
        color: #9b6c42;
        background: #fbf2e8;
    }

    .summary-label {
        color: #9c8791;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .summary-value {
        position: relative;
        z-index: 2;
        display: block;
        margin-bottom: 5px;
        color: #59394a;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.2;
    }

    .summary-note {
        position: relative;
        z-index: 2;
        color: #aa969f;
        font-size: 8px;
    }

    /* =========================================================
       PANEL
    ========================================================= */
    .sales-panel {
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
        width: 40px;
        height: 40px;
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
        margin-bottom: 4px;
        color: #5f3e4f;
        font-size: 13px;
    }

    .panel-title p {
        color: #a18c96;
        font-size: 8px;
    }

    /* =========================================================
       FILTER
    ========================================================= */
    .filter-area {
        padding: 17px 22px;
        border-bottom: 1px solid #f1e8ec;
        background: #fefcfd;
    }

    .filter-form {
        display: grid;
        grid-template-columns:
            minmax(220px, 1fr)
            145px
            145px
            145px
            auto;
        gap: 8px;
        align-items: center;
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
        padding: 0 11px;
        border: 1px solid #e8dce1;
        border-radius: 9px;
        outline: none;
        color: #674858;
        background: #fff;
        font-family: inherit;
        font-size: 8px;
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
        gap: 6px;
    }

    .filter-btn {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 12px;
        border-radius: 9px;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .filter-btn.apply {
        border: 1px solid #8f4667;
        color: #fff;
        background: #8f4667;
    }

    .filter-btn.reset {
        border: 1px solid #e5d8de;
        color: #806575;
        background: #fff;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .table-wrapper {
        overflow-x: auto;
    }

    .sales-table {
        width: 100%;
        min-width: 1030px;
        border-collapse: collapse;
    }

    .sales-table th {
        padding: 12px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8590;
        background: #fdfafb;
        font-size: 8px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .sales-table td {
        padding: 15px 14px;
        border-bottom: 1px solid #f3eaee;
        color: #684858;
        font-size: 9px;
        vertical-align: middle;
    }

    .sales-table tbody tr {
        transition: .15s;
    }

    .sales-table tbody tr:hover {
        background: #fefafb;
    }

    .sales-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* INVOICE */
    .invoice-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .invoice-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 13px;
        font-weight: 700;
    }

    .invoice-number {
        display: block;
        margin-bottom: 3px;
        color: #604050;
        font-size: 9px;
        font-weight: 700;
    }

    .invoice-time {
        color: #a48f99;
        font-size: 7px;
    }

    /* CUSTOMER */
    .customer-name {
        display: block;
        margin-bottom: 3px;
        color: #674657;
        font-size: 9px;
        font-weight: 700;
    }

    .customer-code {
        color: #aa969f;
        font-size: 7px;
    }

    .general-customer {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        border-radius: 7px;
        color: #816b76;
        background: #f6f1f3;
        font-size: 8px;
        font-weight: 600;
    }

    /* ITEMS */
    .items-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 31px;
        height: 27px;
        padding: 0 8px;
        border-radius: 8px;
        color: #76566a;
        background: #f7eff3;
        font-size: 8px;
        font-weight: 700;
    }

    /* TOTAL */
    .total-value {
        color: #653f52;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .status-badge.completed {
        color: #4f765a;
        background: #eaf5ed;
    }

    .status-badge.cancelled {
        color: #a34f61;
        background: #fcecef;
    }

    .status-badge.other {
        color: #93663f;
        background: #fbf1e7;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* USER */
    .user-name {
        display: block;
        margin-bottom: 3px;
        color: #6c4b5b;
        font-size: 8px;
        font-weight: 700;
    }

    .user-role {
        color: #aa969f;
        font-size: 7px;
    }

    /* DETAIL BUTTON */
    .btn-detail {
        min-height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 10px;
        border: 1px solid #e2d2da;
        border-radius: 8px;
        color: #80566b;
        background: #fff;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .btn-detail:hover {
        border-color: #c789a1;
        color: #fff;
        background: #8f4667;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 62px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border-radius: 18px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 22px;
    }

    .empty-state h4 {
        margin-bottom: 7px;
        color: #604050;
        font-size: 12px;
    }

    .empty-state p {
        max-width: 450px;
        margin: 0 auto 15px;
        color: #9e8993;
        font-size: 9px;
        line-height: 1.7;
    }

    .empty-add-btn {
        min-height: 37px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 13px;
        border-radius: 9px;
        color: #fff;
        background: #8f4667;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
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
        flex-wrap: wrap;
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
        text-decoration: none;
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
    @media (max-width: 1100px) {
        .sales-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .search-wrapper {
            grid-column: 1 / -1;
        }

        .filter-actions {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 700px) {
        .sales-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .hero-action,
        .btn-new-sale {
            width: 100%;
        }

        .sales-summary {
            grid-template-columns: 1fr;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .search-wrapper,
        .filter-actions {
            grid-column: auto;
        }

        .filter-actions {
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

<div class="sales-page">

    {{-- BREADCRUMB --}}
    <div class="sales-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Transaksi Penjualan</span>

    </div>


    {{-- HERO --}}
    <section class="sales-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Sales Management
            </div>

            <h1>Transaksi Penjualan</h1>

            <p>
                Kelola transaksi penjualan IntanMitha Collection
                secara terintegrasi dengan data pelanggan, produk,
                dan persediaan. Setiap transaksi yang berhasil akan
                memperbarui stok produk secara otomatis.
            </p>

        </div>


        <div class="hero-action">

            <a
                href="{{ route('sales.create') }}"
                class="btn-new-sale"
            >
                <span class="btn-plus">+</span>
                Transaksi Baru
            </a>

        </div>

    </section>


    {{-- SUMMARY --}}
    <section class="sales-summary">

        {{-- TOTAL SALES --}}
        <div class="summary-card">

            <div class="summary-top">

                <div class="summary-icon sales">
                    Rp
                </div>

                <span class="summary-label">
                    Total Penjualan
                </span>

            </div>

            <strong class="summary-value">
                Rp{{ number_format(
                    $totalSales,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="summary-note">
                Dari seluruh transaksi selesai
            </span>

        </div>


        {{-- TOTAL TRANSACTION --}}
        <div class="summary-card">

            <div class="summary-top">

                <div class="summary-icon transaction">
                    #
                </div>

                <span class="summary-label">
                    Total Transaksi
                </span>

            </div>

            <strong class="summary-value">
                {{ number_format($totalTransactions) }}
            </strong>

            <span class="summary-note">
                Transaksi berhasil diselesaikan
            </span>

        </div>


        {{-- TODAY SALES --}}
        <div class="summary-card">

            <div class="summary-top">

                <div class="summary-icon today">
                    Rp
                </div>

                <span class="summary-label">
                    Penjualan Hari Ini
                </span>

            </div>

            <strong class="summary-value">
                Rp{{ number_format(
                    $todaySales,
                    0,
                    ',',
                    '.'
                ) }}
            </strong>

            <span class="summary-note">
                Pendapatan transaksi hari ini
            </span>

        </div>


        {{-- TODAY TRANSACTION --}}
        <div class="summary-card">

            <div class="summary-top">

                <div class="summary-icon today-transaction">
                    ✓
                </div>

                <span class="summary-label">
                    Transaksi Hari Ini
                </span>

            </div>

            <strong class="summary-value">
                {{ number_format($todayTransactions) }}
            </strong>

            <span class="summary-note">
                Transaksi selesai hari ini
            </span>

        </div>

    </section>


    {{-- SALES PANEL --}}
    <section class="sales-panel">

        <div class="panel-header">

            <div class="panel-title">

                <div class="panel-title-icon">
                    ≡
                </div>

                <div>

                    <h3>Daftar Transaksi</h3>

                    <p>
                        Transaksi terbaru ditampilkan terlebih dahulu.
                    </p>

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="filter-area">

            <form
                action="{{ route('sales.index') }}"
                method="GET"
                class="filter-form"
            >

                {{-- SEARCH --}}
                <div class="search-wrapper">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="filter-control"
                        placeholder="Cari invoice, pelanggan, atau kasir..."
                    >

                </div>


                {{-- STATUS --}}
                <select
                    name="status"
                    class="filter-control"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="completed"
                        {{ $status === 'completed'
                            ? 'selected'
                            : '' }}
                    >
                        Selesai
                    </option>

                    <option
                        value="cancelled"
                        {{ $status === 'cancelled'
                            ? 'selected'
                            : '' }}
                    >
                        Dibatalkan
                    </option>

                </select>


                {{-- DATE FROM --}}
                <input
                    type="date"
                    name="date_from"
                    value="{{ $dateFrom }}"
                    class="filter-control"
                    title="Tanggal mulai"
                >


                {{-- DATE TO --}}
                <input
                    type="date"
                    name="date_to"
                    value="{{ $dateTo }}"
                    class="filter-control"
                    title="Tanggal akhir"
                >


                <div class="filter-actions">

                    <button
                        type="submit"
                        class="filter-btn apply"
                    >
                        Terapkan
                    </button>

                    <a
                        href="{{ route('sales.index') }}"
                        class="filter-btn reset"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        {{-- TABLE --}}
        @if ($sales->count() > 0)

            <div class="table-wrapper">

                <table class="sales-table">

                    <thead>

                        <tr>
                            <th>Invoice</th>
                            <th>Pelanggan</th>
                            <th>Item</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($sales as $sale)

                            <tr>

                                {{-- INVOICE --}}
                                <td>

                                    <div class="invoice-cell">

                                        <div class="invoice-icon">
                                            #
                                        </div>

                                        <div>

                                            <span class="invoice-number">
                                                {{ $sale->invoice_number }}
                                            </span>

                                            <span class="invoice-time">
                                                {{ $sale->sale_date
                                                    ->format('d/m/Y H:i') }}
                                                WIB
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- CUSTOMER --}}
                                <td>

                                    @if ($sale->customer)

                                        <span class="customer-name">
                                            {{ $sale->customer->name }}
                                        </span>

                                        <span class="customer-code">
                                            {{ $sale->customer->customer_code }}
                                        </span>

                                    @else

                                        <span class="general-customer">
                                            Pelanggan Umum
                                        </span>

                                    @endif

                                </td>


                                {{-- ITEMS --}}
                                <td>

                                    <span class="items-badge">
                                        {{ $sale->items_count }}
                                        item
                                    </span>

                                </td>


                                {{-- TOTAL --}}
                                <td>

                                    <span class="total-value">
                                        Rp{{ number_format(
                                            $sale->total_amount,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if ($sale->status === 'completed')

                                        <span class="status-badge completed">

                                            <span class="status-dot"></span>

                                            Selesai

                                        </span>

                                    @elseif ($sale->status === 'cancelled')

                                        <span class="status-badge cancelled">

                                            <span class="status-dot"></span>

                                            Dibatalkan

                                        </span>

                                    @else

                                        <span class="status-badge other">

                                            <span class="status-dot"></span>

                                            {{ ucfirst($sale->status) }}

                                        </span>

                                    @endif

                                </td>


                                {{-- CASHIER --}}
                                <td>

                                    <span class="user-name">
                                        {{ $sale->user->name ?? 'Sistem' }}
                                    </span>

                                    <span class="user-role">
                                        Pengguna InoMitha
                                    </span>

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <a
                                        href="{{ route(
                                            'sales.show',
                                            $sale
                                        ) }}"
                                        class="btn-detail"
                                    >
                                        Detail
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($sales->hasPages())

                <div class="pagination-area">

                    <div class="pagination-info">

                        Menampilkan
                        {{ $sales->firstItem() }}
                        sampai
                        {{ $sales->lastItem() }}
                        dari
                        {{ $sales->total() }}
                        transaksi

                    </div>


                    <div class="pagination-buttons">

                        {{-- PREVIOUS --}}
                        @if ($sales->onFirstPage())

                            <span class="page-link-custom disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $sales->previousPageUrl() }}"
                                class="page-link-custom"
                            >
                                ‹
                            </a>

                        @endif


                        {{-- PAGE NUMBER --}}
                        @foreach (
                            range(1, $sales->lastPage())
                            as $page
                        )

                            @if (
                                $page == 1 ||
                                $page == $sales->lastPage() ||
                                abs(
                                    $page -
                                    $sales->currentPage()
                                ) <= 1
                            )

                                <a
                                    href="{{ $sales->url($page) }}"
                                    class="page-link-custom
                                    {{ $page ==
                                        $sales->currentPage()
                                        ? 'active'
                                        : '' }}"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- NEXT --}}
                        @if ($sales->hasMorePages())

                            <a
                                href="{{ $sales->nextPageUrl() }}"
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

            {{-- EMPTY --}}
            <div class="empty-state">

                <div class="empty-icon">
                    ♢
                </div>

                <h4>
                    Belum Ada Transaksi
                </h4>

                <p>
                    Belum ada transaksi penjualan atau tidak ada
                    transaksi yang sesuai dengan pencarian dan
                    filter yang dipilih.
                </p>

                @if (
                    !$search &&
                    !$status &&
                    !$dateFrom &&
                    !$dateTo
                )

                    <a
                        href="{{ route('sales.create') }}"
                        class="empty-add-btn"
                    >
                        + Buat Transaksi Pertama
                    </a>

                @endif

            </div>

        @endif

    </section>

</div>

@endsection