<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — The Slytherin Restricted Library</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=IM+Fell+English:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float-crest {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-6px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.35; transform: scale(1); }
            50%       { opacity: 0.65; transform: scale(1.08); }
        }
        @keyframes rise {
            0%   { opacity: 0;   transform: translateY(0)      scale(0); }
            20%  { opacity: 0.5; transform: translateY(-30px)  scale(1); }
            80%  { opacity: 0.15;transform: translateY(-90px)  scale(0.5); }
            100% { opacity: 0;   transform: translateY(-130px) scale(0); }
        }
        @keyframes card-in {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .crest-float { animation: float-crest 5s ease-in-out infinite; }
        .crest-glow  { animation: pulse-glow  4s ease-in-out infinite; }
        .card-enter  { animation: card-in 0.5s ease-out both; }

        .particle {
            position: absolute;
            width: 2px; height: 2px;
            border-radius: 9999px;
            opacity: 0;
            animation: rise var(--dur) ease-in var(--delay) infinite;
        }

        .stone-texture {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg,  transparent, transparent 60px, rgba(255,255,255,0.007) 60px, rgba(255,255,255,0.007) 61px),
                repeating-linear-gradient(90deg, transparent, transparent 80px, rgba(255,255,255,0.004) 80px, rgba(255,255,255,0.004) 81px);
            pointer-events: none;
        }

        .corner {
            position: absolute;
            width: 72px; height: 72px;
            pointer-events: none;
        }
        .corner-tl { top: 14px; left: 14px; }
        .corner-tr { top: 14px; right: 14px; transform: scaleX(-1); }
        .corner-bl { bottom: 14px; left: 14px; transform: scaleY(-1); }
        .corner-br { bottom: 14px; right: 14px; transform: scale(-1); }

        /* Input overrides — dark themed */
        .input-dark {
            width: 100%;
            padding: 10px 12px 10px 40px;
            background: #0a1a0f;
            border: 1px solid rgba(26,74,46,0.8);
            border-radius: 6px;
            color: #f5f0e8;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-dark::placeholder { color: rgba(192,192,192,0.35); }
        .input-dark:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,0.12);
        }

        .input-wrap {
            position: relative;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: rgba(192,192,192,0.45);
            pointer-events: none;
        }

        /* Submit button */
        .btn-submit {
            position: relative;
            width: 100%;
            padding: 11px;
            background: transparent;
            border: 1.5px solid #d4af37;
            border-radius: 6px;
            color: #d4af37;
            font-family: 'Cinzel Decorative', serif;
            font-size: 12px;
            letter-spacing: 0.08em;
            cursor: pointer;
            overflow: hidden;
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212,175,55,0.15), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }
        @keyframes shimmer {
            0%   { left: -100%; }
            50%  { left: 100%; }
            100% { left: 100%; }
        }
        .btn-submit:hover {
            background: rgba(212,175,55,0.1);
            box-shadow: 0 0 20px rgba(212,175,55,0.18), inset 0 0 16px rgba(212,175,55,0.05);
            color: #f0d060;
        }

        /* Card border glow on hover */
        .login-card {
            background: #0f2d1a;
            border: 1px solid rgba(212,175,55,0.3);
            border-radius: 12px;
            padding: 36px 40px;
            box-shadow: 0 0 60px rgba(0,0,0,0.5), 0 0 30px rgba(34,197,94,0.04);
            transition: border-color 0.4s, box-shadow 0.4s;
        }
        .login-card:hover {
            border-color: rgba(212,175,55,0.5);
            box-shadow: 0 0 60px rgba(0,0,0,0.5), 0 0 40px rgba(212,175,55,0.06);
        }

        @keyframes floating-candle {
    0%,100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-12px);
    }
}

.candle-float {
    animation: floating-candle 5s ease-in-out infinite;
}
    </style>
</head>
<body class="bg-slytherin-900 min-h-screen flex items-center justify-center font-sans px-4 relative overflow-hidden">

    {{-- Stone texture --}}
    <div class="stone-texture"></div>

    {{-- Ambient glow --}}
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[500px] h-[500px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(34,197,94,0.06) 0%, transparent 70%)"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] rounded-full pointer-events-none"
         style="background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%)"></div>

    {{-- Dust particles --}}
    <div class="particle" style="left:8%;bottom:15%;background:#d4af37;--dur:6s;--delay:0s"></div>
    <div class="particle" style="left:20%;bottom:28%;background:#d4af37;--dur:8s;--delay:1.2s"></div>
    <div class="particle" style="left:78%;bottom:20%;background:#d4af37;--dur:5.5s;--delay:0.5s"></div>
    <div class="particle" style="left:90%;bottom:40%;background:#d4af37;--dur:7s;--delay:2s"></div>
    <div class="particle" style="left:50%;bottom:10%;background:#86efac;--dur:9s;--delay:3s;width:3px;height:3px"></div>
    <div class="particle" style="left:35%;bottom:45%;background:#d4af37;--dur:6.5s;--delay:1.8s"></div>
    <div class="particle" style="left:65%;bottom:35%;background:#d4af37;--dur:7.5s;--delay:0.9s"></div>

    {{-- Gothic corner ornaments --}}
    <svg class="corner corner-tl" viewBox="0 0 72 72" fill="none">
        <path d="M4 68 L4 4 L68 4" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
        <path d="M4 4 L18 4"  stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <path d="M4 4 L4 18" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="18" cy="4"  r="1.2" fill="#d4af37" opacity="0.35"/>
        <circle cx="4"  cy="18" r="1.2" fill="#d4af37" opacity="0.35"/>
        <path d="M12 4 L4 12" stroke="rgba(212,175,55,0.25)" stroke-width="0.5"/>
        <path d="M22 4 L4 22" stroke="rgba(212,175,55,0.12)" stroke-width="0.5"/>
    </svg>
    <svg class="corner corner-tr" viewBox="0 0 72 72" fill="none">
        <path d="M4 68 L4 4 L68 4" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
        <path d="M4 4 L18 4"  stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <path d="M4 4 L4 18" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="18" cy="4"  r="1.2" fill="#d4af37" opacity="0.35"/>
        <circle cx="4"  cy="18" r="1.2" fill="#d4af37" opacity="0.35"/>
        <path d="M12 4 L4 12" stroke="rgba(212,175,55,0.25)" stroke-width="0.5"/>
    </svg>
    <svg class="corner corner-bl" viewBox="0 0 72 72" fill="none">
        <path d="M4 68 L4 4 L68 4" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
        <path d="M4 4 L18 4"  stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <path d="M4 4 L4 18" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="18" cy="4"  r="1.2" fill="#d4af37" opacity="0.35"/>
        <circle cx="4"  cy="18" r="1.2" fill="#d4af37" opacity="0.35"/>
    </svg>
    <svg class="corner corner-br" viewBox="0 0 72 72" fill="none">
        <path d="M4 68 L4 4 L68 4" stroke="rgba(212,175,55,0.3)" stroke-width="1"/>
        <path d="M4 4 L18 4"  stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <path d="M4 4 L4 18" stroke="rgba(212,175,55,0.55)" stroke-width="1.5"/>
        <circle cx="4"  cy="4"  r="2.5" fill="#d4af37" opacity="0.5"/>
        <circle cx="18" cy="4"  r="1.2" fill="#d4af37" opacity="0.35"/>
        <circle cx="4"  cy="18" r="1.2" fill="#d4af37" opacity="0.35"/>
    </svg>

    <img
    src="{{ asset('images/candle.gif') }}"
    class="absolute top-20 left-20 w-[150px] opacity-40 pointer-events-none select-none candle-float"
    alt=""
>

    <img
    src="{{ asset('images/candle.gif') }}"
    class="absolute top-32 right-24 w-[80px] opacity-30 pointer-events-none select-none candle-float"
    style="animation-delay:1.5s"
    alt=""
>

   <img
    src="{{ asset('images/candle.gif') }}"
    class="absolute top-52 left-1/3 w-12 opacity-25 pointer-events-none select-none candle-float"
    style="animation-delay:3s"
    alt=""
>

    {{-- Main wrapper --}}
    <div class="relative z-10 w-full max-w-md card-enter">

        {{-- Logo area --}}
        <div class="text-center mb-8">

            {{-- Mini ornament --}}
            <div class="flex items-center justify-center mb-5">
                <svg width="120" height="14" viewBox="0 0 120 14" fill="none">
                    <defs>
                        <linearGradient id="lo1" x1="0" y1="0" x2="44" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%"   stop-color="#d4af37" stop-opacity="0"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0.55"/>
                        </linearGradient>
                        <linearGradient id="lo2" x1="76" y1="0" x2="120" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%"   stop-color="#d4af37" stop-opacity="0.55"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <line x1="0"  y1="7" x2="44" y2="7" stroke="url(#lo1)" stroke-width="0.75"/>
                    <path d="M48 7 L52 3 L56 7 L52 11 Z" fill="rgba(212,175,55,0.5)"/>
                    <circle cx="60" cy="7" r="2.2" fill="#d4af37" opacity="0.8"/>
                    <path d="M64 7 L68 3 L72 7 L68 11 Z" fill="rgba(212,175,55,0.5)"/>
                    <line x1="76" y1="7" x2="120" y2="7" stroke="url(#lo2)" stroke-width="0.75"/>
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
                        class="w-[100px] h-[100px] object-contain">
                </div>
            </div>

            <h1 class="mb-1" style="font-family:'Cinzel Decorative',serif; font-size:28px; color:#d4af37;
                                     text-shadow: 0 0 30px rgba(212,175,55,0.2); letter-spacing:0.05em;">
                Slytherin
            </h1>
            <p class="italic" style="font-family:'IM Fell English',serif; font-size:17px; color:#86efac;">
                Restricted Library
            </p>
        </div>

        {{-- Card --}}
        <div class="login-card">

            {{-- Card header --}}
            <div class="text-center mb-6">
                <h2 style="font-family:'IM Fell English',serif; font-size:18px; color:#f5f0e8;">
                    Masuk ke Perpustakaan
                </h2>
                <div class="flex items-center justify-center mt-3">
                    <svg width="80" height="8" viewBox="0 0 80 8" fill="none">
                        <defs>
                            <linearGradient id="lc1" x1="0" y1="0" x2="34" y2="0" gradientUnits="userSpaceOnUse">
                                <stop offset="0%"   stop-color="#d4af37" stop-opacity="0"/>
                                <stop offset="100%" stop-color="#d4af37" stop-opacity="0.4"/>
                            </linearGradient>
                            <linearGradient id="lc2" x1="46" y1="0" x2="80" y2="0" gradientUnits="userSpaceOnUse">
                                <stop offset="0%"   stop-color="#d4af37" stop-opacity="0.4"/>
                                <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <line x1="0"  y1="4" x2="34" y2="4" stroke="url(#lc1)" stroke-width="0.75"/>
                        <circle cx="40" cy="4" r="1.8" fill="#d4af37" opacity="0.6"/>
                        <line x1="46" y1="4" x2="80" y2="4" stroke="url(#lc2)" stroke-width="0.75"/>
                    </svg>
                </div>
            </div>

            {{-- Flash error --}}
            @if (session('error'))
                <div class="mb-5 px-4 py-3 rounded-md flex items-center gap-2 text-sm"
                     style="background:#7f1d1d; border:1px solid rgba(239,68,68,0.5); color:#fca5a5;">
                    <i class="ti ti-alert-circle flex-shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 px-4 py-3 rounded-md text-sm"
                     style="background:#7f1d1d; border:1px solid rgba(239,68,68,0.5); color:#fca5a5;">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-center gap-2"><i class="ti ti-alert-circle flex-shrink-0"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-medium mb-1.5 tracking-wide uppercase"
                           style="color:rgba(192,192,192,0.6);">Email</label>
                    <div class="input-wrap">
                        <i class="ti ti-mail input-icon"></i>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               class="input-dark"
                               placeholder="admin@slytherin.test"
                               required autofocus>
                    </div>
                </div>

                    <div>
            <label for="password" class="block text-xs font-medium mb-1.5 tracking-wide uppercase"
                style="color:rgba(192,192,192,0.6);">Password</label>
            <div class="input-wrap" style="position:relative;">
                <i class="ti ti-lock input-icon"></i>
                <input type="password" name="password" id="password"
                    class="input-dark"
                    placeholder="••••••••"
                    style="padding-right: 48px;"
                    required>

                {{-- Toggle button --}}
                <button type="button" id="togglePassword"
                        style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; padding:0; line-height:0;">
                    <img id="eyeImg"
                        src="{{ asset('images/snakepass1.png') }}"
                        alt="Toggle password"
                        style="width:40px; height:40px; object-fit:contain; opacity:0.4; transition: width 0.2s ease, height 0.2s ease, opacity 0.2s ease;"
                        onmouseover="this.style.width='52px'; this.style.height='52px'; this.style.opacity='0.9';"
                        onmouseout="this.style.width='40px'; this.style.height='40px'; this.style.opacity='0.4';">
                </button>
            </div>
        </div>

                <div class="pt-2">
                    <button type="submit" class="btn-submit">
                        <i class="ti ti-door-enter mr-2"></i>
                        Masuk
                    </button>
                </div>

            </form>

        </div>

        {{-- Footer --}}
        <p class="text-center mt-6 text-xs italic" style="color:rgba(192,192,192,0.35); font-family:'IM Fell English',serif;">
            &copy; {{ date('Y') }} The Slytherin Restricted Library — Modul 7
        </p>

    </div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const input = document.getElementById('password');
    const img = document.getElementById('eyeImg');
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    img.src = isPassword
        ? '{{ asset("images/snakepass2.png") }}'
        : '{{ asset("images/snakepass1.png") }}';
});
</script>

</body>
</html>