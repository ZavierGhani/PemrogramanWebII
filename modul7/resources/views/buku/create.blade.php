@extends('layouts.app')

@section('title', 'Tambah Buku — Slytherin Restricted Library')

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

    .card-corner { position: absolute; width: 48px; height: 48px; pointer-events: none; z-index: 10; }
    .card-corner-tl { top: 10px; left: 10px; }
    .card-corner-tr { top: 10px; right: 10px; transform: scaleX(-1); }
    .card-corner-bl { bottom: 10px; left: 10px; transform: scaleY(-1); }
    .card-corner-br { bottom: 10px; right: 10px; transform: scale(-1); }

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
        transition: border-color 0.25s, box-shadow 0.25s;
    }
    .input-field::placeholder { color: rgba(192,192,192,0.3); }
    .input-field:focus {
        border-color: #22c55e;
        border-left: 3px solid #d4af37;
        box-shadow: 0 0 0 3px rgba(34,197,94,0.1), inset 0 0 12px rgba(34,197,94,0.03);
        padding-left: 43px;
    }

    .input-wrap { position: relative; }
    .input-icon {
        position: absolute; left: 13px; top: 50%;
        transform: translateY(-50%);
        font-size: 15px; color: rgba(212,175,55,0.45);
        pointer-events: none; transition: color 0.2s; z-index: 1;
    }
    .input-wrap:focus-within .input-icon { color: rgba(212,175,55,0.8); }

    .field-label {
        display: block;
        font-family: 'Inter', sans-serif;
        font-size: 10.5px; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: rgba(192,192,192,0.55); margin-bottom: 6px;
    }

    /* Book cover preview area */
    .cover-preview-wrap {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }
    .cover-preview {
        flex-shrink: 0;
        width: 90px;
        height: 126px;
        border-radius: 6px;
        border: 1px solid rgba(212,175,55,0.3);
        background: #0a1a0f;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .cover-preview::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 8px;
        background: linear-gradient(180deg, rgba(212,175,55,0.25), rgba(212,175,55,0.08), rgba(212,175,55,0.25));
        border-right: 1px solid rgba(212,175,55,0.2);
    }
    .cover-preview img { width: 100%; height: 100%; object-fit: cover; }

    .file-drop {
        position: relative; width: 100%; padding: 22px 16px;
        background: #0a1a0f;
        border: 1.5px dashed rgba(212,175,55,0.35);
        border-radius: 7px; text-align: center; cursor: pointer;
        transition: border-color 0.25s, background 0.25s;
    }
    .file-drop:hover { border-color: rgba(212,175,55,0.65); background: rgba(212,175,55,0.03); }
    .file-drop input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }

    .btn-gold {
        position: relative;
        display: inline-flex; align-items: center; gap: 7px;
        padding: 11px 28px;
        background: transparent; border: 1.5px solid #d4af37; border-radius: 7px;
        color: #d4af37;
        font-family: 'Cinzel Decorative', serif; font-size: 11px; letter-spacing: 0.07em;
        cursor: pointer; overflow: hidden;
        transition: background 0.3s, box-shadow 0.3s, color 0.3s;
        text-decoration: none;
    }
    .btn-gold::before {
        content: '';
        position: absolute; top: 0; left: -100%;
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
        display: inline-flex; align-items: center; gap: 7px;
        padding: 11px 24px;
        background: transparent; border: 1.5px solid rgba(192,192,192,0.35); border-radius: 7px;
        color: rgba(192,192,192,0.6);
        font-family: 'Inter', sans-serif; font-size: 13px;
        cursor: pointer; text-decoration: none;
        transition: background 0.2s, border-color 0.2s, color 0.2s;
    }
    .btn-silver:hover {
        background: rgba(192,192,192,0.07);
        border-color: rgba(192,192,192,0.55);
        color: rgba(192,192,192,0.85);
    }

    .form-particle {
        position: fixed; width: 2px; height: 2px; border-radius: 9999px;
        opacity: 0; animation: rise var(--dur) ease-in var(--delay) infinite;
        pointer-events: none; z-index: 0;
    }
</style>

<div class="form-particle" style="left:5%;bottom:10%;background:#d4af37;--dur:6s;--delay:0s"></div>
<div class="form-particle" style="left:92%;bottom:20%;background:#d4af37;--dur:8s;--delay:1.5s"></div>
<div class="form-particle" style="left:50%;bottom:5%;background:#86efac;--dur:7s;--delay:2.8s;width:3px;height:3px"></div>
<div class="form-particle" style="left:18%;bottom:30%;background:#d4af37;--dur:5.5s;--delay:0.7s"></div>
<div class="form-particle" style="left:75%;bottom:15%;background:#d4af37;--dur:9s;--delay:3.2s"></div>

<div class="fixed top-1/3 left-1/2 -translate-x-1/2 w-[600px] h-[400px] rounded-full pointer-events-none"
     style="background: radial-gradient(ellipse, rgba(34,197,94,0.05) 0%, transparent 70%); z-index:0;"></div>

<div class="relative z-10 max-w-2xl">

    <div class="mb-8">
        <div class="flex items-center gap-2 mb-3 text-xs" style="font-family:'Inter',sans-serif;">
            <a href="{{ route('buku.index') }}" class="transition" style="color:rgba(134,239,172,0.6);"
               onmouseover="this.style.color='#86efac'" onmouseout="this.style.color='rgba(134,239,172,0.6)'">
                Restricted Collection
            </a>
            <span style="color:rgba(212,175,55,0.4);">›</span>
            <span style="color:rgba(192,192,192,0.45);">Tambah Buku</span>
        </div>

        <h1 style="font-family:'IM Fell English',serif; font-size:26px; color:#f5f0e8; margin-bottom:4px;">
            Tambah Koleksi Baru
        </h1>

        <div style="display:flex; align-items:center; margin: 6px 0 20px;">
            <svg width="200" height="12" viewBox="0 0 200 12" fill="none">
                <defs>
                    <linearGradient id="dv3" x1="0" y1="0" x2="160" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#d4af37" stop-opacity="0.7"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <circle cx="4" cy="6" r="2" fill="#d4af37" opacity="0.7"/>
                <path d="M8 6 L16 2 L20 6 L16 10 Z" fill="rgba(212,175,55,0.45)"/>
                <line x1="24" y1="6" x2="200" y2="6" stroke="url(#dv3)" stroke-width="0.75"/>
            </svg>
        </div>

        <p style="font-family:'IM Fell English',serif; font-style:italic; font-size:14px; color:rgba(134,239,172,0.65);">
            Masukkan grimoire baru ke dalam Restricted Section
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 px-4 py-3 rounded-md text-sm"
             style="background:#7f1d1d; border:1px solid rgba(239,68,68,0.4); color:#fca5a5;">
            @foreach ($errors->all() as $error)
                <p class="flex items-center gap-2"><i class="ti ti-alert-circle flex-shrink-0"></i>{{ $message }}</p>
            @endforeach
        </div>
    @endif

    <div class="form-card">

        <svg class="card-corner card-corner-tl" viewBox="0 0 48 48" fill="none">
            <path d="M3 45 L3 3 L45 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L14 3" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <path d="M3 3 L3 14" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.55"/>
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

        {{-- Section label --}}
        <div class="flex items-center gap-3 mb-6" style="position:relative;z-index:2;">
            <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0"
                 style="border:1px solid rgba(212,175,55,0.4); background:rgba(212,175,55,0.07);">
                <i class="ti ti-book text-xs" style="color:#d4af37;"></i>
            </div>
            <span style="font-family:'IM Fell English',serif; font-size:15px; color:rgba(245,240,232,0.7); font-style:italic;">
                Data Grimoire
            </span>
            <div class="flex-1 h-px" style="background: linear-gradient(90deg, rgba(212,175,55,0.25), transparent);"></div>
        </div>

        <form action="{{ route('buku.store') }}" method="POST" class="space-y-5"
              enctype="multipart/form-data" style="position:relative;z-index:2;">
            @csrf

            <div>
                <label for="judul" class="field-label">Judul</label>
                <div class="input-wrap">
                    <i class="ti ti-book-2 input-icon"></i>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                           class="input-field" placeholder="Secrets of the Darkest Art">
                </div>
                @error('judul')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;"><i class="ti ti-alert-circle text-xs"></i>{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="penulis" class="field-label">Penulis</label>
                    <div class="input-wrap">
                        <i class="ti ti-feather input-icon"></i>
                        <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}"
                               class="input-field" placeholder="Eileen Prince">
                    </div>
                    @error('penulis')
                        <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;"><i class="ti ti-alert-circle text-xs"></i>{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="penerbit" class="field-label">Penerbit</label>
                    <div class="input-wrap">
                        <i class="ti ti-building input-icon"></i>
                        <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}"
                               class="input-field" placeholder="Dark Arts Press">
                    </div>
                    @error('penerbit')
                        <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;"><i class="ti ti-alert-circle text-xs"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div style="max-width:180px;">
                <label for="tahun_terbit" class="field-label">Tahun Terbit</label>
                <div class="input-wrap">
                    <i class="ti ti-calendar input-icon"></i>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}"
                           class="input-field" placeholder="1972" min="1800" max="2023">
                </div>
                @error('tahun_terbit')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;"><i class="ti ti-alert-circle text-xs"></i>{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover upload with live preview --}}
            <div>
                <label class="field-label">Cover Buku <span style="color:rgba(192,192,192,0.35);font-size:9px;">(opsional)</span></label>
                <div class="cover-preview-wrap">
                    <div class="cover-preview" id="coverPreview">
                        <span id="coverPlaceholder">
                            <i class="ti ti-books text-2xl block mb-1" style="color:rgba(212,175,55,0.3);"></i>
                            <span style="font-size:9px; color:rgba(192,192,192,0.3); font-family:'Inter',sans-serif;">COVER</span>
                        </span>
                        <img id="coverImg" src="" alt="" style="display:none; width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div class="flex-1">
                        <div class="file-drop" id="coverDropZone">
                            <input type="file" name="cover" id="cover" accept="image/*"
                                   onchange="previewCover(this)">
                            <div id="coverDropContent">
                                <i class="ti ti-cloud-upload text-2xl mb-2 block" style="color:rgba(212,175,55,0.5);"></i>
                                <p style="color:rgba(245,240,232,0.5); font-size:13px;">Klik atau seret cover ke sini</p>
                                <p style="color:rgba(192,192,192,0.3); font-size:11px; margin-top:4px;">JPG / PNG · Maks. 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                @error('cover')
                    <p class="text-xs mt-1.5 flex items-center gap-1.5" style="color:#fca5a5;"><i class="ti ti-alert-circle text-xs"></i>{{ $message }}</p>
                @enderror
            </div>

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
                        <i class="ti ti-books"></i>
                        Simpan
                    </button>
                    <a href="{{ route('buku.index') }}" class="btn-silver">
                        <i class="ti ti-arrow-left"></i>
                        Batal
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
function previewCover(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('coverImg');
            const placeholder = document.getElementById('coverPlaceholder');
            img.src = e.target.result;
            img.style.display = 'block';
            placeholder.style.display = 'none';

            document.getElementById('coverDropContent').innerHTML = `
                <i class="ti ti-photo-check text-2xl mb-2 block" style="color:#22c55e;"></i>
                <p style="color:#86efac; font-size:13px;">${file.name}</p>
                <p style="color:rgba(192,192,192,0.4); font-size:11px; margin-top:4px;">${(file.size/1024).toFixed(1)} KB</p>
            `;
            document.getElementById('coverDropZone').style.borderColor = 'rgba(34,197,94,0.5)';
            document.getElementById('coverDropZone').style.background = 'rgba(34,197,94,0.04)';
        };
        reader.readAsDataURL(file);
    }
}
</script>

@endsection