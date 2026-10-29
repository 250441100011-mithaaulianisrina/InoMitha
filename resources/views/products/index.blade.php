@extends('layouts.app')

@section('title', 'Produk | InoMitha')
@section('page-title', 'Produk & Kategori')
@section('page-subtitle', 'Kelola katalog produk IntanMitha Collection')

@push('styles')
<style>
    .product-page {
        width: 100%;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .product-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 190px;
        padding: 33px 35px;
        margin-bottom: 22px;
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
                #583247 0%,
                #82405e 52%,
                #b75e81 100%
            );
        box-shadow: 0 17px 42px rgba(89, 48, 68, 0.16);
    }

    .product-hero::before {
        content: "";
        position: absolute;
        width: 215px;
        height: 215px;
        top: -135px;
        right: 120px;
        border: 32px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .product-hero::after {
        content: "";
        position: absolute;
        width: 175px;
        height: 175px;
        right: -50px;
        bottom: -95px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .product-hero-content {
        position: relative;
        z-index: 2;
        max-width: 680px;
    }

    .product-hero-label {
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

    .product-hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .product-hero h1 {
        margin-bottom: 9px;
        font-size: 27px;
        line-height: 1.3;
    }

    .product-hero p {
        max-width: 620px;
        color: #f3e3e9;
        font-size: 12px;
        line-height: 1.8;
    }

    .product-hero-action {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }

    .btn-add-product {
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

    .btn-add-product:hover {
        color: #6f3b53;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(64, 29, 46, 0.20);
    }

    .add-product-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        color: #ffffff;
        background: #8f4667;
        font-size: 16px;
    }

    /* =========================================================
       MODULE SWITCH
    ========================================================= */

    .module-switch {
        display: flex;
        align-items: center;
        gap: 7px;
        width: fit-content;
        margin-bottom: 20px;
        padding: 5px;
        border: 1px solid #eee1e7;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 5px 18px rgba(80, 46, 62, 0.04);
    }

    .module-switch-item {
        min-height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 8px;
        color: #917786;
        font-size: 10px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .module-switch-item:hover {
        color: #75465d;
        background: #faf3f6;
    }

    .module-switch-item.active {
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #a95476);
        box-shadow: 0 5px 13px rgba(143, 70, 103, 0.15);
    }

    .module-switch-item.active:hover {
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #a95476);
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .product-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .product-summary-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 91px;
        padding: 17px 18px;
        border: 1px solid #f0e4e9;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, 0.045);
    }

    .product-summary-icon {
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 17px;
    }

    .product-summary-card.warning .product-summary-icon {
        color: #a66743;
        background: #fbf1e9;
    }

    .product-summary-card.success .product-summary-icon {
        color: #4d755b;
        background: #edf7f0;
    }

    .product-summary-content {
        position: relative;
        z-index: 2;
    }

    .product-summary-content span {
        display: block;
        margin-bottom: 5px;
        color: #9c8791;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .product-summary-content h3 {
        color: #583748;
        font-size: 19px;
    }

    .product-summary-decoration {
        position: absolute;
        width: 70px;
        height: 70px;
        right: -31px;
        bottom: -36px;
        border-radius: 50%;
        background: #fbf2f5;
    }

    /* =========================================================
       FILTER PANEL
    ========================================================= */

    .product-filter-panel {
        margin-bottom: 18px;
        padding: 18px 20px;
        border: 1px solid #eee2e7;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, 0.04);
    }

    .filter-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 14px;
    }

    .filter-heading-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-heading-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 12px;
    }

    .filter-heading h3 {
        margin-bottom: 3px;
        color: #604051;
        font-size: 11px;
    }

    .filter-heading p {
        color: #a18c96;
        font-size: 8px;
    }

    .product-filter-form {
        display: grid;
        grid-template-columns:
            minmax(190px, 1.6fr)
            minmax(140px, 1fr)
            minmax(125px, 0.8fr)
            minmax(135px, 0.9fr)
            auto;
        gap: 9px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        margin-bottom: 6px;
        color: #856c79;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        height: 39px;
        padding: 0 11px;
        border: 1px solid #e9dce2;
        border-radius: 9px;
        outline: none;
        color: #684858;
        background: #fefcfd;
        font-size: 9px;
        transition: 0.2s;
    }

    .filter-input::placeholder {
        color: #b6a4ad;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #c6819d;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(143, 70, 103, 0.07);
    }

    .filter-action-group {
        display: flex;
        gap: 6px;
    }

    .btn-filter,
    .btn-reset-filter {
        height: 39px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 13px;
        border-radius: 9px;
        font-size: 9px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        white-space: nowrap;
    }

    .btn-filter {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: #8f4667;
    }

    .btn-filter:hover {
        background: #783b57;
    }

    .btn-reset-filter {
        border: 1px solid #e8dae1;
        color: #846b78;
        background: #ffffff;
    }

    .btn-reset-filter:hover {
        color: #694455;
        background: #faf4f7;
    }

    /* =========================================================
       TABLE PANEL
    ========================================================= */

    .product-panel {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    .product-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 20px 22px;
        border-bottom: 1px solid #f2e8ec;
    }

    .product-panel-heading h3 {
        margin-bottom: 5px;
        color: #593749;
        font-size: 14px;
    }

    .product-panel-heading p {
        color: #a18b96;
        font-size: 9px;
    }

    .product-result-badge {
        padding: 6px 10px;
        border-radius: 20px;
        color: #845069;
        background: #f7e9ef;
        font-size: 8px;
        font-weight: 700;
    }

    .active-filter-info {
        padding: 11px 22px;
        border-bottom: 1px solid #f3e9ed;
        color: #8f7884;
        background: #fdfafb;
        font-size: 9px;
        line-height: 1.7;
    }

    .active-filter-info strong {
        color: #81435f;
    }

    /* =========================================================
       TABLE
    ========================================================= */

    .product-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .product-table {
        width: 100%;
        min-width: 980px;
        border-collapse: collapse;
    }

    .product-table thead {
        background: #fdfafb;
    }

    .product-table th {
        padding: 13px 15px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8590;
        font-size: 8px;
        font-weight: 700;
        text-align: left;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .product-table td {
        padding: 15px;
        border-bottom: 1px solid #f4ebef;
        color: #654655;
        font-size: 9px;
        vertical-align: middle;
    }

    .product-table tbody tr {
        transition: 0.18s ease;
    }

    .product-table tbody tr:hover {
        background: #fefafb;
    }

    .product-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================================================
       PRODUCT IDENTITY
    ========================================================= */

    .product-identity {
        display: flex;
        align-items: center;
        gap: 11px;
        min-width: 190px;
    }

    .product-avatar {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #efdde5;
        border-radius: 12px;
        color: #8b4664;
        background: linear-gradient(145deg, #fceff4, #f7e3eb);
        font-size: 14px;
        font-weight: 700;
    }

    .product-name {
        margin-bottom: 4px;
        color: #593849;
        font-size: 10px;
        font-weight: 700;
    }

    .product-code {
        color: #a18b96;
        font-size: 8px;
        letter-spacing: 0.3px;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 8px;
        border-radius: 20px;
        color: #80566a;
        background: #f8edf2;
        font-size: 8px;
        font-weight: 700;
        white-space: nowrap;
    }

    .category-badge-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #aa607e;
    }

    .product-price {
        color: #634252;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       STOCK
    ========================================================= */

    .stock-information {
        min-width: 100px;
    }

    .stock-number {
        margin-bottom: 5px;
        color: #5f4050;
        font-size: 10px;
        font-weight: 700;
    }

    .stock-number small {
        color: #a28d97;
        font-size: 7px;
        font-weight: 500;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        font-size: 7px;
        font-weight: 700;
        white-space: nowrap;
    }

    .stock-badge.safe {
        color: #4d7359;
        background: #edf7f0;
    }

    .stock-badge.low {
        color: #a34f61;
        background: #fceef1;
    }

    .stock-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    .minimum-stock {
        color: #9c8791;
        font-size: 8px;
        white-space: nowrap;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 8px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-badge.active {
        color: #4b7258;
        background: #edf7f0;
    }

    .status-badge.inactive {
        color: #85747c;
        background: #f2eff0;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .product-action-group {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .product-action-button {
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

    .product-action-button.view {
        color: #6b668f;
    }

    .product-action-button.view:hover {
        border-color: #dcd8ef;
        background: #f3f1fb;
    }

    .product-action-button.edit {
        color: #9a6942;
    }

    .product-action-button.edit:hover {
        border-color: #eedfcf;
        background: #fcf6ef;
    }

    .product-action-button.delete {
        color: #a34f61;
    }

    .product-action-button.delete:hover {
        border-color: #f0d8de;
        background: #fdf0f3;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .product-empty-state {
        padding: 60px 22px;
        text-align: center;
    }

    .product-empty-icon {
        width: 68px;
        height: 68px;
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

    .product-empty-state h3 {
        margin-bottom: 7px;
        color: #624152;
        font-size: 13px;
    }

    .product-empty-state p {
        max-width: 440px;
        margin: 0 auto 17px;
        color: #9e8993;
        font-size: 10px;
        line-height: 1.7;
    }

    .btn-empty-product {
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

    .product-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 22px;
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

    .product-delete-overlay {
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

    .product-delete-overlay.show {
        display: flex;
    }

    .product-delete-modal {
        width: 100%;
        max-width: 420px;
        padding: 27px;
        border: 1px solid #f0dfe6;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 24px 65px rgba(51, 29, 40, 0.22);
        animation: productModalIn 0.2s ease;
    }

    @keyframes productModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .product-delete-icon {
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
        font-weight: 700;
    }

    .product-delete-modal h3 {
        margin-bottom: 8px;
        color: #5d3b4b;
        font-size: 16px;
    }

    .product-delete-modal p {
        color: #99828e;
        font-size: 10px;
        line-height: 1.7;
    }

    .delete-product-name {
        color: #7d405c;
        font-weight: 700;
    }

    .product-modal-warning {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #f0dfe5;
        border-radius: 9px;
        color: #9a6572;
        background: #fff7f9;
        font-size: 9px;
        line-height: 1.6;
    }

    .product-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
    }

    .btn-modal-cancel,
    .btn-modal-delete {
        height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-modal-cancel {
        border: 1px solid #e9dce2;
        color: #806676;
        background: #ffffff;
    }

    .btn-modal-delete {
        border: 1px solid #9e455a;
        color: #ffffff;
        background: #9e455a;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {
        .product-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .product-filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .filter-action-group {
            grid-column: span 2;
        }
    }

    @media (max-width: 700px) {
        .product-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 24px;
        }

        .product-hero-action {
            width: 100%;
        }

        .btn-add-product {
            width: 100%;
        }

        .module-switch {
            width: 100%;
        }

        .module-switch-item {
            flex: 1;
        }

        .product-summary-grid {
            grid-template-columns: 1fr;
        }

        .product-filter-form {
            grid-template-columns: 1fr;
        }

        .filter-action-group {
            grid-column: auto;
        }

        .btn-filter,
        .btn-reset-filter {
            flex: 1;
        }

        .product-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .product-pagination {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="product-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="product-hero">

        <div class="product-hero-content">

            <div class="product-hero-label">
                <span class="product-hero-dot"></span>
                Product Management
            </div>

            <h1>Kelola Produk IntanMitha</h1>

            <p>
                Kelola katalog, harga, kategori, status, dan kondisi
                persediaan produk IntanMitha Collection dalam satu
                halaman yang terintegrasi.
            </p>

        </div>


        <div class="product-hero-action">

            <a
                href="{{ route('products.create') }}"
                class="btn-add-product"
            >
                <span class="add-product-icon">+</span>
                Tambah Produk
            </a>

        </div>

    </section>


    {{-- =====================================================
         MODULE SWITCH
    ====================================================== --}}

    <div class="module-switch">

        <a
            href="{{ route('categories.index') }}"
            class="module-switch-item"
        >
            ◇
            Kategori
        </a>

        <a
            href="{{ route('products.index') }}"
            class="module-switch-item active"
        >
            ▦
            Produk
        </a>

    </div>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <section class="product-summary-grid">

        <div class="product-summary-card">

            <div class="product-summary-icon">
                ▦
            </div>

            <div class="product-summary-content">
                <span>Total Produk</span>
                <h3>{{ number_format($totalProducts) }}</h3>
            </div>

            <div class="product-summary-decoration"></div>

        </div>


        <div class="product-summary-card success">

            <div class="product-summary-icon">
                ✓
            </div>

            <div class="product-summary-content">
                <span>Produk Aktif</span>
                <h3>{{ number_format($activeProducts) }}</h3>
            </div>

            <div class="product-summary-decoration"></div>

        </div>


        <div class="product-summary-card warning">

            <div class="product-summary-icon">
                !
            </div>

            <div class="product-summary-content">
                <span>Stok Menipis</span>
                <h3>{{ number_format($lowStockProducts) }}</h3>
            </div>

            <div class="product-summary-decoration"></div>

        </div>


        <div class="product-summary-card">

            <div class="product-summary-icon">
                ≡
            </div>

            <div class="product-summary-content">
                <span>Total Unit Stok</span>
                <h3>{{ number_format($totalStock) }}</h3>
            </div>

            <div class="product-summary-decoration"></div>

        </div>

    </section>


    {{-- =====================================================
         FILTER
    ====================================================== --}}

    <section class="product-filter-panel">

        <div class="filter-heading">

            <div class="filter-heading-left">

                <div class="filter-heading-icon">
                    ⌕
                </div>

                <div>
                    <h3>Pencarian & Filter Produk</h3>
                    <p>
                        Temukan produk berdasarkan data dan kondisi persediaan.
                    </p>
                </div>

            </div>

        </div>


        <form
            action="{{ route('products.index') }}"
            method="GET"
            class="product-filter-form"
        >

            {{-- SEARCH --}}

            <div class="filter-group">

                <label for="search">
                    Cari Produk
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    class="filter-input"
                    value="{{ $search }}"
                    placeholder="Kode, nama, atau kategori..."
                    autocomplete="off"
                >

            </div>


            {{-- CATEGORY --}}

            <div class="filter-group">

                <label for="category">
                    Kategori
                </label>

                <select
                    id="category"
                    name="category"
                    class="filter-select"
                >
                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ (string) $categoryId === (string) $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- STATUS --}}

            <div class="filter-group">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="filter-select"
                >
                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="active"
                        {{ $status === 'active' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="inactive"
                        {{ $status === 'inactive' ? 'selected' : '' }}
                    >
                        Nonaktif
                    </option>

                </select>

            </div>


            {{-- STOCK STATUS --}}

            <div class="filter-group">

                <label for="stock_status">
                    Kondisi Stok
                </label>

                <select
                    id="stock_status"
                    name="stock_status"
                    class="filter-select"
                >
                    <option value="">
                        Semua Stok
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

                </select>

            </div>


            {{-- ACTION --}}

            <div class="filter-action-group">

                <button
                    type="submit"
                    class="btn-filter"
                >
                    Terapkan
                </button>

                @if (
                    $search ||
                    $categoryId ||
                    $status ||
                    $stockStatus
                )

                    <a
                        href="{{ route('products.index') }}"
                        class="btn-reset-filter"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

    </section>


    {{-- =====================================================
         PRODUCT PANEL
    ====================================================== --}}

    <section class="product-panel">

        <div class="product-panel-header">

            <div class="product-panel-heading">

                <h3>Daftar Produk</h3>

                <p>
                    Seluruh produk yang terdaftar pada IntanMitha Collection.
                </p>

            </div>


            <span class="product-result-badge">
                {{ number_format($products->total()) }}
                Produk
            </span>

        </div>


        {{-- ACTIVE FILTER INFORMATION --}}

        @if (
            $search ||
            $categoryId ||
            $status ||
            $stockStatus
        )

            <div class="active-filter-info">

                Menampilkan produk berdasarkan filter yang dipilih.

                @if ($search)
                    Pencarian:
                    <strong>"{{ $search }}"</strong>.
                @endif

                @if ($categoryId)
                    @php
                        $selectedCategory = $categories->firstWhere(
                            'id',
                            $categoryId
                        );
                    @endphp

                    @if ($selectedCategory)
                        Kategori:
                        <strong>{{ $selectedCategory->name }}</strong>.
                    @endif
                @endif

                @if ($status)
                    Status:
                    <strong>
                        {{ $status === 'active' ? 'Aktif' : 'Nonaktif' }}
                    </strong>.
                @endif

                @if ($stockStatus)
                    Kondisi:
                    <strong>
                        {{ $stockStatus === 'low' ? 'Stok Menipis' : 'Stok Aman' }}
                    </strong>.
                @endif

            </div>

        @endif


        {{-- =================================================
             PRODUCT DATA
        ================================================== --}}

        @if ($products->count() > 0)

            <div class="product-table-wrapper">

                <table class="product-table">

                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Minimum</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($products as $product)

                            <tr>

                                {{-- PRODUCT --}}

                                <td>

                                    <div class="product-identity">

                                        <div class="product-avatar">
                                            {{ strtoupper(substr($product->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="product-name">
                                                {{ $product->name }}
                                            </div>

                                            <div class="product-code">
                                                {{ $product->product_code }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- CATEGORY --}}

                                <td>

                                    <span class="category-badge">

                                        <span class="category-badge-dot"></span>

                                        {{ $product->category->name }}

                                    </span>

                                </td>


                                {{-- PRICE --}}

                                <td>

                                    <span class="product-price">
                                        Rp {{ number_format(
                                            $product->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- STOCK --}}

                                <td>

                                    <div class="stock-information">

                                        <div class="stock-number">
                                            {{ number_format($product->stock) }}
                                            <small>unit</small>
                                        </div>


                                        @if (
                                            $product->stock <=
                                            $product->minimum_stock
                                        )

                                            <span class="stock-badge low">

                                                <span class="stock-dot"></span>

                                                Menipis

                                            </span>

                                        @else

                                            <span class="stock-badge safe">

                                                <span class="stock-dot"></span>

                                                Aman

                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- MINIMUM STOCK --}}

                                <td>

                                    <span class="minimum-stock">
                                        {{ number_format($product->minimum_stock) }}
                                        unit
                                    </span>

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if ($product->is_active)

                                        <span class="status-badge active">

                                            <span class="status-dot"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="status-badge inactive">

                                            <span class="status-dot"></span>

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    <div class="product-action-group">

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="product-action-button view"
                                            title="Lihat Detail"
                                        >
                                            ◉
                                        </a>

                                        <a
                                            href="{{ route('products.edit', $product) }}"
                                            class="product-action-button edit"
                                            title="Edit Produk"
                                        >
                                            ✎
                                        </a>

                                        <button
                                            type="button"
                                            class="product-action-button delete delete-product-button"
                                            title="Hapus Produk"
                                            data-product-name="{{ $product->name }}"
                                            data-delete-url="{{ route('products.destroy', $product) }}"
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


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            @if ($products->hasPages())

                <div class="product-pagination">

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

                        {{-- PREVIOUS --}}

                        @if ($products->onFirstPage())

                            <span class="page-button disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $products->previousPageUrl() }}"
                                class="page-button"
                            >
                                ‹
                            </a>

                        @endif


                        {{-- PAGE NUMBER --}}

                        @foreach (
                            $products->getUrlRange(
                                max(1, $products->currentPage() - 2),
                                min(
                                    $products->lastPage(),
                                    $products->currentPage() + 2
                                )
                            )
                            as $page => $url
                        )

                            @if ($page == $products->currentPage())

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

                        @if ($products->hasMorePages())

                            <a
                                href="{{ $products->nextPageUrl() }}"
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

            <div class="product-empty-state">

                <div class="product-empty-icon">
                    ▦
                </div>


                @if (
                    $search ||
                    $categoryId ||
                    $status ||
                    $stockStatus
                )

                    <h3>Produk Tidak Ditemukan</h3>

                    <p>
                        Tidak ada produk yang sesuai dengan pencarian
                        atau filter yang dipilih. Coba ubah filter
                        atau tampilkan kembali seluruh produk.
                    </p>

                    <a
                        href="{{ route('products.index') }}"
                        class="btn-empty-product"
                    >
                        Tampilkan Semua Produk
                    </a>

                @else

                    <h3>Belum Ada Produk</h3>

                    <p>
                        Tambahkan produk pertama IntanMitha Collection.
                        Produk nantinya akan terhubung dengan kategori,
                        persediaan, transaksi penjualan, laporan, dan
                        AI Business Assistant.
                    </p>

                    <a
                        href="{{ route('products.create') }}"
                        class="btn-empty-product"
                    >
                        + Tambah Produk Pertama
                    </a>

                @endif

            </div>

        @endif

    </section>

</div>


{{-- =========================================================
     DELETE MODAL
========================================================= --}}

<div
    class="product-delete-overlay"
    id="deleteProductModal"
>

    <div class="product-delete-modal">

        <div class="product-delete-icon">
            !
        </div>

        <h3>Hapus Produk?</h3>

        <p>
            Produk
            <span
                class="delete-product-name"
                id="deleteProductName"
            ></span>
            akan dihapus dari sistem.
        </p>


        <div class="product-modal-warning">

            Produk yang sudah mempunyai riwayat transaksi penjualan
            tidak dapat dihapus. Produk tersebut nantinya cukup
            dinonaktifkan agar riwayat bisnis tetap tersimpan.

        </div>


        <div class="product-modal-actions">

            <button
                type="button"
                class="btn-modal-cancel"
                id="cancelDeleteProduct"
            >
                Batal
            </button>


            <form
                method="POST"
                id="deleteProductForm"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn-modal-delete"
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

        const modal = document.getElementById('deleteProductModal');
        const deleteForm = document.getElementById('deleteProductForm');
        const productName = document.getElementById('deleteProductName');
        const cancelButton = document.getElementById('cancelDeleteProduct');

        const deleteButtons = document.querySelectorAll(
            '.delete-product-button'
        );


        deleteButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const name = this.dataset.productName;
                const deleteUrl = this.dataset.deleteUrl;

                productName.textContent = name;
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