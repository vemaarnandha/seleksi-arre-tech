@extends('layouts.app')

@section('title', 'postingan')

@section('content')

    @if (Auth::check())
        <div class="akun-container">
            <!-- Hero Profile Section -->
            <div class="profile-hero">
                <div class="profile-backdrop"></div>

                <div class="profile-content">
                    <div class="profile-avatar">
                        <div class="avatar-icon">
                            @if (Auth::user()->profil)
                                <img class="pfp" src="{{ asset('storage/' . Auth::user()->profil) }}">
                            @else
                                <i>
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </i>
                            @endif
                        </div>
                    </div>

                    <div class="profile-info">
                        <h1 class="profile-name">{{ Auth::user()->name }}</h1>
                        <p class="profile-email">
                            <i class="ra ra-mail"></i>
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $postCount }}</span>
                            <span class="stat-label">Postingan</span>
                        </div>
                    </div>

                    <a href="{{ route('postingan-baru') }}" class="profile-btn-create">
                        <i class="ra ra-quill-ink"></i>
                        Buat Postingan Baru
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul</th>
                            <th style="width: 180px;">Terakhir Ubah</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($post as $p)
                            <tr>
                                <td class="text-center fw-bold">{{ $post->firstItem() + $loop->index }}</td>
                                <td>
                                    <div class="fw-semibold"><a href="{{ route('postingan.show', $p->post_id) }}"
                                            class="text-decoration-none">{{ $p->judul }}</a></div>
                                    <small class="text-muted">{{ Str::limit($p->isi_post, 60, '...') }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-clock"></i>
                                        {{ $p->updated_at->format('d M Y, H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center flex-wrap">
                                        <a href="{{ route('postingan.show', $p->post_id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('postingan.edit', $p->post_id) }}" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('postingan.delete', $p->post_id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin hapus postingan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-id="{{ $p->post_id }}"
                                                onclick="bukaMod(this)">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada postingan.
                                </td>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $post->links() }}
                </div>
            </div>
            @foreach ($post as $p)
                <form id="form-hapus-{{ $p->post_id }}" action="{{ route('postingan.delete', $p->post_id) }}" method="POST"
                    class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            {{--Modal Hapus Postingan --}}
            <div class="modal fade" id="modalHapus" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Postingan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">Yakin ingin menghapus postingan ini?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" id="btnHapusKonfirm">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Not Authenticated Alert -->
        <div class="akun-container">
            <div class="alert-auth">
                <div class="alert-content">
                    <span class="alert-icon">🔒</span>
                    <div>
                        <strong>Login Diperlukan</strong>
                        <p>Anda harus login untuk melihat informasi akun. <a href="{{ route('login') }}"
                                class="alert-link">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <style>
        /* Container */
        .akun-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Alert */
        .alert-auth {
            background: #fed7aa;
            border: 1px solid #fb923c;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 30px;
        }

        .alert-content {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .alert-icon {
            font-size: 32px;
            flex-shrink: 0;
        }

        .alert-auth strong {
            color: #92400e;
            display: block;
            margin-bottom: 4px;
            font-size: 16px;
        }

        .alert-auth p {
            color: #78350f;
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-link {
            color: #b45309;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .alert-link:hover {
            color: #92400e;
        }

        /* Hero Profile */
        .profile-hero {
            position: relative;
            background: linear-gradient(135deg, #cffafe 0%, #e0f2fe 100%);
            border: 1px solid #bae6fd;
            border-radius: 20px;
            padding: 60px 40px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        .profile-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 150px;
            background: linear-gradient(135deg, #a5f3fc 0%, #7dd3fc 100%);
            opacity: 0.6;
        }

        .profile-content {
            position: relative;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .pfp {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-avatar {
            flex-shrink: 0;
        }

        .avatar-icon {
            width: 160px;
            height: 160px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #fff;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 32px;
            font-weight: 700;
            color: #0c4a6e;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .profile-email {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            color: #475569;
            margin-bottom: 24px;
        }

        .profile-email i {
            color: #3b82f6;
            font-size: 18px;
        }

        .profile-stats {
            display: flex;
            gap: 32px;
            margin-bottom: 24px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #0ea5e9;
        }

        .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-top: 4px;
        }

        .profile-btn-create {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .profile-btn-create:hover {
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            text-decoration: none;
        }

        .profile-btn-create i {
            font-size: 18px;
        }

        /* Posts Section */
        .posts-section {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
        }

        .posts-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 20px;
        }

        .posts-title {
            font-size: 22px;
            font-weight: 700;
            color: #0c4a6e;
            margin: 0;
        }

        .sort-controls {
            display: flex;
            gap: 12px;
        }

        .sort-buttons {
            display: flex;
            gap: 8px;
        }

        .sort-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: #fff;
            border: 1px solid #cbd5e1;
            color: #475569;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .sort-btn:hover {
            background: #e0f2fe;
            border-color: #3b82f6;
            color: #0c4a6e;
        }

        .sort-btn.active {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            border-color: #3b82f6;
            color: #0c4a6e;
        }

        /* Posts List */
        .posts-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .post-item {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            transition: all 0.3s ease;
        }

        .post-item:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .post-item-number {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #0c4a6e;
        }

        .post-item-content {
            flex: 1;
            min-width: 0;
        }

        .post-item-title {
            font-size: 16px;
            font-weight: 700;
            color: #0c4a6e;
            margin: 0 0 6px 0;
            word-break: break-word;
        }

        .post-item-preview {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 8px 0;
            line-height: 1.4;
        }

        .post-item-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .post-item-date,
        .post-item-updated {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #64748b;
        }

        .post-item-date i,
        .post-item-updated i {
            color: #3b82f6;
            font-size: 13px;
        }

        .post-item-actions {
            display: flex;
            gap: 8px;
        }

        .post-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .post-view {
            background: #dbeafe;
            color: #0c4a6e;
            border: 1px solid #93c5fd;
        }

        .post-view:hover {
            background: #bfdbfe;
            border-color: #3b82f6;
            color: #082f49;
        }

        .post-edit {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .post-edit:hover {
            background: #bbf7d0;
            border-color: #22c55e;
            color: #15803d;
        }

        .post-delete {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .post-delete:hover {
            background: #fecaca;
            border-color: #ef4444;
            color: #7f1d1d;
        }


        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #fff;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
        }

        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        .empty-title {
            font-size: 22px;
            font-weight: 700;
            color: #0c4a6e;
            margin-bottom: 8px;
        }

        .empty-text {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }

        .empty-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .empty-btn:hover {
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-outline-primary,
            .btn-outline-success,
            .btn-outline-danger {
                width: 100%;
                justify-content: center;
            }

            .table tbody td {
                padding: 8px;
                font-size: 12px;
            }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .profile-hero {
                padding: 40px;
            }

            .profile-content {
                gap: 30px;
            }

            .posts-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 768px) {
            .akun-container {
                padding: 20px 16px;
            }

            .profile-hero {
                padding: 30px 20px;
            }

            .profile-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .avatar-icon {
                width: 100px;
                height: 100px;
                font-size: 48px;
            }

            .profile-name {
                font-size: 24px;
            }

            .profile-stats {
                justify-content: center;
                gap: 24px;
            }

            .profile-btn-create {
                width: 100%;
            }

            .post-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .post-item-actions {
                width: 100%;
                gap: 10px;
            }

            .post-action-btn {
                flex: 1;
                justify-content: center;
            }

            .posts-header {
                flex-direction: column;
                align-items: stretch;
            }

            .sort-buttons {
                width: 100%;
            }

            .sort-btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .akun-container {
                padding: 16px 12px;
            }

            .profile-hero {
                padding: 20px;
                margin-bottom: 30px;
            }

            .avatar-icon {
                width: 80px;
                height: 80px;
                font-size: 40px;
            }

            .profile-name {
                font-size: 20px;
            }

            .profile-email {
                font-size: 14px;
            }

            .profile-stats {
                flex-direction: column;
                gap: 16px;
            }

            .posts-section {
                padding: 20px;
            }

            .posts-title {
                font-size: 18px;
            }

            .post-item {
                padding: 12px;
            }

            .post-item-title {
                font-size: 14px;
            }

            .post-item-preview {
                font-size: 12px;
            }

            .post-action-btn {
                padding: 8px 10px;
                font-size: 11px;
                gap: 4px;
            }

            .post-action-btn i {
                font-size: 14px;
            }

            .empty-icon {
                font-size: 48px;
            }
        }
    </style>

    <script>
        let formHapus = null;

        function bukaMod(btn) {
            const id = btn.getAttribute('data-id');
            formHapus = document.getElementById('form-hapus-' + id);
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }

        document.getElementById('btnHapusKonfirm').addEventListener('click', () => {
            if (formHapus) formHapus.submit();
        });
    </script>

@endsection