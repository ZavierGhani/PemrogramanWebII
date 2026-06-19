@extends('layouts.app')

@section('title', 'Dashboard — Slytherin Restricted Library')
@section('page-title', 'Dashboard')

@section('content')

@push('styles')
<style>
    /* ── Keyframes ── */
    @keyframes pulse-ring {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50%       { opacity: 0.7; transform: scale(1.12); }
    }
    @keyframes count-shimmer {
        0%   { left: -100%; }
        60%  { left: 100%; }
        100% { left: 100%; }
    }
    @keyframes badge-pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(251,191,36,0.4); }
        50%       { box-shadow: 0 0 0 5px rgba(251,191,36,0); }
    }
    @keyframes dot-blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.2; }
    }
    @keyframes rise-db {
        0%   { opacity: 0; transform: translateY(0) scale(0); }
        20%  { opacity: 0.5; transform: translateY(-30px) scale(1); }
        80%  { opacity: 0.1; transform: translateY(-90px) scale(0.5); }
        100% { opacity: 0; transform: translateY(-130px) scale(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Dust particles in main content ── */
    .db-particle {
        position: fixed;
        width: 2px; height: 2px;
        border-radius: 9999px;
        background: #d4af37;
        opacity: 0;
        animation: rise-db var(--dur) ease-in var(--delay) infinite;
        pointer-events: none;
        z-index: 1;
    }

    /* ── Stat card base ── */
    .stat-card {
        position: relative;
        border-radius: 10px;
        padding: 22px 20px 20px;
        overflow: hidden;
        cursor: default;
        transition: transform 0.3s cubic-bezier(.22,.68,0,1.2),
                    box-shadow 0.3s ease,
                    border-color 0.3s ease;
        animation: fadeInUp 0.5s ease both;
    }
    .stat-card:hover {
        transform: translateY(-5px) scale(1.015);
    }

    /* card shimmer sweep on hover */
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.04), transparent);
        transition: left 0s;
        pointer-events: none;
    }
    .stat-card:hover::after {
        left: 160%;
        transition: left 0.55s ease;
    }

    /* Top edge glow line */
    .stat-card .card-topline {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1.5px;
        transition: opacity 0.3s ease;
    }

    /* Card glow ring */
    .card-glow-ring {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    /* Icon wrapper */
    .stat-icon-wrap {
        position: relative;
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .stat-card:hover .stat-icon-wrap {
        transform: scale(1.1) rotate(-3deg);
    }
    .stat-icon-wrap .pulse-ring {
        position: absolute;
        inset: -4px;
        border-radius: 12px;
        animation: pulse-ring 3s ease-in-out infinite;
    }

    /* Count number */
    .stat-count {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }
    .stat-count::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
        pointer-events: none;
    }
    .stat-card:hover .stat-count::before {
        animation: count-shimmer 0.8s ease forwards;
    }

    /* ── Card: Member (teal) ── */
    .card-member {
        background: linear-gradient(135deg, #245b07 0%, #023013 100%);
        border: 1px solid rgba(34,211,238,0.2);
    }
    .card-member:hover {
        border-color: rgba(34, 238, 78, 0.5);
        box-shadow: 0 8px 32px rgba(34, 238, 95, 0.1), 0 0 0 1px rgba(34, 238, 41, 0.1);
    }
    .card-member .card-topline {
        background: linear-gradient(90deg, transparent, rgba(44, 238, 34, 0.6), transparent);
    }
    .card-member:hover .card-topline { opacity: 1.5; }
    .card-member .stat-icon-wrap {
        background: rgba(34, 238, 126, 0.08);
        border: 1px solid rgba(34, 238, 102, 0.2);
    }
    .card-member .pulse-ring {
        background: rgba(34,211,238,0.07);
    }
    .card-member .stat-label { color: rgba(34, 238, 54, 0.6); }
    .card-member .stat-count { color: #7df967; }
    .card-member .card-glow-ring {
        width: 100px; height: 100px;
        bottom: -30px; right: -20px;
        background: radial-gradient(circle, rgba(34, 238, 65, 0.08) 0%, transparent 70%);
    }

    /* ── Card: Buku (gold) ── */
    .card-buku {
        background: linear-gradient(135deg, #1a1200 0%, #1a1505 100%);
        border: 1px solid rgba(212,175,55,0.3);
    }
    .card-buku:hover {
        border-color: rgba(212,175,55,0.65);
        box-shadow: 0 8px 32px rgba(212,175,55,0.12), 0 0 0 1px rgba(212,175,55,0.12);
    }
    .card-buku .card-topline {
        background: linear-gradient(90deg, transparent, rgba(212,175,55,0.8), transparent);
    }
    .card-buku .stat-icon-wrap {
        background: rgba(212,175,55,0.1);
        border: 1px solid rgba(212,175,55,0.3);
    }
    .card-buku .pulse-ring {
        background: rgba(212,175,55,0.07);
    }
    .card-buku .stat-label { color: rgba(212,175,55,0.6); }
    .card-buku .stat-count { color: #d4af37; }
    .card-buku .card-glow-ring {
        width: 120px; height: 120px;
        bottom: -40px; right: -30px;
        background: radial-gradient(circle, rgba(212,175,55,0.1) 0%, transparent 70%);
    }

    /* ── Card: Total Peminjaman (violet) ── */
    .card-peminjaman {
        background: linear-gradient(135deg, #120a1e 0%, #1a0f2d 100%);
        border: 1px solid rgba(167,139,250,0.2);
    }
    .card-peminjaman:hover {
        border-color: rgba(167,139,250,0.5);
        box-shadow: 0 8px 32px rgba(167,139,250,0.1), 0 0 0 1px rgba(167,139,250,0.08);
    }
    .card-peminjaman .card-topline {
        background: linear-gradient(90deg, transparent, rgba(167,139,250,0.65), transparent);
    }
    .card-peminjaman .stat-icon-wrap {
        background: rgba(167,139,250,0.08);
        border: 1px solid rgba(167,139,250,0.2);
    }
    .card-peminjaman .pulse-ring {
        background: rgba(167,139,250,0.07);
    }
    .card-peminjaman .stat-label { color: rgba(167,139,250,0.65); }
    .card-peminjaman .stat-count { color: #c4b5fd; }
    .card-peminjaman .card-glow-ring {
        width: 100px; height: 100px;
        bottom: -30px; right: -20px;
        background: radial-gradient(circle, rgba(167,139,250,0.09) 0%, transparent 70%);
    }

    /* ── Card: Sedang Dipinjam (amber) ── */
    .card-aktif {
        background: linear-gradient(135deg, #1a1000 0%, #201500 100%);
        border: 1px solid rgba(251,191,36,0.3);
        animation-delay: 0.15s;
    }
    .card-aktif:hover {
        border-color: rgba(251,191,36,0.6);
        box-shadow: 0 8px 32px rgba(251,191,36,0.12), 0 0 0 1px rgba(251,191,36,0.1);
    }
    .card-aktif .card-topline {
        background: linear-gradient(90deg, transparent, rgba(251,191,36,0.8), transparent);
    }
    .card-aktif .stat-icon-wrap {
        background: rgba(251,191,36,0.1);
        border: 1px solid rgba(251,191,36,0.3);
    }
    .card-aktif .pulse-ring {
        background: rgba(251,191,36,0.08);
        animation: badge-pulse 2s ease-in-out infinite;
        inset: -4px;
        border-radius: 12px;
        border: 1px solid rgba(251,191,36,0.2);
        background: transparent;
    }
    .card-aktif .stat-label { color: rgba(251,191,36,0.65); }
    .card-aktif .stat-count { color: #fbbf24; }
    .card-aktif .card-glow-ring {
        width: 120px; height: 120px;
        bottom: -40px; right: -30px;
        background: radial-gradient(circle, rgba(251,191,36,0.1) 0%, transparent 70%);
    }

    /* ── Greeting section ── */
    .greeting-section {
        border-radius: 10px;
        padding: 20px 24px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        background: linear-gradient(120deg, rgba(12,34,20,0.9) 0%, rgba(26,20,5,0.7) 100%);
        border: 1px solid rgba(212,175,55,0.15);
        animation: fadeInUp 0.4s ease both;
    }
    .greeting-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 1.5px;
        background: linear-gradient(90deg, transparent, rgba(212,175,55,0.5), rgba(134,239,172,0.3), rgba(212,175,55,0.5), transparent);
    }

    /* ── Table rows ── */
    .tbl-row {
        border-top: 1px solid rgba(26,74,46,0.35);
        transition: all 0.2s ease;
    }
    .tbl-row:hover {
        background: rgba(15,45,26,0.5) !important;
        border-left: 2.5px solid rgba(212,175,55,0.5);
    }
    .tbl-row td:first-child {
        padding-left: 22px;
        transition: padding-left 0.2s ease;
    }
    .tbl-row:hover td:first-child {
        padding-left: 24px;
    }

    /* ── Decorative section divider ── */
    .section-ornament {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    /* ── Scroll decoration on empty state ── */
    .empty-scroll {
        font-size: 40px;
        color: rgba(26,74,46,0.6);
        margin-bottom: 12px;
        filter: drop-shadow(0 0 8px rgba(34,197,94,0.1));
    }
</style>
@endpush

{{-- Floating dust particles --}}
<div class="db-particle" style="left:30%;bottom:25%;--dur:7s;--delay:0s;"></div>
<div class="db-particle" style="left:50%;bottom:40%;--dur:9s;--delay:2s;"></div>
<div class="db-particle" style="left:70%;bottom:30%;--dur:6s;--delay:1s;"></div>
<div class="db-particle" style="left:85%;bottom:20%;--dur:8s;--delay:3s;background:#86efac;"></div>
<div class="db-particle" style="left:20%;bottom:60%;--dur:5.5s;--delay:4s;"></div>

{{-- ── Greeting Section ── --}}
<div class="greeting-section">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <p class="text-xs tracking-widest uppercase mb-1" style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.14em;">
                Selamat Datang Kembali
            </p>
            <h3 style="font-family:'IM Fell English',serif; font-size:19px; color:#f5f0e8;">
                {{ auth()->user()->username ?? 'Penjaga Perpustakaan' }}
            </h3>
            <p class="italic mt-1" style="font-family:'IM Fell English',serif; font-size:13px; color:rgba(134,239,172,0.55);">
                "Solus sanguis verus portam aperit."
            </p>
        </div>
        <div class="text-right">
            <p id="live-time" class="text-sm font-medium" style="color:#d4af37; font-family:'Cinzel Decorative',serif; font-size:12px;"></p>
            <p id="live-date" class="text-xs mt-0.5" style="color:rgba(192,192,192,0.45);"></p>
        </div>
    </div>

    {{-- Decorative corner rune bottom-right --}}
    <svg class="absolute bottom-3 right-4 opacity-10" width="32" height="32" viewBox="0 0 32 32" fill="none">
        <path d="M16 2 L30 16 L16 30 L2 16 Z" stroke="#d4af37" stroke-width="1"/>
        <circle cx="16" cy="16" r="5" stroke="#d4af37" stroke-width="0.75"/>
        <line x1="16" y1="2" x2="16" y2="11" stroke="#d4af37" stroke-width="0.75"/>
        <line x1="16" y1="21" x2="16" y2="30" stroke="#d4af37" stroke-width="0.75"/>
        <line x1="2" y1="16" x2="11" y2="16" stroke="#d4af37" stroke-width="0.75"/>
        <line x1="21" y1="16" x2="30" y2="16" stroke="#d4af37" stroke-width="0.75"/>
    </svg>
</div>

{{-- ── Stat Cards ── --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

    {{-- Member --}}
    <div class="stat-card card-member" style="animation-delay:0s;">
        <div class="card-topline"></div>
        <div class="card-glow-ring"></div>
        <div class="flex items-start justify-between mb-4">
            <span class="stat-label text-xs tracking-widest uppercase" style="font-size:10px; letter-spacing:0.13em;">
                Total Member
            </span>
            <div class="stat-icon-wrap">
                <div class="pulse-ring"></div>
                <i class="ti ti-users relative z-10" style="color:#6E8A6A; font-size:22px;"></i>
            </div>
        </div>
        <p class="stat-count" style="font-family:'Cinzel Decorative',serif; font-size:34px; line-height:1;" data-target="{{ $totalMember }}">
            0
        </p>
        <p class="mt-2 text-xs" style="color:rgba(149, 195, 96, 0.6);">anggota terdaftar</p>
    </div>

    {{-- Buku --}}
    <div class="stat-card card-buku" style="animation-delay:0.07s;">
        <div class="card-topline"></div>
        <div class="card-glow-ring"></div>

        {{-- Decorative rune --}}
        <svg class="absolute top-3 left-3 opacity-10" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M9 1 L17 9 L9 17 L1 9 Z" stroke="#d4af37" stroke-width="0.75"/>
            <circle cx="9" cy="9" r="2.5" stroke="#d4af37" stroke-width="0.5"/>
        </svg>

        <div class="flex items-start justify-between mb-4">
            <span class="stat-label text-xs tracking-widest uppercase" style="font-size:10px; letter-spacing:0.13em;">
                Total Buku
            </span>
            <div class="stat-icon-wrap">
                <div class="pulse-ring"></div>
                <i class="ti ti-book-2 relative z-10" style="color:#d4af37; font-size:22px;"></i>
            </div>
        </div>
        <p class="stat-count" style="font-family:'Cinzel Decorative',serif; font-size:34px; line-height:1;" data-target="{{ $totalBuku }}">
            0
        </p>
        <p class="mt-2 text-xs" style="color:rgba(212,175,55,0.4);">koleksi tersimpan</p>
    </div>

    {{-- Total Peminjaman --}}
    <div class="stat-card card-peminjaman" style="animation-delay:0.12s;">
        <div class="card-topline"></div>
        <div class="card-glow-ring"></div>
        <div class="flex items-start justify-between mb-4">
            <span class="stat-label text-xs tracking-widest uppercase" style="font-size:10px; letter-spacing:0.13em;">
                Total Peminjaman
            </span>
            <div class="stat-icon-wrap">
                <div class="pulse-ring"></div>
                <i class="ti ti-clipboard-list relative z-10" style="color:#a78bfa; font-size:22px;"></i>
            </div>
        </div>
        <p class="stat-count" style="font-family:'Cinzel Decorative',serif; font-size:34px; line-height:1;" data-target="{{ $totalPeminjaman }}">
            0
        </p>
        <p class="mt-2 text-xs" style="color:rgba(167,139,250,0.4);">transaksi tercatat</p>
    </div>

    {{-- Sedang Dipinjam --}}
    <div class="stat-card card-aktif" style="animation-delay:0.18s;">
        <div class="card-topline"></div>
        <div class="card-glow-ring"></div>

        {{-- Live dot --}}
        <div class="absolute top-3.5 left-4 flex items-center gap-1.5">
            <span class="w-1.5 h-1.5 rounded-full" style="background:#fbbf24; animation: dot-blink 1.5s ease-in-out infinite;"></span>
            <span class="text-xs" style="color:rgba(251,191,36,0.5); font-size:9px; letter-spacing:0.1em; text-transform:uppercase;">Live</span>
        </div>

        <div class="flex items-start justify-between mb-4 mt-4">
            <span class="stat-label text-xs tracking-widest uppercase" style="font-size:10px; letter-spacing:0.13em;">
                Sedang Dipinjam
            </span>
            <div class="stat-icon-wrap">
                <div class="pulse-ring"></div>
                <i class="ti ti-clock relative z-10" style="color:#fbbf24; font-size:22px;"></i>
            </div>
        </div>
        <p class="stat-count" style="font-family:'Cinzel Decorative',serif; font-size:34px; line-height:1;" data-target="{{ $peminjamanAktif }}">
            0
        </p>
        <p class="mt-2 text-xs" style="color:rgba(251,191,36,0.4);">buku belum kembali</p>
    </div>

</div>

{{-- ── Section: Peminjaman Terbaru ── --}}
<div class="section-ornament">
    <svg width="180" height="10" viewBox="0 0 180 10" fill="none">
        <defs>
            <linearGradient id="sec1" x1="0" y1="0" x2="70" y2="0" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#d4af37" stop-opacity="0"/>
                <stop offset="100%" stop-color="#d4af37" stop-opacity="0.45"/>
            </linearGradient>
        </defs>
        <line x1="0" y1="5" x2="70" y2="5" stroke="url(#sec1)" stroke-width="0.75"/>
        <path d="M78 5 L82 2 L86 5 L82 8 Z" fill="rgba(212,175,55,0.35)"/>
        <circle cx="90" cy="5" r="1.5" fill="#d4af37" opacity="0.6"/>
        <path d="M94 5 L98 2 L102 5 L98 8 Z" fill="rgba(212,175,55,0.35)"/>
        <line x1="110" y1="5" x2="180" y2="5" stroke="rgba(212,175,55,0.0)" stroke-width="0.75"/>
    </svg>
    <h2 style="font-family:'IM Fell English',serif; font-size:17px; color:#f5f0e8; white-space:nowrap;">
        Peminjaman Terbaru
    </h2>
    <svg width="180" height="10" viewBox="0 0 180 10" fill="none">
        <defs>
            <linearGradient id="sec2" x1="110" y1="0" x2="180" y2="0" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#d4af37" stop-opacity="0.45"/>
                <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
            </linearGradient>
        </defs>
        <line x1="0" y1="5" x2="70" y2="5" stroke="rgba(212,175,55,0)" stroke-width="0.75"/>
        <path d="M78 5 L82 2 L86 5 L82 8 Z" fill="rgba(212,175,55,0.35)"/>
        <circle cx="90" cy="5" r="1.5" fill="#d4af37" opacity="0.6"/>
        <path d="M94 5 L98 2 L102 5 L98 8 Z" fill="rgba(212,175,55,0.35)"/>
        <line x1="110" y1="5" x2="180" y2="5" stroke="url(#sec2)" stroke-width="0.75"/>
    </svg>
</div>

{{-- Table --}}
<div class="rounded-lg overflow-hidden"
     style="background:#0c2214; border:1px solid rgba(26,74,46,0.5);
            box-shadow: 0 0 40px rgba(0,0,0,0.3), inset 0 0 40px rgba(0,0,0,0.1);">

    {{-- Table top decoration --}}
    <div class="h-px w-full" style="background: linear-gradient(90deg, transparent, rgba(212,175,55,0.35), rgba(134,239,172,0.2), rgba(212,175,55,0.35), transparent);"></div>

    <table class="w-full">
        <thead>
            <tr style="background:rgba(10,26,15,0.7); border-bottom:1px solid rgba(212,175,55,0.08);">
                <th class="px-6 py-3.5 text-left text-xs tracking-widest uppercase"
                    style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.13em;">Member</th>
                <th class="px-6 py-3.5 text-left text-xs tracking-widest uppercase"
                    style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.13em;">Buku</th>
                <th class="px-6 py-3.5 text-left text-xs tracking-widest uppercase"
                    style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.13em;">Tgl Pinjam</th>
                <th class="px-6 py-3.5 text-left text-xs tracking-widest uppercase"
                    style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.13em;">Tgl Kembali</th>
                <th class="px-6 py-3.5 text-left text-xs tracking-widest uppercase"
                    style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.13em;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjamanTerbaru as $p)
                <tr class="tbl-row">
                    <td class="px-6 py-3.5">
                        <div class="flex items-center gap-2.5">
                            {{-- Avatar inisial --}}
                            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0 text-xs"
                                 style="background:#0a1a0f; border:1px solid rgba(212,175,55,0.3);
                                        font-family:'Cinzel Decorative',serif; color:#d4af37; font-size:10px;">
                                {{ strtoupper(substr($p->member->nama_member ?? 'A', 0, 1)) }}
                            </div>
                            <span class="text-sm" style="color:#f5f0e8;">
                                {{ $p->member->nama_member ?? '-' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-sm" style="color:#f5f0e8; max-width:200px;">
                        <span class="truncate block">{{ $p->buku->judul ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-3.5 text-sm" style="color:rgba(192,192,192,0.55);">
                        {{ $p->tgl_pinjam ? \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-3.5 text-sm" style="color:rgba(192,192,192,0.55);">
                        {{ $p->tgl_kembali ? \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-3.5">
                        @if ($p->tgl_kembali)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-xs font-medium"
                                  style="background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.2); color:#86efac;">
                                <i class="ti ti-circle-check" style="font-size:11px;"></i>
                                Selesai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-xs font-medium"
                                  style="background:rgba(251,191,36,0.08); border:1px solid rgba(251,191,36,0.25); color:#fbbf24;
                                         animation: badge-pulse 2.5s ease-in-out infinite;">
                                <span class="w-1.5 h-1.5 rounded-full" style="background:#fbbf24; animation: dot-blink 1.5s ease-in-out infinite;"></span>
                                Dipinjam
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="empty-scroll">
                            <i class="ti ti-scroll"></i>
                        </div>
                        <p class="italic" style="font-family:'IM Fell English',serif; font-size:15px; color:rgba(192,192,192,0.35);">
                            Belum ada catatan peminjaman tersimpan.
                        </p>
                        <p class="text-xs mt-2" style="color:rgba(134,239,172,0.25); font-family:'IM Fell English',serif; font-style:italic;">
                            The scrolls are empty, the library waits...
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Table bottom decoration --}}
    <div class="h-px w-full" style="background: linear-gradient(90deg, transparent, rgba(26,74,46,0.4), transparent);"></div>
</div>

@push('scripts')
<script>
    // ── Count-up animation ──
    document.querySelectorAll('.stat-count[data-target]').forEach(el => {
        const target = parseInt(el.dataset.target) || 0;
        const duration = 900;
        const step = 16;
        const increment = target / (duration / step);
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + increment, target);
            el.textContent = Math.floor(current);
            if (current >= target) clearInterval(timer);
        }, step);
    });

    // ── Live clock ──
    function updateClock() {
        const now = new Date();
        const timeEl = document.getElementById('live-time');
        const dateEl = document.getElementById('live-date');
        if (timeEl) {
            timeEl.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        if (dateEl) {
            dateEl.textContent = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        }
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>
@endpush

@endsection
