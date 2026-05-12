@extends('layouts.app')

@section('title', 'Postingan-baru')

@section('content')
<div class="posting-container">

    <!-- Header -->
    <div class="posting-header">
        <h1 class="posting-title">Buat Postingan</h1>
        <p class="posting-subtitle">Bagikan ide dan pemikiran Anda dengan komunitas</p>
    </div>

    <!-- Not Authenticated Alert -->
    @if (!Auth::check())
        <div class="alert-auth">
            <span class="alert-icon">🔒</span>
            <div>
                <strong>Login Diperlukan</strong>
                <p>Anda harus login untuk membuat postingan. <a href="{{ route('login') }}" class="alert-link">Login di
                        sini</a></p>
            </div>
        </div>
    @else

    <!-- Row Layout: Form + Tips -->
    <div class="posting-row">

        <!-- LEFT: Form Card -->
        <div class="form-card">
            @if ($errors->any())
                <div class="alert-errors">
                    <strong class="alert-title">⚠️ Perhatian!</strong>
                    <ul class="errors-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('post.store') }}" method="POST" class="posting-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <h3 class="fw-light">Image Banner</h3>
                <img class="banner-img" id="preview"
                    src="{{ (isset($post) && $post->gambar) ? asset('storage/' . $post->gambar) : '' }}"
                    style="{{ (isset($post) && $post->gambar) ? '' : 'display:none;' }}">

                @if (!isset($post) || !$post->gambar)
                    <div class="banner-img-null" id="bannerNull"></div>
                @endif
                <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)">
                @error('gambar')
                    <small>{{ $message }}</small>
                @enderror

                <!-- Judul Field -->
                <div class="form-group">
                    <label for="judul" class="form-label">
                        Judul Postingan <span class="label-required">*</span>
                    </label>
                    <input type="text" class="form-input @error('judul') input-error @enderror" id="judul" name="judul"
                        placeholder="Masukkan judul yang menarik..." value="{{ old('judul') }}" maxlength="255"
                        required>
                    <div class="form-help">
                        <span class="char-counter"><span id="judulCount">0</span>/255</span>
                    </div>
                    @error('judul')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Isi Post Field -->
                <div class="form-group">
                    <label for="isi_post" class="form-label">
                        Isi Postingan <span class="label-required">*</span>
                    </label>
                    <textarea class="form-textarea @error('isi_post') input-error @enderror" id="isi_post"
                        name="isi_post" rows="9" placeholder="Tulis isi postingan Anda di sini..." maxlength="2000"
                        required>{{ old('isi_post') }}</textarea>
                    <div class="form-help">
                        <span class="char-counter"><span id="isiCount">0</span>/2000</span>
                    </div>
                    @error('isi_post')
                        <small class="form-error">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Publish</button>
                    <button type="reset" class="btn-secondary" id="resetBtn">Reset</button>
                    <a href="{{ route('home') }}" class="btn-secondary">Kembali</a>
                </div>
            </form>
        </div>

        <!-- RIGHT: Tips Card -->
        <div class="tips-card">
            <h4 class="tips-title">💡 Tips Menulis</h4>
            <ul class="tips-list">
                <li>
                    <span class="tips-check">✓</span>
                    <div>
                        <strong>Judul Menarik</strong>
                        <p>Buat judul yang ringkas dan memikat perhatian pembaca.</p>
                    </div>
                </li>
                <li>
                    <span class="tips-check">✓</span>
                    <div>
                        <strong>Isi Berkualitas</strong>
                        <p>Tulis dengan jelas, terstruktur, dan mudah dipahami.</p>
                    </div>
                </li>
                <li>
                    <span class="tips-check">✓</span>
                    <div>
                        <strong>Relevan</strong>
                        <p>Pastikan postingan sesuai dengan topik komunitas.</p>
                    </div>
                </li>
                <li>
                    <span class="tips-check">✓</span>
                    <div>
                        <strong>Authentic</strong>
                        <p>Bagikan pemikiran dan pengalaman asli Anda.</p>
                    </div>
                </li>
            </ul>

            <div class="tips-divider"></div>

            <div class="tips-info">
                <p><span class="tips-badge">Maks Judul</span> 255 karakter</p>
                <p><span class="tips-badge">Maks Isi</span> 2000 karakter</p>
            </div>
        </div>

    </div>
    @endauth
</div>

<style>
    .posting-container {
        max-width: 960px;
        margin: 0 auto;
        padding: 24px 20px;
    }

    /* Image Banner */
    .banner-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Null Image Banner */
    .banner-img-null {
        width: 100%;
        height: 200px;
        background: #f1f5f9;
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
    }

    /* Header */
    .posting-header {
        margin-bottom: 20px;
    }

    .posting-title {
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
    }

    .posting-subtitle {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    /* Image Banner */

    /* Auth Alert */
    .alert-auth {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 8px;
        padding: 14px 16px;
    }

    .alert-icon {
        font-size: 20px;
        flex-shrink: 0;
    }

    .alert-auth strong {
        color: #92400e;
        display: block;
        margin-bottom: 2px;
        font-size: 14px;
    }

    .alert-auth p {
        color: #78350f;
        margin: 0;
        font-size: 13px;
    }

    .alert-link {
        color: #b45309;
        font-weight: 600;
        text-decoration: none;
    }

    .alert-link:hover {
        text-decoration: underline;
    }

    /* ROW LAYOUT */
    .posting-row {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    /* LEFT: Form Card */
    .form-card {
        flex: 1;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    /* Error Alert */
    .alert-errors {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 16px;
    }

    .alert-title {
        color: #991b1b;
        display: block;
        margin-bottom: 6px;
        font-size: 13px;
    }

    .errors-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .errors-list li {
        color: #7f1d1d;
        font-size: 12px;
        padding: 2px 0;
    }

    .errors-list li::before {
        content: "• ";
        color: #dc2626;
    }

    /* Form */
    .posting-form {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 6px;
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .label-required {
        color: #dc2626;
    }

    .form-input,
    .form-textarea {
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 12px;
        color: #1e293b;
        font-size: 13.5px;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
        box-sizing: border-box;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #94a3b8;
    }

    .form-input.input-error,
    .form-textarea.input-error {
        border-color: #fca5a5;
        background: #fef2f2;
    }

    .form-textarea {
        resize: vertical;
        min-height: 180px;
    }

    .form-help {
        display: flex;
        justify-content: flex-end;
        margin-top: 4px;
    }

    .char-counter {
        font-size: 11px;
        color: #94a3b8;
    }

    .char-counter span {
        color: #3b82f6;
        font-weight: 600;
    }

    .form-error {
        color: #dc2626;
        font-size: 11px;
        margin-top: 4px;
        display: block;
    }

    /* Actions */
    .form-actions {
        display: flex;
        gap: 8px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-submit,
    .btn-secondary {
        padding: 9px 18px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
    }

    .btn-submit {
        flex: 1;
        background: #2563eb;
        color: #fff;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
    }

    .btn-secondary {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #475569;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #1e293b;
        text-decoration: none;
    }

    /* RIGHT: Tips Card */
    .tips-card {
        width: 220px;
        flex-shrink: 0;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 20px;
    }

    .tips-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 14px 0;
    }

    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .tips-list li {
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }

    .tips-check {
        color: #3b82f6;
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .tips-list strong {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .tips-list p {
        font-size: 11.5px;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    .tips-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 14px 0;
    }

    .tips-info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .tips-info p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tips-badge {
        background: #e0e7ff;
        color: #3730a3;
        font-size: 10px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .posting-row {
            flex-direction: column;
        }

        .tips-card {
            width: 100%;
            position: static;
        }

        .posting-container {
            padding: 16px;
        }

        .posting-title {
            font-size: 18px;
        }
    }
</style>

<script>
    // untuk priview gambar sebelum upload
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const bannerNull = document.getElementById('bannerNull');

        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';

        if (bannerNull) bannerNull.style.display = 'none';
    }
</script>
@endsection