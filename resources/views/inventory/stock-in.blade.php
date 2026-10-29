@extends('layouts.app')

@section('title', 'Stok Masuk | InoMitha')
@section('page-title', 'Stok Masuk')
@section('page-subtitle', 'Tambahkan persediaan produk IntanMitha Collection')

@push('styles')
<style>
    .stock-in-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* BREADCRUMB */
    .stock-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
        color: #9b8590;
        font-size: 10px;
    }

    .stock-breadcrumb a {
        color: #8f4667;
        font-weight: 600;
        text-decoration: none;
    }

    .stock-breadcrumb a:hover {
        color: #65364d;
    }

    .breadcrumb-separator {
        color: #c7b7bf;
    }

    /* HERO */
    .stock-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 25px;
        min-height: 190px;
        padding: 32px 35px;
        margin-bottom: 22px;
        border-radius: 23px;
        color: #fff;
        background:
            radial-gradient(
                circle at 88% 15%,
                rgba(255,255,255,.16),
                transparent 25%
            ),
            linear-gradient(
                135deg,
                #583247 0%,
                #81405e 52%,
                #b65d80 100%
            );
        box-shadow: 0 17px 42px rgba(89,48,68,.16);
    }

    .stock-hero::before {
        content: "";
        position: absolute;
        width: 215px;
        height: 215px;
        top: -140px;
        right: 115px;
        border: 32px solid rgba(255,255,255,.055);
        border-radius: 50%;
    }

    .stock-hero::after {
        content: "";
        position: absolute;
        width: 165px;
        height: 165px;
        right: -45px;
        bottom: -90px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
    }

    .hero-content,
    .hero-icon {
        position: relative;
        z-index: 2;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 30px;
        background: rgba(255,255,255,.09);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .hero-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #d9f0df;
        box-shadow: 0 0 0 4px rgba(217,240,223,.12);
    }

    .hero-content h1 {
        margin-bottom: 8px;
        font-size: 27px;
    }

    .hero-content p {
        max-width: 610px;
        color: #f3e3e9;
        font-size: 10px;
        line-height: 1.8;
    }

    .hero-icon {
        width: 76px;
        height: 76px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 22px;
        background: rgba(255,255,255,.11);
        font-size: 30px;
        font-weight: 300;
        backdrop-filter: blur(8px);
    }

    /* LAYOUT */
    .stock-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.65fr) minmax(270px, .72fr);
        gap: 20px;
        align-items: start;
    }

    .stock-form-card,
    .stock-info-card {
        overflow: hidden;
        border: 1px solid #eee2e7;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 9px 30px rgba(80,46,62,.05);
    }

    /* FORM HEADER */
    .form-header {
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
        color: #557b60;
        background: #edf7f0;
        font-size: 18px;
        font-weight: 700;
    }

    .form-header h3 {
        margin-bottom: 4px;
        color: #593749;
        font-size: 14px;
    }

    .form-header p {
        color: #a18b96;
        font-size: 9px;
    }

    .form-body {
        padding: 25px 23px;
    }

    /* VALIDATION */
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

    .validation-icon {
        width: 31px;
        height: 31px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        color: #fff;
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

    /* EMPTY PRODUCTS */
    .empty-product-alert {
        margin-bottom: 22px;
        padding: 16px;
        border: 1px solid #ead9df;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .empty-product-alert strong {
        display: block;
        margin-bottom: 6px;
        color: #74465a;
        font-size: 10px;
    }

    .empty-product-alert p {
        margin-bottom: 11px;
        color: #9b8490;
        font-size: 9px;
        line-height: 1.7;
    }

    .empty-product-alert a {
        display: inline-flex;
        align-items: center;
        min-height: 34px;
        padding: 0 11px;
        border-radius: 8px;
        color: #fff;
        background: #8f4667;
        font-size: 8px;
        font-weight: 700;
        text-decoration: none;
    }

    /* FORM */
    .form-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 19px;
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
        color: #fff;
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
        color: #bd5c75;
    }

    .form-control,
    .form-select,
    .form-textarea {
        width: 100%;
        border: 1px solid #e8dbe1;
        border-radius: 10px;
        outline: none;
        color: #604050;
        background: #fefcfd;
        font-family: inherit;
        font-size: 10px;
        transition: .2s;
    }

    .form-control,
    .form-select {
        min-height: 45px;
        padding: 0 13px;
    }

    .form-textarea {
        min-height: 105px;
        padding: 12px 13px;
        line-height: 1.7;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #c47c98;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(143,70,103,.07);
    }

    .form-control.is-invalid,
    .form-select.is-invalid,
    .form-textarea.is-invalid {
        border-color: #d77b8d;
        background: #fffafb;
    }

    .form-help {
        margin-top: 6px;
        color: #a6929c;
        font-size: 8px;
        line-height: 1.6;
    }

    .error-message {
        margin-top: 6px;
        color: #b54d63;
        font-size: 9px;
        font-weight: 600;
    }

    /* PRODUCT PREVIEW */
    .product-preview {
        display: none;
        margin-top: 11px;
        padding: 14px;
        border: 1px solid #e8dce1;
        border-radius: 11px;
        background: #fdf9fb;
    }

    .product-preview.show {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .preview-avatar {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        color: #8f4667;
        background: #f5e5ec;
        font-size: 14px;
        font-weight: 700;
    }

    .preview-content {
        flex: 1;
    }

    .preview-content strong {
        display: block;
        margin-bottom: 4px;
        color: #604050;
        font-size: 9px;
    }

    .preview-content span {
        color: #9b8690;
        font-size: 8px;
    }

    .preview-stock {
        text-align: right;
    }

    .preview-stock span {
        display: block;
        margin-bottom: 3px;
        color: #a08a95;
        font-size: 7px;
        text-transform: uppercase;
    }

    .preview-stock strong {
        color: #5e3d4e;
        font-size: 15px;
    }

    .preview-stock small {
        color: #9e8993;
        font-size: 8px;
    }

    /* QUANTITY */
    .quantity-box {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 140px;
        gap: 12px;
        align-items: stretch;
    }

    .quantity-result {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px 13px;
        border: 1px solid #dcecdf;
        border-radius: 10px;
        background: #f2f9f4;
    }

    .quantity-result span {
        margin-bottom: 4px;
        color: #76907d;
        font-size: 7px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .quantity-result strong {
        color: #4e7459;
        font-size: 14px;
    }

    /* FORM ACTION */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding: 18px 23px;
        border-top: 1px solid #f1e7eb;
        background: #fefcfd;
    }

    .btn-cancel,
    .btn-save {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 0 16px;
        border-radius: 9px;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s;
    }

    .btn-cancel {
        border: 1px solid #e7d9df;
        color: #806575;
        background: #fff;
    }

    .btn-save {
        border: 1px solid #557b60;
        color: #fff;
        background: linear-gradient(135deg, #557b60, #6c9477);
        box-shadow: 0 7px 17px rgba(72,110,82,.16);
        cursor: pointer;
    }

    .btn-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 21px rgba(72,110,82,.22);
    }

    .btn-save:disabled {
        opacity: .55;
        cursor: not-allowed;
        transform: none;
    }

    /* SIDE INFO */
    .info-header {
        padding: 21px;
        color: #fff;
        background: linear-gradient(135deg, #65394e, #934a68);
    }

    .info-header h3 {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .info-header p {
        color: #ead7df;
        font-size: 9px;
        line-height: 1.6;
    }

    .info-body {
        padding: 20px;
    }

    .info-item {
        display: flex;
        gap: 11px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f2e8ec;
    }

    .info-item:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
    }

    .info-number {
        width: 29px;
        height: 29px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #557b60;
        background: #edf7f0;
        font-size: 9px;
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

    .integration-box {
        margin-top: 18px;
        padding: 14px;
        border: 1px dashed #dfcbd4;
        border-radius: 12px;
        background: #fdf8fa;
    }

    .integration-box strong {
        display: block;
        margin-bottom: 6px;
        color: #74445a;
        font-size: 9px;
    }

    .integration-flow {
        color: #927985;
        font-size: 8px;
        line-height: 1.8;
    }

    @media (max-width: 950px) {
        .stock-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .stock-hero {
            align-items: flex-start;
            flex-direction: column;
            padding: 27px 23px;
        }

        .quantity-box {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-save {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="stock-in-page">

    {{-- BREADCRUMB --}}
    <div class="stock-breadcrumb">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <span class="breadcrumb-separator">/</span>

        <a href="{{ route('inventory.index') }}">
            Persediaan
        </a>

        <span class="breadcrumb-separator">/</span>

        <span>Stok Masuk</span>

    </div>


    {{-- HERO --}}
    <section class="stock-hero">

        <div class="hero-content">

            <div class="hero-label">
                <span class="hero-dot"></span>
                Inventory • Stock In
            </div>

            <h1>Tambah Stok Produk</h1>

            <p>
                Catat persediaan yang masuk ke IntanMitha Collection.
                Jumlah stok produk akan bertambah secara otomatis dan
                aktivitasnya disimpan dalam riwayat pergerakan stok.
            </p>

        </div>

        <div class="hero-icon">
            +
        </div>

    </section>


    <div class="stock-layout">

        {{-- FORM --}}
        <section class="stock-form-card">

            <div class="form-header">

                <div class="form-header-icon">
                    +
                </div>

                <div>

                    <h3>Form Stok Masuk</h3>

                    <p>
                        Pilih produk dan masukkan jumlah persediaan baru.
                    </p>

                </div>

            </div>


            <form
                action="{{ route('inventory.stock-in.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-body">

                    {{-- VALIDATION --}}
                    @if ($errors->any())

                        <div class="validation-alert">

                            <div class="validation-icon">
                                !
                            </div>

                            <div>

                                <h4>Stok belum dapat diproses</h4>

                                <p>
                                    Periksa kembali data stok masuk
                                    yang dimasukkan.
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- NO PRODUCT --}}
                    @if ($products->isEmpty())

                        <div class="empty-product-alert">

                            <strong>
                                Belum Ada Produk Aktif
                            </strong>

                            <p>
                                Stok masuk hanya dapat dicatat untuk
                                produk yang berstatus aktif. Tambahkan
                                atau aktifkan produk terlebih dahulu.
                            </p>

                            <a href="{{ route('products.index') }}">
                                Kelola Produk
                            </a>

                        </div>

                    @endif


                    <div class="form-section-title">

                        <span class="section-number">
                            01
                        </span>

                        Informasi Stok Masuk

                    </div>


                    {{-- PRODUCT --}}
                    <div class="form-group">

                        <label
                            for="product_id"
                            class="form-label"
                        >
                            Produk
                            <span class="required">*</span>
                        </label>


                        <select
                            id="product_id"
                            name="product_id"
                            class="form-select @error('product_id') is-invalid @enderror"
                            {{ $products->isEmpty() ? 'disabled' : '' }}
                            required
                        >

                            <option value="">
                                Pilih produk
                            </option>


                            @foreach ($products as $product)

                                <option
                                    value="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-code="{{ $product->product_code }}"
                                    data-stock="{{ $product->stock }}"
                                    data-category="{{ $product->category->name }}"
                                    {{ (string) old('product_id') ===
                                        (string) $product->id
                                        ? 'selected'
                                        : '' }}
                                >
                                    {{ $product->product_code }}
                                    -
                                    {{ $product->name }}
                                </option>

                            @endforeach

                        </select>


                        @error('product_id')

                            <div class="error-message">
                                ! {{ $message }}
                            </div>

                        @enderror


                        <div
                            class="product-preview"
                            id="productPreview"
                        >

                            <div
                                class="preview-avatar"
                                id="previewAvatar"
                            >
                                P
                            </div>

                            <div class="preview-content">

                                <strong id="previewName">
                                    -
                                </strong>

                                <span id="previewMeta">
                                    -
                                </span>

                            </div>

                            <div class="preview-stock">

                                <span>Stok Saat Ini</span>

                                <strong id="previewStock">
                                    0
                                </strong>

                                <small>unit</small>

                            </div>

                        </div>

                    </div>


                    {{-- QUANTITY --}}
                    <div class="form-group">

                        <label
                            for="quantity"
                            class="form-label"
                        >
                            Jumlah Stok Masuk
                            <span class="required">*</span>
                        </label>


                        <div class="quantity-box">

                            <div>

                                <input
                                    type="number"
                                    id="quantity"
                                    name="quantity"
                                    value="{{ old('quantity') }}"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    min="1"
                                    step="1"
                                    placeholder="Contoh: 10"
                                    {{ $products->isEmpty() ? 'disabled' : '' }}
                                    required
                                >

                                @error('quantity')

                                    <div class="error-message">
                                        ! {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="quantity-result">

                                <span>
                                    Perkiraan Stok Baru
                                </span>

                                <strong id="newStock">
                                    -
                                </strong>

                            </div>

                        </div>


                        <div class="form-help">
                            Masukkan jumlah unit baru yang diterima.
                            Nilai minimal adalah 1 unit.
                        </div>

                    </div>


                    {{-- NOTES --}}
                    <div class="form-group">

                        <label
                            for="notes"
                            class="form-label"
                        >
                            Keterangan
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            class="form-textarea @error('notes') is-invalid @enderror"
                            maxlength="1000"
                            placeholder="Contoh: Restock produk dari pemasok."
                            {{ $products->isEmpty() ? 'disabled' : '' }}
                        >{{ old('notes') }}</textarea>


                        @error('notes')

                            <div class="error-message">
                                ! {{ $message }}
                            </div>

                        @enderror


                        <div class="form-help">
                            Opsional. Jika dikosongkan, sistem akan
                            memberikan keterangan stok masuk secara otomatis.
                        </div>

                    </div>

                </div>


                {{-- ACTION --}}
                <div class="form-actions">

                    <a
                        href="{{ route('inventory.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn-save"
                        {{ $products->isEmpty() ? 'disabled' : '' }}
                    >
                        + Simpan Stok Masuk
                    </button>

                </div>

            </form>

        </section>


        {{-- INFORMATION --}}
        <aside>

            <section class="stock-info-card">

                <div class="info-header">

                    <h3>Bagaimana Stok Masuk Bekerja?</h3>

                    <p>
                        Sistem akan memperbarui stok dan mencatat
                        riwayat persediaan secara bersamaan.
                    </p>

                </div>


                <div class="info-body">

                    <div class="info-item">

                        <div class="info-number">
                            01
                        </div>

                        <div>

                            <h4>Pilih Produk</h4>

                            <p>
                                Pilih produk aktif yang menerima
                                tambahan persediaan.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">
                            02
                        </div>

                        <div>

                            <h4>Masukkan Jumlah</h4>

                            <p>
                                Jumlah stok masuk akan ditambahkan
                                ke stok produk yang tersedia saat ini.
                            </p>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-number">
                            03
                        </div>

                        <div>

                            <h4>Riwayat Otomatis</h4>

                            <p>
                                Sistem mencatat produk, jumlah,
                                keterangan, waktu, dan pengguna
                                yang melakukan perubahan.
                            </p>

                        </div>

                    </div>


                    <div class="integration-box">

                        <strong>
                            Integrasi Persediaan
                        </strong>

                        <div class="integration-flow">
                            Stok Saat Ini
                            + Stok Masuk
                            = Stok Baru
                            <br>
                            Data kemudian tercatat pada
                            riwayat pergerakan stok.
                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>

</div>

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const productSelect =
            document.getElementById('product_id');

        const quantityInput =
            document.getElementById('quantity');

        const preview =
            document.getElementById('productPreview');

        const previewAvatar =
            document.getElementById('previewAvatar');

        const previewName =
            document.getElementById('previewName');

        const previewMeta =
            document.getElementById('previewMeta');

        const previewStock =
            document.getElementById('previewStock');

        const newStock =
            document.getElementById('newStock');


        if (!productSelect || !quantityInput) {
            return;
        }


        function updatePreview() {

            const option =
                productSelect.options[
                    productSelect.selectedIndex
                ];

            if (!option || !option.value) {

                preview.classList.remove('show');

                previewStock.textContent = '0';

                newStock.textContent = '-';

                return;
            }


            const name =
                option.dataset.name || '';

            const code =
                option.dataset.code || '';

            const category =
                option.dataset.category || '';

            const stock =
                parseInt(option.dataset.stock || '0', 10);


            preview.classList.add('show');

            previewAvatar.textContent =
                name
                    ? name.charAt(0).toUpperCase()
                    : 'P';

            previewName.textContent =
                name;

            previewMeta.textContent =
                code + ' • ' + category;

            previewStock.textContent =
                stock.toLocaleString('id-ID');


            updateNewStock();
        }


        function updateNewStock() {

            const option =
                productSelect.options[
                    productSelect.selectedIndex
                ];

            if (!option || !option.value) {

                newStock.textContent = '-';

                return;
            }


            const currentStock =
                parseInt(
                    option.dataset.stock || '0',
                    10
                );

            const quantity =
                parseInt(
                    quantityInput.value || '0',
                    10
                );


            if (
                !quantityInput.value ||
                quantity < 1
            ) {

                newStock.textContent =
                    currentStock.toLocaleString('id-ID')
                    + ' unit';

                return;
            }


            const result =
                currentStock + quantity;


            newStock.textContent =
                result.toLocaleString('id-ID')
                + ' unit';
        }


        productSelect.addEventListener(
            'change',
            updatePreview
        );


        quantityInput.addEventListener(
            'input',
            updateNewStock
        );


        updatePreview();

    });
</script>
@endpush