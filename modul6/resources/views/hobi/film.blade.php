@extends('layouts.app')

@section('title', 'Film — Zavier')

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
    .film-blob {
        position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgba(13, 61, 156, 0.7);
        filter: blur(56px);
    }
   
    .film-blob-2 {
        width: 260px; height: 240px;
        bottom: -5%; left: -80px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: fBlob2 11s ease-in-out infinite alternate;
        opacity: 0.55;
    }
 

@keyframes fBlob2 {
    0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-10deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.8) rotate(8deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-10deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
}

    /* ── Wrapper ── */
    .film-wrapper {
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
    .film-hero {
        margin-bottom: 100px;
        position: relative;
    }

    .film-hero-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        margin-bottom: 16px;
        display: block;
    }

    .film-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(72px, 10vw, 130px);
        font-weight: 600;
        line-height: 0.9;
        color: #1a2540;
        letter-spacing: -0.02em;
    }

    .film-hero-title em {
        font-style: italic;
        color: #315399;
    }

    .film-hero-sub {
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
        font-size: 13px;
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
    .etag.t1 { top: 10%;  right: 5%;   transform: rotate(-2deg); animation: tagIn 0.6s ease forwards 0.4s, tagFloat1 6s ease-in-out 1.4s infinite; }
    .etag.t2 { top: 50%;  right: 2%;   transform: rotate(1.5deg); animation: tagIn 0.6s ease forwards 0.7s, tagFloat2 7s ease-in-out 1.7s infinite; }
    .etag.t3 { bottom: 5%; right: 12%; transform: rotate(-1deg); animation: tagIn 0.6s ease forwards 1.0s, tagFloat1 8s ease-in-out 2.0s infinite; }

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

    /* ── Film Section ── */
    .film-section {
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .film-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 72px;
        align-items: start;
        padding: 80px 0;
    }

    .film-grid.reverse { direction: rtl; }
    .film-grid.reverse > * { direction: ltr; }

    /* ── Poster ── */
    .film-poster-wrapper {
        position: relative;
        max-width: 340px;
    }

    .film-poster-bg {
        position: absolute;
        top: 16px; left: 16px;
        width: 100%; height: 100%;
        border: 2px solid #dce6f7;
        z-index: 0;
        transition: transform 0.4s ease;
    }

    .film-poster-wrapper:hover .film-poster-bg {
        transform: translate(5px, 5px);
    }

    .film-poster {
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        object-fit: cover;
        z-index: 1;
        display: block;
        filter: grayscale(20%);
        transition: filter 0.5s ease, transform 0.4s ease;
    }

    .film-poster-wrapper:hover .film-poster {
        filter: grayscale(0%);
        transform: translateY(-4px);
    }

    .film-rating-badge {
        position: absolute;
        top: -20px;
        right: -20px;
        background: #1a2540;
        padding: 16px 20px;
        z-index: 2;
        text-align: center;
        min-width: 80px;
    }

    .film-rating-num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 36px;
        font-weight: 600;
        color: #ffffff;
        line-height: 1;
        display: block;
    }

    .film-rating-denom {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.15em;
        display: block;
        margin-top: 2px;
    }

    /* ── Info ── */
    .film-info { padding-top: 16px; }

    .film-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
        margin-bottom: 20px;
        display: block;
    }

    .film-judul {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(36px, 4vw, 52px);
        font-weight: 600;
        color: #1a2540;
        line-height: 1.05;
        letter-spacing: -0.01em;
        margin-bottom: 8px;
    }

    .film-meta-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .film-tahun {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
    }

    .film-genre-tag {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #315399;
        border: 1px solid rgba(49, 83, 153, 0.3);
        padding: 3px 10px;
        letter-spacing: 0.1em;
    }

    /* Why I love it — highlight stab */
    .film-why {
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px;
        font-style: italic;
        color: #315399;
        line-height: 1.5;
        margin-bottom: 20px;
        padding: 16px 20px;
        border-left: 3px solid #315399;
        background: rgba(49, 83, 153, 0.04);
    }

    .film-ulasan {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 300;
        color: #1a2540;
        line-height: 1.8;
        margin-bottom: 32px;
    }

    /* ── Trailer embed ── */
    .film-trailer-label {
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: #6b87c4;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
    }

    .film-trailer-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        background: #1a2540;
        overflow: hidden;
        cursor: pointer;
    }

    .film-trailer-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.6;
        transition: opacity 0.3s ease;
        display: block;
    }

    .film-trailer-wrapper:hover .film-trailer-thumb { opacity: 0.8; }

    .film-play-btn {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 56px; height: 56px;
        background: rgba(49, 83, 153, 0.9);
        display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease;
    }

    .film-play-btn svg {
        width: 20px; height: 20px;
        fill: white;
        margin-left: 3px;
    }

    .film-trailer-wrapper:hover .film-play-btn {
        background: #315399;
        transform: translate(-50%, -50%) scale(1.1);
    }

    .film-trailer-label-overlay {
        position: absolute;
        bottom: 12px; left: 12px;
        font-family: 'Space Mono', monospace;
        font-size: 9px;
        color: rgba(255,255,255,0.6);
        letter-spacing: 0.15em;
    }

    /* iframe hidden until clicked */
    .film-trailer-iframe {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        border: none;
        display: none;
    }

    .film-trailer-wrapper.playing .film-trailer-thumb,
    .film-trailer-wrapper.playing .film-play-btn,
    .film-trailer-wrapper.playing .film-trailer-label-overlay {
        display: none;
    }

    .film-trailer-wrapper.playing .film-trailer-iframe {
        display: block;
    }

    /* ── Divider ── */
    .film-divider {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .film-divider-line {
        flex: 1;
        height: 1px;
        background: #dce6f7;
    }

    .film-divider-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
    }
</style>
@endpush

@section('content')

<div id="scroll-progress"></div>
<div class="film-blob film-blob-1"></div>
<div class="film-blob film-blob-2"></div>

<div class="film-wrapper">

    {{-- Back --}}
    <a href="{{ route('profil') }}" class="back-link" data-aos="fade-right">
        <span class="back-arrow">←</span>
        Kembali ke Profil
    </a>

    {{-- Hero --}}
    <div class="film-hero" data-aos="fade-up">
        <span class="film-hero-label"><i class="fa-brands fa-letterboxd" style="color: rgb(52, 87, 150); font-size: 17px;"></i></em> Hobi / Film</span>
        <h1 class="film-hero-title">
            Mengulik<br><em>Film</em>
        </h1>
        <p class="film-hero-sub">
            Five films that left a mark — the kind you can't quite explain,
            only recognize in the silence after.
        </p>

        {{-- Editorial tags --}}
        <div class="etag t1">[ Cinema ]</div>
        <div class="etag t2">—  Masterpiece</div>
        <div class="etag t3">[ Timeless ]</div>
    </div>

    {{-- Film list --}}
    @foreach($film as $index => $f)

        <div class="film-section" data-aos="fade-up" data-aos-delay="100">
            <div class="film-grid {{ $index % 2 !== 0 ? 'reverse' : '' }}">

                {{-- Poster --}}
                <div>
                    <div class="film-poster-wrapper">
                        <div class="film-poster-bg"></div>
                        <img
                            src="{{ asset($f['poster']) }}"
                            alt="Poster {{ $f['judul'] }}"
                            class="film-poster"
                        >
                        <div class="film-rating-badge">
                            <span class="film-rating-num">{{ $f['rating'] }}</span>
                            <span class="film-rating-denom">/ 10</span>
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="film-info">
                    <span class="film-num">0{{ $index + 1 }} / 03</span>

                    <h2 class="film-judul">{{ $f['judul'] }}</h2>

                    <div class="film-meta-row">
                        <span class="film-tahun">{{ $f['tahun'] }} · {{ $f['sutradara'] }}</span>
                        @foreach($f['genre'] as $g)
                            <span class="film-genre-tag">{{ $g }}</span>
                        @endforeach
                    </div>

                    <p class="film-why">"{{ $f['why'] }}"</p>

                    <p class="film-ulasan">{{ $f['ulasan'] }}</p>

                    {{-- Trailer --}}
                    <span class="film-trailer-label">— Official Trailer</span>
                    <div
                        class="film-trailer-wrapper"
                        data-video-id="{{ $f['trailer_id'] }}"
                        onclick="playTrailer(this)"
                    >
                        <img
                            src="https://img.youtube.com/vi/{{ $f['trailer_id'] }}/maxresdefault.jpg"
                            alt="Thumbnail {{ $f['judul'] }}"
                            class="film-trailer-thumb"
                        >
                        <div class="film-play-btn">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                        <span class="film-trailer-label-overlay">PLAY TRAILER</span>
                        <iframe
                            class="film-trailer-iframe"
                            src=""
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                        ></iframe>
                    </div>
                </div>

            </div>
        </div>

        {{-- Divider (skip after last) --}}
        @if($index < count($film) - 1)
        <div class="film-divider" data-aos="fade-up">
            <div class="film-divider-line"></div>
            <span class="film-divider-num">— 0{{ $index + 2 }} —</span>
            <div class="film-divider-line"></div>
        </div>
        @endif

    @endforeach

  {{-- Chapter Break --}}
<div style="position: relative; margin: 120px 0; text-align: center; padding: 60px 0;" data-aos="fade-up">
    


    {{-- Top line --}}
    <div style="width: 1px; height: 80px; background: linear-gradient(180deg, transparent, #315399); margin: 0 auto 40px;"></div>

   

    {{-- Title --}}
    <h2 style="
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(72px, 10vw, 140px);
        font-weight: 600;
        color: #1a2540;
        line-height: 0.9;
        letter-spacing: -0.02em;
        position: relative;
        z-index: 1;
    ">Top 3 <em style="color:#315399; font-style:italic;">Series</em></h2>

    {{-- Bottom line --}}
    <div style="width: 1px; height: 80px; background: linear-gradient(180deg, #315399, transparent); margin: 40px auto 0;"></div>

</div>

{{-- Series List --}}
@foreach($series as $index => $s)
<div class="film-section" data-aos="fade-up" data-aos-delay="100">
    <div class="film-grid {{ $index % 2 !== 0 ? 'reverse' : '' }}">

        {{-- Poster --}}
        <div>
            <div class="film-poster-wrapper">
                <div class="film-poster-bg"></div>
                <img
                    src="{{ asset($s['poster']) }}"
                    alt="Poster {{ $s['judul'] }}"
                    class="film-poster"
                >
                <div class="film-rating-badge">
                    <span class="film-rating-num">{{ $s['rating'] }}</span>
                    <span class="film-rating-denom">/ 10</span>
                </div>
            </div>
        </div>

        {{-- Info --}}
        <div class="film-info">
            <span class="film-num">0{{ $index + 1 }} / 03</span>

            <h2 class="film-judul">{{ $s['judul'] }}</h2>

            <div class="film-meta-row">
                <span class="film-tahun">{{ $s['tahun'] }} · {{ $s['season'] }} Season · </span>
                <span style="font-family:'Space Mono',monospace; font-size:9px; padding: 3px 10px; letter-spacing:0.1em;
                    {{ $s['status'] === 'Ongoing' ? 'color:#4ade80; border: 1px solid rgba(74,222,128,0.3);' : 'color:#6b87c4; border: 1px solid rgba(107,135,196,0.3);' }}">
                    {{ $s['status'] }}
                </span>
                @foreach($s['genre'] as $g)
                    <span class="film-genre-tag">{{ $g }}</span>
                @endforeach
            </div>

            <p class="film-why">"{{ $s['why'] }}"</p>

            <p class="film-ulasan">{{ $s['ulasan'] }}</p>

            {{-- Trailer --}}
            <span class="film-trailer-label">— Official Trailer</span>
            <div
                class="film-trailer-wrapper"
                data-video-id="{{ $s['trailer_id'] }}"
                onclick="playTrailer(this)"
            >
                <img
                    src="https://img.youtube.com/vi/{{ $s['trailer_id'] }}/maxresdefault.jpg"
                    alt="Thumbnail {{ $s['judul'] }}"
                    class="film-trailer-thumb"
                >
                <div class="film-play-btn">
                    <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                <span class="film-trailer-label-overlay">PLAY TRAILER</span>
                <iframe
                    class="film-trailer-iframe"
                    src=""
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
            </div>
        </div>

    </div>
</div>

@if($index < count($series) - 1)
<div class="film-divider" data-aos="fade-up">
    <div class="film-divider-line"></div>
    <span class="film-divider-num">— 0{{ $index + 2 }} —</span>
    <div class="film-divider-line"></div>
</div>
@endif

@endforeach

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

    // Play trailer on click
    function playTrailer(wrapper) {
        const id = wrapper.dataset.videoId;
        const iframe = wrapper.querySelector('.film-trailer-iframe');
        iframe.src = `https://www.youtube.com/embed/${id}?autoplay=1&rel=0&modestbranding=1`;
        wrapper.classList.add('playing');
    }
</script>
@endpush