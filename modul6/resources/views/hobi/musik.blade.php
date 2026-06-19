@extends('layouts.app')

@section('title', 'Musik — Zavier')

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
    .musik-blob {
         position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgba(13, 61, 156, 0.7);
        filter: blur(56px);
    }
    .musik-blob-2 {
         width: 260px; height: 240px;
        bottom: -5%; left: -80px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: mBlob2 11s ease-in-out infinite alternate;
        opacity: 0.55;
    }
    @keyframes mBlob2 {
        0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-10deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.8) rotate(8deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-10deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    }

    /* ── Wrapper ── */
    .musik-wrapper {
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
    .musik-hero {
        margin-bottom: 100px;
        position: relative;
    }

    .musik-hero-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-bottom: 16px;
        display: block;
    }

    .musik-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(72px, 10vw, 130px);
        font-weight: 600;
        line-height: 0.9;
        color: #1a2540;
        letter-spacing: -0.02em;
    }

    .musik-hero-title em {
        font-style: italic;
        color: #315399;
    }

    .musik-hero-sub {
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

    /* ── Album Grid ── */
    .album-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 72px;
        align-items: start;
        padding: 80px 0;
    }

    .album-grid.reverse { direction: rtl; }
    .album-grid.reverse > * { direction: ltr; }

    /* ── Artwork ── */
    .album-artwork-wrapper {
        position: relative;
        max-width: 420px;
    }



    .album-artwork-wrapper:hover .album-artwork-bg {
        transform: translate(5px, 5px);
    }

    .album-artwork {
        position: relative;
        width: 200%;
        aspect-ratio: 1/1;
        object-fit: cover;
        z-index: 1;
        display: block;
        transition: transform 0.4s ease;
    }

    .album-artwork-wrapper:hover .album-artwork {
        transform: translateY(-4px);
    }

    /* spinning vinyl accent on hover */
    .album-vinyl {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        background: #1a2540;
        border-radius: 50%;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.4s ease;
    }

    .album-artwork-wrapper:hover .album-vinyl {
        animation: spinVinyl 3s linear infinite;
    }

    @keyframes spinVinyl {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    .album-vinyl::before {
        content: '';
        width: 20px; height: 20px;
        background: #f4f7ff;
        border-radius: 50%;
        position: absolute;
    }

    .album-vinyl::after {
        content: '';
        width: 6px; height: 6px;
        background: #1a2540;
        border-radius: 50%;
        position: absolute;
        z-index: 1;
    }

    /* ── Info ── */
    .album-info { padding-top: 16px; }

    .album-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
        margin-bottom: 20px;
        display: block;
    }

    .album-judul {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(36px, 4vw, 52px);
        font-weight: 600;
        color: #1a2540;
        line-height: 1.05;
        letter-spacing: -0.01em;
        margin-bottom: 4px;
    }

    .album-artis {
        font-family: 'Outfit', sans-serif;
        font-size: 14px;
        font-weight: 300;
        color: #6b87c4;
        margin-bottom: 16px;
        display: block;
    }

    .album-meta-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .album-tahun {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
    }

    /* genre tags — biru outline */
    .album-genre-tag {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #315399;
        border: 1px solid rgba(49, 83, 153, 0.3);
        padding: 3px 10px;
        letter-spacing: 0.1em;
    }

    /* mood tags — filled muted */
    .album-mood-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .album-mood-tag {
        font-family: 'Outfit', sans-serif;
        font-size: 11px;
        color: #6b87c4;
        background: rgba(49, 83, 153, 0.06);
        padding: 4px 12px;
        border-radius: 0;
        letter-spacing: 0.05em;
    }

    /* lirik favorit — dark box dramatic */
    .album-lirik {
        background: #1a2540;
        padding: 24px 28px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }

    .album-lirik::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, #315399, #6b87c4, #315399);
        background-size: 200% 100%;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0%   { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .album-lirik-quote {
        font-family: 'Cormorant Garamond', serif;
        font-size: 60px;
        font-weight: 700;
        color: rgba(49, 83, 153, 0.3);
        line-height: 0.6;
        margin-bottom: 12px;
        display: block;
        user-select: none;
    }

    .album-lirik-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-style: italic;
        color: #f4f7ff;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }

    .album-ulasan {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 300;
        color: #1a2540;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    /* ── Spotify embed ── */
    .album-spotify-label {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
    }

    .album-spotify-wrapper {
        border: 1px solid #dce6f7;
        overflow: hidden;
        transition: border-color 0.3s ease;
    }

    .album-spotify-wrapper:hover {
        border-color: #315399;
    }

    .album-spotify-wrapper iframe {
        display: block;
        width: 100%;
        border: none;
    }

    /* ── Divider ── */
    .musik-divider {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .musik-divider-line {
        flex: 1;
        height: 1px;
        background: #dce6f7;
    }

    .musik-divider-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
    }
</style>
@endpush

@section('content')

<div id="scroll-progress"></div>
<div class="musik-blob musik-blob-1"></div>
<div class="musik-blob musik-blob-2"></div>

<div class="musik-wrapper">

    {{-- Back --}}
    <a href="{{ route('profil') }}" class="back-link" data-aos="fade-right">
        <span class="back-arrow">←</span>
        Kembali ke Profil
    </a>

    {{-- Hero --}}
    <div class="musik-hero" data-aos="fade-up">
        <span class="musik-hero-label"><em class="hobi-emoji"><i class="fa-brands fa-spotify" style="color: rgb(52, 87, 150); font-size: 17px;"></i></em> Hobi / Musik</span>
        <h1 class="musik-hero-title">
            Mengulik<br><em>Musik</em>
        </h1>
        <p class="musik-hero-sub">
            Three albums that live rent-free in my head,
            and honestly, I don't want them to leave.
        </p>

        {{-- Editorial tags --}}
        <div class="etag t1">[ Vinyl ]</div>
        <div class="etag t2">— Nostalgic </div>
        <div class="etag t3">[ Harmony ]</div>
    </div>

    {{-- Album list --}}
    @foreach($musik as $index => $m)

        <div data-aos="fade-up" data-aos-delay="100">
            <div class="album-grid {{ $index % 2 !== 0 ? 'reverse' : '' }}">

                {{-- Artwork --}}
                <div>
                    <div class="album-artwork-wrapper">
                        <div class="album-artwork-bg"></div>
                        <img
                            src="{{ asset($m['artwork']) }}"
                            alt="Artwork {{ $m['judul'] }}"
                            class="album-artwork"
                        >
                        <div class="album-vinyl"></div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="album-info">
                    <span class="album-num">0{{ $index + 1 }} / 03</span>

                    <h2 class="album-judul">{{ $m['judul'] }}</h2>
                    <span class="album-artis">{{ $m['artis'] }}</span>

                    <div class="album-meta-row">
                        <span class="album-tahun">{{ $m['tahun'] }}</span>
                        @foreach($m['genre'] as $g)
                            <span class="album-genre-tag">{{ $g }}</span>
                        @endforeach
                    </div>

                    <div class="album-mood-row">
                        @foreach($m['mood'] as $mood)
                            <span class="album-mood-tag">{{ $mood }}</span>
                        @endforeach
                    </div>

                    {{-- Lirik favorit --}}
                    <div class="album-lirik">
                        <span class="album-lirik-quote">"</span>
                        <p class="album-lirik-text">{{ $m['lirik_fav'] }}</p>
                    </div>

                    <p class="album-ulasan">{{ $m['ulasan'] }}</p>

                    {{-- Spotify embed --}}
                    <span class="album-spotify-label">— Dengarkan di Spotify</span>
                    <div class="album-spotify-wrapper">
                        <iframe
                            src="https://open.spotify.com/embed/album/{{ $m['spotify_id'] }}?utm_source=generator&theme=0"
                            height="152"
                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>

            </div>
        </div>

        {{-- Divider --}}
        @if($index < count($musik) - 1)
        <div class="musik-divider" data-aos="fade-up">
            <div class="musik-divider-line"></div>
            <span class="musik-divider-num">— 0{{ $index + 2 }} —</span>
            <div class="musik-divider-line"></div>
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