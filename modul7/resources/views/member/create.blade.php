@extends('layouts.app')

@section('title', 'Daftarkan Jiwa — Slytherin Restricted Library')

@section('content')

<style>
    @keyframes shimmer {
        0%   { left: -100%; }
        50%  { left: 100%; }
        100% { left: 100%; }
    }
    @keyframes rise {
        0%   { opacity: 0;   transform: translateY(0)     scale(0); }
        20%  { opacity: 0.5; transform: translateY(-28px) scale(1); }
        80%  { opacity: 0.1; transform: translateY(-80px) scale(0.5); }
        100% { opacity: 0;   transform: translateY(-120px) scale(0); }
    }
    @keyframes field-glow-in {
        from { opacity: 0; transform: translateX(-6px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    @keyframes card-in {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .form-card {
        animation: card-in 0.5s ease-out both;
        position: relative;
        background: #0f2d1a;
        border: 1px solid rgba(212,175,55,0.28);
        border-radius: 14px;
        padding: 40px 44px;
        box-shadow: 0 0 80px rgba(0,0,0,0.55), 0 0 40px rgba(34,197,94,0.04);
        transition: border-color 0.4s, box-shadow 0.4s;
        overflow: hidden;
    }
    .form-card:hover {
        border-color: rgba(212,175,55,0.46);
        box-shadow: 0 0 80px rgba(0,0,0,0.55), 0 0 50px rgba(212,175,55,0.07);
    }

    /* Stone texture inside card */
    .form-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            repeating-linear-gradient(0deg,  transparent, transparent 55px, rgba(255,255,255,0.006) 55px, rgba(255,255,255,0.006) 56px),
            repeating-linear-gradient(90deg, transparent, transparent 70px, rgba(255,255,255,0.004) 70px, rgba(255,255,255,0.004) 71px);
        pointer-events: none;
        border-radius: 14px;
    }

    /* Small corner ornaments on card */
    .card-corner {
        position: absolute;
        width: 48px;
        height: 48px;
        pointer-events: none;
        z-index: 10;
    }
    .card-corner-tl { top: 10px; left: 10px; }
    .card-corner-tr { top: 10px; right: 10px; transform: scaleX(-1); }
    .card-corner-bl { bottom: 10px; left: 10px; transform: scaleY(-1); }
    .card-corner-br { bottom: 10px; right: 10px; transform: scale(-1); }

    /* Input styling */
    .input-field {
        width: 100%;
        padding: 11px 14px 11px 42px;
        background: #0a1a0f;
        border: 1px solid rgba(26,74,46,0.9);
        border-radius: 7px;
        color: #f5f0e8;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        outline: none;
        transition: border-color 0.25s, box-shadow 0.25s, border-left-width 0.2s;
        position: relative;
    }
    .input-field::placeholder { color: rgba(192,192,192,0.3); }
    .input-field:focus {
        border-color: #22c55e;
        border-left: 3px solid #d4af37;
        box-shadow: 0 0 0 3px rgba(34,197,94,0.1), inset 0 0 12px rgba(34,197,94,0.03);
        padding-left: 43px;
    }

    textarea.input-field { resize: none; padding-top: 11px; }

    select.input-field {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23d4af37' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 38px;
        cursor: pointer;
    }

    .input-wrap { position: relative; }
    .input-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        color: rgba(212,175,55,0.45);
        pointer-events: none;
        transition: color 0.2s;
        z-index: 1;
    }
    .input-wrap:focus-within .input-icon { color: rgba(212,175,55,0.8); }
    .textarea-wrap .input-icon { top: 13px; transform: none; }

    .field-label {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 10.5px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(192,192,192,0.55);
        margin-bottom: 6px;
    }

    /* File input */
    .file-drop {
        position: relative;
        width: 100%;
        padding: 22px 16px;
        background: #0a1a0f;
        border: 1.5px dashed rgba(212,175,55,0.35);
        border-radius: 7px;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.25s, background 0.25s;
    }
    .file-drop:hover {
        border-color: rgba(212,175,55,0.65);
        background: rgba(212,175,55,0.03);
    }
    .file-drop input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    /* Buttons */
    .btn-gold {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 28px;
        background: transparent;
        border: 1.5px solid #d4af37;
        border-radius: 7px;
        color: #d4af37;
        font-family: 'Cinzel Decorative', serif;
        font-size: 11px;
        letter-spacing: 0.07em;
        cursor: pointer;
        overflow: hidden;
        transition: background 0.3s, box-shadow 0.3s, color 0.3s;
        text-decoration: none;
    }
    .btn-gold::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(212,175,55,0.15), transparent);
        animation: shimmer 3s ease-in-out infinite;
    }
    .btn-gold:hover {
        background: rgba(212,175,55,0.1);
        box-shadow: 0 0 20px rgba(212,175,55,0.2), inset 0 0 16px rgba(212,175,55,0.05);
        color: #f0d060;
    }

    .btn-silver {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        background: transparent;
        border: 1.5px solid rgba(192,192,192,0.35);
        border-radius: 7px;
        color: rgba(192,192,192,0.6);
        font-family: 'Inter', sans-serif;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s, color 0.2s;
    }
    .btn-silver:hover {
        background: rgba(192,192,192,0.07);
        border-color: rgba(192,192,192,0.55);
        color: rgba(192,192,192,0.85);
    }

    /* Ambient particle */
    .form-particle {
        position: fixed;
        width: 2px; height: 2px;
        border-radius: 9999px;
        opacity: 0;
        animation: rise var(--dur) ease-in var(--delay) infinite;
        pointer-events: none;
        z-index: 0;
    }

    /* Section divider ornament */
    .ornament-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 6px 0 20px;
    }
</style>

{{-- Ambient particles --}}
<div class="form-particle" style="left:5%;bottom:10%;background:#d4af37;--dur:6s;--delay:0s"></div>
<div class="form-particle" style="left:92%;bottom:20%;background:#d4af37;--dur:8s;--delay:1.5s"></div>
<div class="form-particle" style="left:50%;bottom:5%;background:#86efac;--dur:7s;--delay:2.8s;width:3px;height:3px"></div>
<div class="form-particle" style="left:18%;bottom:30%;background:#d4af37;--dur:5.5s;--delay:0.7s"></div>
<div class="form-particle" style="left:75%;bottom:15%;background:#d4af37;--dur:9s;--delay:3.2s"></div>

{{-- Ambient glow behind content --}}
<div class="fixed top-1/3 left-1/2 -translate-x-1/2 w-[600px] h-[400px] rounded-full pointer-events-none"
     style="background: radial-gradient(ellipse, rgba(34,197,94,0.05) 0%, transparent 70%); z-index:0;"></div>

<div class="relative z-10 max-w-2xl">

    {{-- Page header --}}
    <div class="mb-8">
        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 mb-3 text-xs" style="font-family:'Inter',sans-serif;">
            <a href="{{ route('member.index') }}" class="transition" style="color:rgba(134,239,172,0.6);"
               onmouseover="this.style.color='#86efac'" onmouseout="this.style.color='rgba(134,239,172,0.6)'">
                Registry of Souls
            </a>
            <span style="color:rgba(212,175,55,0.4);">›</span>
            <span style="color:rgba(192,192,192,0.45);">Daftarkan Jiwa Baru</span>
        </div>

        <h1 style="font-family:'IM Fell English',serif; font-size:26px; color:#f5f0e8; margin-bottom:4px;">
            Daftarkan Jiwa Baru
        </h1>

        {{-- Ornamental divider --}}
        <div class="ornament-divider" style="justify-content:flex-start;">
            <svg width="200" height="12" viewBox="0 0 200 12" fill="none">
                <defs>
                    <linearGradient id="dv1" x1="0" y1="0" x2="160" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#d4af37" stop-opacity="0.7"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <circle cx="4" cy="6" r="2" fill="#d4af37" opacity="0.7"/>
                <path d="M8 6 L16 2 L20 6 L16 10 Z" fill="rgba(212,175,55,0.45)"/>
                <line x1="24" y1="6" x2="200" y2="6" stroke="url(#dv1)" stroke-width="0.75"/>
            </svg>
        </div>

        <p style="font-family:'IM Fell English',serif; font-style:italic; font-size:14px; color:rgba(134,239,172,0.65);">
            Tambahkan anggota baru ke dalam Registry of Souls
        </p>
    </div>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-6 px-4 py-3 rounded-md flex items-center gap-3 text-sm"
             style="background:#1a4a2e; border:1px solid rgba(34,197,94,0.4); color:#86efac;">
            <i class="ti ti-circle-check flex-shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-6 px-4 py-3 rounded-md text-sm"
             style="background:#7f1d1d; border:1px solid rgba(239,68,68,0.4); color:#fca5a5;">
            @foreach ($errors->all() as $error)
                <p class="flex items-center gap-2"><i class="ti ti-alert-circle flex-shrink-0"></i>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">

        {{-- Card corner ornaments --}}
        <svg class="card-corner card-corner-tl" viewBox="0 0 48 48" fill="none">
            <path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.55"/>
            <circle cx="14" cy="3" r="1" fill="#d4af37" opacity="0.35"/>
            <circle cx="3" cy="14" r="1" fill="#d4af37" opacity="0.35"/>
        </svg>
        <svg class="card-corner card-corner-tr" viewBox="0 0 48 48" fill="none">
            <path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.55"/>
        </svg>
        <svg class="card-corner card-corner-bl" viewBox="0 0 48 48" fill="none">
            <path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.55"/>
        </svg>
        <svg class="card-corner card-corner-br" viewBox="0 0 48 48" fill="none">
            <path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.55"/>
        </svg>

        {{-- Form section label --}}
        <div class="flex items-center gap-3 mb-6" style="position:relative;z-index:2;">
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0"
                 style="border:1px solid rgba(212,175,55,0.4); background:rgba(212,175,55,0.07);">
                <i class="ti ti-users text-xs" style="color:#d4af37;"></i>
            </div>
            <span style="font-family:'IM Fell English',serif; font-size:15px; color:rgba(245,240,232,0.7); font-style:italic;">
                Data Anggota
            </span>
            <div class="flex-1 h-px" style="background: linear-gradient(90deg, rgba(212,175,55,0.25), transparent);"></div>
        </div>

        <form action="{{ route('member.store') }}" method="POST" class="space-y-5" enctype="multipart/form-data"
              style="position:relative;z-index:2;">
            @csrf

            {{-- Nama Member --}}
            <div>
                <label for="nama_member" class="field-label">Nama Member</label>
                <div class="input-wrap">
                    <i class="ti ti-user input-icon"></i>
                    <input type="text" name="nama_member" id="nama_member"
                           value="{{ old('nama_member') }}"
                           class="input-field"
                           placeholder="Severus Snape">
                </div>
                @error('nama_member')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;">
                        <i class="ti ti-alert-circle text-xs"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Nomor Member --}}
            <div>
                <label for="nomor_member" class="field-label">Nomor Member</label>
                <div class="input-wrap">
                    <i class="ti ti-id-badge input-icon"></i>
                    <input type="text" name="nomor_member" id="nomor_member"
                           value="{{ old('nomor_member') }}"
                           class="input-field"
                           placeholder="SLY-0001">
                </div>
                @error('nomor_member')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;">
                        <i class="ti ti-alert-circle text-xs"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="field-label">Alamat</label>
                <div class="input-wrap textarea-wrap">
                    <i class="ti ti-map-pin input-icon"></i>
                    <textarea name="alamat" id="alamat" rows="3"
                              class="input-field"
                              placeholder="Dungeon, Hogwarts Castle...">{{ old('alamat') }}</textarea>
                </div>
                @error('alamat')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;">
                        <i class="ti ti-alert-circle text-xs"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- 2-col: Tgl Mendaftar + Tgl Bayar --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tgl_mendaftar" class="field-label">Tanggal Mendaftar</label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar-plus input-icon"></i>
                        <input type="datetime-local" name="tgl_mendaftar" id="tgl_mendaftar"
                               value="{{ old('tgl_mendaftar', now()->format('Y-m-d\TH:i')) }}"
                               class="input-field">
                    </div>
                    @error('tgl_mendaftar')
                        <p class="text-xs mt-1.5" style="color:#fca5a5;">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tgl_terkahir_bayar" class="field-label">Tgl Terakhir Bayar <span style="color:rgba(192,192,192,0.35);font-size:9px;">(opsional)</span></label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar-check input-icon"></i>
                        <input type="date" name="tgl_terkahir_bayar" id="tgl_terkahir_bayar"
                               value="{{ old('tgl_terkahir_bayar') }}"
                               class="input-field">
                    </div>
                    @error('tgl_terkahir_bayar')
                        <p class="text-xs mt-1.5" style="color:#fca5a5;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Foto Member --}}
            <div>
                <label class="field-label">Foto Member <span style="color:rgba(192,192,192,0.35);font-size:9px;">(opsional)</span></label>
                <div class="file-drop" id="fileDropZone">
                    <input type="file" name="foto" id="foto" accept="image/*"
                           onchange="updateFileName(this)">
                    <div id="fileDropContent">
                        <i class="ti ti-cloud-upload text-2xl mb-2 block" style="color:rgba(212,175,55,0.5);"></i>
                        <p style="color:rgba(245,240,232,0.5); font-size:13px;">
                            Klik atau seret foto ke sini
                        </p>
                        <p style="color:rgba(192,192,192,0.3); font-size:11px; margin-top:4px;">
                            JPG / PNG · Maks. 2MB
                        </p>
                    </div>
                </div>
                @error('foto')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;">
                        <i class="ti ti-alert-circle text-xs"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Divider before buttons --}}
            <div class="pt-2">
                <div class="flex items-center gap-3 mb-5">
                    <div class="flex-1 h-px" style="background: linear-gradient(90deg, rgba(212,175,55,0.2), transparent);"></div>
                    <svg width="40" height="10" viewBox="0 0 40 10" fill="none">
                        <circle cx="20" cy="5" r="1.8" fill="#d4af37" opacity="0.5"/>
                        <path d="M14 5 L17 2 L20 5 L17 8 Z" fill="rgba(212,175,55,0.3)"/>
                        <path d="M26 5 L23 2 L20 5 L23 8 Z" fill="rgba(212,175,55,0.3)"/>
                    </svg>
                    <div class="flex-1 h-px" style="background: linear-gradient(270deg, rgba(212,175,55,0.2), transparent);"></div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="btn-gold">
                        <i class="ti ti-feather"></i>
                        Daftarkan
                    </button>
                    <a href="{{ route('member.index') }}" class="btn-silver">
                        <i class="ti ti-arrow-left"></i>
                        Batal
                    </a>
                </div>
            </div>

        </form>
    </div>

</div>

<script>
function updateFileName(input) {
    const content = document.getElementById('fileDropContent');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        content.innerHTML = `
            <i class="ti ti-photo-check text-2xl mb-2 block" style="color:#22c55e;"></i>
            <p style="color:#86efac; font-size:13px;">${file.name}</p>
            <p style="color:rgba(192,192,192,0.4); font-size:11px; margin-top:4px;">${(file.size/1024).toFixed(1)} KB</p>
        `;
        document.getElementById('fileDropZone').style.borderColor = 'rgba(34,197,94,0.5)';
        document.getElementById('fileDropZone').style.background = 'rgba(34,197,94,0.04)';
    }
}
</script>

@endsection