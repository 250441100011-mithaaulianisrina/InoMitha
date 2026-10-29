@extends('layouts.app')

@section('title', 'Kategori Produk | InoMitha')
@section('page-title', 'Produk & Kategori')
@section('page-subtitle', 'Kelola pengelompokan produk IntanMitha Collection')

@push('styles')
<style>
    .category-page {
        width: 100%;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .category-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 185px;
        padding: 32px 35px;
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

    .category-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -130px;
        right: 120px;
        border: 32px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .category-hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: -50px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .category-hero-content {
        position: relative;
        z-index: 2;
        max-width: 680px;
    }

    .category-hero-label {
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

    .category-hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .category-hero h1 {
        margin-bottom: 9px;
        font-size: 27px;
        line-height: 1.3;
    }

    .category-hero p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 12px;
        line-height: 1.8;
    }

    .category-hero-action {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }

    .btn-add-category {
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

    .btn-add-category:hover {
        color: #6f3b53;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(64, 29, 46, 0.20);
    }

    .add-category-icon {
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 14px;
        border-radius: 8px;
        color: #917786;
        font-size: 10px;
        font-weight: 700;
    }

    .module-switch-item.active {
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #a95476);
        box-shadow: 0 5px 13px rgba(143, 70, 103, 0.15);
    }

    .module-switch-item.disabled {
        color: #b9aab1;
        cursor: default;
    }

    .soon-badge {
        padding: 3px 6px;
        border-radius: 20px;
        color: #a28e98;
        background: #f3eef0;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .category-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 22px;
    }

    .category-summary-card {
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
       PANEL
    ========================================================= */

    .category-panel {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    .category-panel-header {
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

    .category-search-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-search-box {
        position: relative;
        width: 280px;
    }

    .category-search-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #a78d99;
        font-size: 14px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .category-search-input {
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

    .category-search-input::placeholder {
        color: #b4a1aa;
    }

    .category-search-input:focus {
        border-color: #c9829e;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(143, 70, 103, 0.07);
    }

    .btn-category-search,
    .btn-category-reset {
        height: 39px;
        padding: 0 13px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-category-search {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: #8f4667;
    }

    .btn-category-search:hover {
        background: #773a56;
    }

    .btn-category-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #eadde3;
        color: #8b6c7b;
        background: #ffffff;
    }

    .btn-category-reset:hover {
        color: #714257;
        background: #fbf4f7;
    }

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

    .category-table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .category-table {
        width: 100%;
        min-width: 760px;
        border-collapse: collapse;
    }

    .category-table thead {
        background: #fdfafb;
    }

    .category-table th {
        padding: 13px 17px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8590;
        font-size: 9px;
        font-weight: 700;
        text-align: left;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .category-table td {
        padding: 16px 17px;
        border-bottom: 1px solid #f4ebef;
        color: #654655;
        font-size: 10px;
        vertical-align: middle;
    }

    .category-table tbody tr {
        transition: background 0.18s ease;
    }

    .category-table tbody tr:hover {
        background: #fefafb;
    }

    .category-table tbody tr:last-child td {
        border-bottom: none;
    }

    .category-identity {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .category-avatar {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #efdde5;
        border-radius: 11px;
        color: #8b4664;
        background: linear-gradient(145deg, #fceff4, #f7e3eb);
        font-size: 13px;
        font-weight: 700;
    }

    .category-name {
        margin-bottom: 4px;
        color: #593849;
        font-size: 11px;
        font-weight: 700;
    }

    .category-id {
        color: #a18b96;
        font-size: 8px;
    }

    .category-description {
        display: -webkit-box;
        max-width: 390px;
        overflow: hidden;
        color: #8f7984;
        font-size: 9px;
        line-height: 1.6;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .category-description.empty {
        color: #b1a1a9;
        font-style: italic;
    }

    .product-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        color: #765164;
        background: #f8edf2;
        font-size: 9px;
        font-weight: 700;
    }

    .product-count-badge.empty {
        color: #93838b;
        background: #f5f2f3;
    }

    .product-count-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #aa607e;
    }

    .product-count-badge.empty .product-count-dot {
        background: #b9adb2;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .category-action-group {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .category-action-button {
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

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .category-empty-state {
        padding: 58px 20px;
        text-align: center;
    }

    .category-empty-icon {
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

    .category-empty-state h3 {
        margin-bottom: 7px;
        color: #624152;
        font-size: 13px;
    }

    .category-empty-state p {
        max-width: 430px;
        margin: 0 auto 17px;
        color: #9e8993;
        font-size: 10px;
        line-height: 1.7;
    }

    .empty-category-button {
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

    .category-pagination-area {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .category-pagination-info {
        color: #9b8590;
        font-size: 9px;
    }

    .category-pagination-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .category-page-button {
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

    .category-page-button:hover {
        border-color: #c88ba3;
        color: #ffffff;
        background: #9b5471;
    }

    .category-page-button.active {
        border-color: #8f4667;
        color: #ffffff;
        background: #8f4667;
    }

    .category-page-button.disabled {
        color: #c1b5bb;
        background: #faf7f8;
        pointer-events: none;
    }

    /* =========================================================
       DELETE MODAL
    ========================================================= */

    .category-delete-overlay {
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

    .category-delete-overlay.show {
        display: flex;
    }

    .category-delete-modal {
        width: 100%;
        max-width: 410px;
        padding: 27px;
        border: 1px solid #f0dfe6;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 24px 65px rgba(51, 29, 40, 0.22);
        animation: categoryModalIn 0.2s ease;
    }

    @keyframes categoryModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .category-delete-icon {
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

    .category-delete-modal h3 {
        margin-bottom: 8px;
        color: #5d3b4b;
        font-size: 16px;
    }

    .category-delete-modal p {
        color: #99828e;
        font-size: 10px;
        line-height: 1.7;
    }

    .delete-category-name {
        color: #7d405c;
        font-weight: 700;
    }

    .category-modal-warning {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #f0dfe5;
        border-radius: 9px;
        color: #9a6572;
        background: #fff7f9;
        font-size: 9px;
        line-height: 1.6;
    }

    .category-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
    }

    .category-modal-cancel,
    .category-modal-delete {
        height: 38px;
        padding: 0 14px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
    }

    .category-modal-cancel {
        border: 1px solid #e9dce2;
        color: #806676;
        background: #ffffff;
    }

    .category-modal-delete {
        border: 1px solid #9e455a;
        color: #ffffff;
        background: #9e455a;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {
        .category-summary-grid {
            grid-template-columns: 1fr 1fr;
        }

        .category-panel-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .category-search-form {
            width: 100%;
        }

        .category-search-box {
            flex: 1;
            width: auto;
        }
    }

    @media (max-width: 700px) {
        .category-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 24px;
        }

        .category-hero-action {
            width: 100%;
        }

        .btn-add-category {
            width: 100%;
        }

        .module-switch {
            width: 100%;
        }

        .module-switch-item {
            flex: 1;
        }

        .category-summary-grid {
            grid-template-columns: 1fr;
        }

        .category-search-form {
            align-items: stretch;
            flex-wrap: wrap;
        }

        .category-search-box {
            width: 100%;
            flex-basis: 100%;
        }

        .btn-category-search,
        .btn-category-reset {
            flex: 1;
        }

        .category-pagination-area {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endpush


@section('content')

<div class="category-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="category-hero">

        <div class="category-hero-content">

            <div class="category-hero-label">
                <span class="category-hero-dot"></span>
                Product Management
            </div>

            <h1>Kelola Kategori Produk</h1>

            <p>
                Atur pengelompokan produk IntanMitha Collection agar
                pengelolaan katalog, persediaan, penjualan, dan analisis
                produk dapat dilakukan dengan lebih terstruktur.
            </p>

        </div>


        <div class="category-hero-action">

            <a
                href="{{ route('categories.create') }}"
                class="btn-add-category"
            >
                <span class="add-category-icon">+</span>
                Tambah Kategori
            </a>

        </div>

    </section>


    {{-- =====================================================
         CATEGORY / PRODUCT SWITCH
    ====================================================== --}}

    <div class="module-switch">

        <a
            href="{{ route('categories.index') }}"
            class="module-switch-item active"
        >
            ◇
            Kategori
        </a>

        <a
            href="{{ route('products.index') }}"
            class="module-switch-item"
        >
            ▦
            Produk
        </a>

    </div>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <section class="category-summary-grid">

        <div class="category-summary-card">

            <div class="summary-icon">
                ◇
            </div>

            <div class="summary-content">
                <span>Total Kategori</span>
                <h3>{{ number_format($totalCategories) }}</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>


        <div class="category-summary-card">

            <div class="summary-icon">
                ▦
            </div>

            <div class="summary-content">
                <span>Total Produk</span>
                <h3>{{ number_format($totalProducts) }}</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>


        <div class="category-summary-card">

            <div class="summary-icon">
                ✦
            </div>

            <div class="summary-content">
                <span>Status Modul</span>
                <h3>Aktif</h3>
            </div>

            <div class="summary-decoration"></div>

        </div>

    </section>


    {{-- =====================================================
         CATEGORY PANEL
    ====================================================== --}}

    <section class="category-panel">

        <div class="category-panel-header">

            <div class="panel-heading">

                <h3>Daftar Kategori</h3>

                <p>
                    Kelola kategori yang digunakan untuk
                    mengelompokkan produk IntanMitha Collection.
                </p>

            </div>


            {{-- SEARCH --}}

            <form
                action="{{ route('categories.index') }}"
                method="GET"
                class="category-search-form"
            >

                <div class="category-search-box">

                    <span class="category-search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="search"
                        class="category-search-input"
                        value="{{ $search }}"
                        placeholder="Cari nama atau deskripsi kategori..."
                        autocomplete="off"
                    >

                </div>

                <button
                    type="submit"
                    class="btn-category-search"
                >
                    Cari
                </button>

                @if ($search)

                    <a
                        href="{{ route('categories.index') }}"
                        class="btn-category-reset"
                    >
                        Reset
                    </a>

                @endif

            </form>

        </div>


        {{-- =================================================
             SEARCH RESULT
        ================================================== --}}

        @if ($search)

            <div class="search-result-info">

                <span>
                    Hasil pencarian untuk
                    <span class="search-keyword">
                        "{{ $search }}"
                    </span>
                </span>

                <span>
                    {{ number_format($categories->total()) }}
                    kategori ditemukan
                </span>

            </div>

        @endif


        {{-- =================================================
             CATEGORY DATA
        ================================================== --}}

        @if ($categories->count() > 0)

            <div class="category-table-responsive">

                <table class="category-table">

                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach ($categories as $category)

                            <tr>

                                {{-- CATEGORY --}}

                                <td>

                                    <div class="category-identity">

                                        <div class="category-avatar">
                                            {{ strtoupper(substr($category->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="category-name">
                                                {{ $category->name }}
                                            </div>

                                            <div class="category-id">
                                                CATEGORY #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- DESCRIPTION --}}

                                <td>

                                    @if ($category->description)

                                        <div
                                            class="category-description"
                                            title="{{ $category->description }}"
                                        >
                                            {{ $category->description }}
                                        </div>

                                    @else

                                        <div class="category-description empty">
                                            Belum ada deskripsi kategori
                                        </div>

                                    @endif

                                </td>


                                {{-- PRODUCT COUNT --}}

                                <td>

                                    @if ($category->products_count > 0)

                                        <span class="product-count-badge">

                                            <span class="product-count-dot"></span>

                                            {{ number_format($category->products_count) }}
                                            produk

                                        </span>

                                    @else

                                        <span class="product-count-badge empty">

                                            <span class="product-count-dot"></span>

                                            Belum ada produk

                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    <div class="category-action-group">

                                        <a
                                            href="{{ route('categories.show', $category) }}"
                                            class="category-action-button action-view"
                                            title="Lihat Detail"
                                        >
                                            ◉
                                        </a>

                                        <a
                                            href="{{ route('categories.edit', $category) }}"
                                            class="category-action-button action-edit"
                                            title="Edit Kategori"
                                        >
                                            ✎
                                        </a>

                                        <button
                                            type="button"
                                            class="category-action-button action-delete delete-category-button"
                                            title="Hapus Kategori"
                                            data-category-name="{{ $category->name }}"
                                            data-delete-url="{{ route('categories.destroy', $category) }}"
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

            @if ($categories->hasPages())

                <div class="category-pagination-area">

                    <div class="category-pagination-info">

                        Menampilkan
                        {{ $categories->firstItem() }}
                        sampai
                        {{ $categories->lastItem() }}
                        dari
                        {{ $categories->total() }}
                        kategori

                    </div>


                    <div class="category-pagination-buttons">

                        {{-- PREVIOUS --}}

                        @if ($categories->onFirstPage())

                            <span class="category-page-button disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $categories->previousPageUrl() }}"
                                class="category-page-button"
                            >
                                ‹
                            </a>

                        @endif


                        {{-- PAGE NUMBER --}}

                        @foreach (
                            $categories->getUrlRange(
                                max(1, $categories->currentPage() - 2),
                                min(
                                    $categories->lastPage(),
                                    $categories->currentPage() + 2
                                )
                            )
                            as $page => $url
                        )

                            @if ($page == $categories->currentPage())

                                <span class="category-page-button active">
                                    {{ $page }}
                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="category-page-button"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- NEXT --}}

                        @if ($categories->hasMorePages())

                            <a
                                href="{{ $categories->nextPageUrl() }}"
                                class="category-page-button"
                            >
                                ›
                            </a>

                        @else

                            <span class="category-page-button disabled">
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

            <div class="category-empty-state">

                <div class="category-empty-icon">
                    ◇
                </div>

                @if ($search)

                    <h3>Kategori Tidak Ditemukan</h3>

                    <p>
                        Tidak ada kategori yang sesuai dengan pencarian
                        "{{ $search }}". Coba gunakan kata kunci lain
                        atau tampilkan kembali seluruh kategori.
                    </p>

                    <a
                        href="{{ route('categories.index') }}"
                        class="empty-category-button"
                    >
                        Tampilkan Semua Kategori
                    </a>

                @else

                    <h3>Belum Ada Kategori Produk</h3>

                    <p>
                        Tambahkan kategori pertama untuk mulai
                        mengelompokkan produk IntanMitha Collection
                        secara lebih terstruktur.
                    </p>

                    <a
                        href="{{ route('categories.create') }}"
                        class="empty-category-button"
                    >
                        + Tambah Kategori Pertama
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
    class="category-delete-overlay"
    id="deleteCategoryModal"
>

    <div class="category-delete-modal">

        <div class="category-delete-icon">
            !
        </div>

        <h3>Hapus Kategori?</h3>

        <p>
            Kategori
            <span
                class="delete-category-name"
                id="deleteCategoryName"
            ></span>
            akan dihapus dari sistem.
        </p>

        <div class="category-modal-warning">
            Kategori yang sudah digunakan oleh produk tidak dapat
            dihapus. Hal ini dilakukan untuk menjaga hubungan data
            produk tetap aman.
        </div>


        <div class="category-modal-actions">

            <button
                type="button"
                class="category-modal-cancel"
                id="cancelDeleteCategory"
            >
                Batal
            </button>


            <form
                method="POST"
                id="deleteCategoryForm"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="category-modal-delete"
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

        const modal = document.getElementById('deleteCategoryModal');
        const deleteForm = document.getElementById('deleteCategoryForm');
        const categoryName = document.getElementById('deleteCategoryName');
        const cancelButton = document.getElementById('cancelDeleteCategory');

        const deleteButtons = document.querySelectorAll(
            '.delete-category-button'
        );

        deleteButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                const name = this.dataset.categoryName;
                const deleteUrl = this.dataset.deleteUrl;

                categoryName.textContent = name;
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