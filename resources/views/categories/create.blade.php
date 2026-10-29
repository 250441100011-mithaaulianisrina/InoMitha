@extends('layouts.app')

@section('title', 'Tambah Kategori | InoMitha')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Tambahkan kategori baru untuk produk IntanMitha Collection')

@push('styles')
<style>
    .category-create-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .create-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .create-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .create-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .create-hero {
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

    .create-hero::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        top: -135px;
        right: 115px;
        border: 32px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .create-hero::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -45px;
        bottom: -85px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .create-hero-content {
        position: relative;
        z-index: 2;
        max-width: 660px;
    }

    .create-hero-label {
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

    .create-hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .create-hero h1 {
        margin-bottom: 8px;
        font-size: 27px;
        line-height: 1.3;
    }

    .create-hero p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 11px;
        line-height: 1.8;
    }

    .create-hero-icon {
        position: relative;
        z-index: 2;
        width: 79px;
        height: 79px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 23px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.11);
        font-size: 31px;
        backdrop-filter: blur(8px);
    }

    /* =========================================================
       LAYOUT
    ========================================================= */

    .create-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, 0.72fr);
        gap: 20px;
        align-items: start;
    }

    .create-form-card,
    .create-info-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    /* =========================================================
       FORM HEADER
    ========================================================= */

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .form-header-icon {
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

    .form-card-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .form-card-header p {
        color: #a18b96;
        font-size: 10px;
    }

    .form-card-body {
        padding: 25px 23px;
    }

    /* =========================================================
       VALIDATION
    ========================================================= */

    .validation-alert {
        display: flex;
        gap: 12px;
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f0d5dc;
        border-radius: 11px;
        color: #854455;
        background: #fff4f6;
    }

    .validation-alert-icon {
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

    .validation-alert h4 {
        margin-bottom: 4px;
        font-size: 10px;
    }

    .validation-alert p {
        color: #a36877;
        font-size: 9px;
        line-height: 1.6;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 20px;
        color: #664253;
        font-size: 11px;
        font-weight: 700;
    }

    .section-number {
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

    .form-group {
        margin-bottom: 20px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        color: #684757;
        font-size: 10px;
        font-weight: 700;
    }

    .required {
        margin-left: 2px;
        color: #bd5c75;
    }

    .optional {
        margin-left: 5px;
        color: #b09ca5;
        font-size: 8px;
        font-weight: 500;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        color: #a78495;
        font-size: 13px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-control-custom {
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

    .form-control-custom::placeholder {
        color: #b7a5ad;
    }

    .form-control-custom:focus {
        border-color: #c47c98;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(143, 70, 103, 0.07);
    }

    .form-control-custom.is-invalid {
        border-color: #d77b8d;
        background: #fffafb;
    }

    textarea.form-control-custom {
        min-height: 145px;
        padding: 13px 14px;
        line-height: 1.7;
        resize: vertical;
    }

    .field-help {
        margin-top: 6px;
        color: #a6929c;
        font-size: 8px;
        line-height: 1.6;
    }

    .error-message {
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

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .btn-cancel,
    .btn-save-category {
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

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #826978;
        background: #ffffff;
    }

    .btn-cancel:hover {
        color: #653d51;
        background: #faf4f7;
    }

    .btn-save-category {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #aa5577);
        box-shadow: 0 7px 17px rgba(143, 70, 103, 0.17);
    }

    .btn-save-category:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143, 70, 103, 0.23);
    }

    /* =========================================================
       INFORMATION CARD
    ========================================================= */

    .info-card-header {
        position: relative;
        overflow: hidden;
        padding: 21px;
        color: #ffffff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .info-card-header::after {
        content: "◇";
        position: absolute;
        right: -8px;
        bottom: -32px;
        color: rgba(255, 255, 255, 0.07);
        font-size: 100px;
    }

    .info-header-icon {
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

    .info-card-header h3 {
        position: relative;
        z-index: 2;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .info-card-header p {
        position: relative;
        z-index: 2;
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .info-card-body {
        padding: 20px;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .info-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-item-icon {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 10px;
        font-weight: 700;
    }

    .info-item h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .info-item p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.6;
    }

    /* =========================================================
       EXAMPLE
    ========================================================= */

    .category-example {
        margin-top: 18px;
        padding: 15px;
        border: 1px dashed #dfcbd4;
        border-radius: 13px;
        background: #fdf8fa;
    }

    .category-example-label {
        display: block;
        margin-bottom: 10px;
        color: #9c8490;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .example-category {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .example-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #b35d7e);
        font-size: 14px;
    }

    .example-category h4 {
        margin-bottom: 3px;
        color: #684455;
        font-size: 10px;
    }

    .example-category p {
        color: #9d8792;
        font-size: 8px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 950px) {
        .create-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .create-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .create-hero-icon {
            width: 65px;
            height: 65px;
            border-radius: 19px;
            font-size: 25px;
        }

        .form-actions {
            align-items: stretch;
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-save-category {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="category-create-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="create-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('categories.index') }}">
            Produk & Kategori
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>
            Tambah Kategori
        </span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="create-hero">

        <div class="create-hero-content">

            <div class="create-hero-label">
                <span class="create-hero-dot"></span>
                Product Management
            </div>

            <h1>Tambah Kategori Baru</h1>

            <p>
                Buat kategori untuk mengelompokkan produk
                IntanMitha Collection agar katalog dan persediaan
                dapat dikelola secara lebih terstruktur.
            </p>

        </div>


        <div class="create-hero-icon">
            ◇
        </div>

    </section>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <div class="create-layout">

        {{-- =================================================
             FORM CARD
        ================================================== --}}

        <section class="create-form-card">

            <div class="form-card-header">

                <div class="form-header-icon">
                    +
                </div>

                <div>

                    <h3>Informasi Kategori</h3>

                    <p>
                        Lengkapi data kategori produk yang akan ditambahkan.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('categories.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-card-body">

                    {{-- =====================================
                         VALIDATION
                    ====================================== --}}

                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-alert-icon">
                                !
                            </div>

                            <div>

                                <h4>Kategori belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali data yang dimasukkan
                                    pada kolom di bawah ini.
                                </p>

                            </div>

                        </div>

                    @endif


                    <div class="form-section-title">

                        <span class="section-number">
                            01
                        </span>

                        Data Kategori

                    </div>


                    {{-- =====================================
                         CATEGORY NAME
                    ====================================== --}}

                    <div class="form-group">

                        <label
                            for="name"
                            class="form-label"
                        >
                            Nama Kategori
                            <span class="required">*</span>
                        </label>


                        <div class="input-wrapper">

                            <span class="input-icon">
                                ◇
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control-custom @error('name') is-invalid @enderror"
                                placeholder="Contoh: Aksesoris Rambut"
                                maxlength="255"
                                autocomplete="off"
                                required
                                autofocus
                            >

                        </div>


                        @error('name')

                            <div class="error-message">
                                <span>!</span>
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="field-help">
                            Nama kategori harus unik dan tidak boleh sama
                            dengan kategori yang sudah tersimpan.
                        </div>

                    </div>


                    {{-- =====================================
                         DESCRIPTION
                    ====================================== --}}

                    <div class="form-group">

                        <label
                            for="description"
                            class="form-label"
                        >
                            Deskripsi Kategori

                            <span class="optional">
                                Opsional
                            </span>
                        </label>


                        <textarea
                            id="description"
                            name="description"
                            class="form-control-custom @error('description') is-invalid @enderror"
                            placeholder="Jelaskan jenis produk yang termasuk dalam kategori ini..."
                            maxlength="1000"
                        >{{ old('description') }}</textarea>


                        @error('description')

                            <div class="error-message">
                                <span>!</span>
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="field-help">
                            Deskripsi dapat membantu menjelaskan
                            pengelompokan produk dalam kategori ini.
                        </div>

                    </div>

                </div>


                {{-- =========================================
                     ACTION
                ========================================== --}}

                <div class="form-actions">

                    <a
                        href="{{ route('categories.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="btn-save-category"
                    >
                        ✓
                        Simpan Kategori
                    </button>

                </div>

            </form>

        </section>


        {{-- =================================================
             INFORMATION CARD
        ================================================== --}}

        <aside>

            <section class="create-info-card">

                <div class="info-card-header">

                    <div class="info-header-icon">
                        ✦
                    </div>

                    <h3>Tentang Kategori Produk</h3>

                    <p>
                        Kategori menjadi dasar pengelompokan produk
                        dalam sistem InoMitha.
                    </p>

                </div>


                <div class="info-card-body">

                    <div class="info-item">

                        <div class="info-item-icon">
                            01
                        </div>

                        <div>

                            <h4>Pengelompokan Produk</h4>

                            <p>
                                Setiap produk nantinya akan ditempatkan
                                pada salah satu kategori yang tersedia.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">
                            02
                        </div>

                        <div>

                            <h4>Nama Harus Unik</h4>

                            <p>
                                Dua kategori tidak dapat menggunakan
                                nama yang sama agar data tetap terstruktur.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-item-icon">
                            03
                        </div>

                        <div>

                            <h4>Terhubung dengan Produk</h4>

                            <p>
                                Kategori akan digunakan ketika kita
                                menambahkan produk pada tahap berikutnya.
                            </p>

                        </div>

                    </div>


                    <div class="category-example">

                        <span class="category-example-label">
                            Contoh Kategori
                        </span>

                        <div class="example-category">

                            <div class="example-icon">
                                ◇
                            </div>

                            <div>

                                <h4>Aksesoris Rambut</h4>

                                <p>
                                    Scrunchie, hair clip, headband, dan lainnya.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection