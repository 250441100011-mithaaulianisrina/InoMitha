@extends('layouts.app')

@section('title', 'Tambah Pelanggan | InoMitha')
@section('page-title', 'Tambah Pelanggan')
@section('page-subtitle', 'Tambahkan pelanggan baru ke CRM IntanMitha Collection')

@push('styles')
<style>
    .customer-form-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #9a8490;
        font-size: 10px;
    }

    .breadcrumb-custom a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s;
    }

    .breadcrumb-custom a:hover {
        color: #68364e;
    }

    .breadcrumb-separator {
        color: #c5b6bd;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .form-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 175px;
        margin-bottom: 22px;
        padding: 31px 34px;
        border-radius: 22px;
        color: #ffffff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255, 255, 255, 0.15),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #5b3348 0%,
                #82405e 52%,
                #b45d80 100%
            );
        box-shadow: 0 16px 40px rgba(89, 48, 68, 0.15);
    }

    .form-hero::before {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        top: -120px;
        right: 105px;
        border: 30px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .form-hero::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: -45px;
        bottom: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .hero-copy {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }

    .hero-label {
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

    .hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .form-hero h1 {
        margin-bottom: 9px;
        font-size: 26px;
        line-height: 1.3;
    }

    .form-hero p {
        max-width: 590px;
        color: #f4e5eb;
        font-size: 11px;
        line-height: 1.8;
    }

    .hero-icon {
        position: relative;
        z-index: 2;
        width: 88px;
        height: 88px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.09);
        font-size: 35px;
        transform: rotate(5deg);
    }

    .hero-icon span {
        transform: rotate(-5deg);
    }

    /* =========================================================
       LAYOUT
    ========================================================= */

    .form-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, 0.7fr);
        gap: 20px;
        align-items: start;
    }

    .form-card,
    .information-card {
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .header-icon {
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
       FORM
    ========================================================= */

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 18px;
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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-group {
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
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
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a78495;
        font-size: 13px;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .form-control-custom {
        width: 100%;
        min-height: 43px;
        padding: 0 13px 0 38px;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        outline: none;
        color: #604050;
        background: #fefcfd;
        font-size: 10px;
        transition:
            border-color 0.2s,
            box-shadow 0.2s,
            background 0.2s;
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
        min-height: 115px;
        padding: 13px 14px;
        line-height: 1.7;
        resize: vertical;
    }

    .field-help {
        margin-top: 6px;
        color: #a6929c;
        font-size: 8px;
        line-height: 1.5;
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

    .form-divider {
        height: 1px;
        margin: 25px 0;
        background: #f1e7eb;
    }

    /* =========================================================
       ERROR SUMMARY
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
        color: #a7495e;
        background: #f8dde4;
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
       ACTION BUTTONS
    ========================================================= */

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        border-radius: 0 0 19px 19px;
        background: #fefcfd;
    }

    .btn-cancel,
    .btn-save {
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
        transition: 0.2s;
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

    .btn-save {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: linear-gradient(
            135deg,
            #8f4667,
            #a95476
        );
        box-shadow: 0 7px 17px rgba(143, 70, 103, 0.17);
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143, 70, 103, 0.23);
    }

    /* =========================================================
       RIGHT SIDE INFORMATION
    ========================================================= */

    .information-card {
        overflow: hidden;
    }

    .information-header {
        padding: 20px;
        color: #ffffff;
        background: linear-gradient(
            135deg,
            #6a394f,
            #914866
        );
    }

    .information-header-icon {
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 13px;
        border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 11px;
        background: rgba(255, 255, 255, 0.10);
        font-size: 17px;
    }

    .information-header h3 {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .information-header p {
        color: #ead6df;
        font-size: 9px;
        line-height: 1.6;
    }

    .information-body {
        padding: 20px;
    }

    .information-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .information-item:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .information-number {
        width: 27px;
        height: 27px;
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

    .information-item h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .information-item p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.6;
    }

    /* =========================================================
       CODE PREVIEW
    ========================================================= */

    .code-preview-card {
        margin-top: 17px;
        padding: 17px;
        border: 1px dashed #dfcbd4;
        border-radius: 14px;
        background: #fdf8fa;
    }

    .code-preview-label {
        display: block;
        margin-bottom: 7px;
        color: #9d8490;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .code-preview-value {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .code-preview-value strong {
        color: #754058;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .automatic-badge {
        padding: 5px 7px;
        border-radius: 20px;
        color: #875269;
        background: #f3e4ea;
        font-size: 8px;
        font-weight: 700;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 950px) {
        .form-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .form-hero {
            padding: 27px 23px;
        }

        .hero-icon {
            display: none;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-card-body {
            padding: 21px 18px;
        }

        .form-actions {
            align-items: stretch;
            flex-direction: column-reverse;
            padding: 17px 18px;
        }

        .btn-cancel,
        .btn-save {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="customer-form-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="breadcrumb-custom">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('customers.index') }}">
            Pelanggan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>
            Tambah Pelanggan
        </span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="form-hero">

        <div class="hero-copy">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Customer Relationship Management
            </div>

            <h1>Tambah Pelanggan Baru</h1>

            <p>
                Lengkapi informasi pelanggan untuk menyimpan data
                pelanggan baru ke dalam CRM InoMitha. Data ini nantinya
                dapat terhubung dengan riwayat transaksi pelanggan.
            </p>

        </div>

        <div class="hero-icon">
            <span>♙+</span>
        </div>

    </section>


    {{-- =====================================================
         FORM LAYOUT
    ====================================================== --}}

    <div class="form-layout">

        {{-- =================================================
             LEFT - FORM
        ================================================== --}}

        <section class="form-card">

            <div class="form-card-header">

                <div class="header-icon">
                    ✦
                </div>

                <div>
                    <h3>Informasi Pelanggan</h3>
                    <p>
                        Masukkan data pelanggan dengan lengkap dan benar.
                    </p>
                </div>

            </div>


            <form
                action="{{ route('customers.store') }}"
                method="POST"
            >

                @csrf

                <div class="form-card-body">

                    {{-- VALIDATION SUMMARY --}}

                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-alert-icon">
                                !
                            </div>

                            <div>
                                <h4>Data belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali kolom yang ditandai
                                    dan pastikan data yang dimasukkan sudah benar.
                                </p>
                            </div>

                        </div>

                    @endif


                    {{-- =====================================
                         PERSONAL INFORMATION
                    ====================================== --}}

                    <div class="form-section-title">

                        <span class="section-number">
                            01
                        </span>

                        Identitas Pelanggan

                    </div>


                    <div class="form-grid">

                        {{-- NAME --}}

                        <div class="form-group">

                            <label
                                for="name"
                                class="form-label"
                            >
                                Nama Pelanggan
                                <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    ♙
                                </span>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control-custom @error('name') is-invalid @enderror"
                                    placeholder="Contoh: Alya Putri"
                                    maxlength="255"
                                    autocomplete="off"
                                    required
                                >

                            </div>

                            @error('name')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Masukkan nama lengkap pelanggan.
                            </div>

                        </div>


                        {{-- PHONE --}}

                        <div class="form-group">

                            <label
                                for="phone"
                                class="form-label"
                            >
                                Nomor Telepon

                                <span class="optional">
                                    Opsional
                                </span>
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    ☎
                                </span>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control-custom @error('phone') is-invalid @enderror"
                                    placeholder="Contoh: 081234567890"
                                    maxlength="30"
                                    autocomplete="off"
                                >

                            </div>

                            @error('phone')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Nomor yang dapat digunakan untuk menghubungi pelanggan.
                            </div>

                        </div>

                    </div>


                    <div class="form-divider"></div>


                    {{-- =====================================
                         CONTACT INFORMATION
                    ====================================== --}}

                    <div class="form-section-title">

                        <span class="section-number">
                            02
                        </span>

                        Informasi Kontak

                    </div>


                    <div class="form-grid">

                        {{-- EMAIL --}}

                        <div class="form-group full">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email Pelanggan

                                <span class="optional">
                                    Opsional
                                </span>
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    @
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control-custom @error('email') is-invalid @enderror"
                                    placeholder="Contoh: pelanggan@email.com"
                                    maxlength="255"
                                    autocomplete="off"
                                >

                            </div>

                            @error('email')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Email dapat digunakan sebagai informasi kontak tambahan.
                            </div>

                        </div>


                        {{-- ADDRESS --}}

                        <div class="form-group full">

                            <label
                                for="address"
                                class="form-label"
                            >
                                Alamat Pelanggan

                                <span class="optional">
                                    Opsional
                                </span>
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                class="form-control-custom @error('address') is-invalid @enderror"
                                placeholder="Masukkan alamat pelanggan..."
                                maxlength="1000"
                            >{{ old('address') }}</textarea>

                            @error('address')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Tuliskan alamat pelanggan apabila tersedia.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================================
                     ACTIONS
                ========================================== --}}

                <div class="form-actions">

                    <a
                        href="{{ route('customers.index') }}"
                        class="btn-cancel"
                    >
                        ←
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn-save"
                    >
                        <span>✓</span>
                        Simpan Pelanggan
                    </button>

                </div>

            </form>

        </section>


        {{-- =================================================
             RIGHT - INFORMATION
        ================================================== --}}

        <aside>

            <section class="information-card">

                <div class="information-header">

                    <div class="information-header-icon">
                        ✦
                    </div>

                    <h3>CRM InoMitha</h3>

                    <p>
                        Data pelanggan menjadi dasar pengelolaan hubungan
                        pelanggan dan histori pembelian di IntanMitha Collection.
                    </p>

                </div>


                <div class="information-body">

                    <div class="information-item">

                        <div class="information-number">
                            01
                        </div>

                        <div>
                            <h4>Kode Otomatis</h4>

                            <p>
                                Kode pelanggan dibuat otomatis oleh sistem,
                                sehingga tidak perlu dimasukkan secara manual.
                            </p>
                        </div>

                    </div>


                    <div class="information-item">

                        <div class="information-number">
                            02
                        </div>

                        <div>
                            <h4>Informasi Fleksibel</h4>

                            <p>
                                Hanya nama pelanggan yang wajib diisi.
                                Telepon, email, dan alamat dapat dilengkapi
                                apabila informasinya tersedia.
                            </p>
                        </div>

                    </div>


                    <div class="information-item">

                        <div class="information-number">
                            03
                        </div>

                        <div>
                            <h4>Terhubung Transaksi</h4>

                            <p>
                                Setelah modul penjualan selesai, setiap
                                transaksi dapat dikaitkan dengan pelanggan
                                untuk membentuk riwayat pembelian.
                            </p>
                        </div>

                    </div>


                    <div class="code-preview-card">

                        <span class="code-preview-label">
                            Format Kode Pelanggan
                        </span>

                        <div class="code-preview-value">

                            <strong>
                                CUST001
                            </strong>

                            <span class="automatic-badge">
                                OTOMATIS
                            </span>

                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection