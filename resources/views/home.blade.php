@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container border-rounded shadow-sm p-4">
        <!-- Header Section -->
        <div class="posts-header">
            <h1 class="posts-title">
                <i class="bi bi-book"></i> Semua Postingan
            </h1>
            <p class="posts-subtitle">Jelajahi postingan dari komunitas <br>Jumlah semua postingan: {{ $post->total() }}</p>
        </div>

        {{-- search bar --}}
        <div class="search-bar mb-4">
            <form action="{{ route('home') }}" method="GET">
                <div class="row">
                    <div class="col col-md-2 d-flex align-items-center gap-2">
                        <select class="form-control" name="sort" onchange="this.form.submit()">
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>
                    <div class="col col-md-10 d-flex align-items-center gap-2">
                        <input type="text" class="form-control" placeholder="Cari postingan..." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Posts Grid -->
        <div class="posts-grid my-3">
            @forelse ($post as $p)
                <div class="post-card" onclick="window.location='{{ route('postingan.show', $p->post_id) }}'"
                    style="cursor:pointer;">
                    <div class="post-card-content">
                        {{-- Gambar --}}
                        @if ($p->gambar)
                            <img class="banner-img" src="{{ asset('storage/' . $p->gambar) }}" loading="lazy">
                        @else
                            <div style="width: 100%; height: 200px; background: #f1f5f9; border-radius: 8px;"></div>
                        @endif

                        <!-- Title -->
                        <h5 class="post-title mt-3">{{ Str::limit($p->judul, 50, '...') }}</h5>

                        <!-- Preview Text -->
                        <p class="post-preview">
                            {{ Str::limit($p->isi_post, 100, '...') }}
                        </p>

                        <!-- Meta Info -->
                        <div class="post-meta">
                            <span class="post-author">
                                <i class="bi bi-person-fill-gear"></i>
                                Pembuat : {{ $p->user->name ?? 'Anonymous' }}
                            </span>
                            <span class="post-date">
                                <i class="bi bi-calendar"></i>
                                {{ $p->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="post-footer">
                        <a href="{{ route('postingan.show', $p->post_id) }}" class="btn-detail"
                            onclick="event.stopPropagation()">
                            Lihat Detail <i class="ra ra-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div class="empty-icon">📭</div>
                    <h3 class="empty-title">Belum Ada Postingan</h3>
                    <p class="empty-text">Jadilah yang pertama membuat postingan!</p>
                    @auth
                        <a href="{{ route('postingan-baru') }}" class="btn-create-post">
                            <i class="bi bi-pencil"> Buat Postingan</i>
                        </a>
                    @endauth
                </div>
            @endforelse
        </div>
        <!-- Pagination -->
        <div class="pagination-section">
            {{ $post->links() }}
        </div>
    </div>

    <style>
        /* priview banner */
        .banner-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Layout & Spacing */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* Header */
        .posts-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .posts-title {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .posts-subtitle {
            font-size: 16px;
            color: #64748b;
            margin: 0;
        }

        /* Posts Grid */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        /* Post Card */
        .post-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            height: 100%;
        }

        .post-card:hover {
            background: #f8fafc;
            border-color: #3b82f6;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.15);
        }

        .post-card-content {
            flex-grow: 1;
        }

        .post-title {
            font-size: 18px;
            font-weight: 700;
            color: #0c4a6e;
            margin-bottom: 12px;
            line-height: 1.4;
            word-break: break-word;
        }

        .post-preview {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 16px;
            line-height: 1.5;
            min-height: 42px;
        }

        .post-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .post-author,
        .post-date {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
        }

        .post-author i,
        .post-date i {
            font-size: 14px;
            color: #3b82f6;
        }

        /* Button */
        .post-footer {
            margin-top: auto;
        }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
            border: 1px solid #93c5fd;
            color: #0c4a6e;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            border-color: #3b82f6;
            color: #fff;
            text-decoration: none;
            transform: translateX(2px);
        }

        .btn-detail i {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .btn-detail:hover i {
            transform: translateX(2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: #f8fafc;
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

        .btn-create-post {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-create-post:hover {
            background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
            text-decoration: none;
        }

        /* Pagination */
        .pagination-section {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .pagination {
            gap: 6px;
        }

        .page-link {
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #0c4a6e;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background: #e0f2fe;
            border-color: #3b82f6;
            color: #0c4a6e;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            border-color: #3b82f6;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .posts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 20px 12px;
            }

            .posts-title {
                font-size: 24px;
            }

            .posts-subtitle {
                font-size: 14px;
            }

            .post-card {
                padding: 16px;
            }

            .post-title {
                font-size: 16px;
            }
        }
    </style>

@endsection