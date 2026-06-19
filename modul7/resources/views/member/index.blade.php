@extends('layouts.app')

@section('title', 'Daftar Member — Slytherin Restricted Library')

@section('content')

<style>
    @keyframes mem-rise {
        0%   { opacity: 0;   transform: translateY(0) scale(0); }
        20%  { opacity: 0.55;transform: translateY(-30px) scale(1); }
        80%  { opacity: 0.15;transform: translateY(-90px) scale(0.5); }
        100% { opacity: 0;   transform: translateY(-130px) scale(0); }
    }
    @keyframes mem-shimmer { 0% { left: -100%; } 50% { left: 100%; } 100% { left: 100%; } }
    @keyframes mem-pulse   { 0%, 100% { opacity: 0.35; transform: scale(1); } 50% { opacity: 0.7; transform: scale(1.1); } }
    @keyframes mem-fade-down { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes mem-fade-up   { from { opacity: 0; transform: translateY(14px);  } to { opacity: 1; transform: translateY(0); } }
    @keyframes mem-row-in    { from { opacity: 0; transform: translateY(8px);   } to { opacity: 1; transform: translateY(0); } }

    .mem-particle {
        position: absolute; width: 2px; height: 2px; border-radius: 9999px;
        opacity: 0; pointer-events: none;
        animation: mem-rise var(--dur) ease-in var(--delay) infinite;
    }
    .mem-corner { position: absolute; width: 52px; height: 52px; pointer-events: none; z-index: 5; }
    .mem-corner-tl { top: 8px; left: 8px; }
    .mem-corner-tr { top: 8px; right: 8px; transform: scaleX(-1); }
    .mem-corner-bl { bottom: 8px; left: 8px; transform: scaleY(-1); }
    .mem-corner-br { bottom: 8px; right: 8px; transform: scale(-1); }

    .mem-header-in { animation: mem-fade-down 0.5s ease-out both; }
    .mem-card-in   { animation: mem-fade-up 0.55s ease-out 0.1s both; }

    .mem-crest {
        width: 52px; height: 52px; border-radius: 9999px; position: relative;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        border: 1.5px solid rgba(212,175,55,0.5); background: #0f2d1a;
        box-shadow: inset 0 0 12px rgba(0,0,0,0.6);
    }
    .mem-crest::before {
        content: ''; position: absolute; inset: -8px; border-radius: 9999px;
        background: radial-gradient(circle, rgba(34,197,94,0.28) 0%, transparent 70%);
        animation: mem-pulse 4s ease-in-out infinite; z-index: -1;
    }

    .mem-seal {
        width: 56px; height: 56px; border-radius: 9999px;
        display: flex; align-items: center; justify-content: center;
        border: 1.5px solid rgba(212,175,55,0.5); background: #0f2d1a;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.55);
    }

    .mem-btn-primary {
        position: relative; display: inline-flex; align-items: center; gap: 8px;
        padding: 11px 22px; background: #d4af37; color: #0a1a0f; font-weight: 600;
        border-radius: 8px; overflow: hidden; text-decoration: none;
        transition: box-shadow 0.3s, transform 0.2s, background 0.3s;
    }
    .mem-btn-primary::before {
        content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
        animation: mem-shimmer 3s ease-in-out infinite;
    }
    .mem-btn-primary:hover { background: #f0d060; box-shadow: 0 0 24px rgba(212,175,55,0.4); transform: translateY(-1px); }

    .mem-search-input {
        width: 100%; padding: 12px 16px 12px 44px; border-radius: 9999px;
        background: #0a1a0f; border: 1px solid rgba(26,74,46,0.8); color: #f5f0e8;
        font-family: 'Inter', sans-serif; font-size: 14px; outline: none;
        transition: border-color 0.25s, box-shadow 0.25s;
    }
    .mem-search-input::placeholder { color: rgba(192,192,192,0.4); }
    .mem-search-input:focus { border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,0.15), 0 0 20px rgba(34,197,94,0.08); }

    .mem-card {
        position: relative; background: #1a4a2e0d; background-color: #14391f;
        border: 1px solid rgba(212,175,55,0.18); border-radius: 12px; overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.35); transition: border-color 0.4s, box-shadow 0.4s;
    }
    .mem-card:hover { border-color: rgba(212,175,55,0.35); box-shadow: 0 10px 40px rgba(0,0,0,0.35), 0 0 30px rgba(212,175,55,0.06); }

    .mem-row { position: relative; border-left: 2px solid transparent; animation: mem-row-in 0.45s ease-out both; transition: background 0.25s, border-color 0.25s; }
    .mem-row:hover { background: #163a22 !important; border-left-color: #22c55e; }

    .mem-avatar { width: 44px; height: 44px; border-radius: 9999px; object-fit: cover; border: 1.5px solid rgba(212,175,55,0.4); transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s; }
    .mem-row:hover .mem-avatar { transform: scale(1.08); border-color: rgba(212,175,55,0.85); box-shadow: 0 0 14px rgba(212,175,55,0.3); }
    .mem-avatar-ph {
        width: 44px; height: 44px; border-radius: 9999px; display: flex; align-items: center; justify-content: center;
        border: 1.5px solid rgba(212,175,55,0.3); background: radial-gradient(circle, #15351f, #0a1a0f);
        color: rgba(192,192,192,0.45); transition: all 0.3s;
    }
    .mem-row:hover .mem-avatar-ph { border-color: rgba(212,175,55,0.6); box-shadow: 0 0 12px rgba(212,175,55,0.2); }

    .mem-id-badge {
        display: inline-block; font-family: 'Inter', sans-serif; font-size: 12px; letter-spacing: 0.04em;
        padding: 3px 10px; border-radius: 4px; background: rgba(212,175,55,0.08);
        border: 1px solid rgba(212,175,55,0.25); color: #d4af37;
    }

    .mem-action-btn { width: 34px; height: 34px; border-radius: 9999px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid; font-size: 14px; transition: all 0.25s; text-decoration: none; }
    .mem-action-btn.detail { border-color: rgba(192,192,192,0.4); color: #c0c0c0; }
    .mem-action-btn.detail:hover { background: rgba(192,192,192,0.15); box-shadow: 0 0 12px rgba(192,192,192,0.25); transform: translateY(-2px); }
    .mem-action-btn.edit { border-color: rgba(212,175,55,0.4); color: #d4af37; }
    .mem-action-btn.edit:hover { background: rgba(212,175,55,0.15); box-shadow: 0 0 12px rgba(212,175,55,0.3); transform: translateY(-2px); }
    .mem-action-btn.delete { border-color: rgba(239,68,68,0.4); color: #fca5a5; }
    .mem-action-btn.delete:hover { background: rgba(127,29,29,0.45); box-shadow: 0 0 12px rgba(239,68,68,0.3); transform: translateY(-2px); }

    .mem-tooltip { position: relative; }
    .mem-tooltip::after {
        content: attr(data-tooltip); position: absolute; bottom: 120%; left: 50%;
        transform: translateX(-50%) translateY(4px); background: #0a1a0f; color: #f5f0e8;
        font-size: 11px; padding: 4px 9px; border-radius: 4px; border: 1px solid rgba(212,175,55,0.3);
        white-space: nowrap; opacity: 0; pointer-events: none; transition: opacity 0.2s, transform 0.2s; z-index: 30;
    }
    .mem-tooltip:hover::after { opacity: 1; transform: translateX(-50%) translateY(0); }

    .mem-divider line { stroke: rgba(212,175,55,0.35); }

    .mem-pagination [class*="bg-white"], .mem-pagination [class*="border-gray"], .mem-pagination [class*="text-gray"] {
        background: #0f2d1a !important; border-color: rgba(212,175,55,0.25) !important; color: #c0c0c0 !important;
    }
    .mem-pagination a:hover { background: rgba(212,175,55,0.15) !important; color: #d4af37 !important; }
    .mem-pagination [aria-current="page"] span { background: #d4af37 !important; border-color: #d4af37 !important; color: #0a1a0f !important; font-weight: 600; }
    .mem-pagination svg { color: #c0c0c0 !important; }
    .mem-pagination nav > * { font-family: 'Inter', sans-serif; }
</style>

<div class="relative">

    {{-- Ambient glow --}}
    <div class="absolute -top-10 left-1/3 w-[380px] h-[380px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(34,197,94,0.06) 0%, transparent 70%)"></div>
    <div class="absolute top-40 right-0 w-[260px] h-[260px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%)"></div>

    {{-- Floating particles --}}
    <div class="mem-particle" style="left:8%;  bottom:10%; background:#d4af37; --dur:7s;   --delay:0s"></div>
    <div class="mem-particle" style="left:22%; bottom:30%; background:#d4af37; --dur:6s;   --delay:1.4s"></div>
    <div class="mem-particle" style="left:48%; bottom:5%;  background:#86efac; --dur:8.5s; --delay:2.2s; width:3px; height:3px"></div>
    <div class="mem-particle" style="left:65%; bottom:25%; background:#d4af37; --dur:6.5s; --delay:0.6s"></div>
    <div class="mem-particle" style="left:82%; bottom:15%; background:#d4af37; --dur:7.5s; --delay:3s"></div>
    <div class="mem-particle" style="left:92%; bottom:35%; background:#86efac; --dur:9s;   --delay:1.1s"></div>

    <div class="relative z-10">

        {{-- Header --}}
        <div class="mem-header-in flex items-start justify-between mb-5 flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="mem-crest">
                    <i class="ti ti-books text-2xl" style="color:#d4af37"></i>
                </div>
                <div>
                    <h1 style="font-family:'Cinzel Decorative',serif; font-size:1.6rem; color:#d4af37; text-shadow:0 0 26px rgba(212,175,55,0.2); letter-spacing:0.02em;">
                        Daftar Member
                    </h1>
                    <p class="italic mt-0.5" style="font-family:'IM Fell English',serif; font-size:0.95rem; color:#86efac;">
                        Anggota perpustakaan Slytherin
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex flex-col items-center">
                    <div class="mem-seal">
                        <span style="font-family:'Cinzel Decorative',serif; color:#d4af37; font-size:1rem;">{{ $members->total() }}</span>
                    </div>
                    <span class="text-[10px] uppercase tracking-widest mt-1" style="color:#86efac;">Anggota</span>
                </div>

                <a href="{{ route('member.create') }}" class="mem-btn-primary">
                    <i class="ti ti-plus"></i> Tambah Member
                </a>
            </div>
        </div>

        {{-- Ornamental divider --}}
        <div class="mem-divider mb-6">
            <svg width="100%" height="10" viewBox="0 0 100 10" preserveAspectRatio="none">
                <line x1="0" y1="5" x2="42" y2="5" stroke-width="0.3"/>
                <circle cx="50" cy="5" r="1.2" fill="#d4af37" opacity="0.6"/>
                <line x1="58" y1="5" x2="100" y2="5" stroke-width="0.3"/>
            </svg>
        </div>

        {{-- Search --}}
        <form action="{{ route('member.index') }}" method="GET" class="mb-6">
            <div class="relative max-w-md">
                <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2" style="color:rgba(192,192,192,0.5)"></i>
                <input type="text" name="q" value="{{ $q }}"
                       placeholder="Cari nama atau nomor member..."
                       class="mem-search-input">
            </div>
        </form>

        {{-- Table card --}}
        <div class="mem-card mem-card-in">

            <svg class="mem-corner mem-corner-tl" viewBox="0 0 52 52" fill="none">
                <path d="M3 49 L3 3 L49 3" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
                <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.5"/>
            </svg>
            <svg class="mem-corner mem-corner-tr" viewBox="0 0 52 52" fill="none">
                <path d="M3 49 L3 3 L49 3" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
                <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.5"/>
            </svg>
            <svg class="mem-corner mem-corner-bl" viewBox="0 0 52 52" fill="none">
                <path d="M3 49 L3 3 L49 3" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
                <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.5"/>
            </svg>
            <svg class="mem-corner mem-corner-br" viewBox="0 0 52 52" fill="none">
                <path d="M3 49 L3 3 L49 3" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
                <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
                <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.5"/>
            </svg>

            <table class="w-full text-sm relative">
                <thead style="background:#1a4a2e;">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Foto</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Nama</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Nomor Member</th>
                        <th class="px-5 py-3 text-left text-xs uppercase tracking-wide" style="color:#f5f0e8;">Tgl Mendaftar</th>
                        <th class="px-5 py-3 text-right text-xs uppercase tracking-wide" style="color:#f5f0e8;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $member)
                        <tr class="mem-row border-t border-slytherin-700/50" style="background:#0e2516; animation-delay: {{ $loop->index * 0.045 }}s">
                            <td class="px-5 py-3">
                                @if ($member->foto)
                                    <img src="{{ asset('storage/' . $member->foto) }}" alt="{{ $member->nama_member }}" class="mem-avatar">
                                @else
                                    <div class="mem-avatar-ph">
                                        <i class="ti ti-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-3 font-medium" style="color:#f5f0e8;">{{ $member->nama_member }}</td>
                            <td class="px-5 py-3"><span class="mem-id-badge">{{ $member->nomor_member }}</span></td>
                            <td class="px-5 py-3">
                                <div style="color:#c0c0c0;">{{ $member->tgl_mendaftar?->format('d M Y') }}</div>
                                @if ($member->tgl_mendaftar)
                                    <div class="text-xs italic" style="color:rgba(192,192,192,0.45); font-family:'IM Fell English',serif;">{{ $member->tgl_mendaftar->diffForHumans() }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('member.show', $member->id_member) }}" class="mem-action-btn mem-tooltip detail" data-tooltip="Detail">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ route('member.edit', $member->id_member) }}" class="mem-action-btn mem-tooltip edit" data-tooltip="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                  <form action="{{ route('member.destroy', $member->id_member) }}" method="POST"
                                    id="form-hapus-member-{{ $member->id_member }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            onclick="konfirmasiHapus('form-hapus-member-{{ $member->id_member }}', 'Member {{ $member->nama_member }}')"
                                            class="mem-action-btn mem-tooltip delete" data-tooltip="Hapus">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-14 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full flex items-center justify-center" style="border:1.5px dashed rgba(212,175,55,0.35); background:rgba(15,45,26,0.4);">
                                        <i class="ti ti-user-off text-2xl" style="color:rgba(212,175,55,0.5)"></i>
                                    </div>
                                    <p class="italic" style="font-family:'IM Fell English',serif; color:#c0c0c0;">
                                        @if ($q)
                                            Tidak ada catatan anggota bernama "{{ $q }}" di Restricted Section.
                                        @else
                                            Belum ada anggota yang terdaftar di Restricted Section.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 mem-pagination">
            {{ $members->links() }}
        </div>

    </div>
</div>

@endsection