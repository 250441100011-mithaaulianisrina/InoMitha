@extends('layouts.app')

@section('title', 'Detail Pelanggan | InoMitha')
@section('page-title', 'Detail Pelanggan')
@section('page-subtitle', 'Profil dan riwayat pelanggan IntanMitha Collection')

@push('styles')
<style>
    .customer-detail-page {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .detail-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .detail-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .detail-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-divider {
        color: #c7b7bf;
    }

    /* =========================================================
       PROFILE HERO
    ========================================================= */

    .profile-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        min-height: 215px;
        padding: 34px 37px;
        margin-bottom: 21px;
        border-radius: 24px;
        color: #ffffff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255, 255, 255, 0.17),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #573246 0%,
                #80405d 50%,
                #b55c7f 100%
            );
        box-shadow: 0 17px 45px rgba(84, 45, 64, 0.16);
    }

    .profile-hero::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        top: -145px;
        right: 115px;
        border: 34px solid rgba(255, 255, 255, 0.055);
        border-radius: 50%;
    }

    .profile-hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        right: -45px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.065);
    }

    .profile-main {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .profile-avatar {
        width: 82px;
        height: 82px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.20);
        border-radius: 24px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.13);
        box-shadow: inset 0 0 0 5px rgba(255, 255, 255, 0.035);
        font-size: 29px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 10px;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, 0.17);
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .profile-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f7d6e2;
        box-shadow: 0 0 0 4px rgba(247, 214, 226, 0.11);
    }

    .profile-name {
        margin-bottom: 7px;
        font-size: 26px;
        line-height: 1.25;
    }

    .profile-code {
        color: #efdce5;
        font-size: 11px;
        letter-spacing: 0.7px;
    }

    .profile-actions {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .hero-button {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 14px;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .hero-button-edit {
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #6e3a52;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(59, 26, 42, 0.12);
    }

    .hero-button-edit:hover {
        color: #6e3a52;
        transform: translateY(-2px);
    }

    .hero-button-back {
        border: 1px solid rgba(255, 255, 255, 0.20);
        color: #ffffff;
        background: rgba(255, 255, 255, 0.09);
    }

    .hero-button-back:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 21px;
    }

    .summary-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 15px;
        min-height: 100px;
        padding: 19px;
        border: 1px solid #eee3e8;
        border-radius: 17px;
        background: #ffffff;
        box-shadow: 0 7px 25px rgba(80, 46, 62, 0.045);
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 75px;
        height: 75px;
        right: -31px;
        bottom: -36px;
        border-radius: 50%;
        background: #fbf1f5;
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
        font-size: 17px;
    }

    .summary-content {
        position: relative;
        z-index: 2;
        min-width: 0;
    }

    .summary-label {
        display: block;
        margin-bottom: 6px;
        color: #9e8993;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .summary-value {
        color: #583748;
        font-size: 19px;
        font-weight: 700;
    }

    .summary-value.small {
        font-size: 13px;
    }

    /* =========================================================
       DETAIL GRID
    ========================================================= */

    .detail-grid {
        display: grid;
        grid-template-columns: minmax(270px, 0.72fr) minmax(0, 1.55fr);
        gap: 20px;
        align-items: start;
    }

    .detail-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #ffffff;
        box-shadow: 0 9px 30px rgba(80, 46, 62, 0.05);
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 19px 21px;
        border-bottom: 1px solid #f2e8ec;
    }

    .detail-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .detail-heading-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 15px;
    }

    .detail-heading h3 {
        margin-bottom: 4px;
        color: #5c394b;
        font-size: 13px;
    }

    .detail-heading p {
        color: #a08b95;
        font-size: 9px;
    }

    .detail-card-body {
        padding: 21px;
    }

    /* =========================================================
       CUSTOMER INFORMATION
    ========================================================= */

    .info-list {
        display: flex;
        flex-direction: column;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f2e9ed;
    }

    .info-item:first-child {
        padding-top: 0;
    }

    .info-item:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .info-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #98607a;
        background: #faf0f4;
        font-size: 12px;
    }

    .info-content {
        min-width: 0;
    }

    .info-label {
        display: block;
        margin-bottom: 5px;
        color: #a18c96;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .info-value {
        color: #644454;
        font-size: 10px;
        font-weight: 600;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .info-empty {
        color: #ad9ba4;
        font-weight: 400;
        font-style: italic;
    }

    /* =========================================================
       CRM NOTE
    ========================================================= */

    .crm-note {
        position: relative;
        overflow: hidden;
        margin-top: 17px;
        padding: 17px;
        border-radius: 14px;
        color: #ffffff;
        background: linear-gradient(
            135deg,
            #694054,
            #92516d
        );
    }

    .crm-note::after {
        content: "✦";
        position: absolute;
        right: 7px;
        bottom: -25px;
        color: rgba(255, 255, 255, 0.07);
        font-size: 80px;
    }

    .crm-note-label {
        position: relative;
        z-index: 2;
        display: inline-block;
        margin-bottom: 7px;
        color: #f4dce6;
        font-size: 8px;
        font-weight: 700;
        letter-spacing: 0.7px;
        text-transform: uppercase;
    }

    .crm-note p {
        position: relative;
        z-index: 2;
        color: #f1e1e8;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       TRANSACTION TABLE
    ========================================================= */

    .history-count {
        padding: 6px 9px;
        border-radius: 20px;
        color: #875269;
        background: #f7e9ef;
        font-size: 8px;
        font-weight: 700;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .history-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .history-table thead {
        background: #fdfafb;
    }

    .history-table th {
        padding: 12px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9b8490;
        font-size: 8px;
        font-weight: 700;
        text-align: left;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .history-table td {
        padding: 14px;
        border-bottom: 1px solid #f3eaee;
        color: #674757;
        font-size: 9px;
        vertical-align: middle;
    }

    .history-table tbody tr:last-child td {
        border-bottom: none;
    }

    .history-table tbody tr:hover {
        background: #fefafb;
    }

    .invoice-code {
        color: #78415b;
        font-weight: 700;
    }

    .transaction-total {
        color: #5d3d4d;
        font-weight: 700;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 20px;
        font-size: 8px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-completed {
        color: #497158;
        background: #edf7f0;
    }

    .status-other {
        color: #876747;
        background: #fbf3e9;
    }

    .status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       EMPTY TRANSACTIONS
    ========================================================= */

    .history-empty {
        padding: 48px 22px;
        text-align: center;
    }

    .history-empty-icon {
        width: 62px;
        height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        border: 1px solid #efdee5;
        border-radius: 18px;
        color: #995571;
        background: #f9ecf1;
        font-size: 23px;
    }

    .history-empty h4 {
        margin-bottom: 6px;
        color: #624152;
        font-size: 12px;
    }

    .history-empty p {
        max-width: 390px;
        margin: auto;
        color: #9f8994;
        font-size: 9px;
        line-height: 1.7;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 800px) {
        .profile-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-actions {
            width: 100%;
        }

        .hero-button {
            flex: 1;
        }

        .summary-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .profile-hero {
            padding: 27px 23px;
        }

        .profile-main {
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-avatar {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            font-size: 24px;
        }

        .profile-name {
            font-size: 22px;
        }

        .profile-actions {
            flex-direction: column;
        }

        .hero-button {
            width: 100%;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush


@section('content')

<div class="customer-detail-page">

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="detail-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-divider">/</span>

        <a href="{{ route('customers.index') }}">
            Pelanggan
        </a>

        <span class="breadcrumb-divider">/</span>

        <span>
            {{ $customer->customer_code }}
        </span>

    </div>


    {{-- =====================================================
         CUSTOMER PROFILE HERO
    ====================================================== --}}

    <section class="profile-hero">

        <div class="profile-main">

            <div class="profile-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>

            <div>

                <div class="profile-badge">
                    <span class="profile-badge-dot"></span>
                    Customer Profile
                </div>

                <h1 class="profile-name">
                    {{ $customer->name }}
                </h1>

                <div class="profile-code">
                    {{ $customer->customer_code }}
                    · Pelanggan IntanMitha Collection
                </div>

            </div>

        </div>


        <div class="profile-actions">

            <a
                href="{{ route('customers.index') }}"
                class="hero-button hero-button-back"
            >
                ←
                Daftar Pelanggan
            </a>

            <a
                href="{{ route('customers.edit', $customer) }}"
                class="hero-button hero-button-edit"
            >
                ✎
                Edit Pelanggan
            </a>

        </div>

    </section>


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <section class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                ▤
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Total Transaksi
                </span>

                <div class="summary-value">
                    {{ number_format($totalTransactions) }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                Rp
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Total Pembelian
                </span>

                <div class="summary-value">
                    Rp {{ number_format($totalPurchases, 0, ',', '.') }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                Ø
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Rata-rata Transaksi
                </span>

                <div class="summary-value">
                    Rp {{ number_format($averagePurchase, 0, ',', '.') }}
                </div>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                ♙
            </div>

            <div class="summary-content">

                <span class="summary-label">
                    Status Pelanggan
                </span>

                <div class="summary-value small">
                    {{ $totalTransactions > 0 ? 'Pelanggan Aktif' : 'Belum Bertransaksi' }}
                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         DETAIL GRID
    ====================================================== --}}

    <section class="detail-grid">

        {{-- =================================================
             CUSTOMER INFORMATION
        ================================================== --}}

        <div class="detail-card">

            <div class="detail-card-header">

                <div class="detail-heading">

                    <div class="detail-heading-icon">
                        ♙
                    </div>

                    <div>
                        <h3>Informasi Pelanggan</h3>
                        <p>Data kontak dan identitas pelanggan.</p>
                    </div>

                </div>

            </div>


            <div class="detail-card-body">

                <div class="info-list">

                    {{-- CODE --}}

                    <div class="info-item">

                        <div class="info-icon">
                            #
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Kode Pelanggan
                            </span>

                            <div class="info-value">
                                {{ $customer->customer_code }}
                            </div>

                        </div>

                    </div>


                    {{-- NAME --}}

                    <div class="info-item">

                        <div class="info-icon">
                            ♙
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Nama Lengkap
                            </span>

                            <div class="info-value">
                                {{ $customer->name }}
                            </div>

                        </div>

                    </div>


                    {{-- PHONE --}}

                    <div class="info-item">

                        <div class="info-icon">
                            ☎
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Nomor Telepon
                            </span>

                            <div class="info-value">

                                @if ($customer->phone)

                                    {{ $customer->phone }}

                                @else

                                    <span class="info-empty">
                                        Belum tersedia
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="info-item">

                        <div class="info-icon">
                            @
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Email
                            </span>

                            <div class="info-value">

                                @if ($customer->email)

                                    {{ $customer->email }}

                                @else

                                    <span class="info-empty">
                                        Belum tersedia
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- ADDRESS --}}

                    <div class="info-item">

                        <div class="info-icon">
                            ◇
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Alamat
                            </span>

                            <div class="info-value">

                                @if ($customer->address)

                                    {{ $customer->address }}

                                @else

                                    <span class="info-empty">
                                        Belum tersedia
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- CREATED --}}

                    <div class="info-item">

                        <div class="info-icon">
                            ◷
                        </div>

                        <div class="info-content">

                            <span class="info-label">
                                Terdaftar Sejak
                            </span>

                            <div class="info-value">
                                {{ $customer->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="crm-note">

                    <span class="crm-note-label">
                        CRM Insight
                    </span>

                    <p>
                        Riwayat transaksi pelanggan akan membantu
                        IntanMitha Collection memahami aktivitas pembelian
                        dan mendukung analisis pelanggan pada sistem.
                    </p>

                </div>

            </div>

        </div>


        {{-- =================================================
             TRANSACTION HISTORY
        ================================================== --}}

        <div class="detail-card">

            <div class="detail-card-header">

                <div class="detail-heading">

                    <div class="detail-heading-icon">
                        ▤
                    </div>

                    <div>
                        <h3>Riwayat Transaksi</h3>
                        <p>
                            Aktivitas pembelian pelanggan.
                        </p>
                    </div>

                </div>

                <span class="history-count">
                    {{ number_format($customer->sales->count()) }}
                    Riwayat
                </span>

            </div>


            @if ($customer->sales->count() > 0)

                <div class="table-responsive">

                    <table class="history-table">

                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($customer->sales as $sale)

                                <tr>

                                    <td>
                                        <span class="invoice-code">
                                            {{ $sale->invoice_number }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $sale->sale_date->format('d/m/Y H:i') }}
                                    </td>

                                    <td>
                                        <span class="transaction-total">
                                            Rp {{ number_format($sale->total_amount, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    <td>

                                        @if ($sale->status === 'completed')

                                            <span class="status-badge status-completed">

                                                <span class="status-dot"></span>

                                                Selesai

                                            </span>

                                                @else

                                                    <span class="status-badge status-other">

                                                        <span class="status-dot"></span>

                                                        Dibatalkan

                                                    </span>

                                                @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="history-empty">

                    <div class="history-empty-icon">
                        ▤
                    </div>

                    <h4>Belum Ada Riwayat Transaksi</h4>

                    <p>
                        Pelanggan ini belum memiliki transaksi penjualan.
                        Riwayat pembelian akan tampil secara otomatis
                        setelah transaksi pelanggan dicatat melalui
                        modul Penjualan InoMitha.
                    </p>

                </div>

            @endif

        </div>

    </section>

</div>

@endsection