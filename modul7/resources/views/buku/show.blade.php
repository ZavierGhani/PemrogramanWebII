@extends('layouts.app')

@section('title', 'Detail Buku — Slytherin Restricted Library')

@section('content')

<style>
    @keyframes bkd-rise { 0%{opacity:0;transform:translateY(0) scale(0);} 20%{opacity:.55;transform:translateY(-30px) scale(1);} 80%{opacity:.15;transform:translateY(-90px) scale(.5);} 100%{opacity:0;transform:translateY(-130px) scale(0);} }
    @keyframes bkd-pulse { 0%,100%{opacity:.35;transform:scale(1);} 50%{opacity:.65;transform:scale(1.08);} }
    @keyframes bkd-fade-down { from{opacity:0;transform:translateY(-10px);} to{opacity:1;transform:translateY(0);} }
    @keyframes bkd-fade-up { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }
    @keyframes bkd-shimmer { 0%{left:-100%;} 50%{left:100%;} 100%{left:100%;} }

    .bkd-particle { position:absolute; width:2px; height:2px; border-radius:9999px; opacity:0; pointer-events:none; animation: bkd-rise var(--dur) ease-in var(--delay) infinite; }
    .bkd-corner { position:absolute; width:48px; height:48px; pointer-events:none; z-index:5; }
    .bkd-corner-tl{top:8px;left:8px;} .bkd-corner-tr{top:8px;right:8px;transform:scaleX(-1);}
    .bkd-corner-bl{bottom:8px;left:8px;transform:scaleY(-1);} .bkd-corner-br{bottom:8px;right:8px;transform:scale(-1);}

    .bkd-header-in { animation: bkd-fade-down .5s ease-out both; }
    .bkd-card-in { animation: bkd-fade-up .55s ease-out .1s both; }
    .bkd-card-in-2 { animation: bkd-fade-up .55s ease-out .2s both; }

    .bkd-crest { width:52px; height:52px; border-radius:9999px; position:relative; display:flex; align-items:center; justify-content:center; flex-shrink:0; border:1.5px solid rgba(212,175,55,.5); background:#0f2d1a; box-shadow: inset 0 0 12px rgba(0,0,0,.6); }
    .bkd-crest::before { content:''; position:absolute; inset:-8px; border-radius:9999px; background: radial-gradient(circle, rgba(34,197,94,.28) 0%, transparent 70%); animation: bkd-pulse 4s ease-in-out infinite; z-index:-1; }

    .bkd-back-btn { display:inline-flex; align-items:center; gap:6px; padding:10px 18px; border-radius:9999px; border:1px solid rgba(192,192,192,.4); color:#c0c0c0; font-size:13px; text-decoration:none; transition: all .25s; }
    .bkd-back-btn:hover { background: rgba(192,192,192,.1); border-color: rgba(192,192,192,.7); box-shadow: 0 0 14px rgba(192,192,192,.15); transform: translateX(-2px); }

    .bkd-card { position:relative; background-color:#14391f; border:1px solid rgba(212,175,55,.18); border-radius:14px; padding:32px; box-shadow:0 10px 40px rgba(0,0,0,.35); transition: border-color .4s, box-shadow .4s; }
    .bkd-card:hover { border-color: rgba(212,175,55,.32); box-shadow:0 10px 40px rgba(0,0,0,.35), 0 0 30px rgba(212,175,55,.05); }

    .bkd-cover-wrap { position:relative; flex-shrink:0; }
    .bkd-cover-wrap::before { content:''; position:absolute; inset:-16px; border-radius:14px; background: radial-gradient(circle, rgba(212,175,55,.18) 0%, transparent 70%); z-index:0; }
    .bkd-cover, .bkd-cover-ph { position:relative; z-index:1; width:148px; height:204px; border-radius:8px; transition: transform .35s, box-shadow .35s; }
    .bkd-cover { object-fit:cover; border:2px solid rgba(212,175,55,.5); }
    .bkd-cover-ph { border:2px dashed rgba(212,175,55,.3); background:#0a1a0f; display:flex; align-items:center; justify-content:center; }
    .bkd-cover-wrap:hover .bkd-cover, .bkd-cover-wrap:hover .bkd-cover-ph { transform: scale(1.04) translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,.4), 0 0 24px rgba(212,175,55,.2); }

    .bkd-field { display:flex; gap:12px; padding:11px 0; border-bottom:1px solid rgba(212,175,55,.1); }
    .bkd-field:last-child { border-bottom:none; }
    .bkd-field-icon { width:30px; height:30px; border-radius:9999px; background: rgba(212,175,55,.08); border:1px solid rgba(212,175,55,.25); display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#d4af37; font-size:14px; }

    .bkd-stamp { display:inline-block; font-family:'Cinzel Decorative',serif; font-size:13px; letter-spacing:.04em; padding:4px 14px; border-radius:6px; background: rgba(212,175,55,.1); border:1px solid rgba(212,175,55,.35); color:#d4af37; }

    .bkd-action-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:8px; border:1px solid; font-size:13px; font-weight:500; text-decoration:none; cursor:pointer; transition: all .25s; }
    .bkd-action-btn.edit { border-color: rgba(212,175,55,.4); color:#d4af37; background: rgba(212,175,55,.06); }
    .bkd-action-btn.edit:hover { background: rgba(212,175,55,.16); box-shadow:0 0 16px rgba(212,175,55,.25); transform: translateY(-2px); }
    .bkd-action-btn.delete { border-color: rgba(239,68,68,.4); color:#fca5a5; background: rgba(127,29,29,.15); }
    .bkd-action-btn.delete:hover { background: rgba(127,29,29,.4); box-shadow:0 0 16px rgba(239,68,68,.25); transform: translateY(-2px); }

    .bkd-sub { background-color:#14391f; border:1px solid rgba(212,175,55,.15); border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,.3); }
    .bkd-sub-head { padding:18px 24px; border-bottom:1px solid rgba(212,175,55,.15); display:flex; align-items:center; gap:10px; }
    .bkd-row { transition: background .25s; }
    .bkd-row:hover { background:#163a22; }
    .bkd-badge { display:inline-flex; align-items:center; gap:5px; padding:3px 11px; border-radius:9999px; font-size:11px; font-weight:600; }
    .bkd-badge-done { background: rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.35); color:#86efac; }
    .bkd-badge-active { background: rgba(212,175,55,.12); border:1px solid rgba(212,175,55,.4); color:#fcd34d; }
</style>

<div class="relative">

    <div class="absolute -top-10 left-1/3 w-[360px] h-[360px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(34,197,94,.06) 0%, transparent 70%)"></div>
    <div class="absolute top-52 right-0 w-[240px] h-[240px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,.06) 0%, transparent 70%)"></div>

    <div class="bkd-particle" style="left:10%; bottom:10%; background:#d4af37; --dur:7s; --delay:0s"></div>
    <div class="bkd-particle" style="left:30%; bottom:35%; background:#d4af37; --dur:6.5s; --delay:1.2s"></div>
    <div class="bkd-particle" style="left:60%; bottom:8%; background:#86efac; --dur:8s; --delay:2s; width:3px; height:3px"></div>
    <div class="bkd-particle" style="left:85%; bottom:25%; background:#d4af37; --dur:7s; --delay:.6s"></div>

    <div class="relative z-10">

        <div class="bkd-header-in flex items-start justify-between mb-6 flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="bkd-crest"><i class="ti ti-bookmark text-2xl" style="color:#d4af37"></i></div>
                <div>
                    <h1 style="font-family:'Cinzel Decorative',serif; font-size:1.6rem; color:#d4af37; text-shadow:0 0 26px rgba(212,175,55,.2);">Detail Buku</h1>
                    <p class="italic mt-0.5" style="font-family:'IM Fell English',serif; color:#86efac;">Informasi lengkap koleksi buku</p>
                </div>
            </div>
            <a href="{{ route('buku.index') }}" class="bkd-back-btn"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>

        <div class="bkd-card bkd-card-in max-w-2xl mb-6">
            <svg class="bkd-corner bkd-corner-tl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="bkd-corner bkd-corner-tr" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="bkd-corner bkd-corner-bl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="bkd-corner bkd-corner-br" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>

            <div class="flex gap-8 relative z-10">
                <div class="bkd-cover-wrap">
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover {{ $buku->judul }}" class="bkd-cover">
                    @else
                        <div class="bkd-cover-ph"><i class="ti ti-book text-3xl" style="color:rgba(192,192,192,.35)"></i></div>
                    @endif
                </div>

                <div class="flex-1">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color:#86efac;">Judul</p>
                    <h2 class="mb-4" style="font-family:'IM Fell English',serif; font-size:1.4rem; color:#f5f0e8;">{{ $buku->judul }}</h2>

                    <div class="bkd-field">
                        <div class="bkd-field-icon"><i class="ti ti-feather"></i></div>
                        <div><div class="text-xs uppercase tracking-wide" style="color:#86efac;">Penulis</div><div style="color:#f5f0e8;">{{ $buku->penulis }}</div></div>
                    </div>
                    <div class="bkd-field">
                        <div class="bkd-field-icon"><i class="ti ti-building"></i></div>
                        <div><div class="text-xs uppercase tracking-wide" style="color:#86efac;">Penerbit</div><div style="color:#f5f0e8;">{{ $buku->penerbit }}</div></div>
                    </div>
                    <div class="bkd-field">
                        <div class="bkd-field-icon"><i class="ti ti-calendar-event"></i></div>
                        <div><div class="text-xs uppercase tracking-wide mb-1" style="color:#86efac;">Tahun Terbit</div><span class="bkd-stamp">{{ $buku->tahun_terbit }}</span></div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-6 relative z-10">
                <a href="{{ route('buku.edit', $buku->id) }}" class="bkd-action-btn edit"><i class="ti ti-edit"></i> Edit</a>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST"
                id="form-hapus-buku-{{ $buku->id }}">
                @csrf
                @method('DELETE')

                <button type="button"
                        onclick="konfirmasiHapus('form-hapus-buku-{{ $buku->id }}', 'Buku {{ $buku->judul_buku }}')"
                        class="bkd-action-btn delete">
                    <i class="ti ti-trash"></i> Hapus
                </button>
            </form>
            </div>
        </div>

        <div class="bkd-sub bkd-card-in-2 max-w-2xl">
            <div class="bkd-sub-head">
                <i class="ti ti-history" style="color:#d4af37"></i>
                <h2 style="font-family:'IM Fell English',serif; font-size:1.05rem; color:#f5f0e8;">Riwayat Peminjaman</h2>
            </div>
            <table class="w-full text-sm">
                <thead style="background:#1a4a2e;">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Member</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Tgl Pinjam</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Tgl Kembali</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($buku->peminjamans as $p)
                        <tr class="bkd-row border-t" style="border-color: rgba(212,175,55,.1); background:#0e2516;">
                            <td class="px-5 py-3" style="color:#f5f0e8;">{{ $p->member->nama_member ?? '-' }}</td>
                            <td class="px-5 py-3" style="color:#c0c0c0;">{{ $p->tgl_pinjam?->format('d M Y') }}</td>
                            <td class="px-5 py-3" style="color:#c0c0c0;">{{ $p->tgl_kembali?->format('d M Y') ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @if ($p->tgl_kembali)
                                    <span class="bkd-badge bkd-badge-done"><i class="ti ti-check"></i> Selesai</span>
                                @else
                                    <span class="bkd-badge bkd-badge-active"><i class="ti ti-clock"></i> Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-8 text-center italic" style="font-family:'IM Fell English',serif; color:#c0c0c0;">Belum pernah dipinjam.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection