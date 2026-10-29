@extends('layouts.app')

@section('title', 'Riwayat Persediaan | InoMitha')
@section('page-title', 'Riwayat Persediaan')
@section('page-subtitle', 'Pantau seluruh pergerakan stok IntanMitha Collection')

@push('styles')
<style>
    .history-page {
        width: 100%;
        max-width: 1220px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */
    .history-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .history-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        text-decoration: none;
    }

    .history-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */
    .history-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 28px;
        min-height: 195px;
        padding: 33px 36px;
        margin-bottom: 22px;
        border-radius: 24px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 12%,
                rgba(255,255,255,.16),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #563044 0%,
                #7e3f5c 50%,
                #b65d80 100%
            );
        box-shadow: 0 18px 43px rgba(89,48,68,.16);
    }

    .history-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        top: -145px;
        right: 135px;
        border: 34px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .history-hero::after {
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

    .hero-dot {
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
        max-width: 620px;
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
        min-height: 41px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .hero-btn.secondary {
        border: 1px solid rgba(255,255,255,.22);
        color: #fff;
        background: rgba(255,255,255,.10);
    }

    .hero-btn.primary {
        border: 1px solid #fff;
        color: #753e58;
        background: #fff;
    }

    .hero-btn:hover {
        transform: translateY(-1px);
    }

    /* =========================================================
       INFORMATION CARDS
    ========================================================= */
    .history-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 22px;
    }

    .summary-card {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 90px;
        padding: 17px;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 7px 24px rgba(80,46,62,.045);
    }

    .summary-icon {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 17px;
        font-weight: 700;
    }

    .summary-icon.in {
        color: #557b60;
        background: #edf7f0;
    }

    .summary-icon.out {
        color: #a34f61;
        background: #fcecef;
    }

    .summary-icon.all {
        color: #8f4667;
        background: #f8e9ef;
    }

    .summary-content strong {
        display: block;
        margin-bottom: 4px;
        color: #604050;
        font-size: 11px;
    }

    .summary-content span {
        color: #9d8792;
        font-size: 8px;
        line-height: 1.6;
    }

    /* =========================================================
       PANEL
    ========================================================= */
    .history-panel {
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
        font-family: inherit;
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
        font-family: inherit;
        font-size: 9px;
        font-weight: 700;
        text-decoration: none;
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

    .history-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .history-table th {
        padding: 12px 15px;
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
        padding: 15px;
        border-bottom: 1px solid #f3eaee;
        color: #684858;
        font-size: 9px;
        vertical-align: middle;
    }

    .history-table tbody tr {
        transition: .15s;
    }

    .history-table tbody tr:hover {
        background: #fefafb;
    }

    .history-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* PRODUCT */
    .product-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .product-avatar {
        width: 36px;
        height: 36px;
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
        font-size: 9px;
        font-weight: 700;
    }

    .product-code {
        color: #a38e98;
        font-size: 8px;
    }

    /* TYPE */
    .movement-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
    }

    .movement-badge.in {
        color: #4e7459;
        background: #eaf5ed;
    }

    .movement-badge.out {
        color: #a34f61;
        background: #fcecef;
    }

    .movement-badge.adjustment {
        color: #99643e;
        background: #fbf1e9;
    }

    .movement-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* QUANTITY */
    .quantity {
        font-size: 11px;
        font-weight: 700;
    }

    .quantity.in {
        color: #52765d;
    }

    .quantity.out {
        color: #a34f61;
    }

    .quantity.adjustment {
        color: #99643e;
    }

    /* SOURCE */
    .source-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 8px;
        border-radius: 8px;
        color: #765669;
        background: #f7eff3;
        font-size: 8px;
        font-weight: 700;
    }

    .source-badge.sale {
        color: #655280;
        background: #f0edf7;
    }

    /* NOTES */
    .notes-text {
        display: block;
        max-width: 260px;
        color: #806875;
        line-height: 1.6;
    }

    .notes-empty {
        color: #b7a6ae;
        font-style: italic;
    }

    /* USER */
    .user-cell strong {
        display: block;
        margin-bottom: 3px;
        color: #684858;
        font-size: 8px;
    }

    .user-cell span {
        color: #aa969f;
        font-size: 7px;
    }

    /* DATE */
    .date-cell strong {
        display: block;
        margin-bottom: 3px;
        color: #684858;
        font-size: 8px;
        white-space: nowrap;
    }

    .date-cell span {
        color: #aa969f;
        font-size: 7px;
        white-space: nowrap;
    }

    /* EMPTY */
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

    .source-cancel {
        color: #9a4f65;
        background: #fbe8ee;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .history-hero {
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

    @media (max-width: 750px) {
        .history-summary {
            grid-template-columns: 1fr;
        }

        .history-hero {
            padding: 27px 23px;
        }

        .hero-actions {
            width: 100%;
        }

        .hero-btn {
            flex: 1;
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

<div class="history-page">

    {{-- BREADCRUMB --}}
    <div class="history-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('inventory.index') }}">
            Persediaan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Riwayat Persediaan</span>

    </div>


    {{-- HERO --}}
    <section class="history-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Inventory History
            </div>

            <h1>Riwayat Pergerakan Stok</h1>

            <p>
                Lihat seluruh aktivitas stok masuk dan stok keluar
                IntanMitha Collection secara terpusat. Setiap perubahan
                tercatat bersama produk, jumlah, keterangan, pengguna,
                dan waktu aktivitas.
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


    {{-- INFORMATION --}}
    <section class="history-summary">

        <div class="summary-card">

            <div class="summary-icon in">
                +
            </div>

            <div class="summary-content">

                <strong>Stok Masuk</strong>

                <span>
                    Penambahan stok awal maupun restock produk.
                </span>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon out">
                −
            </div>

            <div class="summary-content">

                <strong>Stok Keluar</strong>

                <span>
                    Pengurangan stok manual maupun transaksi penjualan.
                </span>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon all">
                ↻
            </div>

            <div class="summary-content">

                <strong>Riwayat Terintegrasi</strong>

                <span>
                    Semua perubahan persediaan tercatat dalam satu tempat.
                </span>

            </div>

        </div>

    </section>


    {{-- PANEL --}}
    <section class="history-panel">

        <div class="panel-header">

            <div class="panel-title">

                <div class="panel-title-icon">
                    ↻
                </div>

                <div>

                    <h3>Aktivitas Persediaan</h3>

                    <p>
                        Riwayat pergerakan stok terbaru ditampilkan
                        terlebih dahulu.
                    </p>

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="filter-area">

            <form
                action="{{ route('inventory.history') }}"
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
                        placeholder="Cari kode, produk, atau keterangan..."
                    >

                </div>


                <select
                    name="type"
                    class="filter-control"
                >

                    <option value="">
                        Semua Pergerakan
                    </option>

                    <option
                        value="in"
                        {{ $type === 'in' ? 'selected' : '' }}
                    >
                        Stok Masuk
                    </option>

                    <option
                        value="out"
                        {{ $type === 'out' ? 'selected' : '' }}
                    >
                        Stok Keluar
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
                        href="{{ route('inventory.history') }}"
                        class="filter-btn reset"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        @if ($movements->count() > 0)

            <div class="table-wrapper">

                <table class="history-table">

                    <thead>

                        <tr>
                            <th>Produk</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Sumber</th>
                            <th>Keterangan</th>
                            <th>Pengguna</th>
                            <th>Waktu</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($movements as $movement)

                            <tr>

                                {{-- PRODUCT --}}
                                <td>

                                    <div class="product-cell">

                                        <div class="product-avatar">
                                            {{ strtoupper(
                                                substr(
                                                    $movement->product->name,
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </div>


                                        <div>

                                            <span class="product-name">
                                                {{ $movement->product->name }}
                                            </span>

                                            <span class="product-code">
                                                {{ $movement->product->product_code }}

                                                @if ($movement->product->category)
                                                    •
                                                    {{ $movement->product->category->name }}
                                                @endif
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- MOVEMENT TYPE --}}
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


                                {{-- QUANTITY --}}
                                <td>

                                    @if ($movement->movement_type === 'in')

                                        <span class="quantity in">
                                            +{{ number_format($movement->quantity) }}
                                        </span>

                                    @elseif ($movement->movement_type === 'out')

                                        <span class="quantity out">
                                            -{{ number_format($movement->quantity) }}
                                        </span>

                                    @else

                                        <span class="quantity adjustment">
                                            {{ number_format($movement->quantity) }}
                                        </span>

                                    @endif

                                    <span style="
                                        color:#a18b96;
                                        font-size:7px;
                                    ">
                                        unit
                                    </span>

                                </td>


                                {{-- SOURCE --}}
                                <td>

                                    @if (
                                        $movement->sale_id &&
                                        $movement->movement_type === 'in' &&
                                        str_contains(
                                            strtolower($movement->notes ?? ''),
                                            'pembatalan'
                                        )
                                    )

                                        <span class="source-badge source-cancel">
                                            Pembatalan Penjualan
                                        </span>

                                    @elseif ($movement->sale_id)

                                        <span class="source-badge source-sale">
                                            Penjualan
                                        </span>

                                    @else

                                        <span class="source-badge source-manual">
                                            Persediaan
                                        </span>

                                    @endif

                                </td>


                                {{-- NOTES --}}
                                <td>

                                    @if ($movement->notes)

                                        <span class="notes-text">
                                            {{ $movement->notes }}
                                        </span>

                                    @elseif ($movement->sale)

                                        <span class="notes-text">
                                            Penjualan
                                            {{ $movement->sale->invoice_number }}
                                        </span>

                                    @else

                                        <span class="notes-empty">
                                            Tidak ada keterangan
                                        </span>

                                    @endif

                                </td>


                                {{-- USER --}}
                                <td>

                                    <div class="user-cell">

                                        <strong>
                                            {{ $movement->user->name ?? 'Sistem' }}
                                        </strong>

                                        <span>
                                            {{ $movement->user
                                                ? 'Pengguna InoMitha'
                                                : 'Proses Sistem' }}
                                        </span>

                                    </div>

                                </td>


                                {{-- DATE --}}
                                <td>

                                    <div class="date-cell">

                                        <strong>
                                            {{ $movement->created_at
                                                ->format('d/m/Y') }}
                                        </strong>

                                        <span>
                                            {{ $movement->created_at
                                                ->format('H:i') }}
                                            WIB
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($movements->hasPages())

                <div class="pagination-area">

                    <div class="pagination-info">

                        Menampilkan
                        {{ $movements->firstItem() }}
                        sampai
                        {{ $movements->lastItem() }}
                        dari
                        {{ $movements->total() }}
                        aktivitas

                    </div>


                    <div class="pagination-buttons">

                        @if ($movements->onFirstPage())

                            <span class="page-link-custom disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $movements->previousPageUrl() }}"
                                class="page-link-custom"
                            >
                                ‹
                            </a>

                        @endif


                        @foreach (
                            range(1, $movements->lastPage())
                            as $page
                        )

                            @if (
                                $page == 1 ||
                                $page == $movements->lastPage() ||
                                abs(
                                    $page - $movements->currentPage()
                                ) <= 1
                            )

                                <a
                                    href="{{ $movements->url($page) }}"
                                    class="page-link-custom
                                    {{ $page == $movements->currentPage()
                                        ? 'active'
                                        : '' }}"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        @if ($movements->hasMorePages())

                            <a
                                href="{{ $movements->nextPageUrl() }}"
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
                    ↻
                </div>

                <h4>Belum Ada Riwayat Ditemukan</h4>

                <p>
                    Belum ada aktivitas persediaan atau tidak ada
                    data yang sesuai dengan pencarian dan filter
                    yang dipilih.
                </p>

            </div>

        @endif

    </section>

</div>

@endsection