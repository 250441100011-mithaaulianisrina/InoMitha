@extends('layouts.app')

@section('title', 'Edit Pelanggan | InoMitha')
@section('page-title', 'Edit Pelanggan')
@section('page-subtitle', 'Perbarui informasi pelanggan IntanMitha Collection')

@push('styles')
<style>
    .customer-edit-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .edit-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9a8490;
        font-size: 10px;
    }

    .edit-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s;
    }

    .edit-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c5b6bd;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .edit-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 180px;
        margin-bottom: 22px;
        padding: 32px 35px;
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
                #593247 0%,
                #81405e 52%,
                #b45d80 100%
            );
        box-shadow: 0 16px 42px rgba(89, 48, 68, 0.15);
    }

    .edit-hero::before {
        content: "";
        position: absolute;
        width: 205px;
        height: 205px;
        top: -130px;
        right: 110px;
        border: 31px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .edit-hero::after {
        content: "";
        position: absolute;
        width: 155px;
        height: 155px;
        right: -45px;
        bottom: -80px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
    }

    .edit-hero-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }

    .edit-hero-label {
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

    .edit-hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f7d4e1;
        box-shadow: 0 0 0 4px rgba(247, 212, 225, 0.12);
    }

    .edit-hero h1 {
        margin-bottom: 8px;
        font-size: 26px;
        line-height: 1.3;
    }

    .edit-hero p {
        max-width: 600px;
        color: #f4e5eb;
        font-size: 11px;
        line-height: 1.8;
    }

    .edit-hero-profile {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .edit-avatar {
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
        backdrop-filter: blur(7px);
    }

    .edit-profile-code {
        padding: 5px 8px;
        border-radius: 20px;
        color: #f5e5ec;
        background: rgba(255, 255, 255, 0.09);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .edit-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(260px, 0.7fr);
        gap: 20px;
        align-items: start;
    }

    .edit-card,
    .side-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    /* =========================================================
       FORM CARD
    ========================================================= */

    .edit-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 21px 23px;
        border-bottom: 1px solid #f2e8ec;
    }

    .edit-header-icon {
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

    .edit-card-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .edit-card-header p {
        color: #a18b96;
        font-size: 10px;
    }

    .edit-card-body {
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
        transition: 0.2s;
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

    .form-control-custom.code-input {
        color: #754058;
        background: #faf5f7;
        font-weight: 700;
        letter-spacing: 0.7px;
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
       ACTIONS
    ========================================================= */

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .action-left,
    .action-right {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .btn-detail,
    .btn-cancel,
    .btn-update {
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

    .btn-detail {
        border: 1px solid #e5d9df;
        color: #755568;
        background: #ffffff;
    }

    .btn-detail:hover,
    .btn-cancel:hover {
        color: #653d51;
        background: #faf4f7;
    }

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #826978;
        background: #ffffff;
    }

    .btn-update {
        border: 1px solid #8f4667;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #aa5577);
        box-shadow: 0 7px 17px rgba(143, 70, 103, 0.17);
    }

    .btn-update:hover {
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(143, 70, 103, 0.23);
    }

    /* =========================================================
       SIDE PANEL
    ========================================================= */

    .side-card-header {
        position: relative;
        overflow: hidden;
        padding: 21px;
        color: #ffffff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .side-card-header::after {
        content: "✦";
        position: absolute;
        right: -4px;
        bottom: -27px;
        color: rgba(255, 255, 255, 0.07);
        font-size: 85px;
    }

    .side-header-icon {
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

    .side-card-header h3 {
        position: relative;
        z-index: 2;
        margin-bottom: 5px;
        font-size: 13px;
    }

    .side-card-header p {
        position: relative;
        z-index: 2;
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .side-card-body {
        padding: 20px;
    }

    .side-info {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .side-info:last-child {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .side-info-icon {
        width: 28px;
        height: 28px;
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

    .side-info h4 {
        margin-bottom: 4px;
        color: #674555;
        font-size: 10px;
    }

    .side-info p {
        color: #9e8993;
        font-size: 9px;
        line-height: 1.6;
    }

    .customer-mini-profile {
        margin-top: 17px;
        padding: 15px;
        border: 1px dashed #dfcbd4;
        border-radius: 13px;
        background: #fdf8fa;
    }

    .mini-profile-label {
        display: block;
        margin-bottom: 9px;
        color: #9c8490;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .mini-profile-main {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mini-avatar {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #ffffff;
        background: linear-gradient(135deg, #8f4667, #b35d7e);
        font-size: 11px;
        font-weight: 700;
    }

    .mini-profile-name {
        margin-bottom: 3px;
        color: #684455;
        font-size: 10px;
        font-weight: 700;
    }

    .mini-profile-code {
        color: #9d8792;
        font-size: 8px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 950px) {
        .edit-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .edit-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .edit-hero-profile {
            align-items: flex-start;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .action-left,
        .action-right {
            width: 100%;
        }

        .btn-detail,
        .btn-cancel,
        .btn-update {
            flex: 1;
        }
    }

    @media (max-width: 500px) {
        .action-left,
        .action-right {
            flex-direction: column;
        }

        .btn-detail,
        .btn-cancel,
        .btn-update {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="customer-edit-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="edit-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('customers.index') }}">
            Pelanggan
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('customers.show', $customer) }}">
            {{ $customer->customer_code }}
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Edit</span>

    </div>


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <section class="edit-hero">

        <div class="edit-hero-content">

            <div class="edit-hero-label">
                <span class="edit-hero-dot"></span>
                Customer Relationship Management
            </div>

            <h1>Edit Data Pelanggan</h1>

            <p>
                Perbarui informasi {{ $customer->name }} agar data pelanggan
                yang tersimpan di CRM InoMitha tetap akurat dan dapat
                digunakan dalam pengelolaan hubungan pelanggan.
            </p>

        </div>


        <div class="edit-hero-profile">

            <div class="edit-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>

            <span class="edit-profile-code">
                {{ $customer->customer_code }}
            </span>

        </div>

    </section>


    {{-- =====================================================
         EDIT LAYOUT
    ====================================================== --}}

    <div class="edit-layout">

        {{-- =================================================
             FORM
        ================================================== --}}

        <section class="edit-card">

            <div class="edit-card-header">

                <div class="edit-header-icon">
                    ✎
                </div>

                <div>
                    <h3>Perbarui Informasi Pelanggan</h3>

                    <p>
                        Ubah data yang diperlukan kemudian simpan perubahan.
                    </p>
                </div>

            </div>


            <form
                action="{{ route('customers.update', $customer) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="edit-card-body">

                    {{-- =====================================
                         VALIDATION
                    ====================================== --}}

                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-alert-icon">
                                !
                            </div>

                            <div>

                                <h4>Perubahan belum dapat disimpan</h4>

                                <p>
                                    Periksa kembali kolom yang ditandai
                                    dan pastikan data yang dimasukkan sudah benar.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- =====================================
                         IDENTITAS
                    ====================================== --}}

                    <div class="form-section-title">

                        <span class="section-number">
                            01
                        </span>

                        Identitas Pelanggan

                    </div>


                    <div class="form-grid">

                        {{-- CUSTOMER CODE --}}

                        <div class="form-group">

                            <label
                                for="customer_code"
                                class="form-label"
                            >
                                Kode Pelanggan
                                <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    #
                                </span>

                                <input
                                    type="text"
                                    id="customer_code"
                                    name="customer_code"
                                    value="{{ old('customer_code', $customer->customer_code) }}"
                                    class="form-control-custom code-input @error('customer_code') is-invalid @enderror"
                                    maxlength="255"
                                    required
                                >

                            </div>

                            @error('customer_code')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Kode ini merupakan identitas unik pelanggan.
                            </div>

                        </div>


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
                                    value="{{ old('name', $customer->name) }}"
                                    class="form-control-custom @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama pelanggan"
                                    maxlength="255"
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
                                Gunakan nama pelanggan yang benar dan mudah dikenali.
                            </div>

                        </div>

                    </div>


                    <div class="form-divider"></div>


                    {{-- =====================================
                         CONTACT
                    ====================================== --}}

                    <div class="form-section-title">

                        <span class="section-number">
                            02
                        </span>

                        Informasi Kontak

                    </div>


                    <div class="form-grid">

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
                                    value="{{ old('phone', $customer->phone) }}"
                                    class="form-control-custom @error('phone') is-invalid @enderror"
                                    placeholder="Contoh: 081234567890"
                                    maxlength="30"
                                >

                            </div>

                            @error('phone')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- EMAIL --}}

                        <div class="form-group">

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
                                    value="{{ old('email', $customer->email) }}"
                                    class="form-control-custom @error('email') is-invalid @enderror"
                                    placeholder="Contoh: pelanggan@email.com"
                                    maxlength="255"
                                >

                            </div>

                            @error('email')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

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
                            >{{ old('address', $customer->address) }}</textarea>

                            @error('address')
                                <div class="error-message">
                                    <span>!</span>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="field-help">
                                Perbarui alamat apabila informasi pelanggan berubah.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================================
                     ACTIONS
                ========================================== --}}

                <div class="form-actions">

                    <div class="action-left">

                        <a
                            href="{{ route('customers.show', $customer) }}"
                            class="btn-detail"
                        >
                            ◉
                            Lihat Detail
                        </a>

                    </div>


                    <div class="action-right">

                        <a
                            href="{{ route('customers.index') }}"
                            class="btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-update"
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

            <section class="side-card">

                <div class="side-card-header">

                    <div class="side-header-icon">
                        ✦
                    </div>

                    <h3>Informasi Pengeditan</h3>

                    <p>
                        Pastikan perubahan data pelanggan sesuai dengan
                        informasi terbaru yang dimiliki IntanMitha Collection.
                    </p>

                </div>


                <div class="side-card-body">

                    <div class="side-info">

                        <div class="side-info-icon">
                            01
                        </div>

                        <div>

                            <h4>Periksa Data</h4>

                            <p>
                                Pastikan nama, nomor telepon, email,
                                dan alamat pelanggan sudah sesuai.
                            </p>

                        </div>

                    </div>


                    <div class="side-info">

                        <div class="side-info-icon">
                            02
                        </div>

                        <div>

                            <h4>Kode Pelanggan</h4>

                            <p>
                                Kode pelanggan harus tetap unik agar
                                setiap pelanggan dapat dibedakan di sistem.
                            </p>

                        </div>

                    </div>


                    <div class="side-info">

                        <div class="side-info-icon">
                            03
                        </div>

                        <div>

                            <h4>Riwayat Tetap Tersimpan</h4>

                            <p>
                                Memperbarui profil pelanggan tidak menghapus
                                riwayat transaksi yang sudah terhubung.
                            </p>

                        </div>

                    </div>


                    <div class="customer-mini-profile">

                        <span class="mini-profile-label">
                            Pelanggan yang Diedit
                        </span>

                        <div class="mini-profile-main">

                            <div class="mini-avatar">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>

                            <div>

                                <div class="mini-profile-name">
                                    {{ $customer->name }}
                                </div>

                                <div class="mini-profile-code">
                                    {{ $customer->customer_code }}
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