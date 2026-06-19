@extends('layouts.app')

@section('title', 'Daftar Buku — Slytherin Restricted Library')

@push('styles')
<style>
    /* ── Keyframes ── */
    @keyframes shimmer {
        0%   { left: -100%; }
        50%  { left: 100%; }
        100% { left: 100%; }
    }
    @keyframes rise {
        0%   { opacity: 0;   transform: translateY(0)      scale(0); }
        20%  { opacity: 0.5; transform: translateY(-30px)  scale(1); }
        80%  { opacity: 0.15;transform: translateY(-90px)  scale(0.5); }
        100% { opacity: 0;   transform: translateY(-130px) scale(0); }
    }
    @keyframes fadeSlideIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes rowGlow {
        from { box-shadow: none; }
        to   { box-shadow: inset 3px 0 0 #d4af37, inset 0 0 40px rgba(212,175,55,0.04); }
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 0.4; transform: scale(1); }
        50%       { opacity: 1;   transform: scale(1.3); }
    }
    @keyframes borderGlow {
        0%, 100% { box-shadow: 0 0 8px rgba(212,175,55,0.15); }
        50%       { box-shadow: 0 0 20px rgba(212,175,55,0.35), 0 0 40px rgba(34,197,94,0.08); }
    }

    /* ── Particles ── */
    .particle {
        position: fixed;
        width: 2px; height: 2px;
        border-radius: 9999px;
        opacity: 0;
        pointer-events: none;
        animation: rise var(--dur) ease-in var(--delay) infinite;
        z-index: 0;
    }

    /* ── Page enter ── */
    .page-enter { animation: fadeSlideIn 0.5s ease both; }
    .page-enter-delay-1 { animation: fadeSlideIn 0.5s ease 0.08s both; }
    .page-enter-delay-2 { animation: fadeSlideIn 0.5s ease 0.16s both; }
    .page-enter-delay-3 { animation: fadeSlideIn 0.5s ease 0.24s both; }

    /* ── Gold shimmer button ── */
    .btn-gold {
        position: relative;
        overflow: hidden;
        background: #d4af37;
        color: #0a1a0f;
        font-weight: 600;
        transition: background 0.25s, box-shadow 0.25s, transform 0.15s;
    }
    .btn-gold::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
        animation: shimmer 3s ease-in-out infinite;
    }
    .btn-gold:hover {
        background: #e8c84a;
        box-shadow: 0 0 18px rgba(212,175,55,0.45);
        transform: translateY(-1px);
    }
    .btn-gold:active { transform: translateY(0); }

    /* ── Search input glow ── */
    .search-input:focus {
        border-color: #d4af37 !important;
        box-shadow: 0 0 0 2px rgba(212,175,55,0.15), 0 0 20px rgba(212,175,55,0.08);
    }

    /* ── Table row hover ── */
    .tome-row {
        transition: background 0.2s, box-shadow 0.2s;
        position: relative;
    }
    .tome-row:hover {
        background: #1a4a2e !important;
        box-shadow: inset 3px 0 0 #d4af37, inset 0 0 40px rgba(212,175,55,0.04);
    }
    .tome-row:hover .row-title {
        color: #f5f0e8;
        text-shadow: 0 0 12px rgba(212,175,55,0.15);
    }

    /* ── Cover image ── */
    .cover-thumb {
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid rgba(212,175,55,0.2);
    }
    .tome-row:hover .cover-thumb {
        transform: scale(1.08) rotate(-1deg);
        box-shadow: 0 4px 16px rgba(0,0,0,0.5), 0 0 12px rgba(212,175,55,0.2);
    }

    /* ── Action buttons ── */
    .btn-detail {
        transition: all 0.2s;
        border: 1px solid rgba(192,192,192,0.25);
    }
    .btn-detail:hover {
        background: rgba(192,192,192,0.2) !important;
        border-color: rgba(192,192,192,0.5);
        transform: translateY(-1px);
    }
    .btn-edit {
        transition: all 0.2s;
        border: 1px solid rgba(212,175,55,0.25);
    }
    .btn-edit:hover {
        background: rgba(212,175,55,0.25) !important;
        border-color: rgba(212,175,55,0.6);
        box-shadow: 0 0 12px rgba(212,175,55,0.2);
        transform: translateY(-1px);
    }
    .btn-hapus {
        transition: all 0.2s;
        border: 1px solid rgba(239,68,68,0.2);
    }
    .btn-hapus:hover {
        background: rgba(127,29,29,0.8) !important;
        border-color: rgba(239,68,68,0.5);
        box-shadow: 0 0 12px rgba(239,68,68,0.15);
        transform: translateY(-1px);
    }

    /* ── Tabel container glow border ── */
    .tome-table-wrap {
        animation: borderGlow 4s ease-in-out infinite;
    }

    /* ── Section ornament divider ── */
    .ornament-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        margin-bottom: 1.5rem;
    }

    /* ── Empty state ── */
    .empty-state {
        padding: 3.5rem 1rem;
        text-align: center;
    }

    /* ── Pagination styling ── */
    .pagination-wrap nav span,
    .pagination-wrap nav a {
        background: #0f2d1a !important;
        border-color: rgba(212,175,55,0.2) !important;
        color: #c0c0c0 !important;
        transition: all 0.2s;
    }
    .pagination-wrap nav a:hover {
        background: #1a4a2e !important;
        border-color: rgba(212,175,55,0.5) !important;
        color: #d4af37 !important;
    }
    .pagination-wrap nav span[aria-current="page"] span {
        background: #d4af37 !important;
        border-color: #d4af37 !important;
        color: #0a1a0f !important;
        font-weight: 700;
    }

    /* ── Stone texture ── */
    .stone-texture {
        position: fixed;
        inset: 0;
        background-image:
            repeating-linear-gradient(0deg,  transparent, transparent 60px, rgba(255,255,255,0.005) 60px, rgba(255,255,255,0.005) 61px),
            repeating-linear-gradient(90deg, transparent, transparent 80px, rgba(255,255,255,0.003) 80px, rgba(255,255,255,0.003) 81px);
        pointer-events: none;
        z-index: 0;
    }

    /* ── Cover placeholder ── */
    .cover-placeholder {
        width: 40px; height: 56px;
        border-radius: 4px;
        background: #0f2d1a;
        border: 1px solid rgba(212,175,55,0.15);
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s;
    }
    .tome-row:hover .cover-placeholder {
        border-color: rgba(212,175,55,0.35);
        box-shadow: 0 0 10px rgba(212,175,55,0.1);
    }

    /* ── Year badge ── */
    .year-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 3px;
        background: rgba(212,175,55,0.1);
        border: 1px solid rgba(212,175,55,0.2);
        color: #d4af37;
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 0.05em;
        transition: all 0.2s;
    }
    .tome-row:hover .year-badge {
        background: rgba(212,175,55,0.18);
        border-color: rgba(212,175,55,0.4);
        box-shadow: 0 0 8px rgba(212,175,55,0.15);
    }
</style>
@endpush

@section('content')

{{-- Stone texture --}}
<div class="stone-texture"></div>

{{-- Ambient glow --}}
<div class="fixed top-1/3 right-1/4 w-96 h-96 rounded-full pointer-events-none"
     style="background: radial-gradient(circle, rgba(34,197,94,0.04) 0%, transparent 70%); z-index:0;"></div>
<div class="fixed bottom-1/4 left-1/3 w-64 h-64 rounded-full pointer-events-none"
     style="background: radial-gradient(circle, rgba(212,175,55,0.04) 0%, transparent 70%); z-index:0;"></div>

{{-- Dust particles --}}
<div class="particle" style="left:8%;bottom:20%;background:#d4af37;--dur:6s;--delay:0s"></div>
<div class="particle" style="left:18%;bottom:30%;background:#d4af37;--dur:8s;--delay:1.5s"></div>
<div class="particle" style="left:45%;bottom:15%;background:#86efac;--dur:7s;--delay:0.8s;width:3px;height:3px"></div>
<div class="particle" style="left:60%;bottom:25%;background:#d4af37;--dur:9s;--delay:2.2s"></div>
<div class="particle" style="left:75%;bottom:20%;background:#d4af37;--dur:6s;--delay:1s"></div>
<div class="particle" style="left:85%;bottom:40%;background:#d4af37;--dur:7.5s;--delay:3s"></div>
<div class="particle" style="left:30%;bottom:50%;background:#86efac;--dur:5.5s;--delay:4s;width:3px;height:3px"></div>

{{-- ════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════ --}}
<div class="relative z-10 page-enter mb-8">

    {{-- Top ornament --}}
    <div class="flex items-center gap-3 mb-4">
        <svg width="160" height="14" viewBox="0 0 160 14" fill="none">
            <defs>
                <linearGradient id="hdl1" x1="0" y1="0" x2="70" y2="0" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#d4af37" stop-opacity="0"/>
                    <stop offset="100%" stop-color="#d4af37" stop-opacity="0.5"/>
                </linearGradient>
                <linearGradient id="hdl2" x1="90" y1="0" x2="160" y2="0" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#d4af37" stop-opacity="0.5"/>
                    <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                </linearGradient>
            </defs>
            <line x1="0"  y1="7" x2="70" y2="7" stroke="url(#hdl1)" stroke-width="0.75"/>
            <path d="M74 7 L78 3 L82 7 L78 11 Z" fill="rgba(212,175,55,0.5)"/>
            <circle cx="80" cy="7" r="2" fill="#d4af37" opacity="0.8"/>
            <path d="M82 7 L86 3 L90 7 L86 11 Z" fill="rgba(212,175,55,0.5)"/>
            <line x1="90" y1="7" x2="160" y2="7" stroke="url(#hdl2)" stroke-width="0.75"/>
        </svg>
    </div>

    <div class="flex items-end justify-between">
        <div>
            {{-- Eyebrow --}}
            <p class="text-xs tracking-[0.2em] uppercase mb-1"
               style="color: rgba(212,175,55,0.6); font-family:'Inter',sans-serif;">
                ✦ &nbsp;Restricted Section
            </p>
            <h1 style="font-family:'IM Fell English',serif; font-size:28px; color:#f5f0e8;
                       text-shadow: 0 0 30px rgba(212,175,55,0.1); line-height:1.2;">
                Koleksi Buku
            </h1>
            <p class="mt-1 text-sm" style="color:#c0c0c0; font-family:'IM Fell English',serif; font-style:italic;">
                Hanya yang layak, boleh membuka lembaran ini.
            </p>
        </div>

        {{-- Add button --}}
        <a href="{{ route('buku.create') }}"
           class="btn-gold flex items-center gap-2 px-5 py-2.5 rounded-md text-sm">
            <i class="ti ti-book-plus text-base"></i>
            Tambah Buku
        </a>
    </div>

    {{-- Bottom ornament --}}
    <div class="mt-4">
        <svg width="100%" height="8" viewBox="0 0 600 8" fill="none" preserveAspectRatio="none">
            <defs>
                <linearGradient id="hbl" x1="0" y1="0" x2="600" y2="0" gradientUnits="userSpaceOnUse">
                    <stop offset="0%"   stop-color="#d4af37" stop-opacity="0"/>
                    <stop offset="30%"  stop-color="#d4af37" stop-opacity="0.4"/>
                    <stop offset="70%"  stop-color="#d4af37" stop-opacity="0.4"/>
                    <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                </linearGradient>
            </defs>
            <line x1="0" y1="4" x2="600" y2="4" stroke="url(#hbl)" stroke-width="0.75"/>
        </svg>
    </div>
</div>

{{-- ════════════════════════════════════════════
     FLASH MESSAGES
════════════════════════════════════════════ --}}
<div class="relative z-10 page-enter-delay-1">
    @if (session('success'))
        <div class="mb-5 px-4 py-3 rounded-md flex items-center gap-3 text-sm"
             style="background: rgba(26,74,46,0.8); border: 1px solid rgba(34,197,94,0.4); color:#86efac;
                    box-shadow: 0 0 20px rgba(34,197,94,0.08);">
            <i class="ti ti-circle-check flex-shrink-0 text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-5 px-4 py-3 rounded-md flex items-center gap-3 text-sm"
             style="background: rgba(127,29,29,0.8); border: 1px solid rgba(239,68,68,0.4); color:#fca5a5;
                    box-shadow: 0 0 20px rgba(239,68,68,0.08);">
            <i class="ti ti-alert-circle flex-shrink-0 text-base"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
</div>

{{-- ════════════════════════════════════════════
     SEARCH BAR
════════════════════════════════════════════ --}}
<div class="relative z-10 mb-5 page-enter-delay-1">
    <form action="{{ route('buku.index') }}" method="GET">
        <div class="flex gap-2 max-w-lg">
            <div class="relative flex-1">
                {{-- Ornament inside input --}}
                <i class="ti ti-search absolute left-3.5 top-1/2 -translate-y-1/2 text-sm"
                   style="color: rgba(212,175,55,0.5);"></i>
                <input type="text" name="q" value="{{ $q }}"
                       placeholder="Cari judul, penulis, atau penerbit…"
                       class="search-input w-full pl-10 pr-4 py-2.5 rounded-md text-sm transition-all duration-200"
                       style="background: #0f2d1a; border: 1px solid rgba(212,175,55,0.2);
                              color: #f5f0e8; outline: none;"
                       onkeydown="if(event.key==='Enter')this.closest('form').submit()">
            </div>
            <button type="submit"
                    class="px-4 py-2.5 rounded-md text-sm transition-all duration-200 flex items-center gap-1.5"
                    style="background: rgba(212,175,55,0.12); border: 1px solid rgba(212,175,55,0.3); color: #d4af37;"
                    onmouseover="this.style.background='rgba(212,175,55,0.2)'"
                    onmouseout="this.style.background='rgba(212,175,55,0.12)'">
                <i class="ti ti-search text-sm"></i>
                Cari
            </button>
            @if($q)
                <a href="{{ route('buku.index') }}"
                   class="px-4 py-2.5 rounded-md text-sm transition-all duration-200 flex items-center gap-1.5"
                   style="background: rgba(192,192,192,0.08); border: 1px solid rgba(192,192,192,0.2); color: #c0c0c0;"
                   onmouseover="this.style.background='rgba(192,192,192,0.15)'"
                   onmouseout="this.style.background='rgba(192,192,192,0.08)'">
                    <i class="ti ti-x text-sm"></i>
                    Reset
                </a>
            @endif
        </div>
        @if($q)
            <p class="mt-2 text-xs" style="color: rgba(212,175,55,0.6); font-style:italic;">
                ✦ Menampilkan hasil untuk: "{{ $q }}"
            </p>
        @endif
    </form>
</div>

{{-- ════════════════════════════════════════════
     TABLE
════════════════════════════════════════════ --}}
<div class="relative z-10 page-enter-delay-2">
    <div class="tome-table-wrap rounded-lg overflow-hidden"
         style="border: 1px solid rgba(212,175,55,0.25); background: #0f2d1a;">

        {{-- Table header ornament --}}
        <div class="flex items-center justify-between px-5 py-3"
             style="background: linear-gradient(90deg, #1a4a2e, #0f2d1a);
                    border-bottom: 1px solid rgba(212,175,55,0.2);">
            <div class="flex items-center gap-2">
                {{-- Small crest icon --}}
                <div class="w-6 h-6 rounded-full flex items-center justify-center"
                     style="border: 1px solid rgba(212,175,55,0.3); background: rgba(212,175,55,0.05);">
                    <i class="ti ti-shield-half-filled text-xs" style="color:#d4af37;"></i>
                </div>
                <span class="text-xs tracking-widest uppercase" style="color: rgba(212,175,55,0.7); font-family:'Inter',sans-serif;">
                    Restricted Collection
                </span>
            </div>
            <div class="flex items-center gap-1.5">
                <div class="w-1.5 h-1.5 rounded-full" style="background:#22c55e; animation: pulse-dot 2s ease-in-out infinite;"></div>
                <span class="text-xs" style="color: rgba(134,239,172,0.6);">
                    {{ $bukus->total() }} tome{{ $bukus->total() != 1 ? 's' : '' }}
                </span>
            </div>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr style="background: linear-gradient(90deg, #1a4a2e 0%, #0f2d1a 100%);
                           border-bottom: 1px solid rgba(212,175,55,0.2);">
                    <th class="px-5 py-3.5 text-left w-16"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Cover
                    </th>
                    <th class="px-5 py-3.5 text-left"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Judul
                    </th>
                    <th class="px-5 py-3.5 text-left hidden md:table-cell"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Penulis
                    </th>
                    <th class="px-5 py-3.5 text-left hidden lg:table-cell"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Penerbit
                    </th>
                    <th class="px-5 py-3.5 text-left"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Tahun
                    </th>
                    <th class="px-5 py-3.5 text-right"
                        style="color: rgba(212,175,55,0.8); font-family:'Inter',sans-serif;
                               font-size:11px; letter-spacing:0.12em; font-weight:600; text-transform:uppercase;">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                    <tr class="tome-row" style="background: #0a1a0f; border-top: 1px solid rgba(212,175,55,0.08);">

                        {{-- Cover --}}
                        <td class="px-5 py-3">
                            @if ($buku->cover)
                                <img src="{{ asset('storage/' . $buku->cover) }}"
                                     alt="{{ $buku->judul }}"
                                     class="cover-thumb w-10 h-14 object-cover rounded">
                            @else
                                <div class="cover-placeholder">
                                    <i class="ti ti-book text-xs" style="color: rgba(212,175,55,0.3);"></i>
                                </div>
                            @endif
                        </td>

                        {{-- Judul --}}
                        <td class="px-5 py-3">
                            <span class="row-title font-medium transition-all duration-200"
                                  style="color: #f5f0e8; font-family:'Inter',sans-serif;">
                                {{ $buku->judul }}
                            </span>
                        </td>

                        {{-- Penulis --}}
                        <td class="px-5 py-3 hidden md:table-cell"
                            style="color: #c0c0c0;">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-feather-pointed" style="color: #efbf04; opacity:0.5"></i>
                                {{ $buku->penulis }}
                            </span>
                        </td>

                        {{-- Penerbit --}}
                        <td class="px-5 py-3 hidden lg:table-cell"
                            style="color: rgba(192,192,192,0.7);">
                            {{ $buku->penerbit }}
                        </td>

                        {{-- Tahun --}}
                        <td class="px-5 py-3">
                            <span class="year-badge">{{ $buku->tahun_terbit }}</span>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-5 py-3">
                            <div class="flex justify-end gap-1.5">
                                <a href="{{ route('buku.show', $buku->id) }}"
                                   class="btn-detail flex items-center gap-1 px-3 py-1.5 rounded-md text-xs"
                                   style="background: rgba(192,192,192,0.1); color: #c0c0c0;"
                                   title="Detail">
                                    <i class="ti ti-eye text-xs"></i>
                                    <span class="hidden sm:inline">Detail</span>
                                </a>
                                <a href="{{ route('buku.edit', $buku->id) }}"
                                   class="btn-edit flex items-center gap-1 px-3 py-1.5 rounded-md text-xs"
                                   style="background: rgba(212,175,55,0.12); color: #d4af37;"
                                   title="Edit">
                                    <i class="ti ti-edit text-xs"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                                id="form-hapus-{{ $buku->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="konfirmasiHapus('form-hapus-{{ $buku->id }}', 'Buku {{ $buku->judul }}')"
                                        class="btn-hapus flex items-center gap-1 px-3 py-1.5 rounded-md text-xs"
                                        style="background: rgba(127,29,29,0.4); color: #fca5a5;"
                                        title="Hapus">
                                    <i class="ti ti-trash text-xs"></i>
                                    <span class="hidden sm:inline">Hapus</span>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                {{-- Empty ornament --}}
                                <div class="flex justify-center mb-4">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <circle cx="40" cy="40" r="32"
                                                stroke="rgba(212,175,55,0.15)" stroke-width="1"
                                                stroke-dasharray="4 4"/>
                                        <circle cx="40" cy="40" r="22"
                                                stroke="rgba(212,175,55,0.1)" stroke-width="0.75"/>
                                        <text x="40" y="44" text-anchor="middle"
                                              font-family="tabler-icons" font-size="22"
                                              fill="rgba(212,175,55,0.3)"></text>
                                    </svg>
                                </div>
                                <i class="ti ti-books text-4xl mb-3 block" style="color: rgba(212,175,55,0.25);"></i>
                                @if ($q)
                                    <p style="color: #c0c0c0; font-family:'IM Fell English',serif; font-style:italic;">
                                        Tidak ditemukan tome yang berjudul atau ditulis oleh<br>
                                        <span style="color:#d4af37;">"{{ $q }}"</span>
                                    </p>
                                    <a href="{{ route('buku.index') }}"
                                       class="inline-flex items-center gap-1.5 mt-4 text-xs transition-all duration-200"
                                       style="color: rgba(212,175,55,0.6);"
                                       onmouseover="this.style.color='#d4af37'"
                                       onmouseout="this.style.color='rgba(212,175,55,0.6)'">
                                        <i class="ti ti-arrow-left text-xs"></i>
                                        Tampilkan semua koleksi
                                    </a>
                                @else
                                    <p style="color: #c0c0c0; font-family:'IM Fell English',serif; font-style:italic;">
                                        Restricted Section masih kosong.<br>Mulai tambahkan koleksi pertama.
                                    </p>
                                    <a href="{{ route('buku.create') }}"
                                       class="btn-gold inline-flex items-center gap-2 mt-5 px-5 py-2.5 rounded-md text-sm">
                                        <i class="ti ti-book-plus"></i>
                                        Tambah Buku Pertama
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Table footer --}}
        @if($bukus->count() > 0)
        <div class="px-5 py-3 flex items-center justify-between"
             style="border-top: 1px solid rgba(212,175,55,0.1);
                    background: linear-gradient(90deg, #0a1a0f, #0f2d1a);">
            <p class="text-xs" style="color: rgba(192,192,192,0.45); font-style:italic;">
                Menampilkan {{ $bukus->firstItem() }}–{{ $bukus->lastItem() }} dari {{ $bukus->total() }} koleksi
            </p>
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 rounded-full" style="background: rgba(212,175,55,0.3);"></div>
                <div class="w-1 h-1 rounded-full" style="background: rgba(212,175,55,0.5);"></div>
                <div class="w-1 h-1 rounded-full" style="background: rgba(212,175,55,0.3);"></div>
            </div>
        </div>
        @endif
    </div>

    {{-- Pagination --}}
    @if ($bukus->hasPages())
        <div class="pagination-wrap mt-4">
            {{ $bukus->links() }}
        </div>
    @endif
</div>

@endsection