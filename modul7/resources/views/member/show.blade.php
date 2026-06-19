@extends('layouts.app')

@section('title', 'Detail Member — Slytherin Restricted Library')

@section('content')

<style>
    @keyframes mdt-rise { 0%{opacity:0;transform:translateY(0) scale(0);} 20%{opacity:.55;transform:translateY(-30px) scale(1);} 80%{opacity:.15;transform:translateY(-90px) scale(.5);} 100%{opacity:0;transform:translateY(-130px) scale(0);} }
    @keyframes mdt-pulse { 0%,100%{opacity:.35;transform:scale(1);} 50%{opacity:.65;transform:scale(1.08);} }
    @keyframes mdt-fade-down { from{opacity:0;transform:translateY(-10px);} to{opacity:1;transform:translateY(0);} }
    @keyframes mdt-fade-up { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }

    .mdt-particle { position:absolute; width:2px; height:2px; border-radius:9999px; opacity:0; pointer-events:none; animation: mdt-rise var(--dur) ease-in var(--delay) infinite; }
    .mdt-corner { position:absolute; width:48px; height:48px; pointer-events:none; z-index:5; }
    .mdt-corner-tl{top:8px;left:8px;} .mdt-corner-tr{top:8px;right:8px;transform:scaleX(-1);}
    .mdt-corner-bl{bottom:8px;left:8px;transform:scaleY(-1);} .mdt-corner-br{bottom:8px;right:8px;transform:scale(-1);}

    .mdt-header-in { animation: mdt-fade-down .5s ease-out both; }
    .mdt-card-in { animation: mdt-fade-up .55s ease-out .1s both; }
    .mdt-card-in-2 { animation: mdt-fade-up .55s ease-out .2s both; }

    .mdt-crest { width:52px; height:52px; border-radius:9999px; position:relative; display:flex; align-items:center; justify-content:center; flex-shrink:0; border:1.5px solid rgba(212,175,55,.5); background:#0f2d1a; box-shadow: inset 0 0 12px rgba(0,0,0,.6); }
    .mdt-crest::before { content:''; position:absolute; inset:-8px; border-radius:9999px; background: radial-gradient(circle, rgba(34,197,94,.28) 0%, transparent 70%); animation: mdt-pulse 4s ease-in-out infinite; z-index:-1; }

    .mdt-back-btn { display:inline-flex; align-items:center; gap:6px; padding:10px 18px; border-radius:9999px; border:1px solid rgba(192,192,192,.4); color:#c0c0c0; font-size:13px; text-decoration:none; transition: all .25s; }
    .mdt-back-btn:hover { background: rgba(192,192,192,.1); border-color: rgba(192,192,192,.7); box-shadow: 0 0 14px rgba(192,192,192,.15); transform: translateX(-2px); }

    .mdt-card { position:relative; background-color:#14391f; border:1px solid rgba(212,175,55,.18); border-radius:14px; padding:32px; box-shadow:0 10px 40px rgba(0,0,0,.35); transition: border-color .4s, box-shadow .4s; }
    .mdt-card:hover { border-color: rgba(212,175,55,.32); box-shadow:0 10px 40px rgba(0,0,0,.35), 0 0 30px rgba(212,175,55,.05); }

    .mdt-avatar-wrap { position:relative; flex-shrink:0; }
    .mdt-avatar-wrap::before { content:''; position:absolute; inset:-14px; border-radius:9999px; background: radial-gradient(circle, rgba(212,175,55,.2) 0%, transparent 70%); z-index:0; }
    .mdt-avatar, .mdt-avatar-ph { position:relative; z-index:1; width:120px; height:120px; border-radius:9999px; transition: transform .35s, box-shadow .35s; }
    .mdt-avatar { object-fit:cover; border:2px solid rgba(212,175,55,.5); }
    .mdt-avatar-ph { border:2px dashed rgba(212,175,55,.3); background:#0a1a0f; display:flex; align-items:center; justify-content:center; }
    .mdt-avatar-wrap:hover .mdt-avatar, .mdt-avatar-wrap:hover .mdt-avatar-ph { transform: scale(1.05); box-shadow: 0 12px 28px rgba(0,0,0,.4), 0 0 24px rgba(212,175,55,.2); }

    .mdt-field { display:flex; gap:12px; padding:11px 0; border-bottom:1px solid rgba(212,175,55,.1); }
    .mdt-field:last-child { border-bottom:none; }
    .mdt-field-icon { width:30px; height:30px; border-radius:9999px; background: rgba(212,175,55,.08); border:1px solid rgba(212,175,55,.25); display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#d4af37; font-size:14px; }

    .mdt-stamp { display:inline-block; font-family:'Cinzel Decorative',serif; font-size:13px; letter-spacing:.04em; padding:4px 14px; border-radius:6px; background: rgba(212,175,55,.1); border:1px solid rgba(212,175,55,.35); color:#d4af37; }

    .mdt-action-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border-radius:8px; border:1px solid; font-size:13px; font-weight:500; text-decoration:none; cursor:pointer; transition: all .25s; }
    .mdt-action-btn.edit { border-color: rgba(212,175,55,.4); color:#d4af37; background: rgba(212,175,55,.06); }
    .mdt-action-btn.edit:hover { background: rgba(212,175,55,.16); box-shadow:0 0 16px rgba(212,175,55,.25); transform: translateY(-2px); }
    .mdt-action-btn.delete { border-color: rgba(239,68,68,.4); color:#fca5a5; background: rgba(127,29,29,.15); }
    .mdt-action-btn.delete:hover { background: rgba(127,29,29,.4); box-shadow:0 0 16px rgba(239,68,68,.25); transform: translateY(-2px); }

    .mdt-sub { background-color:#14391f; border:1px solid rgba(212,175,55,.15); border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,.3); }
    .mdt-sub-head { padding:18px 24px; border-bottom:1px solid rgba(212,175,55,.15); display:flex; align-items:center; gap:10px; }
    .mdt-row { transition: background .25s; }
    .mdt-row:hover { background:#163a22; }
    .mdt-badge { display:inline-flex; align-items:center; gap:5px; padding:3px 11px; border-radius:9999px; font-size:11px; font-weight:600; }
    .mdt-badge-done { background: rgba(34,197,94,.12); border:1px solid rgba(34,197,94,.35); color:#86efac; }
    .mdt-badge-active { background: rgba(212,175,55,.12); border:1px solid rgba(212,175,55,.4); color:#fcd34d; }
</style>

<div class="relative">

    <div class="absolute -top-10 left-1/3 w-[360px] h-[360px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(34,197,94,.06) 0%, transparent 70%)"></div>
    <div class="absolute top-52 right-0 w-[240px] h-[240px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,.06) 0%, transparent 70%)"></div>

    <div class="mdt-particle" style="left:12%; bottom:12%; background:#d4af37; --dur:7s; --delay:0s"></div>
    <div class="mdt-particle" style="left:32%; bottom:30%; background:#86efac; --dur:8s; --delay:1.5s; width:3px; height:3px"></div>
    <div class="mdt-particle" style="left:65%; bottom:8%; background:#d4af37; --dur:6.5s; --delay:.8s"></div>
    <div class="mdt-particle" style="left:88%; bottom:28%; background:#d4af37; --dur:7.5s; --delay:2.2s"></div>

    <div class="relative z-10">

        <div class="mdt-header-in flex items-start justify-between mb-6 flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="mdt-crest"><i class="ti ti-id-badge text-2xl" style="color:#d4af37"></i></div>
                <div>
                    <h1 style="font-family:'Cinzel Decorative',serif; font-size:1.6rem; color:#d4af37; text-shadow:0 0 26px rgba(212,175,55,.2);">Detail Member</h1>
                    <p class="italic mt-0.5" style="font-family:'IM Fell English',serif; color:#86efac;">Informasi lengkap anggota perpustakaan</p>
                </div>
            </div>
            <a href="{{ route('member.index') }}" class="mdt-back-btn"><i class="ti ti-arrow-left"></i> Kembali</a>
        </div>

        <div class="mdt-card mdt-card-in max-w-2xl mb-6">
            <svg class="mdt-corner mdt-corner-tl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="mdt-corner mdt-corner-tr" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="mdt-corner mdt-corner-bl" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>
            <svg class="mdt-corner mdt-corner-br" viewBox="0 0 48 48" fill="none"><path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,.3)" stroke-width="1"/><circle cx="3" cy="3" r="2" fill="#d4af37" opacity=".5"/></svg>

            <div class="flex gap-8 relative z-10">
                <div class="mdt-avatar-wrap">
                    @if ($member->foto)
                        <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama_member }}" class="mdt-avatar">
                    @else
                        <div class="mdt-avatar-ph"><i class="ti ti-user text-3xl" style="color:rgba(192,192,192,.35)"></i></div>
                    @endif
                </div>

                <div class="flex-1">
                    <p class="text-xs uppercase tracking-widest mb-1" style="color:#86efac;">Nama Member</p>
                    <h2 class="mb-4" style="font-family:'IM Fell English',serif; font-size:1.4rem; color:#f5f0e8;">{{ $member->nama_member }}</h2>

                    <div class="mdt-field">
                        <div class="mdt-field-icon"><i class="ti ti-fingerprint"></i></div>
                        <div><div class="text-xs uppercase tracking-wide mb-1" style="color:#86efac;">Nomor Member</div><span class="mdt-stamp">{{ $member->nomor_member }}</span></div>
                    </div>
                    <div class="mdt-field">
                        <div class="mdt-field-icon"><i class="ti ti-map-pin"></i></div>
                        <div><div class="text-xs uppercase tracking-wide" style="color:#86efac;">Alamat</div><div style="color:#f5f0e8;">{{ $member->alamat }}</div></div>
                    </div>
                    <div class="mdt-field">
                        <div class="mdt-field-icon"><i class="ti ti-calendar-plus"></i></div>
                        <div>
                            <div class="text-xs uppercase tracking-wide" style="color:#86efac;">Tanggal Mendaftar</div>
                            <div style="color:#f5f0e8;">{{ $member->tgl_mendaftar?->format('d M Y H:i') }}</div>
                            @if ($member->tgl_mendaftar)
                                <div class="text-xs italic" style="font-family:'IM Fell English',serif; color:rgba(192,192,192,.45);">{{ $member->tgl_mendaftar->diffForHumans() }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="mdt-field">
                        <div class="mdt-field-icon"><i class="ti ti-receipt"></i></div>
                        <div><div class="text-xs uppercase tracking-wide" style="color:#86efac;">Tgl Terakhir Bayar</div><div style="color:#f5f0e8;">{{ $member->tgl_terkahir_bayar?->format('d M Y') ?? '-' }}</div></div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-6 relative z-10">
                <a href="{{ route('member.edit', $member->id_member) }}" class="mdt-action-btn edit"><i class="ti ti-edit"></i> Edit</a>
                <form action="{{ route('member.destroy', $member->id_member) }}" method="POST"
                id="form-hapus-member-show-{{ $member->id_member }}">
                @csrf @method('DELETE')
                <button type="button"
                        onclick="konfirmasiHapus('form-hapus-member-show-{{ $member->id_member }}', 'Member {{ $member->nama_member }}')"
                        class="mdt-action-btn delete">
                    <i class="ti ti-trash"></i> Hapus
                </button>
</form>
            </div>
        </div>

        <div class="mdt-sub mdt-card-in-2 max-w-2xl">
            <div class="mdt-sub-head">
                <i class="ti ti-history" style="color:#d4af37"></i>
                <h2 style="font-family:'IM Fell English',serif; font-size:1.05rem; color:#f5f0e8;">Riwayat Peminjaman</h2>
            </div>
            <table class="w-full text-sm">
                <thead style="background:#1a4a2e;">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Buku</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Tgl Pinjam</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Tgl Kembali</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($member->peminjamans as $p)
                        <tr class="mdt-row border-t" style="border-color: rgba(212,175,55,.1); background:#0e2516;">
                            <td class="px-5 py-3" style="color:#f5f0e8;">{{ $p->buku->judul ?? '-' }}</td>
                            <td class="px-5 py-3" style="color:#c0c0c0;">{{ $p->tgl_pinjam?->format('d M Y') }}</td>
                            <td class="px-5 py-3" style="color:#c0c0c0;">{{ $p->tgl_kembali?->format('d M Y') ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @if ($p->tgl_kembali)
                                    <span class="mdt-badge mdt-badge-done"><i class="ti ti-check"></i> Selesai</span>
                                @else
                                    <span class="mdt-badge mdt-badge-active"><i class="ti ti-clock"></i> Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-5 py-8 text-center italic" style="font-family:'IM Fell English',serif; color:#c0c0c0;">Belum pernah meminjam buku.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection