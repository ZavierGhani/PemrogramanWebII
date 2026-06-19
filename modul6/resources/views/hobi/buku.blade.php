@extends('layouts.app')

@section('title', 'Buku — Zavier')

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
    .buku-blob {
        position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgba(13, 61, 156, 0.7);
        filter: blur(56px);
    }
    .buku-blob-2 {
        width: 260px; height: 240px;
        bottom: -5%; left: -80px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: bBlob2 11s ease-in-out infinite alternate;
        opacity: 0.55;
    }
    @keyframes bBlob2 {
       0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-10deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.8) rotate(8deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-10deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    }

    /* ── Wrapper ── */
    .buku-wrapper {
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
    .buku-hero {
        margin-bottom: 100px;
        position: relative;
    }

    .buku-hero-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-bottom: 16px;
        display: block;
    }

    .buku-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(72px, 10vw, 130px);
        font-weight: 600;
        line-height: 0.9;
        color: #1a2540;
        letter-spacing: -0.02em;
    }

    .buku-hero-title em {
        font-style: italic;
        color: #315399;
    }

    .buku-hero-sub {
        font-family: 'Outfit', sans-serif;
        font-size: 17px;
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

    /* ── Book Grid ── */
    .buku-grid {
        display: grid;
        grid-template-columns: 1fr 1.4fr;
        gap: 72px;
        align-items: start;
        padding: 80px 0 40px;
    }

    .buku-grid.reverse { direction: rtl; }
    .buku-grid.reverse > * { direction: ltr; }

    /* ── Cover ── */
    .buku-cover-wrapper {
        position: relative;
        max-width: 280px;
    }

    .buku-cover-bg {
        position: absolute;
        top: 16px; left: 16px;
        width: 100%; height: 100%;
        border: 2px solid #dce6f7;
        z-index: 0;
        transition: transform 0.4s ease;
    }

    .buku-cover-wrapper:hover .buku-cover-bg {
        transform: translate(5px, 5px);
    }

    .buku-cover {
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        object-fit: cover;
        z-index: 1;
        display: block;
        filter: grayscale(15%);
        transition: filter 0.5s ease, transform 0.4s ease;
        box-shadow: 8px 8px 32px rgba(26, 37, 64, 0.15);
    }

    .buku-cover-wrapper:hover .buku-cover {
        filter: grayscale(0%);
        transform: translateY(-4px);
    }

    /* page count accent */
    .buku-cover-tag {
        position: absolute;
        bottom: -12px;
        left: 20px;
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        background: #f4f7ff;
        padding: 4px 10px;
        border: 1px solid #dce6f7;
        z-index: 2;
    }

    /* ── Info ── */
    .buku-info { padding-top: 16px; }

    .buku-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
        margin-bottom: 20px;
        display: block;
    }

    .buku-judul {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(32px, 3.5vw, 48px);
        font-weight: 600;
        color: #1a2540;
        line-height: 1.1;
        letter-spacing: -0.01em;
        margin-bottom: 6px;
    }

    .buku-penulis {
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 300;
        color: #6b87c4;
        margin-bottom: 20px;
        display: block;
    }

    .buku-meta-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .buku-tahun {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
    }

    .buku-genre-tag {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #315399;
        border: 1px solid rgba(49, 83, 153, 0.3);
        padding: 3px 10px;
        letter-spacing: 0.1em;
    }

    /* rekomendasi badge */
    .buku-rekomendasi {
        display: inline-block;
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 5px 14px;
        margin-bottom: 24px;
    }

    .buku-rekomendasi.must-read {
        background: #1a2540;
        color: #f4f7ff;
        border: 1px solid #1a2540;
    }

    .buku-rekomendasi.good {
        background: transparent;
        color: #315399;
        border: 1px solid #315399;
    }

    .buku-rekomendasi.optional {
        background: transparent;
        color: #6b87c4;
        border: 1px solid #dce6f7;
    }

    .buku-ulasan {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 300;
        color: #1a2540;
        line-height: 1.8;
    }

    /* ── Pull Quote — full width, centered ── */
    .buku-pullquote {
        padding: 48px 80px;
        text-align: center;
        position: relative;
        margin-bottom: 0;
    }

    .buku-pullquote::before,
    .buku-pullquote::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 1px;
        background: #dce6f7;
    }

    .buku-pullquote::before { top: 0; }
    .buku-pullquote::after  { bottom: 0; }

    .buku-pullquote-mark {
        font-family: 'Cormorant Garamond', serif;
        font-size: 80px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.15);
        line-height: 0.5;
        display: block;
        margin-bottom: 16px;
        user-select: none;
    }

    .buku-pullquote-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(22px, 3vw, 32px);
        font-style: italic;
        color: #1a2540;
        line-height: 1.5;
        max-width: 720px;
        margin: 0 auto 20px;
        letter-spacing: -0.01em;
    }

    .buku-pullquote-source {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.25em;
        text-transform: uppercase;
    }

    /* ── Divider ── */
    .buku-divider {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-top: 48px;
    }

    .buku-divider-line {
        flex: 1;
        height: 1px;
        background: #dce6f7;
    }

    .buku-divider-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
    }
</style>
@endpush

@section('content')

<div id="scroll-progress"></div>
<div class="buku-blob buku-blob-1"></div>
<div class="buku-blob buku-blob-2"></div>

<div class="buku-wrapper">

    {{-- Back --}}
    <a href="{{ route('profil') }}" class="back-link" data-aos="fade-right">
        <span class="back-arrow">←</span>
        Kembali ke Profil
    </a>

    {{-- Hero --}}
    <div class="buku-hero" data-aos="fade-up">
        <span class="buku-hero-label"><em class="hobi-emoji"><i class="fa-solid fa-book-open" style="color: rgb(52, 87, 150); font-size: 17px;"></i></em> Hobi / Buku</span>
        <h1 class="buku-hero-title">
            Membaca<br><em>Buku</em>
        </h1>
        <p class="buku-hero-sub">
            Three books I can't recommend to just anyone — because some books need to find you themselves,
            at exactly the right moment.
        </p>

        {{-- Editorial tags --}}
        <div class="etag t1">[ Fiction / Non-Fiction ]</div>
        <div class="etag t2">— Page Turner</div>
        <div class="etag t3">[ Must Read ]</div>
    </div>

    {{-- Buku list --}}
    @foreach($buku as $index => $b)

        <div data-aos="fade-up" data-aos-delay="100">

            {{-- Grid: cover + info --}}
            <div class="buku-grid {{ $index % 2 !== 0 ? 'reverse' : '' }}">

                {{-- Cover --}}
                <div>
                    <div class="buku-cover-wrapper">
                        <div class="buku-cover-bg"></div>
                        <img
                            src="{{ asset($b['cover']) }}"
                            alt="Cover {{ $b['judul'] }}"
                            class="buku-cover"
                        >
                        <span class="buku-cover-tag">Dibaca {{ $b['tahun_baca'] }}</span>
                    </div>
                </div>

                {{-- Info --}}
                <div class="buku-info">
                    <span class="buku-num">0{{ $index + 1 }} / 03</span>

                    <h2 class="buku-judul">{{ $b['judul'] }}</h2>
                    <span class="buku-penulis">— {{ $b['penulis'] }}</span>

                    <div class="buku-meta-row">
                        @foreach($b['genre'] as $g)
                            <span class="buku-genre-tag">{{ $g }}</span>
                        @endforeach
                    </div>

                    <span class="buku-rekomendasi {{ $b['rekomendasi'] }}">
                        @if($b['rekomendasi'] === 'must-read') ★ Must Read
                        @elseif($b['rekomendasi'] === 'good') ✓ Good Read
                        @else ○ Optional
                        @endif
                    </span>

                    <p class="buku-ulasan">{{ $b['ulasan'] }}</p>
                </div>

            </div>

            {{-- Pull quote — full width --}}
            <div class="buku-pullquote" data-aos="fade-up" data-aos-delay="150">
                <span class="buku-pullquote-mark">"</span>
                <p class="buku-pullquote-text">{{ $b['kutipan'] }}</p>
                <span class="buku-pullquote-source">— {{ $b['penulis'] }}, {{ $b['judul'] }}</span>
            </div>

        </div>

        {{-- Divider --}}
        @if($index < count($buku) - 1)
        <div class="buku-divider" data-aos="fade-up">
            <div class="buku-divider-line"></div>
            <span class="buku-divider-num">— 0{{ $index + 2 }} —</span>
            <div class="buku-divider-line"></div>
        </div>
        @endif

    @endforeach

</div>

@endsection

@push('scripts')
<script>
    const bar = document.getElementById('scroll-progress');
    window.addEventListener('scroll', () => {
        const pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
        bar.style.width = pct + '%';
    });
</script>
@endpush