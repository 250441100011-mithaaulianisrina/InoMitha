@extends('layouts.app')

@section('title', 'Edit Kategori | InoMitha')
@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Perbarui informasi kategori produk IntanMitha Collection')

@push('styles')
<style>
    .category-edit-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .category-edit-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .category-edit-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .category-edit-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .category-edit-hero {
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
                circle at 88% 15%,
                rgba(255, 255, 255, 0.16),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #583247 0%,
                #81405e 52%,
                #b65d80 100%
            );
        box-shadow: 0 17px 42px rgba(89, 48, 68, 0.16);
    }

    .category-edit-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -135px;
        right: 115px;
        border: 32px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .category-edit-hero::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -45px;
        bottom: -85px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .category-edit-hero-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }

    .category-edit-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
        padding: 7px 11px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .category-edit-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .category-edit-hero h1 {
        margin-bottom: 8px;
        font-size: 27px;
        line-height: 1.3;
    }

    .category-edit-hero p {
        max-width: 600px;
        color: #f3e3e9;
        font-size: 11px;
        line-height: 1.8;
    }

    .category-edit-profile {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .category-edit-avatar {
        width: 76px;
        height: 76px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 22px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.11);
        font-size: 27px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .category-edit-code {
        padding: 5px 9px;
        border-radius: 20px;
        color: #f5e5ec;
        background: rgba(255, 255, 255, 0.09);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* =========================================================
       LAYOUT
    ========================================================= */

    .category-edit-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, 0.72fr);
        gap: 20px;
        align-items: start;
    }

    .category-edit-card,
    .category-edit-info-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .category-edit-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .category-edit-header-icon {
        width: 41px;
        height: 41px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 17px;
    }

    .category-edit-card-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .category-edit-card-header p {
        color: #a18b96;
        font-size: 10px;
    }

    .category-edit-card-body {
        padding: 25px 23px;
    }

    /* =========================================================
       VALIDATION
    ========================================================= */

    .category-validation-alert {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f0d5dc;
        border-radius: 11px;
        color: #854455;
        background: #fff4f6;
    }

    .category-validation-icon {
        width: 31px;
        height: 31px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #ffffff;
        background: #aa5368;
        font-size: 13px;
        font-weight: 700;
    }

    .category-validation-alert h4 {
        margin-bottom: 4px;
        font-size: 10px;
    }

    .category-validation-alert p {
        color: #a36877;
        font-size: 9px;
        line-height: 1.6;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .category-form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 20px;
        color: #664253;
        font-size: 11px;
        font-weight: 700;
    }

    .category-section-number {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        color: #ffffff;
        background: #8f4667;
        font-size: 9px;
    }

    .category-form-group {
        margin-bottom: 20px;
    }

    .category-form-group:last-child {
        margin-bottom: 0;
    }

    .category-form-label {
        display: block;
        margin-bottom: 7px;
        color: #684757;
        font-size: 10px;
        font-weight: 700;
    }

    .category-required {
        color: #bd5c75;
    }

    .category-optional {
        margin-left: 5px;
        color: #b09ca5;
        font-size: 8px;
        font-weight: 500;
    }

    .category-input-wrapper {
        position: relative;
    }

    .category-input-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #a78495;
        font-size: 13px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .category-form-control {
        width: 100%;
        min-height: 44px;
        padding: 0 14px 0 39px;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        outline: none;
        color: #604050;
        background: #fefcfd;
        font-size: 10px;
        transition: 0.2s ease;
    }

    .category-form-control::placeholder {
        color: #b7a5ad;
    }

    .category-form-control:focus {
        border-color: #c47c98;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(143, 70, 103, 0.07);
    }

    .category-form-control.is-invalid {
        border-color: #d77b8d;
        background: #fffafb;
    }

    textarea.category-form-control {
        min-height: 145px;
        padding: 13px 14px;
        line-height: 1.7;
        resize: vertical;
    }

    .category-field-help {
        margin-top: 6px;
        color: #a6929c;
        font-size: 8px;
        line-height: 1.6;
    }

    .category-error-message {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 6px;
        color: #b54d63;
        font-size: 9px;
        font-weight: 600;
    }

    /* =========================================================
       ACTIONS
    ========================================================= */

    .category-form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .category-action-left,
    .category-action-right {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .category-btn-detail,
    .category-btn-cancel,
    .category-btn-update {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 15px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .category-btn-detail,
    .category-btn-cancel {
        border: 1px solid #e7d9df;
        color: #806575;
        background: #ffffff;
    }

    .category-btn-detail:hover,
    .category-btn-cancel:hover {
        color: #653d51;
        background: #faf4f7;
    }

    .category-btn-update {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #aa5577);
        box-shadow: 0 7px 17px rgba(143, 70, 103, 0.17);
    }

    .category-btn-update:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143, 70, 103, 0.23);
    }

    /* =========================================================
       INFORMATION
    ========================================================= */

    .category-info-header {
        position: relative;
        overflow: hidden;
        padding: 21px;
        color: #ffffff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .category-info-header::after {
        content: "✦";
        position: absolute;
        right: -4px;
        bottom: -28px;
        color: rgba(255, 255, 255, 0.07);
        font-size: 88px;
    }

    .category-info-header-icon {
        position: relative;
        z-index: 2;
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 13px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 11px;
        background: rgba(255, 255, 255, 0.10);
        font-size: 16px;
    }

    .category-info-header h3 {
        position: relative;
        z-index: 2;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .category-info-header p {
        position: relative;
        z-index: 2;
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .category-info-body {
        padding: 20px;
    }

    .category-info-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .category-info-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .category-info-number {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 9px;
        font-weight: 700;
    }

    .category-info-item h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .category-info-item p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.6;
    }

    /* =========================================================
       CURRENT CATEGORY
    ========================================================= */

    .current-category {
        margin-top: 18px;
        padding: 15px;
        border: 1px dashed #dfcbd4;
        border-radius: 13px;
        background: #fdf8fa;
    }

    .current-category-label {
        display: block;
        margin-bottom: 10px;
        color: #9c8490;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .current-category-profile {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .current-category-avatar {
        width: 37px;
        height: 37px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #b35d7e);
        font-size: 12px;
        font-weight: 700;
    }

    .current-category-name {
        margin-bottom: 3px;
        color: #684455;
        font-size: 10px;
        font-weight: 700;
    }

    .current-category-id {
        color: #9d8792;
        font-size: 8px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 950px) {
        .category-edit-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .category-edit-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .category-edit-profile {
            align-items: flex-start;
        }

        .category-form-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .category-action-left,
        .category-action-right {
            width: 100%;
        }

        .category-btn-detail,
        .category-btn-cancel,
        .category-btn-update {
            flex: 1;
        }
    }

    @media (max-width: 500px) {
        .category-action-left,
        .category-action-right {
            flex-direction: column;
        }

        .category-btn-detail,
        .category-btn-cancel,
        .category-btn-update {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="category-edit-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="category-edit-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('categories.index') }}">
            Produk & Kategori
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('categories.show', $category) }}">
            {{ $category->name }}
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Edit</span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="category-edit-hero">

        <div class="category-edit-hero-content">

            <div class="category-edit-label">
                <span class="category-edit-dot"></span>
                Product Management
            </div>

            <h1>Edit Kategori Produk</h1>

            <p>
                Perbarui informasi kategori {{ $category->name }}
                agar pengelompokan produk IntanMitha Collection
                tetap jelas, terstruktur, dan mudah dikelola.
            </p>

        </div>


        <div class="category-edit-profile">

            <div class="category-edit-avatar">
                {{ strtoupper(substr($category->name, 0, 1)) }}
            </div>

            <span class="category-edit-code">
                CATEGORY #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
            </span>

        </div>

    </section>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <div class="category-edit-layout">

        {{-- =================================================
             FORM
        ================================================== --}}

        <section class="category-edit-card">

            <div class="category-edit-card-header">

                <div class="category-edit-header-icon">
                    ✎
                </div>

                <div>

                    <h3>Perbarui Informasi Kategori</h3>

                    <p>
                        Ubah data yang diperlukan kemudian simpan perubahan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('categories.update', $category) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="category-edit-card-body">

                    {{-- VALIDATION --}}

                    @if ($errors->any())

                        <div class="category-validation-alert">

                            <div class="category-validation-icon">
                                !
                            </div>

                            <div>

                                <h4>Perubahan belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali data kategori yang
                                    dimasukkan pada kolom di bawah ini.
                                </p>

                            </div>

                        </div>

                    @endif


                    <div class="category-form-section-title">

                        <span class="category-section-number">
                            01
                        </span>

                        Data Kategori

                    </div>


                    {{-- CATEGORY NAME --}}

                    <div class="category-form-group">

                        <label
                            for="name"
                            class="category-form-label"
                        >
                            Nama Kategori
                            <span class="category-required">*</span>
                        </label>


                        <div class="category-input-wrapper">

                            <span class="category-input-icon">
                                ◇
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $category->name) }}"
                                class="category-form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama kategori"
                                maxlength="255"
                                autocomplete="off"
                                required
                                autofocus
                            >

                        </div>


                        @error('name')

                            <div class="category-error-message">
                                <span>!</span>
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="category-field-help">
                            Nama kategori harus unik dan tidak boleh sama
                            dengan kategori lain yang sudah tersimpan.
                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="category-form-group">

                        <label
                            for="description"
                            class="category-form-label"
                        >
                            Deskripsi Kategori

                            <span class="category-optional">
                                Opsional
                            </span>
                        </label>


                        <textarea
                            id="description"
                            name="description"
                            class="category-form-control @error('description') is-invalid @enderror"
                            placeholder="Jelaskan jenis produk yang termasuk dalam kategori ini..."
                            maxlength="1000"
                        >{{ old('description', $category->description) }}</textarea>


                        @error('description')

                            <div class="category-error-message">
                                <span>!</span>
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="category-field-help">
                            Deskripsi dapat diperbarui agar isi kategori
                            semakin mudah dipahami.
                        </div>

                    </div>

                </div>


                {{-- =========================================
                     ACTION
                ========================================== --}}

                <div class="category-form-actions">

                    <div class="category-action-left">

                        <a
                            href="{{ route('categories.show', $category) }}"
                            class="category-btn-detail"
                        >
                            ◉
                            Lihat Detail
                        </a>

                    </div>


                    <div class="category-action-right">

                        <a
                            href="{{ route('categories.index') }}"
                            class="category-btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="category-btn-update"
                        >
                            ✓
                            Simpan Perubahan
                        </button>

                    </div>

                </div>

            </form>

        </section>


        {{-- =================================================
             INFORMATION
        ================================================== --}}

        <aside>

            <section class="category-edit-info-card">

                <div class="category-info-header">

                    <div class="category-info-header-icon">
                        ✦
                    </div>

                    <h3>Informasi Pengeditan</h3>

                    <p>
                        Perubahan kategori akan langsung digunakan
                        pada data produk yang terhubung.
                    </p>

                </div>


                <div class="category-info-body">

                    <div class="category-info-item">

                        <div class="category-info-number">
                            01
                        </div>

                        <div>

                            <h4>Nama Kategori</h4>

                            <p>
                                Gunakan nama yang jelas dan sesuai
                                dengan kelompok produk di dalamnya.
                            </p>

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-number">
                            02
                        </div>

                        <div>

                            <h4>Nama Harus Unik</h4>

                            <p>
                                Sistem tidak mengizinkan dua kategori
                                memiliki nama yang sama.
                            </p>

                        </div>

                    </div>


                    <div class="category-info-item">

                        <div class="category-info-number">
                            03
                        </div>

                        <div>

                            <h4>Produk Tetap Terhubung</h4>

                            <p>
                                Mengubah nama atau deskripsi kategori
                                tidak menghapus produk yang sudah
                                berada di dalam kategori tersebut.
                            </p>

                        </div>

                    </div>


                    <div class="current-category">

                        <span class="current-category-label">
                            Kategori yang Diedit
                        </span>


                        <div class="current-category-profile">

                            <div class="current-category-avatar">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>

                            <div>

                                <div class="current-category-name">
                                    {{ $category->name }}
                                </div>

                                <div class="current-category-id">
                                    CATEGORY #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection