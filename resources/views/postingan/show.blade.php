@extends('layouts.app')
@section('title', $post->judul)
@section('content')

    <div class="detail-container">

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="post-detail-card">

            {{-- Banner --}}
            @if ($post->gambar)
                <img class="banner-img" src="{{ asset('storage/' . $post->gambar) }}" alt="Banner Image">
            @else
                <div class="banner-null"></div>
            @endif

            {{-- Header --}}
            <div class="post-detail-header">
                <h1 class="post-detail-title">{{ $post->judul }}</h1>

                <div class="post-detail-meta">
                    <div class="meta-author">
                        <i class="bi bi-person-fill-gear"></i>
                        <span class="author-name">{{ $post->user->name ?? 'Anonymous' }}</span>
                    </div>
                    <div class="meta-date">
                        <i class="bi bi-calendar2-date-fill"></i>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="meta-time">
                        <i class="bi bi-alarm-fill"></i>
                        <span>{{ $post->created_at->format('H:i') }}</span>
                    </div>
                    @if ($post->updated_at != $post->created_at)
                        <div class="meta-updated">
                            <i class="bi bi-pencil"></i>
                            <span>Diedit {{ $post->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Aksi --}}
            <div class="post-actions">
                <a onclick="window.history.back()" class="btn-action btn-back" style="cursor:pointer;">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                @auth
                    @if (auth()->id() === $post->user_id)
                        <a href="{{ route('postingan.edit', $post->post_id) }}" class="btn-action btn-edit">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <button type="button" class="btn-action btn-delete"
                            data-id="{{ $post->post_id }}" onclick="bukaMod(this)">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    @endif
                @endauth
            </div>
            {{-- Konten --}}
            <hr>
            <div class="post-detail-content">
                {{ $post->isi_post }}
            </div>
        </div>
    </div>

    {{-- Form hapus tersembunyi --}}
    <form id="form-hapus-{{ $post->post_id }}"
        action="{{ route('postingan.destroy', $post->post_id) }}"
        method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Postingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Yakin ingin menghapus postingan ini? Tindakan ini tidak bisa dibatalkan.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnHapusKonfirm">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .detail-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .banner-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .banner-null {
            width: 100%;
            height: 200px;
            background: #f1f5f9;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .post-detail-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .post-detail-header {
            margin-bottom: 24px;
        }

        .post-detail-title {
            font-size: 36px;
            font-weight: 700;
            color: #0c4a6e;
            margin-bottom: 16px;
            line-height: 1.4;
            word-break: break-word;
        }

        .post-detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            color: #64748b;
            font-size: 14px;
        }

        .post-detail-meta div {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .post-detail-meta i {
            color: #3b82f6;
            font-size: 15px;
        }

        .author-name {
            color: #0c4a6e;
            font-weight: 600;
        }

        .meta-updated {
            color: #94a3b8;
            font-style: italic;
        }

        .post-detail-content {
            font-size: 16px;
            color: #475569;
            line-height: 1.8;
            word-break: break-word;
            white-space: pre-wrap;
            margin-bottom: 24px;
        }

        .post-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back {
            background: #e0f2fe;
            border: 1px solid #93c5fd;
            color: #0c4a6e;
        }

        .btn-back:hover {
            background: #bfdbfe;
            border-color: #3b82f6;
            color: #082f49;
            text-decoration: none;
        }

        .btn-edit {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
        }

        .btn-edit:hover {
            background: #bbf7d0;
            border-color: #22c55e;
            color: #15803d;
            text-decoration: none;
        }

        .btn-delete {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .btn-delete:hover {
            background: #fecaca;
            border-color: #ef4444;
            color: #7f1d1d;
        }

        @media (max-width: 768px) {
            .detail-container { padding: 20px 16px; }
            .post-detail-card { padding: 20px; }
            .post-detail-title { font-size: 24px; }
            .post-detail-meta { gap: 12px; font-size: 13px; }
            .banner-img { height: 200px; }
        }

        @media (max-width: 576px) {
            .detail-container { padding: 16px 12px; }
            .post-detail-card { padding: 16px; }
            .post-detail-title { font-size: 20px; }
            .post-detail-meta { flex-direction: column; gap: 10px; }
            .post-detail-content { font-size: 14px; }
            .post-actions { flex-direction: column; }
            .btn-action { width: 100%; padding: 12px; }
        }
    </style>

    <script>
        let formHapus = null;

        function bukaMod(btn) {
            const id = btn.getAttribute('data-id');
            formHapus = document.getElementById('form-hapus-' + id);
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }

        document.getElementById('btnHapusKonfirm')?.addEventListener('click', () => {
            if (formHapus) formHapus.submit();
        });
    </script>

@endsection