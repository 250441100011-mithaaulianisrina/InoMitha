@extends('layouts.app')

@section('title', 'Detail Transaksi | InoMitha')
@section('page-title', 'Detail Transaksi')
@section('page-subtitle', 'Informasi lengkap transaksi penjualan IntanMitha Collection')

@push('styles')
<style>
    .sale-detail-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */
    .sale-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #a08a95;
        font-size: 9px;
    }

    .sale-breadcrumb a {
        color: #8f4667;
        font-weight: 700;
        text-decoration: none;
    }

    .sale-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #cbbdc4;
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
        padding: 29px 32px;
        margin-bottom: 20px;
        border-radius: 22px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255,255,255,.15),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #553044 0%,
                #7d405c 52%,
                #b45c80 100%
            );
        box-shadow: 0 17px 40px rgba(89,48,68,.15);
    }

    .detail-hero::before {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: 70px;
        top: -110px;
        border: 28px solid rgba(255,255,255,.05);
        border-radius: 50%;
    }

    .detail-hero::after {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        right: -35px;
        bottom: -70px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
    }

    .hero-content,
    .hero-status {
        position: relative;
        z-index: 2;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

    .hero-label-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f5dbe5;
    }

    .hero-content h1 {
        margin: 0 0 7px;
        font-size: 24px;
        line-height: 1.3;
    }

    .hero-content p {
        max-width: 620px;
        margin: 0;
        color: #f0dfe6;
        font-size: 9px;
        line-height: 1.7;
    }

    .hero-status {
        min-width: 165px;
        padding: 14px 16px;
        border: 1px solid rgba(255,255,255,.17);
        border-radius: 13px;
        background: rgba(255,255,255,.1);
        backdrop-filter: blur(6px);
    }

    .hero-status-label {
        display: block;
        margin-bottom: 7px;
        color: #ead7df;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
        transition: all .25s ease;
    }

    .status-completed {
        color: #dff6e5;
        background: rgba(78,143,98,.28);
    }

    .status-cancelled {
        color: #ffe1e6;
        background: rgba(184,72,96,.3);
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */
    .page-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .action-left,
    .action-right {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .btn {
        min-height: 37px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 13px;
        border-radius: 9px;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-secondary {
        border: 1px solid #e3d5dc;
        color: #735768;
        background: #fff;
    }

    .btn-secondary:hover {
        border-color: #c99bad;
        color: #8f4667;
    }

    .btn-primary {
        border: 1px solid #8f4667;
        color: #fff;
        background: #8f4667;
    }

    .btn-primary:hover {
        background: #743952;
    }

    .btn-danger {
        border: 1px solid #e5b7c1;
        color: #a6465d;
        background: #fff5f7;
    }

    .btn-danger:hover {
        border-color: #ad4e64;
        color: #fff;
        background: #ad4e64;
    }

    /* =========================================================
       CANCELLED NOTICE
    ========================================================= */
    .cancelled-notice {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #efccd4;
        border-radius: 13px;
        color: #844c5a;
        background: #fff4f6;
        animation: noticeIn .3s ease;
    }

    .cancelled-notice.hidden {
        display: none;
    }

    @keyframes noticeIn {
        from {
            opacity: 0;
            transform: translateY(-7px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .cancelled-notice-icon {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #a94c62;
        background: #f8dfe5;
        font-size: 11px;
        font-weight: 700;
    }

    .cancelled-notice strong {
        display: block;
        margin-bottom: 4px;
        font-size: 9px;
    }

    .cancelled-notice p {
        margin: 0;
        color: #a0707c;
        font-size: 8px;
        line-height: 1.6;
    }

    /* =========================================================
       INFO CARDS
    ========================================================= */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .info-card {
        min-width: 0;
        padding: 17px;
        border: 1px solid #eee2e7;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 6px 22px rgba(80,46,62,.035);
    }

    .info-card-label {
        display: block;
        margin-bottom: 7px;
        color: #a18b96;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .45px;
    }

    .info-card-value {
        display: block;
        overflow: hidden;
        color: #624353;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.5;
        text-overflow: ellipsis;
    }

    .info-card-sub {
        display: block;
        margin-top: 4px;
        color: #ad9aa3;
        font-size: 7px;
        line-height: 1.5;
    }

    /* =========================================================
       MAIN CONTENT
    ========================================================= */
    .detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 270px;
        gap: 18px;
        align-items: start;
    }

    .detail-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 7px 25px rgba(80,46,62,.04);
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 17px 19px;
        border-bottom: 1px solid #f0e6ea;
    }

    .detail-card-header h3 {
        margin: 0 0 3px;
        color: #604050;
        font-size: 11px;
    }

    .detail-card-header p {
        margin: 0;
        color: #a08c95;
        font-size: 7px;
    }

    .item-count {
        padding: 5px 8px;
        border-radius: 20px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 7px;
        font-weight: 700;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .table-wrapper {
        overflow-x: auto;
    }

    .detail-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .detail-table th {
        padding: 12px 15px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8791;
        background: #fdfafb;
        font-size: 7px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .detail-table td {
        padding: 14px 15px;
        border-bottom: 1px solid #f2e9ed;
        color: #725767;
        font-size: 8px;
        vertical-align: middle;
    }

    .detail-table tbody tr:last-child td {
        border-bottom: none;
    }

    .product-name {
        display: block;
        margin-bottom: 4px;
        color: #604050;
        font-size: 9px;
        font-weight: 700;
    }

    .product-code {
        display: block;
        color: #aa969f;
        font-size: 7px;
    }

    .category-badge {
        display: inline-flex;
        padding: 5px 7px;
        border-radius: 7px;
        color: #806174;
        background: #f7f1f4;
        font-size: 7px;
        font-weight: 600;
    }

    .qty-badge {
        display: inline-flex;
        min-width: 30px;
        justify-content: center;
        padding: 5px 7px;
        border-radius: 7px;
        color: #795267;
        background: #f9eaf0;
        font-size: 8px;
        font-weight: 700;
    }

    .money {
        color: #674758;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */
    .summary-card {
        position: sticky;
        top: 92px;
        overflow: hidden;
        border: 1px solid #e8dae1;
        border-radius: 17px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(80,46,62,.05);
    }

    .summary-header {
        padding: 18px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #684056,
            #99506e
        );
    }

    .summary-header span {
        display: block;
        margin-bottom: 4px;
        color: #ead9e1;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .45px;
    }

    .summary-header h3 {
        margin: 0;
        font-size: 12px;
    }

    .summary-body {
        padding: 17px 18px;
    }

    .summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 9px 0;
        border-bottom: 1px dashed #e9dde3;
    }

    .summary-row span {
        color: #9a858f;
        font-size: 8px;
    }

    .summary-row strong {
        color: #684858;
        font-size: 8px;
    }

    .grand-total {
        margin-top: 14px;
        padding: 14px;
        border-radius: 11px;
        background: #faf0f4;
    }

    .grand-total span {
        display: block;
        margin-bottom: 5px;
        color: #9b7486;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .grand-total strong {
        display: block;
        color: #713f57;
        font-size: 19px;
    }

    .summary-note {
        margin-top: 13px;
        color: #a18d96;
        font-size: 7px;
        line-height: 1.7;
    }

    /* =========================================================
       MODAL
    ========================================================= */
    .cancel-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(48, 29, 39, .58);
        backdrop-filter: blur(5px);
    }

    .cancel-modal-overlay.show {
        display: flex;
    }

    .cancel-modal {
        width: 100%;
        max-width: 420px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.5);
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 24px 70px rgba(40,20,30,.28);
        animation: modalIn .18s ease-out;
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .cancel-modal-top {
        padding: 24px 24px 18px;
        text-align: center;
    }

    .cancel-modal-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 13px;
        border-radius: 50%;
        color: #a7485f;
        background: #fbe8ed;
        font-size: 21px;
        font-weight: 700;
    }

    .cancel-modal-top h3 {
        margin: 0 0 8px;
        color: #624050;
        font-size: 15px;
    }

    .cancel-modal-top p {
        margin: 0;
        color: #927985;
        font-size: 8px;
        line-height: 1.8;
    }

    .cancel-invoice-box {
        margin: 0 24px 18px;
        padding: 12px 14px;
        border: 1px solid #eee0e6;
        border-radius: 11px;
        background: #fdf9fb;
        text-align: center;
    }

    .cancel-invoice-box span {
        display: block;
        margin-bottom: 4px;
        color: #a28b96;
        font-size: 7px;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .cancel-invoice-box strong {
        color: #74485d;
        font-size: 10px;
    }

    .cancel-warning {
        margin: 0 24px 20px;
        padding: 11px 12px;
        border-radius: 10px;
        color: #9b5667;
        background: #fff3f5;
        font-size: 7px;
        line-height: 1.7;
    }

    .cancel-modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
        padding: 16px 24px 22px;
        border-top: 1px solid #f0e5e9;
        background: #fdfafb;
    }

    .modal-btn {
        min-height: 41px;
        border-radius: 9px;
        font-family: inherit;
        font-size: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .modal-btn-back {
        border: 1px solid #ded0d7;
        color: #755b68;
        background: #fff;
    }

    .modal-btn-confirm {
        border: 1px solid #aa4c62;
        color: #fff;
        background: #aa4c62;
    }

    .modal-btn-confirm:hover {
        background: #913d52;
    }

    .modal-btn-confirm:disabled {
        opacity: .6;
        cursor: wait;
    }

    /* =========================================================
       TOAST
    ========================================================= */
    .inomitha-toast-container {
        position: fixed;
        top: 88px;
        right: 24px;
        z-index: 10050;
        width: min(355px, calc(100vw - 40px));
        pointer-events: none;
    }

    .inomitha-toast {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 14px 15px;
        border: 1px solid #d9e9de;
        border-radius: 13px;
        background: #fff;
        box-shadow: 0 15px 45px rgba(53,34,43,.16);
        opacity: 0;
        transform: translateX(25px);
        transition: opacity .25s ease, transform .25s ease;
        pointer-events: auto;
    }

    .inomitha-toast.show {
        opacity: 1;
        transform: translateX(0);
    }

    .inomitha-toast.error {
        border-color: #efccd4;
    }

    .toast-icon {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #4f8760;
        background: #e8f5ec;
        font-size: 10px;
        font-weight: 800;
    }

    .inomitha-toast.error .toast-icon {
        color: #a84d62;
        background: #fbe8ed;
    }

    .toast-content {
        flex: 1;
    }

    .toast-title {
        display: block;
        margin-bottom: 3px;
        color: #624353;
        font-size: 9px;
        font-weight: 700;
    }

    .toast-message {
        margin: 0;
        color: #927d87;
        font-size: 7px;
        line-height: 1.6;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 1000px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .detail-layout {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: static;
        }
    }

    @media (max-width: 650px) {
        .detail-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 24px 21px;
        }

        .hero-status {
            width: 100%;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .page-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .action-left,
        .action-right {
            width: 100%;
        }

        .btn {
            flex: 1;
        }

        .cancel-modal-actions {
            grid-template-columns: 1fr;
        }

        .inomitha-toast-container {
            top: 20px;
            right: 20px;
            left: 20px;
            width: auto;
        }
    }

    /* =========================================================
       PRINT
    ========================================================= */
    @media print {
        .sidebar,
        .topbar,
        .sale-breadcrumb,
        .page-actions,
        .cancel-modal-overlay,
        .inomitha-toast-container {
            display: none !important;
        }

        .sale-detail-page {
            max-width: none;
        }

        .detail-hero,
        .detail-card,
        .summary-card,
        .info-card {
            box-shadow: none;
        }

        .summary-card {
            position: static;
        }
    }
</style>
@endpush


@section('content')

<div class="sale-detail-page">

    {{-- BREADCRUMB --}}
    <div class="sale-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('sales.index') }}">
            Transaksi Penjualan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>
            {{ $sale->invoice_number }}
        </span>

    </div>


    {{-- HERO --}}
    <section class="detail-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-label-dot"></span>
                Sales Transaction
            </div>

            <h1>
                {{ $sale->invoice_number }}
            </h1>

            <p>
                Detail transaksi penjualan IntanMitha Collection
                beserta produk, pelanggan, kasir, dan total pembayaran.
            </p>

        </div>


        <div class="hero-status">

            <span class="hero-status-label">
                Status Transaksi
            </span>

            <span
                id="heroStatusBadge"
                class="status-badge
                    {{ $sale->status === 'completed'
                        ? 'status-completed'
                        : 'status-cancelled' }}"
            >
                <span class="status-dot"></span>

                <span id="heroStatusText">
                    {{ $sale->status === 'completed'
                        ? 'Selesai'
                        : 'Dibatalkan' }}
                </span>
            </span>

        </div>

    </section>


    {{-- NOTICE PEMBATALAN --}}
    <div
        id="cancelledNotice"
        class="cancelled-notice
            {{ $sale->status === 'cancelled' ? '' : 'hidden' }}"
    >

        <div class="cancelled-notice-icon">
            !
        </div>

        <div>

            <strong>
                Transaksi ini telah dibatalkan
            </strong>

            <p>
                Transaksi tetap disimpan sebagai riwayat,
                tetapi tidak lagi dihitung sebagai penjualan berhasil.
                Stok produk dari transaksi ini telah dikembalikan
                ke persediaan.
            </p>

        </div>

    </div>


    {{-- ACTIONS --}}
    <div class="page-actions">

        <div class="action-left">

            <a
                href="{{ route('sales.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('sales.create') }}"
                class="btn btn-primary"
            >
                + Transaksi Baru
            </a>

        </div>


        <div class="action-right">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="window.print()"
            >
                Cetak Transaksi
            </button>


            @if ($sale->status === 'completed')

                <button
                    type="button"
                    class="btn btn-danger"
                    id="openCancelModal"
                >
                    Batalkan Transaksi
                </button>

            @endif

        </div>

    </div>


    {{-- INFORMATION --}}
    <div class="info-grid">

        <div class="info-card">

            <span class="info-card-label">
                Tanggal Transaksi
            </span>

            <span class="info-card-value">
                {{ $sale->sale_date->format('d M Y') }}
            </span>

            <span class="info-card-sub">
                {{ $sale->sale_date->format('H:i') }} WIB
            </span>

        </div>


        <div class="info-card">

            <span class="info-card-label">
                Pelanggan
            </span>

            <span class="info-card-value">
                {{ $sale->customer?->name ?? 'Pelanggan Umum' }}
            </span>

            <span class="info-card-sub">
                {{ $sale->customer?->customer_code ?? 'Non-Member' }}
            </span>

        </div>


        <div class="info-card">

            <span class="info-card-label">
                Kasir
            </span>

            <span class="info-card-value">
                {{ $sale->user?->name ?? '-' }}
            </span>

            <span class="info-card-sub">
                Pengguna yang mencatat transaksi
            </span>

        </div>


        <div class="info-card">

            <span class="info-card-label">
                Jumlah Jenis Produk
            </span>

            <span class="info-card-value">
                {{ $sale->items->count() }} Produk
            </span>

            <span class="info-card-sub">
                {{ $sale->items->sum('quantity') }} total item
            </span>

        </div>

    </div>


    <div class="detail-layout">

        {{-- DETAIL PRODUK --}}
        <section class="detail-card">

            <div class="detail-card-header">

                <div>

                    <h3>
                        Detail Produk
                    </h3>

                    <p>
                        Daftar produk yang tercatat dalam transaksi.
                    </p>

                </div>

                <span class="item-count">
                    {{ $sale->items->count() }} Produk
                </span>

            </div>


            <div class="table-wrapper">

                <table class="detail-table">

                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($sale->items as $item)

                            <tr>

                                <td>

                                    <span class="product-name">
                                        {{ $item->product?->name ?? 'Produk Tidak Tersedia' }}
                                    </span>

                                    <span class="product-code">
                                        {{ $item->product?->product_code ?? '-' }}
                                    </span>

                                </td>


                                <td>

                                    <span class="category-badge">
                                        {{ $item->product?->category?->name ?? '-' }}
                                    </span>

                                </td>


                                <td>

                                    <span class="money">
                                        Rp{{ number_format(
                                            (float) $item->unit_price,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                <td>

                                    <span class="qty-badge">
                                        {{ $item->quantity }}
                                    </span>

                                </td>


                                <td>

                                    <span class="money">
                                        Rp{{ number_format(
                                            (float) $item->subtotal,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    style="
                                        text-align:center;
                                        padding:35px;
                                        color:#a08b95;
                                    "
                                >
                                    Tidak ada detail produk pada transaksi ini.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- SUMMARY --}}
        <aside class="summary-card">

            <div class="summary-header">

                <span>
                    Payment Summary
                </span>

                <h3>
                    Ringkasan Pembayaran
                </h3>

            </div>


            <div class="summary-body">

                <div class="summary-row">

                    <span>
                        Jenis Produk
                    </span>

                    <strong>
                        {{ $sale->items->count() }}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Total Item
                    </span>

                    <strong>
                        {{ $sale->items->sum('quantity') }}
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Status
                    </span>

                    <strong id="summaryStatusText">
                        {{ $sale->status === 'completed'
                            ? 'Selesai'
                            : 'Dibatalkan' }}
                    </strong>

                </div>


                <div class="grand-total">

                    <span>
                        Total Pembayaran
                    </span>

                    <strong>
                        Rp{{ number_format(
                            (float) $sale->total_amount,
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>


                <p
                    class="summary-note"
                    id="summaryNote"
                >
                    @if ($sale->status === 'completed')

                        Total pembayaran dihitung berdasarkan
                        harga produk yang tersimpan pada saat
                        transaksi dilakukan.

                    @else

                        Nilai transaksi tetap ditampilkan sebagai
                        riwayat, tetapi transaksi yang dibatalkan
                        tidak dihitung sebagai penjualan berhasil.

                    @endif
                </p>

            </div>

        </aside>

    </div>

</div>


{{-- =========================================================
     MODAL PEMBATALAN
========================================================= --}}
@if ($sale->status === 'completed')

    <div
        class="cancel-modal-overlay"
        id="cancelModal"
    >

        <div
            class="cancel-modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="cancelModalTitle"
        >

            <div class="cancel-modal-top">

                <div class="cancel-modal-icon">
                    !
                </div>

                <h3 id="cancelModalTitle">
                    Batalkan Transaksi?
                </h3>

                <p>
                    Pastikan transaksi memang perlu dibatalkan.
                    Tindakan ini akan mengubah status transaksi
                    dan mengembalikan seluruh stok produk yang
                    sebelumnya terjual.
                </p>

            </div>


            <div class="cancel-invoice-box">

                <span>
                    Invoice yang akan dibatalkan
                </span>

                <strong>
                    {{ $sale->invoice_number }}
                </strong>

            </div>


            <div class="cancel-warning">
                Stok setiap produk akan otomatis dikembalikan
                sesuai jumlah yang tercatat pada transaksi.
                Riwayat transaksi tetap disimpan.
            </div>


            <form
                action="{{ route('sales.cancel', $sale) }}"
                method="POST"
                id="cancelSaleForm"
            >

                @csrf
                @method('PATCH')


                <div class="cancel-modal-actions">

                    <button
                        type="button"
                        class="modal-btn modal-btn-back"
                        id="closeCancelModal"
                    >
                        Tidak, Kembali
                    </button>


                    <button
                        type="submit"
                        class="modal-btn modal-btn-confirm"
                        id="confirmCancelButton"
                    >
                        Ya, Batalkan Transaksi
                    </button>

                </div>

            </form>

        </div>

    </div>

@endif


{{-- TOAST --}}
<div
    class="inomitha-toast-container"
    id="toastContainer"
></div>

@endsection


@push('scripts')

@if ($sale->status === 'completed')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const cancelModal =
        document.getElementById('cancelModal');

    const openCancelModalButton =
        document.getElementById('openCancelModal');

    const closeCancelModalButton =
        document.getElementById('closeCancelModal');

    const cancelSaleForm =
        document.getElementById('cancelSaleForm');

    const confirmCancelButton =
        document.getElementById('confirmCancelButton');

    const heroStatusBadge =
        document.getElementById('heroStatusBadge');

    const heroStatusText =
        document.getElementById('heroStatusText');

    const summaryStatusText =
        document.getElementById('summaryStatusText');

    const summaryNote =
        document.getElementById('summaryNote');

    const cancelledNotice =
        document.getElementById('cancelledNotice');

    const toastContainer =
        document.getElementById('toastContainer');


    /*
    |--------------------------------------------------------------------------
    | Buka modal
    |--------------------------------------------------------------------------
    */
    function openCancelModal() {

        if (!cancelModal) {
            return;
        }

        cancelModal.classList.add('show');

        document.body.style.overflow =
            'hidden';
    }


    /*
    |--------------------------------------------------------------------------
    | Tutup modal
    |--------------------------------------------------------------------------
    */
    function closeCancelModal() {

        if (!cancelModal) {
            return;
        }

        cancelModal.classList.remove('show');

        document.body.style.overflow =
            '';
    }


    /*
    |--------------------------------------------------------------------------
    | Toast
    |--------------------------------------------------------------------------
    */
    function showToast(
        message,
        type = 'success'
    ) {

        toastContainer.innerHTML = '';

        const toast =
            document.createElement('div');

        toast.className =
            'inomitha-toast';

        if (type === 'error') {
            toast.classList.add('error');
        }

        const iconText =
            type === 'error'
                ? '!'
                : '✓';

        const titleText =
            type === 'error'
                ? 'Terjadi Kesalahan'
                : 'Berhasil';

        toast.innerHTML = `
            <div class="toast-icon">
                ${iconText}
            </div>

            <div class="toast-content">
                <span class="toast-title">
                    ${titleText}
                </span>

                <p class="toast-message"></p>
            </div>
        `;

        toast.querySelector(
            '.toast-message'
        ).textContent = message;

        toastContainer.appendChild(
            toast
        );

        requestAnimationFrame(
            function () {
                toast.classList.add(
                    'show'
                );
            }
        );

        setTimeout(
            function () {

                toast.classList.remove(
                    'show'
                );

                setTimeout(
                    function () {
                        toast.remove();
                    },
                    250
                );

            },
            4000
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Event buka modal
    |--------------------------------------------------------------------------
    */
    if (openCancelModalButton) {

        openCancelModalButton.addEventListener(
            'click',
            function () {
                openCancelModal();
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Event tutup modal
    |--------------------------------------------------------------------------
    */
    if (closeCancelModalButton) {

        closeCancelModalButton.addEventListener(
            'click',
            function () {
                closeCancelModal();
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Klik area luar modal
    |--------------------------------------------------------------------------
    */
    if (cancelModal) {

        cancelModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target ===
                    cancelModal
                ) {
                    closeCancelModal();
                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Escape untuk tutup modal
    |--------------------------------------------------------------------------
    */
    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                cancelModal &&
                cancelModal.classList.contains(
                    'show'
                )
            ) {
                closeCancelModal();
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Submit pembatalan dengan Fetch API
    |--------------------------------------------------------------------------
    */
    if (cancelSaleForm) {

        cancelSaleForm.addEventListener(
            'submit',
            async function (event) {

                /*
                |--------------------------------------------------------------------------
                | Cegah submit normal / reload halaman
                |--------------------------------------------------------------------------
                */
                event.preventDefault();


                /*
                |--------------------------------------------------------------------------
                | Loading state
                |--------------------------------------------------------------------------
                */
                confirmCancelButton.disabled =
                    true;

                closeCancelModalButton.disabled =
                    true;

                confirmCancelButton.textContent =
                    'Membatalkan...';


                try {

                    /*
                    |--------------------------------------------------------------------------
                    | Kirim request PATCH melalui FormData
                    |--------------------------------------------------------------------------
                    |
                    | Form sudah memiliki:
                    | - CSRF token
                    | - _method = PATCH
                    |
                    | Jadi request HTTP dikirim POST,
                    | kemudian Laravel membaca _method sebagai PATCH.
                    |--------------------------------------------------------------------------
                    */
                    const formData =
                        new FormData(
                            cancelSaleForm
                        );


                    const response =
                        await fetch(
                            cancelSaleForm.action,
                            {
                                method: 'POST',

                                headers: {
                                    'Accept':
                                        'application/json',

                                    'X-Requested-With':
                                        'XMLHttpRequest',
                                },

                                body:
                                    formData,
                            }
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | Ambil JSON dari backend
                    |--------------------------------------------------------------------------
                    */
                    const data =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | Jika server mengembalikan error
                    |--------------------------------------------------------------------------
                    */
                    if (!response.ok) {

                        throw new Error(
                            data.message ||
                            'Transaksi gagal dibatalkan.'
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Pastikan backend menyatakan berhasil
                    |--------------------------------------------------------------------------
                    */
                    if (!data.success) {

                        throw new Error(
                            data.message ||
                            'Transaksi gagal dibatalkan.'
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 1. Tutup modal
                    |--------------------------------------------------------------------------
                    */
                    closeCancelModal();


                    /*
                    |--------------------------------------------------------------------------
                    | 2. Ubah status hero
                    |--------------------------------------------------------------------------
                    */
                    heroStatusBadge.classList.remove(
                        'status-completed'
                    );

                    heroStatusBadge.classList.add(
                        'status-cancelled'
                    );

                    heroStatusText.textContent =
                        data.status_label ||
                        'Dibatalkan';


                    /*
                    |--------------------------------------------------------------------------
                    | 3. Ubah status ringkasan
                    |--------------------------------------------------------------------------
                    */
                    summaryStatusText.textContent =
                        'Dibatalkan';


                    /*
                    |--------------------------------------------------------------------------
                    | 4. Ubah keterangan ringkasan
                    |--------------------------------------------------------------------------
                    */
                    summaryNote.textContent =
                        'Nilai transaksi tetap ditampilkan sebagai riwayat, tetapi transaksi yang dibatalkan tidak dihitung sebagai penjualan berhasil.';


                    /*
                    |--------------------------------------------------------------------------
                    | 5. Tampilkan notice pembatalan
                    |--------------------------------------------------------------------------
                    */
                    cancelledNotice.classList.remove(
                        'hidden'
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | 6. Hilangkan tombol Batalkan Transaksi
                    |--------------------------------------------------------------------------
                    */
                    if (
                        openCancelModalButton
                    ) {
                        openCancelModalButton.remove();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 7. Hapus modal dari DOM
                    |--------------------------------------------------------------------------
                    |
                    | Karena transaksi sudah cancelled,
                    | modal tidak diperlukan lagi.
                    |--------------------------------------------------------------------------
                    */
                    if (cancelModal) {
                        cancelModal.remove();
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | 8. Tampilkan notifikasi berhasil
                    |--------------------------------------------------------------------------
                    */
                    showToast(
                        data.message ||
                        'Transaksi berhasil dibatalkan dan stok produk telah dikembalikan.',
                        'success'
                    );

                } catch (error) {

                    /*
                    |--------------------------------------------------------------------------
                    | Kalau gagal, modal tetap terbuka
                    |--------------------------------------------------------------------------
                    */
                    confirmCancelButton.disabled =
                        false;

                    closeCancelModalButton.disabled =
                        false;

                    confirmCancelButton.textContent =
                        'Ya, Batalkan Transaksi';


                    showToast(
                        error.message ||
                        'Terjadi kesalahan saat membatalkan transaksi.',
                        'error'
                    );

                }

            }
        );

    }

});
</script>

@endif

@endpush