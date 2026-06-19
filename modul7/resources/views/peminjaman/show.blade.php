@extends('layouts.app')

@section('title', 'Detail Peminjaman — Slytherin Restricted Library')

@section('content')

<style>
    @keyframes pmd-rise { 0%{opacity:0;transform:translateY(0) scale(0);} 20%{opacity:.55;transform:translateY(-30px) scale(1);} 80%{opacity:.15;transform:translateY(-90px) scale(.5);} 100%{opacity:0;transform:translateY(-130px) scale(0);} }
    @keyframes pmd-pulse { 0%,100%{opacity:.35;transform:scale(1);} 50%{opacity:.65;transform:scale(1.08);} }
    @keyframes pmd-fade-down { from{opacity:0;transform:translateY(-10px);} to{opacity:1;transform:translateY(0);} }
    @keyframes pmd-fade-up { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }
    @keyframes pmd-blink { 0%,100%{opacity:1;} 50%{opacity:.55;} }

    .pmd-particle { position:absolute; width:2px; height:2px; border-radius:9999px; opacity:0; pointer-events:none; animation: pmd-rise var(--dur) ease-in var(--delay) infinite; }
    .pmd-corner { position:absolute; width:48px; height:48px; pointer-events:none; z-index:5; }
    .pmd-corner-tl{top:8px;left:8px;} .pmd-corner-tr{top:8px;right:8px;transform:scaleX(-1);}
    .pmd-corner-bl{bottom:8px;left:8px;transform:scaleY(-1);} .pmd-corner-br{bottom:8px;right:8px;transform:scale(-1);}

    .pmd-header-in { animation: pmd-fade-down .5s ease-out both; }
    .pmd-card-in { animation: pmd-fade-up .55s ease-out .1s both; }

    .pmd-crest { width:52px; height:52px; border-radius:9999px; position:relative; display:flex; align-items:center; justify-content:center; flex-shrink:0; border:1.5px solid rgba(212,175,55,.5); background:#0f2d1a; box-shadow: inset 0 0 12px rgba(0,0,0,.6); }
    .pmd-crest::before { content:''; position:absolute; inset:-8px; border-radius:9999px; background: radial-gradient(circle, rgba(34,197,94,.28) 0%, transparent 70%); animation: pmd-pulse 4s ease-in-out infinite; z-index:-1; }

    .pmd-back-btn { display:inline-flex; align-items:center; gap:6px; padding:10px 18px; border-radius:9999px; border:1px solid rgba(192,192,192,.4); color:#c0c0c0; font-size:13px; text-decoration:none; transition: all .25s; }
    .pmd-back-btn:hover { background: rgba(192,192,192,.1); border-color: rgba(192,192,192,.7); box-shadow: 0 0 14px rgba(192,192,192,.15); transform: translateX(-2px); }

    .pmd-card { position:relative; background-color:#14391f; border:1px solid rgba(212,175,55,.18); border-radius:14px; padding:32px; box-shadow:0 10px 40px rgba(0,0,0,.35); transition: border-color .4s, box-shadow .4s; }
    .pmd-card:hover { border-color: rgba(212,175,55,.32); box-shadow:0 10px 40px rgba(0,0,0,.35), 0 0 30px rgba(212,175,55,.05); }

    .pmd-cover-wrap { position:relative; flex-shrink:0; }
    .pmd-cover-wrap::before { content:''; position:absolute; inset:-14px; border-radius:14px; background: radial-gradient(circle, rgba(212,175,55,.18) 0%, transparent 70%); z-index:0; }
    .pmd-cover, .pmd-cover-ph { position:relative; z-index:1; width:108px; height:148px; border-radius:8px; transition: transform .35s, box-shadow .35s; }
    .pmd-cover { object-fit:cover; border:2px solid rgba(212,175,55,.5); }
    .pmd-cover-ph { border:2px dashed rgba(212,175,55,.3); background:#0a1a0f; display:flex; align-items:center; justify-content:center; }
    .pmd-cover-wrap:hover .pmd-cover, .pmd-cover-wrap:hover .pmd-cover-ph { transform: scale(1.04) translateY(-3px); box-shadow: 0 10px 26px rgba(0,0,0,.4), 0 0 22px rgba(212,175,55,.2); }

    .pmd-field { display:flex; gap:12px; padding:10px 0; border-bottom:1px solid rgba(212,175,55,.1); }
    .pmd-field:last-child { border-bottom:none; }
    .pmd-field-icon { width:28px; height:28px; border-radius:9999px; background: rgba(212,175,55,.08); border:1px solid rgba(212,175,55,.25); display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#d4af37; font-size:13px; }

    .pmd-badge { display:inline-flex; align-items:center; gap:5px; padding:4px 12px; border-radius:9999px; font-size:11px; font-weight:600; }
    .pmd-badge-done { background: rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.35); color:#86efac; }
    .pmd-badge-active { background: rgba(212,175,55,.12); border:1px solid rgba(212,175,55,.4); color:#fcd34d; }
    .pmd-badge-active .pmd-dot { width:6px; height:6px; border-radius:9999px; background:#fcd34d; animation: pmd-blink 1.6s ease-in-out infinite; }

    .pmd-stat { background:#0e2516; border:1px solid rgba(212,175,55,.12); border-radius:10px; padding:16px; transition: border-color .3s; }
    .pmd-stat:hover { border-color: rgba(212,175,55,.3); }

    .pmd-action-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:8px; border:1px solid; font-size:13px; font-weight:500; text-decoration:none; cursor:pointer; transition: all .25s; }
    .pmd-action-btn.edit { border-color: rgba(212,175,55,.4); color:#d4af37; background: rgba(212,175,55,.06); }
    .pmd-action-btn.edit:hover { background: rgba(212,175,55,.16); box-shadow:0 0 16px rgba(212,175,55,.25); transform: translateY(-2px); }
    .pmd-action-btn.delete { border-color: rgba(239,68,68,.4); color:#fca5a5; background: rgba(127,29,29,.15); }
    .pmd-action-btn.delete:hover { background: rgba(127,29,29,.4); box-shadow:0 0 16px rgba(239,68,68,.25); transform: translateY(-2px); }
</style>

<div class="relative">

    <div class="absolute -top-10 left-1/3 w-[360px] h-[360px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(34,197,94,.06) 0%, transparent 70%)"></div>
    <div class="absolute top-52 right-0 w-[240px] h-[240px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,.06) 0%, transparent 70%)"></div>

    <div class="pmd-particle" style="left:12%; bottom:12%; background:#d4af37; --dur:7s; --delay:0s"></div>
    <div class="pmd-particle" style="left:35%; bottom:30%; background:#86efac; --dur:8s; --delay:1.5s; width:3px; height:3px"></div>
    <div class="pmd-particle" style="left:70%; bottom:8%; background:#d4af37; --dur:6.5s; --delay:.8s"></div>

    <div class="relative z-10">

        <div class="pmd-header-in flex items-start justify-between mb-6 flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="pmd-crest"><i class="ti ti-history text-2xl" style="color:#d4af37"></i></div>
                <div>
                    <h1 style="font-family:'Cinzel Decorative',serif; font-size:1.6rem; color:#d4af37; text-shadow:0 0 26px rgba(212,175,55,.2);">Detail Peminjaman</h1>
                    <p class="italic mt-0.5" style="font-family:'IM Fell English',serif; color:#86efac;">Informasi lengkap peminjaman</p>
                </div>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="pmd-back-btn"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>

        <div class="pmd-card pmd-card-in max-w-2xl">

            <svg class="pmd-corner pmd-corner-tl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="pmd-corner pmd-corner-tr" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="pmd-corner pmd-corner-bl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="pmd-corner pmd-corner-br" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>

            <div class="flex gap-7 mb-6 relative z-10">
                <div class="pmd-cover-wrap">
                    @if ($peminjaman->buku->cover)
                        <img src="{{ asset('storage/' . $peminjaman->buku->cover) }}" alt="{{ $peminjaman->buku->judul }}" class="pmd-cover">
                    @else
                        <div class="pmd-cover-ph"><i class="ti ti-book text-2xl" style="color:rgba(192,192,192,.35)"></i></div>
                    @endif
                </div>

                <div class="flex-1">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color:#86efac;">Buku</p>
                    <h2 class="mb-3" style="font-family:'IM Fell English',serif; font-size:1.25rem; color:#f5f0e8;">{{ $peminjaman->buku->judul ?? '-' }}</h2>

                    <div class="pmd-field">
                        <div class="pmd-field-icon"><i class="ti ti-user"></i></div>
                        <div>
                            <div class="text-xs uppercase tracking-wide" style="color:#86efac;">Member</div>
                            <div style="color:#f5f0e8;">{{ $peminjaman->member->nama_member ?? '-' }} <span style="color:#c0c0c0;">({{ $peminjaman->member->nomor_member ?? '-' }})</span></div>
                        </div>
                    </div>
                    <div class="pmd-field">
                        <div class="pmd-field-icon"><i class="ti ti-flag"></i></div>
                        <div>
                            <div class="text-xs uppercase tracking-wide mb-1" style="color:#86efac;">Status</div>
                            @if ($peminjaman->tgl_kembali)
                                <span class="pmd-badge pmd-badge-done"><i class="ti ti-check"></i> Selesai</span>
                            @else
                                <span class="pmd-badge pmd-badge-active"><span class="pmd-dot"></span> Dipinjam</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6 relative z-10">
                <div class="pmd-stat">
                    <div class="flex items-center gap-2 mb-1.5"><i class="ti ti-calendar-down" style="color:#d4af37;font-size:14px;"></i><span class="text-xs uppercase tracking-wide" style="color:#86efac;">Tanggal Pinjam</span></div>
                    <p class="font-medium" style="color:#f5f0e8;">{{ $peminjaman->tgl_pinjam?->format('d M Y') }}</p>
                    @if ($peminjaman->tgl_pinjam)
                        <p class="text-xs italic mt-0.5" style="font-family:'IM Fell English',serif; color:rgba(192,192,192,.45);">{{ $peminjaman->tgl_pinjam->diffForHumans() }}</p>
                    @endif
                </div>
                <div class="pmd-stat">
                    <div class="flex items-center gap-2 mb-1.5"><i class="ti ti-calendar-up" style="color:#d4af37;font-size:14px;"></i><span class="text-xs uppercase tracking-wide" style="color:#86efac;">Tanggal Kembali</span></div>
                    <p class="font-medium" style="color:#f5f0e8;">{{ $peminjaman->tgl_kembali?->format('d M Y') ?? '-' }}</p>
                    @if ($peminjaman->tgl_kembali && $peminjaman->tgl_pinjam)
                        <p class="text-xs italic mt-0.5" style="font-family:'IM Fell English',serif; color:rgba(192,192,192,.45);">{{ $peminjaman->tgl_pinjam->diffInDays($peminjaman->tgl_kembali) }} hari peminjaman</p>
                    @elseif (!$peminjaman->tgl_kembali && $peminjaman->tgl_pinjam)
                        <p class="text-xs italic mt-0.5" style="font-family:'IM Fell English',serif; color:rgba(252,211,77,.6);">Sudah {{ $peminjaman->tgl_pinjam->diffInDays(now()) }} hari dipinjam</p>
                    @endif
                </div>
            </div>

            <div class="flex gap-3 relative z-10">
                <a href="{{ route('peminjaman.edit', $peminjaman->id_peminjaman) }}" class="pmd-action-btn edit"><i class="ti ti-edit"></i> Edit</a>
                <form action="{{ route('peminjaman.destroy', $peminjaman->id_peminjaman) }}" method="POST"
                id="form-hapus-peminjaman-show-{{ $peminjaman->id_peminjaman }}">
                @csrf @method('DELETE')
                <button type="button"
                        onclick="konfirmasiHapus('form-hapus-peminjaman-show-{{ $peminjaman->id_peminjaman }}', 'Data peminjaman ini')"
                        class="pmd-action-btn delete">
                    <i class="ti ti-trash"></i> Hapus
                </button>
            </form>
            </div>
        </div>

    </div>
</div>

@endsection