@extends('layouts.app')

@section('title', 'Olahraga — Zavier')

@push('styles')
<style>
    html, body { overflow-x: hidden; }

    /* ── Scroll Progress ── */
    #scroll-progress {
        position: fixed;
        top: 0; left: 0;
        height: 2px;
        width: 0%;
        background: linear-gradient(90deg, #315399, #6b87c4);
        z-index: 9999;
        transition: width 0.1s linear;
    }

    /* ── Blob ── */
    .ola-blob {
       position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgba(13, 61, 156, 0.7);
        filter: blur(56px);
    }
    .ola-blob-2 {
        width: 260px; height: 240px;
        bottom: -5%; left: -80px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: oBlob2 11s ease-in-out infinite alternate;
        opacity: 0.55;
    }
    @keyframes oBlob2 {
       0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-10deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.8) rotate(8deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-10deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    }

    /* ── Wrapper ── */
    .ola-wrapper {
        padding-top: 140px;
        padding-bottom: 120px;
        padding-left: 48px;
        padding-right: 48px;
        max-width: 1100px;
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
    .back-link:hover { color: #315399; gap: 16px; }
    .back-link:hover .back-arrow { transform: translateX(-5px); }
    .back-arrow { display: inline-block; transition: transform 0.3s ease; font-size: 14px; }

    /* ── Hero ── */
    .ola-hero {
        margin-bottom: 80px;
        position: relative;
    }

    .ola-hero-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-bottom: 16px;
        display: block;
    }

    .ola-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(72px, 10vw, 130px);
        font-weight: 600;
        line-height: 0.9;
        color: #1a2540;
        letter-spacing: -0.02em;
    }

    .ola-hero-title em {
        font-style: italic;
        color: #315399;
    }

    .ola-hero-sub {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 300;
        color: #6b87c4;
        margin-top: 24px;
        max-width: 400px;
        line-height: 1.7;
    }

    /* editorial tags */
    .etag {
        position: absolute;
        font-family: 'Space Mono', monospace;
        font-size: 12px;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #315399;
        border: 1px solid rgba(49, 83, 153, 0.25);
        padding: 5px 12px;
        background: rgba(244, 247, 255, 0.8);
        backdrop-filter: blur(4px);
        pointer-events: none;
        white-space: nowrap;
        opacity: 0;
    }
    .etag.t1 { top: 10%;  right: 5%;   transform: rotate(-2deg);  animation: tagIn 0.6s ease forwards 0.4s, tagFloat1 6s ease-in-out 1.4s infinite; }
    .etag.t2 { top: 52%;  right: 2%;   transform: rotate(1.5deg); animation: tagIn 0.6s ease forwards 0.7s, tagFloat2 7s ease-in-out 1.7s infinite; }
    .etag.t3 { bottom: 5%; right: 12%; transform: rotate(-1deg);  animation: tagIn 0.6s ease forwards 1.0s, tagFloat1 8s ease-in-out 2.0s infinite; }

    @keyframes tagIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes tagFloat1 {
        0%, 100% { transform: translateY(0) rotate(-2deg); }
        50%       { transform: translateY(-30px) rotate(-1deg); }
    }
    @keyframes tagFloat2 {
        0%, 100% { transform: translateY(0) rotate(1.5deg); }
        50%       { transform: translateY(-42px) rotate(2.5deg); }
    }

    /* ── Opening Quote ── */
    .ola-opening-quote {
        text-align: center;
        padding: 64px 80px;
        margin-bottom: 100px;
        border-top: 1px solid #dce6f7;
        border-bottom: 1px solid #dce6f7;
        position: relative;
    }

    .ola-opening-quote-mark {
        font-family: 'Cormorant Garamond', serif;
        font-size: 100px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.12);
        line-height: 0.5;
        display: block;
        margin-bottom: 20px;
        user-select: none;
    }

    .ola-opening-quote-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(28px, 4vw, 44px);
        font-style: italic;
        color: #1a2540;
        line-height: 1.4;
        letter-spacing: -0.01em;
    }

    /* ── Section label ── */
    .ola-section-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 40px;
    }

    .ola-section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px;
        font-weight: 600;
        color: #1a2540;
        white-space: nowrap;
    }

    .ola-section-line {
        flex: 1;
        height: 1px;
        background: #dce6f7;
    }

    .ola-section-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
    }

    /* ── Jenis Olahraga Cards ── */
    .ola-jenis-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2px;
        background: #dce6f7;
        margin-bottom: 100px;
    }

    .ola-jenis-card {
        background: #ffffff;
        padding: 40px 32px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        cursor: default;
    }

    .ola-jenis-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 0; height: 3px;
        background: #315399;
        transition: width 0.4s ease;
    }

    .ola-jenis-card:hover::before { width: 100%; }

    .ola-jenis-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(49, 83, 153, 0.08);
        z-index: 2;
    }

    .ola-jenis-emoji {
        font-size: 40px;
        display: block;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .ola-jenis-card:hover .ola-jenis-emoji {
        transform: scale(1.15);
    }

    .ola-jenis-nama {
        font-family: 'Cormorant Garamond', serif;
        font-size: 28px;
        font-weight: 600;
        color: #1a2540;
        line-height: 1.1;
        margin-bottom: 8px;
        display: block;
        transition: color 0.3s ease;
    }

    .ola-jenis-card:hover .ola-jenis-nama { color: #315399; }

    .ola-jenis-frekuensi {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #315399;
        letter-spacing: 0.15em;
        margin-bottom: 16px;
        display: block;
        border: 1px solid rgba(49, 83, 153, 0.25);
        padding: 3px 10px;
        display: inline-block;
    }

    .ola-jenis-catatan {
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 300;
        color: #6b87c4;
        line-height: 1.6;
        margin-top: 12px;
        display: block;
    }

    /* ── Personal Records ── */
    .ola-pr-section {
        margin-bottom: 100px;
        background: #1a2540;
        padding: 64px 48px;
        position: relative;
        overflow: hidden;
    }

    /* shimmer top */
    .ola-pr-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #315399, #6b87c4, #315399);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* ghost big text */
    .ola-pr-section::after {
        content: 'PR';
        position: absolute;
        right: -20px; bottom: -40px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 240px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.08);
        line-height: 1;
        pointer-events: none;
        user-select: none;
    }

    .ola-pr-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 48px;
    }

    .ola-pr-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px;
        font-weight: 600;
        color: #f4f7ff;
        white-space: nowrap;
    }

    .ola-pr-line {
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.1);
    }

    .ola-pr-label-top {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
    }

    .ola-pr-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 48px;
        position: relative;
        z-index: 1;
    }

    .ola-pr-item {
        text-align: center;
    }

    .ola-pr-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(56px, 7vw, 88px);
        font-weight: 600;
        color: #f4f7ff;
        line-height: 1;
        display: block;
        letter-spacing: -0.02em;
    }

    .ola-pr-unit {
        font-family: 'Space Mono', monospace;
        font-size: 14px;
        color: #6b87c4;
    }

    .ola-pr-lift {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 12px;
        display: block;
        border-top: 1px solid rgba(255,255,255,0.08);
        padding-top: 12px;
    }

    /* ── Foto Gallery ── */
    .ola-gallery-section {
        margin-bottom: 0;
    }

    .ola-gallery-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        grid-template-rows: auto auto;
        gap: 4px;
    }

    .ola-gallery-item {
        overflow: hidden;
        position: relative;
    }

    .ola-gallery-item.main {
        grid-row: 1 / 3;
    }

    .ola-gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        filter: grayscale(30%);
        transition: filter 0.5s ease, transform 0.5s ease;
        min-height: 220px;
    }

    .ola-gallery-item.main .ola-gallery-img {
        min-height: 460px;
    }

    .ola-gallery-item:hover .ola-gallery-img {
        filter: grayscale(0%);
        transform: scale(1.03);
    }

    /* overlay label */
    .ola-gallery-overlay {
        position: absolute;
        bottom: 12px; left: 12px;
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: rgba(255,255,255,0.6);
        letter-spacing: 0.2em;
        text-transform: uppercase;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .ola-gallery-item:hover .ola-gallery-overlay {
        opacity: 1;
    }
</style>
@endpush

@section('content')

<div id="scroll-progress"></div>
<div class="ola-blob ola-blob-1"></div>
<div class="ola-blob ola-blob-2"></div>

<div class="ola-wrapper">

    {{-- Back --}}
    <a href="{{ route('profil') }}" class="back-link" data-aos="fade-right">
        <span class="back-arrow">←</span>
        Kembali ke Profil
    </a>

    {{-- Hero --}}
    <div class="ola-hero" data-aos="fade-up">
        <span class="ola-hero-label"><em class="hobi-emoji"><i class="fa-solid fa-dumbbell" style="color: rgb(52, 87, 150); font-size: 17px;"></i></em> Hobi / Olahraga</span>
        <h1 class="ola-hero-title">
            Berolahraga
        </h1>
        <p class="ola-hero-sub">{{ $olahraga['deskripsi'] }}</p>

        {{-- Editorial tags --}}
        <div class="etag t1">[ PR ]</div>
        <div class="etag t2">— Gains</div>
        <div class="etag t3">[ Consistent ]</div>
    </div>

    {{-- Opening Quote --}}
    <div class="ola-opening-quote" data-aos="fade-up">
        <span class="ola-opening-quote-mark">"</span>
        <p class="ola-opening-quote-text">{{ $olahraga['quote'] }}</p>
    </div>

    {{-- Jenis Olahraga --}}
    <div data-aos="fade-up">
        <div class="ola-section-header">
            <h2 class="ola-section-title">Rutinitas</h2>
            <div class="ola-section-line"></div>
            <span class="ola-section-num">0{{ count($olahraga['jenis']) }} JENIS</span>
        </div>

        <div class="ola-jenis-grid">
            @foreach($olahraga['jenis'] as $j)
            <div class="ola-jenis-card">
                <span class="ola-jenis-emoji">{{ $j['emoji'] }}</span>
                <span class="ola-jenis-nama">{{ $j['nama'] }}</span>
                <span class="ola-jenis-frekuensi">{{ $j['frekuensi'] }}</span>
                <span class="ola-jenis-catatan">{{ $j['catatan'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Personal Records --}}
    <div class="ola-pr-section" data-aos="fade-up">
        <div class="ola-pr-header">
            <h2 class="ola-pr-title">Personal Records</h2>
            <div class="ola-pr-line"></div>
            <span class="ola-pr-label-top">1 REP MAX</span>
        </div>

        <div class="ola-pr-grid" id="pr-grid">
            @foreach($olahraga['pr'] as $pr)
            @php
                preg_match('/(\d+)/', $pr['record'], $matches);
                $num = $matches[1] ?? 0;
                $unit = preg_replace('/\d+/', '', $pr['record']);
            @endphp
            <div class="ola-pr-item">
                <span class="ola-pr-num">
                    <span class="pr-counter" data-target="{{ $num }}">0</span><span class="ola-pr-unit">{{ trim($unit) }}</span>
                </span>
                <span class="ola-pr-lift">{{ $pr['lift'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Foto Gallery --}}
    <div data-aos="fade-up">
        <div class="ola-section-header" style="margin-bottom: 16px;">
            <h2 class="ola-section-title">Dokumentasi</h2>
            <div class="ola-section-line"></div>
            <span class="ola-section-num">GYM LIFE</span>
        </div>

        <div class="ola-gallery-grid">
            @foreach($olahraga['foto'] as $i => $foto)
            <div class="ola-gallery-item {{ $i === 0 ? 'main' : '' }}">
                <img
                    src="{{ asset($foto) }}"
                    alt="Foto gym {{ $i + 1 }}"
                    class="ola-gallery-img"
                >
                <span class="ola-gallery-overlay">{{ $i === 0 ? 'Main Session' : 'Session 0' . ($i + 1) }}</span>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Scroll progress
    const bar = document.getElementById('scroll-progress');
    window.addEventListener('scroll', () => {
        const pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
        bar.style.width = pct + '%';
    });

    // PR counter animation
    function animateCounter(el, target, duration = 1400) {
        const start = Math.max(0, target - 60);
        const startTime = performance.now();
        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(start + (target - start) * eased);
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    const prGrid = document.getElementById('pr-grid');
    if (prGrid) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                document.querySelectorAll('.pr-counter').forEach(el => {
                    animateCounter(el, parseInt(el.dataset.target));
                });
                observer.disconnect();
            }
        }, { threshold: 0.4 });
        observer.observe(prGrid);
    }
</script>
@endpush