@extends('layouts.app')

@section('title', 'AI Business Assistant | InoMitha')
@section('page-title', 'AI Business Assistant')
@section('page-subtitle', 'Analisis dan rekomendasi bisnis berbasis Artificial Intelligence')

@push('styles')
<style>
    .ai-page {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .ai-hero {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: center;
        gap: 32px;
        min-height: 210px;
        margin-bottom: 22px;
        padding: 32px;
        border-radius: 24px;
        color: #ffffff;
        background:
            radial-gradient(
                circle at 88% 12%,
                rgba(255, 255, 255, 0.15),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #4f2d40 0%,
                #78405a 48%,
                #a95276 100%
            );
        box-shadow: 0 18px 42px rgba(88, 47, 67, 0.16);
    }

    .ai-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -70px;
        bottom: -140px;
        border: 32px solid rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .ai-hero-content {
        position: relative;
        z-index: 2;
    }

    .ai-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 13px;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, 0.17);
        border-radius: 30px;
        color: #f7e9ef;
        background: rgba(255, 255, 255, 0.08);
        font-size: 8px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .ai-hero-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #f3c8d9;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, .06);
    }

    .ai-hero h1 {
        margin: 0 0 10px;
        font-size: 27px;
        line-height: 1.25;
    }

    .ai-hero p {
        max-width: 690px;
        margin: 0;
        color: #f0dfe7;
        font-size: 10px;
        line-height: 1.75;
    }

    .ai-hero-visual {
        position: relative;
        z-index: 2;
        width: 150px;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ai-orbit {
        position: absolute;
        width: 145px;
        height: 145px;
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: 50%;
        animation: aiOrbit 12s linear infinite;
    }

    .ai-orbit::before,
    .ai-orbit::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: #f3c8d9;
    }

    .ai-orbit::before {
        width: 8px;
        height: 8px;
        top: 17px;
        right: 20px;
    }

    .ai-orbit::after {
        width: 6px;
        height: 6px;
        left: 14px;
        bottom: 31px;
    }

    @keyframes aiOrbit {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .ai-core {
        width: 88px;
        height: 88px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, .18);
        border-radius: 27px;
        background: rgba(255, 255, 255, .11);
        box-shadow:
            inset 0 0 30px rgba(255, 255, 255, .05),
            0 14px 30px rgba(49, 21, 35, .15);
        backdrop-filter: blur(7px);
        font-size: 34px;
    }

    /* =========================================================
       SECTION
    ========================================================= */

    .section-heading {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 15px;
        margin: 0 0 13px;
    }

    .section-heading h2 {
        margin: 0 0 4px;
        color: #604050;
        font-size: 14px;
    }

    .section-heading p {
        margin: 0;
        color: #9c8791;
        font-size: 8px;
        line-height: 1.6;
    }

    .section-badge {
        padding: 6px 9px;
        border-radius: 20px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 7px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* =========================================================
       SNAPSHOT
    ========================================================= */

    .snapshot-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 24px;
    }

    .snapshot-card {
        position: relative;
        overflow: hidden;
        min-height: 116px;
        padding: 17px;
        border: 1px solid #eee2e7;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 7px 24px rgba(80, 46, 62, .04);
    }

    .snapshot-card::after {
        content: "";
        position: absolute;
        width: 65px;
        height: 65px;
        right: -30px;
        bottom: -30px;
        border-radius: 50%;
        background: #fbf1f5;
    }

    .snapshot-icon {
        position: relative;
        z-index: 2;
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 11px;
        border-radius: 9px;
        color: #8f4667;
        background: #faedf2;
        font-size: 10px;
        font-weight: 800;
    }

    .snapshot-value {
        position: relative;
        z-index: 2;
        display: block;
        margin-bottom: 4px;
        color: #604050;
        font-size: 15px;
        font-weight: 800;
    }

    .snapshot-label {
        position: relative;
        z-index: 2;
        color: #9c8791;
        font-size: 7px;
    }

    /* =========================================================
       WORKSPACE
    ========================================================= */

    .workspace-grid {
        display: grid;
        grid-template-columns: minmax(280px, .75fr) minmax(0, 1.45fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .ai-panel {
        overflow: hidden;
        border: 1px solid #eadfe4;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 8px 26px rgba(80, 46, 62, .045);
    }

    .panel-header {
        padding: 18px 19px;
        border-bottom: 1px solid #f0e6ea;
    }

    .panel-header h3 {
        margin: 0 0 5px;
        color: #604050;
        font-size: 12px;
    }

    .panel-header p {
        margin: 0;
        color: #9e8993;
        font-size: 8px;
        line-height: 1.6;
    }

    .analysis-options {
        padding: 14px;
    }

    .analysis-option {
        position: relative;
        display: block;
        margin-bottom: 9px;
        cursor: pointer;
    }

    .analysis-option:last-child {
        margin-bottom: 0;
    }

    .analysis-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .analysis-option-content {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 13px;
        border: 1px solid #eee3e8;
        border-radius: 12px;
        background: #fff;
        transition: .2s ease;
    }

    .analysis-option:hover .analysis-option-content {
        border-color: #dcbcca;
        background: #fffafb;
    }

    .analysis-option input:checked + .analysis-option-content {
        border-color: #bd7f9b;
        background: #fcf2f6;
        box-shadow: inset 3px 0 0 #9c5575;
    }

    .option-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #faedf2;
        font-size: 13px;
    }

    .option-title {
        display: block;
        margin: 1px 0 4px;
        color: #654555;
        font-size: 9px;
        font-weight: 700;
    }

    .option-text {
        display: block;
        color: #9e8993;
        font-size: 7px;
        line-height: 1.55;
    }

    .ai-form-footer {
        padding: 0 14px 14px;
    }

    .generate-button {
        width: 100%;
        min-height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        border-radius: 10px;
        color: #ffffff;
        background: linear-gradient(135deg, #754158, #a75377);
        box-shadow: 0 8px 20px rgba(143, 70, 103, .18);
        font-size: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .generate-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(143, 70, 103, .24);
    }

    .generate-button:disabled {
        opacity: .65;
        cursor: wait;
        transform: none;
    }

    .button-spinner {
        width: 13px;
        height: 13px;
        display: none;
        border: 2px solid rgba(255, 255, 255, .35);
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .generate-button.loading .button-spinner {
        display: block;
    }

    .generate-button.loading .button-star {
        display: none;
    }

    .form-note {
        margin-top: 8px;
        color: #aa969f;
        font-size: 7px;
        line-height: 1.55;
        text-align: center;
    }

    /* =========================================================
       RESULT
    ========================================================= */

    .result-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .result-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 20px;
        color: #8f4667;
        background: #f8e9ef;
        font-size: 7px;
        font-weight: 700;
        white-space: nowrap;
    }

    .result-status.success {
        color: #44715a;
        background: #edf8f1;
    }

    .result-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .result-empty {
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 35px;
        text-align: center;
    }

    .result-empty-content {
        max-width: 430px;
    }

    .result-empty-icon {
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border: 1px solid #eadce3;
        border-radius: 22px;
        color: #8f4667;
        background: linear-gradient(135deg, #fdf5f8, #f7e7ed);
        font-size: 27px;
    }

    .result-empty h4 {
        margin: 0 0 7px;
        color: #604050;
        font-size: 12px;
    }

    .result-empty p {
        margin: 0;
        color: #9c8791;
        font-size: 8px;
        line-height: 1.75;
    }

    .ai-result {
        padding: 20px;
    }

    .ai-result-top {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 16px;
        padding: 12px 13px;
        border: 1px solid #eadfe4;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .ai-result-icon {
        width: 35px;
        height: 35px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #ffffff;
        background: linear-gradient(135deg, #754158, #a75377);
        font-size: 13px;
    }

    .ai-result-type {
        margin-bottom: 3px;
        color: #604050;
        font-size: 9px;
        font-weight: 700;
    }

    .ai-result-meta {
        color: #9d8792;
        font-size: 6px;
    }

    .ai-result-content {
        color: #674f5b;
        font-size: 8px;
        line-height: 1.9;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    /* =========================================================
       DATA INSIGHT
    ========================================================= */

    .insight-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 24px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .ai-table {
        width: 100%;
        min-width: 500px;
        border-collapse: collapse;
    }

    .ai-table th {
        padding: 11px 14px;
        border-bottom: 1px solid #eee4e8;
        color: #9c8791;
        background: #fdfafb;
        font-size: 6px;
        font-weight: 700;
        text-align: left;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .ai-table td {
        padding: 12px 14px;
        border-bottom: 1px solid #f2e9ed;
        color: #725767;
        font-size: 7px;
        vertical-align: middle;
    }

    .ai-table tbody tr:last-child td {
        border-bottom: none;
    }

    .primary-text {
        display: block;
        margin-bottom: 3px;
        color: #624353;
        font-size: 8px;
        font-weight: 700;
    }

    .secondary-text {
        display: block;
        color: #aa969f;
        font-size: 6px;
    }

    .rank {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #8f4667;
        background: #f9eaf0;
        font-size: 7px;
        font-weight: 800;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 7px;
        border-radius: 20px;
        font-size: 6px;
        font-weight: 700;
    }

    .stock-low {
        color: #946920;
        background: #fff4dc;
    }

    .stock-out {
        color: #a04b5d;
        background: #fde9ed;
    }

    .stock-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: currentColor;
    }

    /* =========================================================
       HISTORY
    ========================================================= */

    .history-section {
        margin-bottom: 24px;
    }

    .history-list {
        padding: 6px 18px;
    }

    .history-item {
        display: grid;
        grid-template-columns: 42px minmax(0, 1fr) auto;
        align-items: center;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #f0e7eb;
    }

    .history-item.active-history {
        margin: 5px -9px;
        padding: 13px 9px;
        border: 1px solid #ead5df;
        border-radius: 12px;
        background: #fdf7f9;
    }

    .history-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-view-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 9px;
        border: 1px solid #ead8e1;
        border-radius: 8px;
        color: #86536b;
        background: #ffffff;
        font-size: 6px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .history-view-link:hover {
        border-color: #c998ae;
        color: #ffffff;
        background: #8f4667;
    }

    .history-result-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 20px;
        padding-top: 14px;
        border-top: 1px solid #eee2e7;
        color: #a08b95;
        font-size: 7px;
    }

    .new-analysis-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 10px;
        border-radius: 8px;
        color: #ffffff;
        background: #8f4667;
        font-size: 7px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .new-analysis-link:hover {
        background: #743b55;
    }

    .history-item:last-child {
        border-bottom: none;
    }

    .history-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: #8f4667;
        background: #faedf2;
        font-size: 12px;
    }

    .history-title {
        margin-bottom: 3px;
        color: #654555;
        font-size: 8px;
        font-weight: 700;
    }

    .history-date {
        color: #a08b95;
        font-size: 6px;
    }

    .history-badge {
        padding: 5px 8px;
        border-radius: 20px;
        color: #7d5669;
        background: #f8eaf0;
        font-size: 6px;
        font-weight: 700;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .empty-state {
        padding: 32px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        border-radius: 13px;
        color: #98627b;
        background: #faedf2;
        font-size: 16px;
    }

    .empty-state h4 {
        margin: 0 0 5px;
        color: #674958;
        font-size: 9px;
    }

    .empty-state p {
        max-width: 330px;
        margin: 0 auto;
        color: #a08c95;
        font-size: 7px;
        line-height: 1.7;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {
        .snapshot-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .workspace-grid,
        .insight-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 720px) {
        .ai-hero {
            grid-template-columns: 1fr;
            padding: 25px 21px;
        }

        .ai-hero-visual {
            display: none;
        }

        .snapshot-grid {
            grid-template-columns: 1fr 1fr;
        }

        .section-heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .result-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .snapshot-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush


@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Hasil AI yang Sedang Ditampilkan
    |--------------------------------------------------------------------------
    |
    | Jika pengguna membuka riwayat, gunakan hasil dari database.
    | Jika baru selesai melakukan analisis, gunakan hasil dari session.
    |
    */

    $selectedRecommendation = $selectedRecommendation ?? null;

    $isHistoryView = $selectedRecommendation !== null;

    $aiResult = $isHistoryView
        ? $selectedRecommendation->result
        : session('ai_result');

    $aiType = $isHistoryView
        ? $selectedRecommendation->type
        : session('ai_type');

    $aiResultDate = $isHistoryView
        ? $selectedRecommendation->created_at
        : null;

    $aiTypeLabel = match ($aiType) {
        'sales_analysis' => 'Analisis Penjualan',
        'promotion' => 'Ide Promosi',
        'inventory' => 'Rekomendasi Stok',
        default => 'Analisis AI',
    };
@endphp

<div class="ai-page">

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <section class="ai-hero">

        <div class="ai-hero-content">

            <div class="ai-hero-badge">
                <span class="ai-hero-badge-dot"></span>
                InoMitha Intelligence
            </div>

            <h1>
                AI Business Assistant
            </h1>

            <p>
                Ubah data bisnis IntanMitha Collection menjadi
                insight yang lebih mudah dipahami. AI Business
                Assistant membantu menganalisis penjualan,
                menyusun ide promosi, dan memberikan rekomendasi
                persediaan berdasarkan data yang tersimpan
                di dalam InoMitha.
            </p>

        </div>

        <div class="ai-hero-visual">

            <div class="ai-orbit"></div>

            <div class="ai-core">
                ✦
            </div>

        </div>

    </section>


    {{-- =====================================================
         BUSINESS SNAPSHOT
    ====================================================== --}}
    <div class="section-heading">

        <div>
            <h2>Business Snapshot</h2>

            <p>
                Ringkasan kondisi bisnis yang digunakan
                sebagai dasar analisis AI.
            </p>
        </div>

        <span class="section-badge">
            Data InoMitha
        </span>

    </div>


    <div class="snapshot-grid">

        <article class="snapshot-card">

            <div class="snapshot-icon">
                Rp
            </div>

            <strong class="snapshot-value">
                Rp{{ number_format((float) $totalSales, 0, ',', '.') }}
            </strong>

            <span class="snapshot-label">
                Total Penjualan
            </span>

        </article>


        <article class="snapshot-card">

            <div class="snapshot-icon">
                #
            </div>

            <strong class="snapshot-value">
                {{ number_format($totalTransactions, 0, ',', '.') }}
            </strong>

            <span class="snapshot-label">
                Transaksi Selesai
            </span>

        </article>


        <article class="snapshot-card">

            <div class="snapshot-icon">
                Ø
            </div>

            <strong class="snapshot-value">
                Rp{{ number_format((float) $averageTransaction, 0, ',', '.') }}
            </strong>

            <span class="snapshot-label">
                Rata-rata Transaksi
            </span>

        </article>


        <article class="snapshot-card">

            <div class="snapshot-icon">
                !
            </div>

            <strong class="snapshot-value">
                {{ number_format($lowStockCount, 0, ',', '.') }}
            </strong>

            <span class="snapshot-label">
                Produk Stok Menipis
            </span>

        </article>


        <article class="snapshot-card">

            <div class="snapshot-icon">
                0
            </div>

            <strong class="snapshot-value">
                {{ number_format($outOfStockCount, 0, ',', '.') }}
            </strong>

            <span class="snapshot-label">
                Produk Stok Habis
            </span>

        </article>

    </div>


    {{-- =====================================================
         AI WORKSPACE
    ====================================================== --}}
    <div class="section-heading">

        <div>
            <h2>AI Analysis Workspace</h2>

            <p>
                Pilih jenis analisis, kemudian biarkan Gemini
                membantu membaca data bisnis InoMitha.
            </p>
        </div>

        <span class="section-badge">
            Gemini AI
        </span>

    </div>


    <div class="workspace-grid">

        {{-- PILIH ANALISIS --}}
        <section class="ai-panel">

            <div class="panel-header">

                <h3>
                    Pilih Analisis
                </h3>

                <p>
                    Setiap pilihan menghasilkan rekomendasi
                    dengan fokus yang berbeda.
                </p>

            </div>


            <form
                action="{{ route('ai.analyze') }}"
                method="POST"
                id="aiAnalysisForm"
            >
                @csrf

                <div class="analysis-options">

                    {{-- ANALISIS PENJUALAN --}}
                    <label class="analysis-option">

                        <input
                            type="radio"
                            name="analysis_type"
                            value="sales_analysis"
                            {{ old('analysis_type', $aiType ?? 'sales_analysis') === 'sales_analysis' ? 'checked' : '' }}
                        >

                        <span class="analysis-option-content">

                            <span class="option-icon">
                                ↗
                            </span>

                            <span>

                                <span class="option-title">
                                    Analisis Penjualan
                                </span>

                                    <span class="option-text">
                                        Analisis performa transaksi,
                                        tren penjualan, produk terlaris,
                                        dan kondisi bisnis.
                                    </span>

                            </span>

                        </span>

                    </label>


                    {{-- IDE PROMOSI --}}
                    <label class="analysis-option">

                        <input
                            type="radio"
                            name="analysis_type"
                            value="promotion"
                            {{ old('analysis_type', $aiType) === 'promotion' ? 'checked' : '' }}
                        >

                        <span class="analysis-option-content">

                            <span class="option-icon">
                                ✦
                            </span>

                            <span>

                                <span class="option-title">
                                    Ide Promosi
                                </span>

                                <span class="option-text">
                                    Mendapatkan rekomendasi promosi
                                    berdasarkan performa produk
                                    dan kondisi penjualan.
                                </span>

                            </span>

                        </span>

                    </label>


                    {{-- REKOMENDASI STOK --}}
                    <label class="analysis-option">

                        <input
                            type="radio"
                            name="analysis_type"
                            value="inventory"
                            {{ old('analysis_type', $aiType) === 'inventory' ? 'checked' : '' }}
                        >

                        <span class="analysis-option-content">

                            <span class="option-icon">
                                ≡
                            </span>

                            <span>

                                <span class="option-title">
                                    Rekomendasi Stok
                                </span>

                                <span class="option-text">
                                    Menentukan produk yang perlu
                                    mendapat perhatian dan prioritas
                                    pengelolaan persediaan.
                                </span>

                            </span>

                        </span>

                    </label>

                </div>


                <div class="ai-form-footer">

                    <button
                        type="submit"
                        class="generate-button"
                        id="generateButton"
                    >

                        <span class="button-star">
                            ✦
                        </span>

                        <span class="button-spinner"></span>

                        <span id="generateButtonText">
                            Analisis dengan AI
                        </span>

                    </button>

                    <p class="form-note">
                        Gemini hanya menerima ringkasan data bisnis.
                        Data pribadi pelanggan tidak dikirim.
                    </p>

                </div>

            </form>

        </section>


        {{-- HASIL ANALISIS --}}
        <section class="ai-panel">

            <div class="panel-header result-header">

                <div>

                    <h3>
                        Hasil Analisis AI
                    </h3>

                    <p>
                        Insight dan rekomendasi berdasarkan
                        data bisnis InoMitha.
                    </p>

                </div>


                @if ($aiResult)

                    <span class="result-status success">

                        <span class="result-status-dot"></span>

                        {{ $isHistoryView ? 'Riwayat Analisis' : 'Analisis Selesai' }}

                    </span>

                @else

                    <span class="result-status">

                        <span class="result-status-dot"></span>

                        Menunggu Analisis

                    </span>

                @endif

            </div>


            @if ($aiResult)

                <div class="ai-result">

                    <div class="ai-result-top">

                        <div class="ai-result-icon">
                            ✦
                        </div>

                        <div>

                            <div class="ai-result-type">
                                {{ $aiTypeLabel }}
                            </div>

                                <div class="ai-result-meta">

                                    @if ($isHistoryView)

                                        Riwayat dibuat pada
                                        {{ $aiResultDate->format('d M Y, H:i') }} WIB

                                        @if (
                                            $selectedRecommendation->period_start &&
                                            $selectedRecommendation->period_end
                                        )
                                            · Tren data
                                            {{ $selectedRecommendation->period_start->format('d M Y') }}
                                            sampai
                                            {{ $selectedRecommendation->period_end->format('d M Y') }}
                                        @endif

                                    @else

                                        Dihasilkan oleh Gemini AI berdasarkan
                                        data bisnis InoMitha

                                    @endif

                                </div>

                        </div>

                    </div>


                    <div class="ai-result-content">{{ $aiResult }}</div>

                    @if ($isHistoryView)

                        <div class="history-result-footer">

                            <span>
                                ✦ Hasil analisis tersimpan
                            </span>

                            <a
                                href="{{ route('ai.index') }}"
                                class="new-analysis-link"
                            >
                                Buat Analisis Baru
                            </a>

                        </div>

                    @endif

                </div>

            @else

                <div class="result-empty">

                    <div class="result-empty-content">

                        <div class="result-empty-icon">
                            ✦
                        </div>

                        <h4>
                            Siap Menganalisis Data Bisnis
                        </h4>

                        <p>
                            Pilih salah satu jenis analisis di sebelah
                            kiri lalu tekan tombol Analisis dengan AI.
                            Gemini akan membaca ringkasan data bisnis
                            dan menyusun insight yang sesuai.
                        </p>

                    </div>

                </div>

            @endif

        </section>

    </div>


    {{-- =====================================================
         DATA INSIGHT
    ====================================================== --}}
    <div class="section-heading">

        <div>

            <h2>
                Data Insight
            </h2>

                <p>
                    Ringkasan data penjualan dan persediaan
                    yang digunakan sebagai bagian dari analisis AI.
                </p>

        </div>

    </div>


    <div class="insight-grid">

        {{-- PRODUK TERLARIS --}}
        <section class="ai-panel">

            <div class="panel-header">

                <h3>
                    Produk Terlaris
                </h3>

                <p>
                    Lima produk dengan jumlah penjualan
                    tertinggi dari transaksi selesai.
                </p>

            </div>


            @if ($bestSellingProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="ai-table">

                        <thead>

                            <tr>
                                <th>Rank</th>
                                <th>Produk</th>
                                <th>Terjual</th>
                                <th>Pendapatan</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($bestSellingProducts as $index => $item)

                                <tr>

                                    <td>
                                        <span class="rank">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>


                                    <td>

                                        <span class="primary-text">
                                            {{ $item->product?->name ?? 'Produk Tidak Tersedia' }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $item->product?->category?->name ?? '-' }}
                                        </span>

                                    </td>


                                    <td>
                                        {{ number_format(
                                            $item->total_quantity,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                        item
                                    </td>


                                    <td>
                                        Rp{{ number_format(
                                            (float) $item->total_revenue,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ◇
                    </div>

                    <h4>
                        Belum Ada Data Penjualan
                    </h4>

                    <p>
                        Produk terlaris akan muncul setelah
                        terdapat transaksi penjualan selesai.
                    </p>

                </div>

            @endif

        </section>


        {{-- PRIORITAS PERSEDIAAN --}}
        <section class="ai-panel">

            <div class="panel-header">

                <h3>
                    Prioritas Persediaan
                </h3>

                <p>
                    Produk aktif dengan kondisi stok
                    menipis atau habis.
                </p>

            </div>


            @if ($stockAttentionProducts->isNotEmpty())

                <div class="table-wrapper">

                    <table class="ai-table">

                        <thead>

                            <tr>
                                <th>Produk</th>
                                <th>Stok</th>
                                <th>Minimum</th>
                                <th>Status</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($stockAttentionProducts as $product)

                                <tr>

                                    <td>

                                        <span class="primary-text">
                                            {{ $product->name }}
                                        </span>

                                        <span class="secondary-text">
                                            {{ $product->category?->name ?? '-' }}
                                        </span>

                                    </td>


                                    <td>
                                        <strong>
                                            {{ $product->stock }}
                                        </strong>
                                    </td>


                                    <td>
                                        {{ $product->minimum_stock }}
                                    </td>


                                    <td>

                                        @if ($product->stock == 0)

                                            <span class="stock-badge stock-out">

                                                <span class="stock-dot"></span>

                                                Habis

                                            </span>

                                        @else

                                            <span class="stock-badge stock-low">

                                                <span class="stock-dot"></span>

                                                Menipis

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h4>
                        Persediaan Aman
                    </h4>

                    <p>
                        Tidak ada produk aktif dengan
                        stok menipis maupun stok habis.
                    </p>

                </div>

            @endif

        </section>

    </div>


    {{-- =====================================================
         RIWAYAT AI
    ====================================================== --}}
    <section class="history-section">

        <div class="section-heading">

            <div>

                <h2>
                    Riwayat Rekomendasi AI
                </h2>

                <p>
                    Lima analisis terbaru yang dibuat
                    melalui akun ini.
                </p>

            </div>

        </div>


        <section class="ai-panel">

            @if ($recommendationHistory->isNotEmpty())

                <div class="history-list">

                    @foreach ($recommendationHistory as $history)

                        @php
                            $historyTypeLabel = match ($history->type) {
                                'sales_analysis' => 'Analisis Penjualan',
                                'promotion' => 'Ide Promosi',
                                'inventory' => 'Rekomendasi Stok',
                                default => 'Analisis AI',
                            };
                        @endphp

                        <div
                            class="history-item
                                {{ $isHistoryView && $selectedRecommendation->id === $history->id
                                    ? 'active-history'
                                    : '' }}"
                        >

                            <div class="history-icon">
                                ✦
                            </div>


                            <div>

                                <div class="history-title">
                                    {{ $historyTypeLabel }}
                                </div>

                                    <div class="history-date">

                                        {{ $history->created_at->format('d M Y, H:i') }}
                                        WIB

                                        @if (
                                            $history->period_start &&
                                            $history->period_end
                                        )
                                            · Tren
                                            {{ $history->period_start->format('M Y') }}
                                            sampai
                                            {{ $history->period_end->format('M Y') }}
                                        @endif

                                    </div>

                            </div>


                            <div class="history-actions">

                                <span class="history-badge">
                                    Gemini AI
                                </span>

                                <a
                                    href="{{ route('ai.show', $history) }}"
                                    class="history-view-link"
                                >
                                    Lihat Hasil
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ✦
                    </div>

                    <h4>
                        Belum Ada Riwayat AI
                    </h4>

                    <p>
                        Setelah analisis pertama berhasil dibuat,
                        hasilnya akan tersimpan dan riwayatnya
                        muncul pada bagian ini.
                    </p>

                </div>

            @endif

        </section>

    </section>

</div>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('aiAnalysisForm');
        const button = document.getElementById('generateButton');
        const buttonText = document.getElementById('generateButtonText');

        if (!form || !button || !buttonText) {
            return;
        }

        form.addEventListener('submit', function () {

            button.disabled = true;
            button.classList.add('loading');

            buttonText.textContent =
                'Gemini sedang menganalisis...';

        });

    });
</script>
@endpush