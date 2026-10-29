@extends('layouts.app')

@section('title', 'Pelanggan | InoMitha')
@section('page-title', 'Pelanggan')
@section('page-subtitle', 'Kelola data dan hubungan pelanggan IntanMitha Collection')

@push('styles')
<style>
    /* =========================================================
       CUSTOMER CRM PAGE
    ========================================================= */

    .customer-page {
        width: 100%;
    }

    /* =========================================================
       PAGE HERO
    ========================================================= */

    .customer-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 185px;
        padding: 32px 35px;
        margin-bottom: 24px;
        border-radius: 23px;
        color: #ffffff;
        background:
            radial-gradient(
                circle at 90% 15%,
                rgba(255, 255, 255, 0.16),
                transparent 24%
            ),
            linear-gradient(
                135deg,
                #5d3449 0%,
                #84415f 52%,
                #b76083 100%
            );
        box-shadow: 0 17px 42px rgba(89, 48, 68, 0.16);
    }

    .customer-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -130px;
        right: 120px;
        border: 32px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .customer-hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: -50px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 670px;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 11px;
        margin-bottom: 14px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .hero-label-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .customer-hero h1 {
        margin-bottom: 9px;
        font-size: 27px;
        line-height: 1.3;
    }

    .customer-hero p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 12px;
        line-height: 1.8;
    }

    .hero-action {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }

    .btn-add-customer {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 44px;
        padding: 0 17px;
        border: 1px solid rgba(255, 255, 255, 0.20);
        border-radius: 11px;
        color: #6f3b53;
        background: #ffffff;
        box-shadow: 0 9px 24px rgba(64, 29, 46, 0.15);
        font-size: 11px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .btn-add-customer:hover {
        color: #6f3b53;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(64, 29, 46, 0.20);
    }

    .add-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        color: #ffffff;
        background: #8f4667;
        font-size: 16px;
        font-weight: 400;
    }

    /* =========================================================
       SUMMARY CARDS
    ========================================================= */

    .customer-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 22px;
    }

    .customer-summary-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px 19px;
        border: 1px solid #f0e4e9;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, 0.045);
    }

    .summary-icon {
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 18px;
    }

    .summary-content span {
        display: block;
        margin-bottom: 5px;
        color: #9c8791;
        font-size: 9px;
        font-weight: 600;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .summary-content h3 {
        color: #583748;
        font-size: 20px;
    }

    .summary-decoration {
        position: absolute;
        width: 70px;
        height: 70px;
        right: -30px;
        bottom: -35px;
        border-radius: 50%;
        background: #fbf2f5;
    }

    /* =========================================================
       MAIN PANEL
    ========================================================= */

    .customer-panel {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    .customer-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .panel-heading h3 {
        margin-bottom: 5px;
        color: #593749;
        font-size: 14px;
    }

    .panel-heading p {
        color: #a18b96;
        font-size: 10px;
    }

    /* =========================================================
       SEARCH
    ========================================================= */

    .search-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-box {
        position: relative;
        width: 280px;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #a78d99;
        font-size: 14px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        height: 39px;
        padding: 0 13px 0 37px;
        border: 1px solid #eadde3;
        border-radius: 10px;
        outline: none;
        color: #614252;
        background: #fefcfd;
        font-size: 10px;
        transition: 0.2s;
    }

    .search-input::placeholder {
        color: #b4a1aa;
    }

    .search-input:focus {
        border-color: #c9829e;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(143, 70, 103, 0.07);
    }

    .btn-search,
    .btn-reset {
        height: 39px;
        padding: 0 13px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-search {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: #8f4667;
    }

    .btn-search:hover {
        background: #773a56;
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eadde3;
        color: #8b6c7b;
        background: #ffffff;
    }

    .btn-reset:hover {
        color: #714257;
        background: #fbf4f7;
    }

    /* =========================================================
       SEARCH INFO
    ========================================================= */

    .search-result-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 23px;
        border-bottom: 1px solid #f3e9ed;
        color: #8f7884;
        background: #fdfafb;
        font-size: 10px;
    }

    .search-keyword {
        color: #81435f;
        font-weight: 700;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .customer-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .customer-table thead {
        background: #fdfafb;
    }

    .customer-table th {
        padding: 13px 16px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8590;
        font-size: 9px;
        font-weight: 700;
        text-align: left;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .customer-table td {
        padding: 15px 16px;
        border-bottom: 1px solid #f4ebef;
        color: #654655;
        font-size: 10px;
        vertical-align: middle;
    }

    .customer-table tbody tr {
        transition: background 0.18s ease;
    }

    .customer-table tbody tr:hover {
        background: #fefafb;
    }

    .customer-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================================================
       CUSTOMER IDENTITY
    ========================================================= */

    .customer-profile {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .customer-avatar {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #efdde5;
        border-radius: 11px;
        color: #8b4664;
        background:
            linear-gradient(
                145deg,
                #fceff4,
                #f7e3eb
            );
        font-size: 12px;
        font-weight: 700;
    }

    .customer-name {
        margin-bottom: 4px;
        color: #593849;
        font-size: 11px;
        font-weight: 700;
    }

    .customer-email {
        color: #a18b96;
        font-size: 9px;
    }

    .customer-code {
        display: inline-flex;
        align-items: center;
        padding: 5px 8px;
        border: 1px solid #eadce2;
        border-radius: 7px;
        color: #8a4a67;
        background: #fcf5f8;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .contact-main {
        margin-bottom: 3px;
        color: #644655;
        font-weight: 600;
    }

    .contact-secondary {
        max-width: 190px;
        overflow: hidden;
        color: #a28d97;
        font-size: 9px;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* =========================================================
       TRANSACTION BADGE
    ========================================================= */

    .transaction-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        color: #765164;
        background: #f8edf2;
        font-size: 9px;
        font-weight: 600;
    }

    .transaction-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #aa607e;
    }

    .transaction-badge.empty {
        color: #93838b;
        background: #f6f3f4;
    }

    .transaction-badge.empty .transaction-dot {
        background: #b7aab0;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .action-group {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .action-button {
        width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eadde3;
        border-radius: 8px;
        background: #ffffff;
        font-size: 12px;
        cursor: pointer;
        transition: 0.18s ease;
    }

    .action-view {
        color: #6b668f;
    }

    .action-view:hover {
        border-color: #dcd8ef;
        background: #f3f1fb;
    }

    .action-edit {
        color: #9a6942;
    }

    .action-edit:hover {
        border-color: #eedfcf;
        background: #fcf6ef;
    }

    .action-delete {
        color: #a34f61;
    }

    .action-delete:hover {
        border-color: #f0d8de;
        background: #fdf0f3;
    }

    .delete-form {
        display: inline-flex;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 58px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 67px;
        height: 67px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        border: 1px solid #f0dce5;
        border-radius: 20px;
        color: #9b5572;
        background: #f9ebf1;
        font-size: 27px;
    }

    .empty-state h3 {
        margin-bottom: 7px;
        color: #624152;
        font-size: 13px;
    }

    .empty-state p {
        max-width: 410px;
        margin: 0 auto 17px;
        color: #9e8993;
        font-size: 10px;
        line-height: 1.7;
    }

    .empty-add-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 14px;
        border-radius: 9px;
        color: #ffffff;
        background: #8f4667;
        font-size: 10px;
        font-weight: 700;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .pagination-area {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .pagination-info {
        color: #9b8590;
        font-size: 9px;
    }

    .pagination-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-button {
        min-width: 31px;
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 9px;
        border: 1px solid #eadde3;
        border-radius: 8px;
        color: #80586b;
        background: #ffffff;
        font-size: 9px;
        transition: 0.18s;
    }

    .page-button:hover {
        border-color: #c88ba3;
        color: #ffffff;
        background: #9b5471;
    }

    .page-button.active {
        border-color: #8f4667;
        color: #ffffff;
        background: #8f4667;
    }

    .page-button.disabled {
        color: #c1b5bb;
        background: #faf7f8;
        pointer-events: none;
    }

    /* =========================================================
       DELETE MODAL
    ========================================================= */

    .delete-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 3000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(49, 29, 39, 0.48);
        backdrop-filter: blur(5px);
    }

    .delete-modal-overlay.show {
        display: flex;
    }

    .delete-modal {
        width: 100%;
        max-width: 410px;
        padding: 27px;
        border: 1px solid #f0dfe6;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 24px 65px rgba(51, 29, 40, 0.22);
        animation: customerModalIn 0.2s ease;
    }

    @keyframes customerModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .delete-modal-icon {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 17px;
        border-radius: 16px;
        color: #a3485c;
        background: #fbecef;
        font-size: 21px;
    }

    .delete-modal h3 {
        margin-bottom: 8px;
        color: #5d3b4b;
        font-size: 16px;
    }

    .delete-modal p {
        color: #99828e;
        font-size: 10px;
        line-height: 1.7;
    }

    .delete-customer-name {
        color: #7d405c;
        font-weight: 700;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
    }

    .modal-cancel,
    .modal-delete {
        height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
    }

    .modal-cancel {
        border: 1px solid #e9dce2;
        color: #806676;
        background: #ffffff;
    }

    .modal-delete {
        border: 1px solid #9e455a;
        color: #ffffff;
        background: #9e455a;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {
        .customer-summary-grid {
            grid-template-columns: 1fr 1fr;
        }

        .customer-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .search-form {
            width: 100%;
        }

        .search-box {
            flex: 1;
            width: auto;
        }
    }

    @media (max-width: 700px) {
        .customer-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 24px;
        }

        .hero-action {
            width: 100%;
        }

        .btn-add-customer {
            width: 100%;
        }

        .customer-summary-grid {
            grid-template-columns: 1fr;
        }

        .search-form {
            align-items: stretch;
            flex-wrap: wrap;
        }

        .search-box {
            width: 100%;
            flex-basis: 100%;
        }

        .btn-search,
        .btn-reset {
            flex: 1;
        }

        .pagination-area {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="customer-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="customer-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-label-dot"></span>
                Customer Relationship Management
            </div>

            <h1>Kelola Pelanggan Lebih Terarah</h1>

            <p>
                Simpan informasi pelanggan dan pantau riwayat transaksi
                untuk membantu IntanMitha Collection memahami hubungan
                serta aktivitas setiap pelanggan.
            </p>

        </div>

        <div class="hero-action">

            <a
                href="{{ route('customers.create') }}"
                class="btn-add-customer"
            >
                <span class="add-icon">+</span>
                Tambah Pelanggan
            </a>

        </div>

    </section>


    {{-- =====================================================
         CUSTOMER SUMMARY
    ====================================================== --}}

    <section class="customer-summary-grid">

        <div class="customer-summary-card">

            <div class="summary-icon">
                ♙
            </div>

            <div class="summary-content">
                <span>Total Pelanggan</span>
                <h3>{{ number_format($totalCustomers) }}</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>


        <div class="customer-summary-card">

            <div class="summary-icon">
                ▤
            </div>

            <div class="summary-content">
                <span>Data Ditampilkan</span>
                <h3>{{ number_format($customers->count()) }}</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>


        <div class="customer-summary-card">

            <div class="summary-icon">
                ✦
            </div>

            <div class="summary-content">
                <span>Status CRM</span>
                <h3>Aktif</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>

    </section>


    {{-- =====================================================
         CUSTOMER TABLE PANEL
    ====================================================== --}}

    <section class="customer-panel">

        <div class="customer-panel-header">

            <div class="panel-heading">
                <h3>Daftar Pelanggan</h3>
                <p>
                    Kelola informasi dan riwayat pelanggan
                    IntanMitha Collection.
                </p>
            </div>


            {{-- SEARCH --}}

            <form
                action="{{ route('customers.index') }}"
                method="GET"
                class="search-form"
            >

                <div class="search-box">

                    <span class="search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="search-input"
                        value="{{ $search }}"
                        placeholder="Cari kode, nama, telepon, atau email..."
                        autocomplete="off"
                    >

                </div>

                <button
                    type="submit"
                    class="btn-search"
                >
                    Cari
                </button>

                @if ($search)
                    <a
                        href="{{ route('customers.index') }}"
                        class="btn-reset"
                    >
                        Reset
                    </a>
                @endif

            </form>

        </div>


        {{-- SEARCH RESULT INFORMATION --}}

        @if ($search)

            <div class="search-result-info">

                <span>
                    Hasil pencarian untuk
                    <span class="search-keyword">
                        "{{ $search }}"
                    </span>
                </span>

                <span>
                    {{ number_format($customers->total()) }}
                    data ditemukan
                </span>

            </div>

        @endif


        {{-- =================================================
             CUSTOMER DATA
        ================================================== --}}

        @if ($customers->count() > 0)

            <div class="table-responsive">

                <table class="customer-table">

                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Kontak</th>
                            <th>Alamat</th>
                            <th>Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($customers as $customer)

                            <tr>

                                {{-- CUSTOMER CODE --}}

                                <td>
                                    <span class="customer-code">
                                        {{ $customer->customer_code }}
                                    </span>
                                </td>


                                {{-- CUSTOMER --}}

                                <td>

                                    <div class="customer-profile">

                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="customer-name">
                                                {{ $customer->name }}
                                            </div>

                                            <div class="customer-email">
                                                {{ $customer->email ?: 'Email belum tersedia' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- CONTACT --}}

                                <td>

                                    <div class="contact-main">
                                        {{ $customer->phone ?: '-' }}
                                    </div>

                                    <div class="contact-secondary">
                                        {{ $customer->email ?: 'Tidak ada email' }}
                                    </div>

                                </td>


                                {{-- ADDRESS --}}

                                <td>

                                    <div
                                        class="contact-secondary"
                                        title="{{ $customer->address }}"
                                    >
                                        {{ $customer->address ?: 'Alamat belum tersedia' }}
                                    </div>

                                </td>


                                {{-- TRANSACTION --}}

                                <td>

                                    @if ($customer->completed_sales_count > 0)

                                        <span class="transaction-badge">

                                            <span class="transaction-dot"></span>

                                            {{ $customer->completed_sales_count }}
                                            transaksi

                                        </span>

                                    @else

                                        <span class="transaction-badge empty">

                                            <span class="transaction-dot"></span>

                                            Belum ada

                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    <div class="action-group">

                                        <a
                                            href="{{ route('customers.show', $customer) }}"
                                            class="action-button action-view"
                                            title="Lihat Detail"
                                        >
                                            ◉
                                        </a>

                                        <a
                                            href="{{ route('customers.edit', $customer) }}"
                                            class="action-button action-edit"
                                            title="Edit Pelanggan"
                                        >
                                            ✎
                                        </a>

                                        <button
                                            type="button"
                                            class="action-button action-delete delete-customer-button"
                                            title="Hapus Pelanggan"
                                            data-customer-name="{{ $customer->name }}"
                                            data-delete-url="{{ route('customers.destroy', $customer) }}"
                                        >
                                            ×
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =============================================
                 CUSTOM PAGINATION
            ============================================== --}}

            @if ($customers->hasPages())

                <div class="pagination-area">

                    <div class="pagination-info">

                        Menampilkan
                        {{ $customers->firstItem() }}
                        sampai
                        {{ $customers->lastItem() }}
                        dari
                        {{ $customers->total() }}
                        pelanggan

                    </div>


                    <div class="pagination-buttons">

                        {{-- PREVIOUS --}}

                        @if ($customers->onFirstPage())

                            <span class="page-button disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $customers->previousPageUrl() }}"
                                class="page-button"
                            >
                                ‹
                            </a>

                        @endif


                        {{-- PAGE NUMBERS --}}

                        @foreach ($customers->getUrlRange(
                            max(1, $customers->currentPage() - 2),
                            min($customers->lastPage(), $customers->currentPage() + 2)
                        ) as $page => $url)

                            @if ($page == $customers->currentPage())

                                <span class="page-button active">
                                    {{ $page }}
                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="page-button"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- NEXT --}}

                        @if ($customers->hasMorePages())

                            <a
                                href="{{ $customers->nextPageUrl() }}"
                                class="page-button"
                            >
                                ›
                            </a>

                        @else

                            <span class="page-button disabled">
                                ›
                            </span>

                        @endif

                    </div>

                </div>

            @endif

        @else

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div class="empty-state">

                <div class="empty-icon">
                    ♙
                </div>

                @if ($search)

                    <h3>Pelanggan Tidak Ditemukan</h3>

                    <p>
                        Tidak ada data pelanggan yang sesuai dengan
                        pencarian "{{ $search }}". Coba gunakan kata
                        kunci lain atau tampilkan kembali seluruh data.
                    </p>

                    <a
                        href="{{ route('customers.index') }}"
                        class="empty-add-button"
                    >
                        Tampilkan Semua Pelanggan
                    </a>

                @else

                    <h3>Belum Ada Data Pelanggan</h3>

                    <p>
                        Mulai kelola hubungan pelanggan dengan
                        menambahkan pelanggan pertama
                        IntanMitha Collection.
                    </p>

                    <a
                        href="{{ route('customers.create') }}"
                        class="empty-add-button"
                    >
                        + Tambah Pelanggan Pertama
                    </a>

                @endif

            </div>

        @endif

    </section>

</div>


{{-- =========================================================
     DELETE CONFIRMATION MODAL
========================================================= --}}

<div
    class="delete-modal-overlay"
    id="deleteCustomerModal"
>

    <div class="delete-modal">

        <div class="delete-modal-icon">
            !
        </div>

        <h3>Hapus Pelanggan?</h3>

        <p>
            Data pelanggan
            <span
                class="delete-customer-name"
                id="deleteCustomerName"
            ></span>
            akan dihapus dari sistem. Riwayat transaksi yang
            sudah tersimpan tidak ikut terhapus.
        </p>

        <div class="modal-actions">

            <button
                type="button"
                class="modal-cancel"
                id="cancelDeleteCustomer"
            >
                Batal
            </button>

            <form
                method="POST"
                id="deleteCustomerForm"
                class="delete-form"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="modal-delete"
                >
                    Ya, Hapus
                </button>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('deleteCustomerModal');
        const deleteForm = document.getElementById('deleteCustomerForm');
        const customerName = document.getElementById('deleteCustomerName');
        const cancelButton = document.getElementById('cancelDeleteCustomer');

        const deleteButtons = document.querySelectorAll(
            '.delete-customer-button'
        );

        deleteButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const name = this.dataset.customerName;
                const deleteUrl = this.dataset.deleteUrl;

                customerName.textContent = name;
                deleteForm.action = deleteUrl;

                modal.classList.add('show');

            });

        });


        cancelButton.addEventListener('click', function () {
            modal.classList.remove('show');
        });


        modal.addEventListener('click', function (event) {

            if (event.target === modal) {
                modal.classList.remove('show');
            }

        });


        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                modal.classList.remove('show');
            }

        });

    });
</script>
@endpush