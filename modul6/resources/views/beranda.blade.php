@extends('layouts.app')

@section('title', 'Beranda — Zavier Putra Nata Ghani')

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

    /* ── Hero ── */
    .hero-section {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 0 48px;
        position: relative;
        overflow: hidden;
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-top: 120px;
        padding-bottom: 80px;
        padding-right: 60px;
        position: relative;
        z-index: 2;
    }

    .hero-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(64px, 8vw, 110px);
        font-weight: 600;
        line-height: 0.95;
        color: #1a2540;
        letter-spacing: -0.02em;
    }

    .hero-name em {
        font-style: italic;
        color: #315399;
    }

    .hero-nim {
        font-family: 'Space Mono', monospace;
        font-size: 13px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        margin-top: 28px;
    }

    .hero-desc {
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 300;
        color: #6b87c4;
        line-height: 1.7;
        margin-top: 20px;
        max-width: 380px;
    }

    .hero-cta {
        margin-top: 48px;
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .btn-primary {
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.05em;
        color: #ffffff;
        background: #315399;
        padding: 14px 32px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: #1e3d7a;
        transition: left 0.3s ease;
        z-index: 0;
    }

    .btn-primary:hover::before { left: 0; }
    .btn-primary span { position: relative; z-index: 1; }

    .btn-secondary {
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        color: #315399;
        text-decoration: none;
        letter-spacing: 0.1em;
        border-bottom: 1px solid #dce6f7;
        padding-bottom: 2px;
        transition: border-color 0.3s ease;
    }

    .btn-secondary:hover { border-color: #315399; }

    /* ── Hero Right ── */
    .hero-right {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 120px;
        position: relative;
        z-index: 2;
    }

    .hero-image-wrapper {
        position: relative;
        width: 300px;
        height: 360px;
        flex-shrink: 0;
        transition: transform 0.5s ease;
    }

    .hero-image-wrapper:hover {
        transform: translateY(-6px);
    }

    .hero-image-bg {
        position: absolute;
        top: 16px;
        left: 16px;
        width: 100%;
        height: 100%;
        border: 2px solid #315399;
        z-index: 0;
        transition: transform 0.5s ease;
    }

    .hero-image-wrapper:hover .hero-image-bg {
        transform: translate(4px, 4px);
    }

    .hero-image {
        position: relative;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        filter: grayscale(20%);
        display: block;
        transition: filter 0.5s ease;
    }

    .hero-image-wrapper:hover .hero-image {
        filter: grayscale(0%);
    }

    .hero-image-label {
        position: absolute;
        bottom: -28px;
        right: 0;
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .hero-deco-number {
        position: absolute;
        top: -20px;
        left: 0;
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #245ab7;
        letter-spacing: 0.3em;
    }

    /* ── Stats ── */
    .hero-stats {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #dce6f7;
        display: flex;
        gap: 48px;
    }

    .stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px;
        font-weight: 600;
        color: #315399;
        line-height: 1;
    }

    .stat-label {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 6px;
    }

    /* ── Letter animation ── */
    .char {
        display: inline-block;
        opacity: 0;
        transform: translateY(40px) rotate(3deg);
        animation: charIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    @keyframes charIn {
        to { opacity: 1; transform: translateY(0) rotate(0deg); }
    }

    /* ── Highlight stab ── */
    .highlight-stab {
        position: relative;
        display: inline;
        z-index: 1;
    }

    .highlight-stab::before {
        content: '';
        position: absolute;
        bottom: 2px;
        left: -4px;
        right: -4px;
        height: 10px;
        background: rgba(49, 83, 153, 0.1);
        border-radius: 2px;
        z-index: -1;
    }

    /* ── Scroll indicator ── */
    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 48px;
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 2;
    }

    .scroll-line {
        width: 40px;
        height: 1px;
        background: #dce6f7;
        position: relative;
        overflow: hidden;
    }

    .scroll-line::after {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: #315399;
        animation: scrollLine 2s ease infinite;
    }

    @keyframes scrollLine {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .scroll-text {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }

    /* ── Vertical text ── */
    .hero-vertical-text {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
    }

    /* ── Decorative base ── */
    .deco-circle {
        position: absolute;
        border-radius: 50%;
        border: 1.5px solid rgba(49, 83, 153, 0.12);
        pointer-events: none;
    }

    .deco-big-num {
        position: absolute;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.05);
        line-height: 1;
        pointer-events: none;
        user-select: none;
    }

    .deco-thick-border {
        position: absolute;
        border: 3px solid rgba(49, 83, 153, 0.1);
        pointer-events: none;
    }

    /* ══════════════════════════════════════
       OPSI B — Morphing Blob Accent
    ══════════════════════════════════════ */
    .blob {
        position: absolute;
        pointer-events: none;
        z-index: 0;
        background: rgb(8, 26, 128);
        filter: blur(48px);
        animation: blobMorph 15s ease-in-out infinite alternate;
    }

.blob-1 {
    width: 560px;
    height: 520px;
    top: 10%;
    right: -130px;
    transform: translateY(-50%);
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    animation: blobMorph1 15s ease-in-out infinite;
    opacity: 0.47;
    
}

.blob-2 {
    width: 320px;
    height: 300px;
    bottom: 0px;
    left: -40px;
    border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
    animation: blobMorph2 7s ease-in-out infinite;
    opacity: 0.17;
}

@keyframes blobMorph1 {
    0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform: translateY(-50%) scale(1) rotate(0deg); }
    20%  { border-radius: 20% 80% 70% 30% / 80% 10% 90% 20%; transform: translateY(-50%) scale(1.5) rotate(15deg); }
    40%  { border-radius: 90% 10% 20% 80% / 20% 90% 10% 80%; transform: translateY(-50%) scale(0.7) rotate(-10deg); }
    60%  { border-radius: 10% 90% 80% 20% / 60% 20% 80% 40%; transform: translateY(-50%) scale(1.4) rotate(20deg); }
    80%  { border-radius: 80% 20% 10% 90% / 10% 80% 30% 70%; transform: translateY(-50%) scale(0.8) rotate(-5deg); }
    100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform: translateY(-50%) scale(1) rotate(0deg); }
}

@keyframes blobMorph2 {
    0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-20deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.65) rotate(12deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-15deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
}

    /* ══════════════════════════════════════
       OPSI C — Scattered Editorial Tags
    ══════════════════════════════════════ */
    .etag {
        position: absolute;
        font-family: 'Space Mono', monospace;
        font-size: 9.5px;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: #315399;
        border: 1px solid rgba(49, 83, 153, 0.25);
        padding: 5px 12px;
        background: rgba(244, 247, 255, 0.7);
        backdrop-filter: blur(4px);
        pointer-events: none;
        opacity: 0;
        white-space: nowrap;
        z-index: 3;
        transition: opacity 0.3s ease;
    }

    /* stagger in */
    .etag.t1 { animation: tagIn 0.6s ease forwards 1.0s; }
    .etag.t2 { animation: tagIn 0.6s ease forwards 1.3s; }
    .etag.t3 { animation: tagIn 0.6s ease forwards 1.6s; }
    .etag.t4 { animation: tagIn 0.6s ease forwards 1.9s; }
    .etag.t5 { animation: tagIn 0.6s ease forwards 2.1s; }
    .etag.t6 { animation: tagIn 0.6s ease forwards 2.4s; }

    @keyframes tagIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* positions */
    .etag.t1 { top: 14%;  left: 52%;  transform: rotate(-2deg); }
    .etag.t2 { top: 22%;  right: 6%;  transform: rotate(1.5deg); }
    .etag.t3 { top: 60%;  right: 4%;  transform: rotate(-1deg); }
    .etag.t4 { bottom: 22%; left: 55%; transform: rotate(2deg); }
    .etag.t5 { top: 38%;  left: 49%;  transform: rotate(-0.5deg); }
    .etag.t6 { bottom: 14%; right: 8%; transform: rotate(1deg); }

    /* float */
    .etag.t1 { animation: tagIn 0.6s ease forwards 1.0s, tagFloat1 6s ease-in-out 2s infinite; }
    .etag.t2 { animation: tagIn 0.6s ease forwards 1.3s, tagFloat2 7s ease-in-out 2.3s infinite; }
    .etag.t3 { animation: tagIn 0.6s ease forwards 1.6s, tagFloat1 5s ease-in-out 2.6s infinite; }
    .etag.t4 { animation: tagIn 0.6s ease forwards 1.9s, tagFloat2 8s ease-in-out 2.9s infinite; }
    .etag.t5 { animation: tagIn 0.6s ease forwards 2.1s, tagFloat1 6.5s ease-in-out 3.1s infinite; }
    .etag.t6 { animation: tagIn 0.6s ease forwards 2.4s, tagFloat2 7.5s ease-in-out 3.4s infinite; }

    @keyframes tagFloat1 {
        0%, 100% { transform: translateY(0) rotate(-2deg); }
        50%       { transform: translateY(-15px) rotate(-1deg); }
    }
    @keyframes tagFloat2 {
        0%, 100% { transform: translateY(0) rotate(1.5deg); }
        50%       { transform: translateY(-17px) rotate(2.5deg); }
    }
</style>
@endpush

@section('content')

{{-- Scroll Progress --}}
<div id="scroll-progress"></div>

<section class="hero-section">

    {{-- ── OPSI B: Morphing Blob Accent ── --}}
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    {{-- ── OPSI C: Scattered Editorial Tags ── --}}
    <div class="etag t1">— Sineas</div>
    <div class="etag t2">[ TI · ULM  ]</div>
    <div class="etag t3">Portfolio 2026</div>
    <div class="etag t4">— Coder</div>
    <div class="etag t5">Storyteller</div>
    <div class="etag t6">[ Reader · Music ]</div>

    {{-- Existing decorative elements --}}
    <div class="deco-circle" style="width: 500px; height: 500px; right: -100px; top: 50%; transform: translateY(-50%);"></div>
    <div class="deco-circle" style="width: 300px; height: 300px; right: 0px; top: 50%; transform: translateY(-50%); opacity: 0.6;"></div>
    <div class="deco-big-num" style="font-size: 280px; right: 40px; bottom: -40px;">01</div>
    <div class="deco-thick-border" style="width: 80px; height: 80px; top: 130px; left: 200px; transform: rotate(12deg);"></div>

    {{-- Left --}}
    <div class="hero-left">

        <div data-aos="fade-up" data-aos-delay="100">
            <span class="section-label">— Mahasiswa Teknologi Informasi</span>
        </div>

        <h1 class="hero-name" id="hero-name">
            <span id="name-line-1">Zavier</span><br>
            <span id="name-line-2">Putra</span><br>
            <em><span class="highlight-stab"><span id="name-line-3">Nataghani</span></span></em>
        </h1>

        <p class="hero-nim" data-aos="fade-up" data-aos-delay="350">
            {{ $profil['nim'] }}
        </p>

        <p class="hero-desc" data-aos="fade-up" data-aos-delay="400">
            Mahasiswa TI yang suka ngulik hal-hal baru  ○○○ <br>
            dari baris kode sampai beragam karya favorit.
        </p>

      <div class="hero-cta" data-aos="fade-up" data-aos-delay="500">
    <a href="{{ route('profil') }}" class="btn-primary">
        <span>Lihat Profil →</span>
    </a>
    <a href="{{ route('profil') }}#pengalaman" class="btn-secondary">Pengalaman</a>
</div>
        <div class="hero-stats" data-aos="fade-up" data-aos-delay="600">
            <div class="stat-item">
                <div class="stat-number" data-count="4">0</div>
                <div class="stat-label">Pengalaman</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="8">0</div>
                <div class="stat-label">Skill</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" data-count="2024">0</div>
                <div class="stat-label">Angkatan</div>
            </div>
        </div>

    </div>

    {{-- Right --}}
    <div class="hero-right" data-aos="fade-left" data-aos-delay="300">
        <div class="hero-image-wrapper">
            <div class="hero-image-bg"></div>
            <img
            src="{{ asset('images/Zavier.jpeg') }}"
            alt="Foto {{ $profil['nama'] }}"
            class="hero-image"
        >
            <span class="hero-image-label">{{ $profil['nama'] }}</span>
            <span class="hero-deco-number">001 / PORTFOLIO</span>
        </div>
    </div>

    {{-- Vertical text --}}
    <div class="hero-vertical-text">
        <span class="vertical-text">Teknologi Informasi — 2024</span>
    </div>

    {{-- Scroll indicator --}}
    <div class="scroll-indicator">
        <div class="scroll-line"></div>
        <span class="scroll-text">Scroll</span>
    </div>

</section>

@endsection

@push('scripts')
<script>
    // ── Letter-by-letter animation ──
    function splitAndAnimate(elementId, baseDelay = 200) {
        const el = document.getElementById(elementId);
        if (!el) return;
        const text = el.textContent;
        el.innerHTML = '';
        [...text].forEach((char, i) => {
            const span = document.createElement('span');
            span.className = 'char';
            span.textContent = char === ' ' ? '\u00A0' : char;
            span.style.animationDelay = `${baseDelay + i * 45}ms`;
            el.appendChild(span);
        });
    }

    splitAndAnimate('name-line-1', 200);
    splitAndAnimate('name-line-2', 420);
    splitAndAnimate('name-line-3', 620);

    // ── Stats counter ──
    function animateCounter(el, target, duration = 1400) {
        const isYear = target > 100;
        const start = isYear ? target - 80 : 0;
        const startTime = performance.now();
        function update(now) {
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(start + (target - start) * eased);
            el.textContent = current;
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                document.querySelectorAll('.stat-number[data-count]').forEach(el => {
                    animateCounter(el, parseInt(el.dataset.count));
                });
                statsObserver.disconnect();
            }
        });
    }, { threshold: 0.5 });

    const statsEl = document.querySelector('.hero-stats');
    if (statsEl) statsObserver.observe(statsEl);

    // ── Scroll progress bar ──
    const progressBar = document.getElementById('scroll-progress');
    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        progressBar.style.width = pct + '%';
    });
</script>
@endpush