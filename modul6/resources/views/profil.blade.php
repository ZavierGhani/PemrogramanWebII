@extends('layouts.app')

@section('title', 'Profil — Zavier Putra Nata Ghani')

@push('styles')
<style>
    html, body {
        overflow-x: hidden;
    }

    /* ── Wrapper ── */
    .profil-wrapper {
        padding-top: 140px;
        padding-bottom: 120px;
        padding-left: 48px;
        padding-right: 48px;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
    }

    /* ── Blob accent (konsisten dari beranda) ── */
    .profil-blob {
        position: fixed;
        pointer-events: none;
        z-index: 0;
        background: rgb(60, 74, 157);
        filter: blur(56px);
    }

    .profil-blob-1 {
        width: 500px;
        height: 460px;
        top: 10%;
        right: -100px;
        border-radius: 60% 40% 55% 45% / 50% 60% 40% 50%;
        animation: profBlob1 16s ease-in-out infinite alternate;
    }

    .profil-blob-2 {
        width: 280px;
        height: 260px;
        bottom: 5%;
        left: -60px;
        border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
        animation: profBlob2 11s ease-in-out infinite alternate;
        opacity: 0.5;
    }

    @keyframes profBlob1 {
    0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 20% 80% 70% 30% / 80% 10% 90% 20%; transform:  scale(1.2) rotate(15deg); }
    40%  { border-radius: 90% 10% 20% 80% / 20% 90% 10% 80%; transform:  scale(0.9) rotate(-10deg); }
    60%  { border-radius: 10% 90% 80% 20% / 60% 20% 80% 40%; transform:  scale(1.2) rotate(20deg); }
    80%  { border-radius: 80% 20% 10% 90% / 10% 80% 30% 70%; transform:  scale(0.8) rotate(-5deg); }
    100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; transform:  scale(1) rotate(0deg); }
}

@keyframes profBlob2 {
    0%   { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
    20%  { border-radius: 80% 20% 90% 10% / 10% 90% 20% 80%; transform: scale(1.2) rotate(-20deg); }
    40%  { border-radius: 10% 90% 20% 80% / 80% 20% 90% 10%; transform: scale(0.65) rotate(12deg); }
    60%  { border-radius: 70% 30% 80% 20% / 30% 70% 10% 90%; transform: scale(1.2) rotate(-15deg); }
    80%  { border-radius: 20% 80% 30% 70% / 90% 10% 70% 30%; transform: scale(0.85) rotate(8deg); }
    100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; transform: scale(1) rotate(0deg); }
}

    /* ── Hero Profil ── */
    .profil-hero {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 80px;
        align-items: start;
        margin-bottom: 120px;
        position: relative;
        z-index: 1;
    }

    /* ── Image with tilt ── */
    .profil-image-wrapper {
        position: relative;
        width: 100%;
        max-width: 340px;
        cursor: default;
        transform-style: preserve-3d;
        transition: transform 0.15s ease;
        will-change: transform;
    }

    .profil-image-bg {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 100%;
        height: 100%;
        border: 2px solid #315399;
        z-index: 0;
        transition: transform 0.4s ease;
    }

    .profil-image-wrapper:hover .profil-image-bg {
        transform: translate(5px, 5px);
    }

    .profil-image {
        position: relative;
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        z-index: 1;
        display: block;
        filter: grayscale(15%);
        transition: filter 0.5s ease;
    }

    .profil-image-wrapper:hover .profil-image {
        filter: grayscale(0%);
    }

    .profil-image-tag {
        position: absolute;
        bottom: -36px;
        left: 20px;
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }

    /* ── Bio ── */
    .profil-bio {
        padding-top: 20px;
        position: relative;
        z-index: 1;
    }

    .profil-heading {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(48px, 5vw, 72px);
        font-weight: 600;
        line-height: 1;
        color: #1a2540;
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }

    .profil-heading em {
        font-style: italic;
        color: #315399;
    }

    .profil-nim {
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        margin-bottom: 32px;
        display: block;
    }

    .profil-meta {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 40px;
        padding-bottom: 40px;
        border-bottom: 1px solid #dce6f7;
    }

    .meta-row {
        display: flex;
        align-items: baseline;
        gap: 16px;
    }

    .meta-label {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        min-width: 100px;
    }

    .meta-value {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        color: #1a2540;
        font-weight: 400;
    }

    /* ── Hobi dengan emoji hover ── */
    .hobi-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 32px;
    }

    .hobi-item {
        font-family: 'Outfit', sans-serif;
        font-size: 13px;
        color: #1a2540;
        padding: 8px 18px;
        border: 1px solid #dce6f7;
        background: #ffffff;
        transition: all 0.3s ease;
        cursor: default;
        position: relative;
        overflow: hidden;
    }

    .hobi-item .hobi-emoji {
        display: inline-block;
        opacity: 0;
        max-width: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        font-style: normal;
    }

    .hobi-item:hover {
        border-color: #315399;
        color: #315399;
        transform: translateY(-2px);
        padding-left: 10px;
    }

    .hobi-item:hover .hobi-emoji {
        opacity: 1;
        max-width: 24px;
        margin-right: 6px;
    }

    /* ── Skill pills stagger + liquid fill ── */
    .skill-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .skill-pill {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #315399;
        padding: 6px 14px;
        border: 1px solid #315399;
        letter-spacing: 0.1em;
        cursor: default;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(12px);
        transition: color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .skill-pill.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* liquid fill from left */
    .skill-pill::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #315399;
        transition: left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 0;
    }

    .skill-pill:hover::before { left: 0; }
    .skill-pill:hover { color: #ffffff; }
    .skill-pill span { position: relative; z-index: 1; }

    /* ── Section Divider dengan draw-itself line ── */
    .section-divider {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 64px;
    }

    .section-divider-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 48px;
        font-weight: 600;
        color: #1a2540;
        white-space: nowrap;
    }

    .section-divider-line {
        flex: 1;
        height: 1px;
        background: #dce6f7;
        position: relative;
        overflow: hidden;
    }

    .section-divider-line::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #315399;
        transition: left 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .section-divider-line.draw::after {
        left: 0;
    }

    .section-divider-num {
        font-family: 'Space Mono', monospace;
        font-size: 12px;
        color: #122142;
        letter-spacing: 0.2em;
    }

    /* ── Experience Cards + ghost number ── */
    .experience-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2px;
        background: #dce6f7;
        position: relative;
        z-index: 1;
    }

    .exp-card {
        background: #ffffff;
        padding: 40px 36px;
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }

    /* accent bottom line */
    .exp-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: #315399;
        transition: width 0.4s ease;
        z-index: 1;
    }

    .exp-card:hover::before { width: 100%; }

    /* ghost big number background */
    .exp-card::after {
        content: attr(data-num);
        position: absolute;
        bottom: -10px;
        right: 16px;
        font-family: 'Cormorant Garamond', serif;
        font-size: 120px;
        font-weight: 700;
        color: rgba(255, 21, 21, 0);
        line-height: 1;
        pointer-events: none;
        transition: color 0.4s ease, transform 0.4s ease;
        transform: translateY(10px);
        user-select: none;
    }

    .exp-card:hover::after {
        color: rgba(49, 84, 153, 0.33);
        transform: translateY(0);
    }

    .exp-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 60px rgba(49, 83, 153, 0.08);
        z-index: 2;
    }

    .exp-num {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #dce6f7;
        letter-spacing: 0.3em;
        margin-bottom: 24px;
        display: block;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .exp-card:hover .exp-num { color: #315399; }

    .exp-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px;
        font-weight: 600;
        color: #1a2540;
        line-height: 1.2;
        margin-bottom: 16px;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .exp-card:hover .exp-title { color: #315399; }

    .exp-singkat {
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        color: #6b87c4;
        line-height: 1.6;
        margin-bottom: 32px;
        position: relative;
        z-index: 1;
    }

    .exp-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .exp-waktu {
        font-family: 'Space Mono', monospace;
        font-size: 10px;
        color: #6b87c4;
        letter-spacing: 0.15em;
    }

    .exp-arrow {
        font-family: 'Outfit', sans-serif;
        font-size: 20px;
        color: #dce6f7;
        transition: all 0.3s ease;
    }

    .exp-card:hover .exp-arrow {
        color: #315399;
        transform: translateX(4px);
    }

    .hobi-item {
    text-decoration: none;
    color: inherit;
    cursor: pointer;
}

a.skill-pill {
    text-decoration: none;
    cursor: pointer;
}
</style>
@endpush

@section('content')

{{-- Blob accent --}}
<div class="profil-blob profil-blob-1"></div>
<div class="profil-blob profil-blob-2"></div>

<div class="profil-wrapper">

    {{-- Hero Profil --}}
    <div class="profil-hero">

        {{-- Image with tilt --}}
        <div data-aos="fade-right">
            <div class="profil-image-wrapper" id="tilt-image">
                <div class="profil-image-bg"></div>
                <img
                    src="{{ $profil['foto'] }}"
                    alt="Foto {{ $profil['nama'] }}"
                    class="profil-image"
                >
                <span class="profil-image-tag">{{ $profil['nim'] }}</span>
            </div>
        </div>

        {{-- Bio --}}
        <div class="profil-bio" data-aos="fade-left" data-aos-delay="100">

            <span class="section-label">— Tentang Saya</span>

            <h1 class="profil-heading" style="margin-top: 16px;">
                Zavier<br>
                Putra<br>
                <em>Nata Ghani</em>
            </h1>

            <span class="profil-nim">{{ $profil['nim'] }}</span>

            <div class="profil-meta">
                <div class="meta-row">
                    <span class="meta-label">Prodi</span>
                    <span class="meta-value">{{ $profil['prodi'] }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Angkatan</span>
                    <span class="meta-value">2024</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Universitas</span>
                    <span class="meta-value">Universitas Lambung Mangkurat</span>
                </div>
            </div>

                {{-- Hobi --}}
        <div style="margin-bottom: 32px;" data-aos="fade-up" data-aos-delay="200">
            <span class="section-label" style="display:block; margin-bottom: 16px;">— Hobi</span>
            <div class="hobi-list">
                <a href="{{ route('hobi.film') }}" class="hobi-item"><em class="hobi-emoji"><i class="fa-brands fa-letterboxd" style="color: rgb(52, 87, 150);"></i></em>Mengulik Film</a>
                <a href="{{ route('hobi.musik') }}" class="hobi-item"><em class="hobi-emoji"><i class="fa-brands fa-spotify" style="color: rgb(52, 87, 150);"></i></em>Mengulik Musik</a>
                <a href="{{ route('hobi.buku') }}" class="hobi-item"><em class="hobi-emoji"><i class="fa-solid fa-book-open" style="color: rgb(52, 87, 150);"></i></em>Membaca Buku</a>
                <a href="{{ route('hobi.olahraga') }}" class="hobi-item"><em class="hobi-emoji"><i class="fa-solid fa-dumbbell" style="color: rgb(52, 87, 150);"></i></em>Berolahraga</a>
            </div>
        </div>

         {{-- Skill pills --}}
        <div data-aos="fade-up" data-aos-delay="300">
            <span class="section-label" style="display:block; margin-bottom: 16px;">— Skill</span>
            <div class="skill-list" id="skill-list">
                @foreach($profil['skill'] as $skill)
                    <a href="https://github.com/ZavierGhani" target="_blank" class="skill-pill">
                        <span>{{ $skill }}</span>
                    </a>
                @endforeach
            </div>
        </div>
        </div>
    </div>

  <div id="pengalaman" data-aos="fade-up">
    <div class="section-divider">
        <h2 class="section-divider-title">Pengalaman</h2>
        <div class="section-divider-line" id="divider-line"></div>
        <span class="section-divider-num">04 KEGIATAN</span>
    </div>
</div>

    {{-- Experience Grid --}}
    <div class="experience-grid" data-aos="fade-up" data-aos-delay="100">
        @foreach($pengalaman as $index => $item)
        <a href="{{ route('detail', $item['id']) }}" class="exp-card" data-num="0{{ $index + 1 }}">
            <span class="exp-num">0{{ $index + 1 }}</span>
            <h3 class="exp-title">{{ $item['judul'] }}</h3>
            <p class="exp-singkat">{{ $item['singkat'] }}</p>
            <div class="exp-footer">
                <span class="exp-waktu">{{ $item['waktu'] }}</span>
                <span class="exp-arrow">→</span>
            </div>
        </a>
        @endforeach
    </div>

</div>

@endsection

@push('scripts')
<script>
    // ── 3D Tilt effect on foto ──
    const tiltEl = document.getElementById('tilt-image');
    if (tiltEl) {
        tiltEl.addEventListener('mousemove', (e) => {
            const rect = tiltEl.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width  - 0.5;
            const y = (e.clientY - rect.top)  / rect.height - 0.5;
            tiltEl.style.transform = `perspective(600px) rotateY(${x * 10}deg) rotateX(${-y * 10}deg) scale(1.02)`;
        });
        tiltEl.addEventListener('mouseleave', () => {
            tiltEl.style.transform = 'perspective(600px) rotateY(0) rotateX(0) scale(1)';
        });
    }

    // ── Skill pills stagger in ──
    const pills = document.querySelectorAll('.skill-pill');
    const pillObserver = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            pills.forEach((pill, i) => {
                setTimeout(() => pill.classList.add('visible'), i * 80);
            });
            pillObserver.disconnect();
        }
    }, { threshold: 0.3 });

    if (pills.length) pillObserver.observe(document.getElementById('skill-list'));

    // ── Divider line draw on scroll ──
    const dividerLine = document.getElementById('divider-line');
    const lineObserver = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            dividerLine.classList.add('draw');
            lineObserver.disconnect();
        }
    }, { threshold: 0.5 });

    if (dividerLine) lineObserver.observe(dividerLine);
</script>
@endpush