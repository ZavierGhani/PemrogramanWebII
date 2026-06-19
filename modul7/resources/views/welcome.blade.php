<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Slytherin Restricted Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=IM+Fell+English:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float-crest {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50%       { opacity: 0.75; transform: scale(1.1); }
        }
        @keyframes rise {
            0%   { opacity: 0;   transform: translateY(0)     scale(0); }
            20%  { opacity: 0.6; transform: translateY(-30px) scale(1); }
            80%  { opacity: 0.2; transform: translateY(-90px) scale(0.5); }
            100% { opacity: 0;   transform: translateY(-130px) scale(0); }
        }
        @keyframes shimmer {
            0%   { left: -100%; }
            50%  { left: 100%; }
            100% { left: 100%; }
        }

        .crest-float  { animation: float-crest 6s ease-in-out infinite; }
        .crest-glow   { animation: pulse-glow  4s ease-in-out infinite; }

        .particle {
            position: absolute;
            width: 2px; height: 2px;
            border-radius: 9999px;
            opacity: 0;
            animation: rise var(--dur) ease-in var(--delay) infinite;
        }

        .corner {
            position: absolute;
            width: 80px; height: 80px;
            pointer-events: none;
        }
        .corner-tl { top: 16px; left: 16px; }
        .corner-tr { top: 16px; right: 16px; transform: scaleX(-1); }
        .corner-bl { bottom: 16px; left: 16px; transform: scaleY(-1); }
        .corner-br { bottom: 16px; right: 16px; transform: scale(-1); }

        .btn-enter {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 36px;
            background: transparent;
            border: 1.5px solid #d4af37;
            border-radius: 4px;
            color: #d4af37;
            font-family: 'Cinzel Decorative', serif;
            font-size: 13px;
            letter-spacing: 0.08em;
            cursor: pointer;
            overflow: hidden;
            text-decoration: none;
            transition: color 0.3s, background 0.3s, box-shadow 0.3s;
        }
        .btn-enter::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,175,55,0.15), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }
        .btn-enter:hover {
            background: rgba(212,175,55,0.12);
            box-shadow: 0 0 20px rgba(212,175,55,0.2), inset 0 0 20px rgba(212,175,55,0.05);
            color: #f0d060;
        }

        /* stone grid texture */
        .stone-texture {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg,  transparent, transparent 60px, rgba(255,255,255,0.008) 60px, rgba(255,255,255,0.008) 61px),
                repeating-linear-gradient(90deg, transparent, transparent 80px, rgba(255,255,255,0.005) 80px, rgba(255,255,255,0.005) 81px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-slytherin-900 min-h-screen flex items-center justify-center font-sans px-4 relative overflow-hidden">

    {{-- Stone texture --}}
    <div class="stone-texture"></div>

    {{-- Ambient glow --}}
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[420px] h-[420px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(34,197,94,0.08) 0%, transparent 70%)"></div>
    <div class="absolute bottom-0 right-0 w-[260px] h-[260px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(212,175,55,0.07) 0%, transparent 70%)"></div>

    {{-- Dust particles --}}
    <div class="particle" style="left:15%;bottom:20%;background:#d4af37;--dur:5s;--delay:0s"></div>
    <div class="particle" style="left:25%;bottom:30%;background:#d4af37;--dur:7s;--delay:1.5s"></div>
    <div class="particle" style="left:40%;bottom:15%;background:#d4af37;--dur:6s;--delay:0.8s"></div>
    <div class="particle" style="left:55%;bottom:25%;background:#d4af37;--dur:8s;--delay:2.2s"></div>
    <div class="particle" style="left:70%;bottom:20%;background:#d4af37;--dur:5.5s;--delay:1s"></div>
    <div class="particle" style="left:80%;bottom:35%;background:#d4af37;--dur:7s;--delay:0.3s"></div>
    <div class="particle" style="left:10%;bottom:40%;background:#d4af37;--dur:6.5s;--delay:3s"></div>
    <div class="particle" style="left:88%;bottom:45%;background:#d4af37;--dur:9s;--delay:1.8s"></div>
    <div class="particle" style="left:33%;bottom:50%;background:#d4af37;--dur:5s;--delay:4s"></div>
    <div class="particle" style="left:62%;bottom:55%;background:#86efac;--dur:7.5s;--delay:2.8s;width:3px;height:3px"></div>


    {{-- Gothic corner ornaments --}}
    <svg class="corner corner-tl" viewBox="0 0 80 80" fill="none">
        <path d="M4 76 L4 4 L76 4" stroke="rgba(212,175,55,0.35)" stroke-width="1"/>
        <path d="M4 4 L20 4"  stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <path d="M4 4 L4 20" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="20" cy="4"  r="1.2" fill="#d4af37" opacity="0.4"/>
        <circle cx="4"  cy="20" r="1.2" fill="#d4af37" opacity="0.4"/>
        <path d="M14 4 L4 14" stroke="rgba(212,175,55,0.3)"  stroke-width="0.5"/>
        <path d="M24 4 L4 24" stroke="rgba(212,175,55,0.15)" stroke-width="0.5"/>
    </svg>
    <svg class="corner corner-tr" viewBox="0 0 80 80" fill="none">
        <path d="M4 76 L4 4 L76 4" stroke="rgba(212,175,55,0.35)" stroke-width="1"/>
        <path d="M4 4 L20 4"  stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <path d="M4 4 L4 20" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="20" cy="4"  r="1.2" fill="#d4af37" opacity="0.4"/>
        <circle cx="4"  cy="20" r="1.2" fill="#d4af37" opacity="0.4"/>
        <path d="M14 4 L4 14" stroke="rgba(212,175,55,0.3)"  stroke-width="0.5"/>
        <path d="M24 4 L4 24" stroke="rgba(212,175,55,0.15)" stroke-width="0.5"/>
    </svg>
    <svg class="corner corner-bl" viewBox="0 0 80 80" fill="none">
        <path d="M4 76 L4 4 L76 4" stroke="rgba(212,175,55,0.35)" stroke-width="1"/>
        <path d="M4 4 L20 4"  stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <path d="M4 4 L4 20" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="20" cy="4"  r="1.2" fill="#d4af37" opacity="0.4"/>
        <circle cx="4"  cy="20" r="1.2" fill="#d4af37" opacity="0.4"/>
    </svg>
    <svg class="corner corner-br" viewBox="0 0 80 80" fill="none">
        <path d="M4 76 L4 4 L76 4" stroke="rgba(212,175,55,0.35)" stroke-width="1"/>
        <path d="M4 4 L20 4"  stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <path d="M4 4 L4 20" stroke="rgba(212,175,55,0.6)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="20" cy="4"  r="1.2" fill="#d4af37" opacity="0.4"/>
        <circle cx="4"  cy="20" r="1.2" fill="#d4af37" opacity="0.4"/>
    </svg>

    {{-- Main content --}}
    <div class="relative z-10 text-center max-w-lg w-full">

        {{-- Top ornamental divider --}}
        <div class="flex items-center justify-center mb-8">
            <svg width="140" height="16" viewBox="0 0 140 16" fill="none">
                <defs>
                    <linearGradient id="gt1" x1="0" y1="0" x2="52" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%"   stop-color="#d4af37" stop-opacity="0"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0.6"/>
                    </linearGradient>
                    <linearGradient id="gt2" x1="88" y1="0" x2="140" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%"   stop-color="#d4af37" stop-opacity="0.6"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <line x1="0"  y1="8" x2="52" y2="8" stroke="url(#gt1)" stroke-width="0.75"/>
                <path d="M56 8 L60 4 L64 8 L60 12 Z" fill="rgba(212,175,55,0.5)"/>
                <circle cx="70" cy="8" r="2.5" fill="#d4af37" opacity="0.85"/>
                <path d="M76 8 L80 4 L84 8 L80 12 Z" fill="rgba(212,175,55,0.5)"/>
                <line x1="88" y1="8" x2="140" y2="8" stroke="url(#gt2)" stroke-width="0.75"/>
            </svg>
        </div>
            {{-- Crest --}}
            <div class="relative inline-block mb-6 crest-float">
                <div class="absolute inset-0 rounded-full crest-glow"
                    style="background: radial-gradient(circle, rgba(34,197,94,0.3) 0%, transparent 70%); margin: -12px;"></div>
                <div class="relative w-28 h-28 mx-auto rounded-full flex items-center justify-center"
                    style="border: 1.5px solid rgba(212,175,55,0.55); background: #0f2d1a;
                            box-shadow: inset 0 0 20px rgba(0,0,0,0.6), 0 0 30px rgba(34,197,94,0.1);">
                    <img src="{{ asset('images/slytherin.png') }}"
                        alt="Slytherin Crest"
                        class="w-[120px] h-[120px] object-contain">
                </div>
            </div>

        {{-- Title --}}
        <h1 class="font-display text-4xl sm:text-5xl mb-1 tracking-wide"
            style="color:#d4af37; text-shadow: 0 0 40px rgba(212,175,55,0.25); font-family:'Cinzel Decorative',serif;">
            Slytherin
        </h1>
        <p class="text-xl sm:text-2xl mb-4 italic" style="font-family:'IM Fell English',serif; color:#86efac;">
            Restricted Library
        </p>
        <p class="text-sm mb-10 max-w-sm mx-auto leading-relaxed" style="color:#c0c0c0;">
            Pengetahuan terlarang menanti di kedalaman perpustakaan bawah tanah Hogwarts.
        </p>

       {{-- CTA --}}
<button type="button" onclick="cekPureBlood()" class="btn-enter">
    <i class="ti ti-door-enter"></i>
    Masuk ke Perpustakaan
</button>

<script>
function cekPureBlood() {
    Swal.fire({
        title: '<span style="font-family:\'Cinzel Decorative\',serif; font-size:20px; color:#d4af37; letter-spacing:0.05em;">Sebelum Melanjutkan...</span>',
        html: `<p style="font-family:'IM Fell English',serif; font-style:italic; color:rgba(245,240,232,0.85); font-size:18px; line-height:1.8; margin-top:8px;">
                    Apakah kamu <span style="color:#d4af37; font-size:20px;">Pure Blood</span>?<br>
                    <span style="font-size:13px; color:rgba(192,192,192,0.55);">Hanya yang layak boleh memasuki Restricted Section.</span>
               </p>`,
        background: '#0c2214',
        color: '#f5f0e8',
        iconColor: '#d4af37',
        showCancelButton: true,
        confirmButtonColor: '#1a3a22',
        cancelButtonColor: '#7f1d1d',
        confirmButtonText: 'Proudly Pure Blood',
didOpen: () => {
    const confirmBtn = Swal.getConfirmButton();
    confirmBtn.innerHTML = '<i class="fa-solid fa-droplet" style="color:#efbf04; margin-right:6px;"></i> Proudly Pure Blood';
},
        cancelButtonText: '🧙🏻 No, I\'m a Mugblood',
        reverseButtons: false,
        width: '520px',
        padding: '2.5rem',
        customClass: {
            confirmButton: 'swal-btn-confirm',
            cancelButton: 'swal-btn-cancel',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("login") }}';
        } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: '<span style="font-family:\'Cinzel Decorative\',serif; font-size:18px; color:#ef4444; letter-spacing:0.05em;">Pergi dari sini, Muggle!</span>',
                html: `<p style="font-family:'IM Fell English',serif; font-style:italic; color:rgba(245,240,232,0.7); font-size:17px; line-height:1.9; margin-top:8px;">
                            Darahmu tidak cukup murni untuk mengakses<br>
                            <span style="color:#d4af37; font-size:18px;">The Slytherin Restricted Library.</span><br><br>
                            <span style="font-size:13px; color:rgba(239,68,68,0.7); letter-spacing:0.05em;">— Kembali ke tempatmu, Muggleborn. —</span>
                       </p>`,
                background: '#0c2214',
                color: '#f5f0e8',
                iconColor: '#ef4444',
                icon: 'error',
                confirmButtonColor: '#7f1d1d',
                confirmButtonText: ':( Baik...',
                width: '520px',
                padding: '2.5rem',
            });
        }
    });
}
</script>

<style>
.swal-btn-confirm, .swal-btn-cancel {
    font-family: 'IM Fell English', serif !important;
    font-size: 15px !important;
    padding: 10px 24px !important;
    letter-spacing: 0.03em !important;
}
</style>

        {{-- Bottom ornamental divider --}}
        <div class="flex items-center justify-center mt-8">
            <svg width="200" height="20" viewBox="0 0 200 20" fill="none">
                <defs>
                    <linearGradient id="gb1" x1="0" y1="0" x2="72" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%"   stop-color="#d4af37" stop-opacity="0"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0.5"/>
                    </linearGradient>
                    <linearGradient id="gb2" x1="132" y1="0" x2="200" y2="0" gradientUnits="userSpaceOnUse">
                        <stop offset="0%"   stop-color="#d4af37" stop-opacity="0.5"/>
                        <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                    </linearGradient>
                </defs>
                <line x1="0"   y1="10" x2="72"  y2="10" stroke="url(#gb1)" stroke-width="0.75"/>
                <path d="M76 10 L79 6 L82 10 L79 14 Z"  fill="rgba(212,175,55,0.35)"/>
                <circle cx="86"  cy="10" r="1.5" fill="#d4af37" opacity="0.5"/>
                <path d="M88 4 L91 10 L94 4" stroke="rgba(212,175,55,0.5)" stroke-width="0.75" fill="none"/>
                <circle cx="100" cy="10" r="3"   fill="none" stroke="#d4af37" stroke-width="0.75" opacity="0.6"/>
                <circle cx="100" cy="10" r="1.2" fill="#d4af37" opacity="0.7"/>
                <path d="M106 4 L109 10 L112 4" stroke="rgba(212,175,55,0.5)" stroke-width="0.75" fill="none"/>
                <circle cx="118" cy="10" r="1.5" fill="#d4af37" opacity="0.5"/>
                <path d="M122 10 L125 6 L128 10 L125 14 Z" fill="rgba(212,175,55,0.35)"/>
                <line x1="132" y1="10" x2="200" y2="10" stroke="url(#gb2)" stroke-width="0.75"/>
            </svg>
        </div>

        <p class="text-xs mt-4 italic" style="color:rgba(192,192,192,0.4); font-family:'IM Fell English',serif;">
            &copy; {{ date('Y') }} The Slytherin Restricted Library
        </p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>