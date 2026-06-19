@extends('layouts.app')

@section('title', '{{ $item["judul"] }} — Zavier')

@push('styles')
<style>
    html, body {
        overflow-x: hidden;
    }

    /* ── Scroll Progress Bar ── */
    #scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 2px;
        width: 0%;
        background: linear-gradient(90deg, #315399, #6b87c4);
        z-index: 9999;
        transition: width 0.1s linear;
    }

    /* ── Blob accent ── */
    .detail-blob {
        position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgba(60, 75, 157, 0.38);
        filter: blur(56px);
    }

    .detail-blob-1 {
        width: 460px;
        height: 420px;
        top: 5%;
        right: -120px;
        border-radius: 60% 40% 55% 45% / 50% 60% 40% 50%;
        animation: detBlob1 15s ease-in-out infinite alternate;
    }

    .detail-blob-2 {
        width: 260px;
        height: 240px;
        bottom: 5%;
        left: -60px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: detBlob2 10s ease-in-out infinite alternate;
        opacity: 0.55;
    }

    @keyframes detBlob1 {
    0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 20% 80% 70% 30% / 80% 10% 90% 20%; transform:  scale(1.2) rotate(15deg); }
    40%  { border-radius: 90% 10% 20% 80% / 20% 90% 10% 80%; transform:  scale(0.9) rotate(-10deg); }
    60%  { border-radius: 10% 90% 80% 20% / 60% 20% 80% 40%; transform:  scale(1.2) rotate(20deg); }
    80%  { border-radius: 80% 20% 10% 90% / 10% 80% 30% 70%; transform:  scale(0.8) rotate(-5deg); }
    100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform:  scale(1) rotate(0deg); }
}

@keyframes detBlob2 {
    0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-20deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.65) rotate(12deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-15deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
}

    /* ── Wrapper ── */
    .detail-wrapper {
        padding-top: 140px;
        padding-bottom: 120px;
        padding-left: 48px;
        padding-right: 48px;
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    /* ── Back link ── */
    .back-link {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        text-decoration: none;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 64px;
        transition: color 0.3s ease, gap 0.3s ease;
    }

    .back-link:hover {
        color: #315399;
        gap: 16px;
    }

    .back-arrow {
        display: inline-block;
        transition: transform 0.3s ease;
        font-size: 14px;
    }

    .back-link:hover .back-arrow {
        transform: translateX(-5px);
    }

    /* ── Header ── */
    .detail-header {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: start;
        gap: 40px;
        margin-bottom: 24px;
        padding-bottom: 40px;
        border-bottom: 1px solid #dce6f7;
    }

    .detail-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(48px, 6vw, 80px);
        font-weight: 600;
        line-height: 1;
        color: #1a2540;
        letter-spacing: -0.02em;
        overflow: hidden;
    }

    .detail-title em {
        font-style: italic;
        color: #315399;
    }

    /* line-by-line reveal */
    .title-line {
        display: block;
        overflow: hidden;
    }

    .title-line-inner {
        display: block;
        opacity: 0;
        transform: translateY(100%);
        animation: lineReveal 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    .title-line:nth-child(1) .title-line-inner { animation-delay: 0.1s; }
    .title-line:nth-child(2) .title-line-inner { animation-delay: 0.25s; }
    .title-line:nth-child(3) .title-line-inner { animation-delay: 0.4s; }

    @keyframes lineReveal {
        to { opacity: 1; transform: translateY(0); }
    }

    .detail-meta {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 8px;
        padding-top: 8px;
    }

    .detail-waktu {
        font-family: 'Space Mono', monospace;
        font-size: 12px;
        color: #315399;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        font-weight: 500;
    }

    .detail-tag {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        border: 1px solid #7691c1;
        padding: 4px 12px;
    }

    .detail-read-time {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #678ccb;
        letter-spacing: 0.15em;
        margin-top: 4px;
    }

    /* ── Image with parallax ── */
    .detail-image-wrapper {
        position: relative;
        width: calc(100% - 16px);
        margin-bottom: 72px;
        overflow: hidden;
    }

    .detail-image-bg {
        position: absolute;
        top: 16px;
        left: 16px;
        width: 100%;
        height: 100%;
        border: 2px solid #dce6f7;
        z-index: 0;
    }

    .detail-image-clip {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        z-index: 1;
    }

    .detail-image {
        width: 100%;
        height: 115%;
        object-fit: cover;
        display: block;
        filter: grayscale(10%);
        transform: translateY(0);
        will-change: transform;
        transition: filter 0.5s ease;
    }

    .detail-image-wrapper:hover .detail-image {
        filter: grayscale(0%);
    }

    .detail-image-num {
        position: absolute;
        top: -20px;
        right: 0;
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
    }

    /* ── Body ── */
    .detail-body {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        margin-bottom: 80px;
        align-items: start;
    }

    .detail-section-label {
        font-family: 'Space Mono', monospace;
        font-size: 18px;
        color: #406bc8;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        margin-bottom: 20px;
        display: block;
    }

    .detail-deskripsi {
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 300;
        color: #1a2540;
        line-height: 1.8;
    }

    /* ── Kesan — dramatic dark ── */
    .detail-kesan-wrapper {
        position: relative;
        padding: 44px 40px;
        background: #1a2540;
        overflow: hidden;
    }

    /* subtle shimmer top edge */
    .detail-kesan-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #315399, #6b87c4, #315399);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* big ghost quotemark */
    .detail-kesan-quote {
        font-family: 'Cormorant Garamond', serif;
        font-size: 120px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.25);
        line-height: 0.6;
        margin-bottom: 20px;
        display: block;
        user-select: none;
    }

    .detail-kesan {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px;
        font-style: italic;
        color: #f4f7ff;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .detail-kesan-author {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 24px;
        display: block;
    }

    /* ghost big number inside kesan */
    .detail-kesan-wrapper::after {
        content: '"';
        position: absolute;
        bottom: -30px;
        right: 20px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 180px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.08);
        line-height: 1;
        pointer-events: none;
        user-select: none;
    }

    /* ── Bottom Nav ── */
    .detail-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 40px;
        border-top: 1px solid #dce6f7;
    }

    .detail-nav-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }

    .detail-nav-back {
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #ffffff;
        background: #315399;
        padding: 14px 32px;
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: color 0.3s ease;
    }

    .detail-nav-back::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: #1e3d7a;
        transition: left 0.3s ease;
        z-index: 0;
    }

    .detail-nav-back:hover::before { left: 0; }
    .detail-nav-back span { position: relative; z-index: 1; }
</style>
@endpush

@section('content')

{{-- Scroll Progress --}}
<div id="scroll-progress"></div>

{{-- Blob accent --}}
<div class="detail-blob detail-blob-1"></div>
<div class="detail-blob detail-blob-2"></div>

<div class="detail-wrapper">

    {{-- Back --}}
    <a href="{{ route('profil') }}" class="back-link" data-aos="fade-right">
        <span class="back-arrow">←</span>
        Kembali ke Profil
    </a>

    {{-- Header --}}
    <div class="detail-header" data-aos="fade-up">
        <h1 class="detail-title">
            <span class="title-line"><span class="title-line-inner">{{ $item['judul'] }}</span></span>
        </h1>
        <div class="detail-meta">
            <span class="detail-waktu">{{ $item['waktu'] }}</span>
            <span class="detail-tag">Pengalaman Kuliah</span>
            <span class="detail-read-time" id="read-time">~ menghitung...</span>
        </div>
    </div>

    {{-- Image with parallax --}}
    <div class="detail-image-wrapper" data-aos="fade-up" data-aos-delay="100">
        <div class="detail-image-bg"></div>
        <span class="detail-image-num">DOKUMENTASI / {{ strtoupper($item['waktu']) }}</span>
        <div class="detail-image-clip">
            <img
                src="{{ $item['foto'] }}"
                alt="Dokumentasi {{ $item['judul'] }}"
                class="detail-image"
                id="parallax-img"
            >
        </div>
    </div>

    {{-- Body --}}
    <div class="detail-body">

        {{-- Deskripsi --}}
        <div data-aos="fade-right" data-aos-delay="150">
            <span class="detail-section-label">— Tentang Kegiatan</span>
            <p class="detail-deskripsi" id="deskripsi-text">{{ $item['deskripsi'] }}</p>
        </div>

        {{-- Kesan — dramatic dark --}}
        <div data-aos="fade-left" data-aos-delay="200">
            <span class="detail-section-label">— Kesan & Pesan</span>
            <div class="detail-kesan-wrapper">
                <span class="detail-kesan-quote">"</span>
                <p class="detail-kesan">{{ $item['kesan'] }}</p>
                <span class="detail-kesan-author">— {{ $item['nama'] ?? 'Zavier Putra Nata Ghani' }}</span>
            </div>
        </div>

    </div>

    {{-- Bottom Nav --}}
    <div class="detail-nav" data-aos="fade-up">
        <span class="detail-nav-label">ZPNG — Portfolio</span>
        <a href="{{ route('profil') }}#pengalaman" class="detail-nav-back">
            <span>← Lihat Semua Pengalaman</span>
        </a>
    </div>

</div>

@endsection

@push('scripts')
<script>
    // ── Scroll progress bar ──
    const progressBar = document.getElementById('scroll-progress');
    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = pct + '%';
    });

    // ── Parallax image on scroll ──
    const parallaxImg = document.getElementById('parallax-img');
    if (parallaxImg) {
        window.addEventListener('scroll', () => {
            const wrapper = parallaxImg.closest('.detail-image-wrapper');
            const rect = wrapper.getBoundingClientRect();
            const viewH = window.innerHeight;
            if (rect.bottom > 0 && rect.top < viewH) {
                const progress = (viewH - rect.top) / (viewH + rect.height);
                const offset = (progress - 0.5) * 60;
                parallaxImg.style.transform = `translateY(${offset}px)`;
            }
        }, { passive: true });
    }

    // ── Reading time estimate ──
    const deskripsiEl = document.getElementById('deskripsi-text');
    const readTimeEl  = document.getElementById('read-time');
    if (deskripsiEl && readTimeEl) {
        const words = deskripsiEl.textContent.trim().split(/\s+/).length;
        const minutes = Math.max(1, Math.round(words / 200));
        readTimeEl.textContent = `~ ${minutes} min read`;
    }
</script>
@endpush