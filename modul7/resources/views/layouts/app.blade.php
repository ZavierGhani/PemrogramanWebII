<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'The Slytherin Restricted Library')</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=IM+Fell+English:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        /* ── Stone texture overlay ── */
        .stone-texture {
            position: fixed;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg,  transparent, transparent 60px, rgba(255,255,255,0.006) 60px, rgba(255,255,255,0.006) 61px),
                repeating-linear-gradient(90deg, transparent, transparent 80px, rgba(255,255,255,0.004) 80px, rgba(255,255,255,0.004) 81px);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Sidebar gradient border (torch-light effect) ── */
        .sidebar-border {
            position: absolute;
            top: 0; right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(
                to bottom,
                transparent 0%,
                rgba(212,175,55,0.15) 15%,
                rgba(212,175,55,0.45) 50%,
                rgba(212,175,55,0.15) 85%,
                transparent 100%
            );
        }

        /* Animated torch glow on sidebar border */
        @keyframes torch-flicker {
            0%, 100% { opacity: 1; }
            45%       { opacity: 0.7; }
            55%       { opacity: 0.9; }
            75%       { opacity: 0.6; }
        }
        .sidebar-border { animation: torch-flicker 4s ease-in-out infinite; }

        /* ── Nav states ── */
        .nav-active {
            position: relative;
            background: linear-gradient(90deg, rgba(212,175,55,0.1) 0%, rgba(212,175,55,0.02) 100%);
            border-left: 2.5px solid #d4af37;
            color: #d4af37;
            font-weight: 500;
        }
        .nav-active i { color: #d4af37; }

        .nav-inactive {
            border-left: 2.5px solid transparent;
            color: rgba(245,240,232,0.55);
            transition: all 0.25s ease;
        }
        .nav-inactive:hover {
            background: rgba(212,175,55,0.05);
            color: #86efac;
            border-left-color: rgba(212,175,55,0.35);
        }
        .nav-inactive:hover i { color: #86efac; }

        /* ── Sidebar dust particles ── */
        @keyframes rise {
            0%   { opacity: 0; transform: translateY(0) scale(0); }
            20%  { opacity: 0.5; transform: translateY(-25px) scale(1); }
            80%  { opacity: 0.15; transform: translateY(-70px) scale(0.5); }
            100% { opacity: 0; transform: translateY(-100px) scale(0); }
        }
        .s-particle {
            position: absolute;
            width: 2px; height: 2px;
            border-radius: 9999px;
            background: #d4af37;
            opacity: 0;
            animation: rise var(--dur) ease-in var(--delay) infinite;
            pointer-events: none;
        }

        /* ── Logo shield pulse ── */
        @keyframes logo-glow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50%       { opacity: 0.85; transform: scale(1.08); }
        }
        .logo-glow { animation: logo-glow 4s ease-in-out infinite; }

        /* ── Nav section rune ornament ── */
        .nav-rune {
            display: inline-block;
            width: 4px; height: 4px;
            background: #d4af37;
            opacity: 0.4;
            transform: rotate(45deg);
            margin-right: 6px;
            vertical-align: middle;
        }

        /* ── User avatar ── */
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: #0a1a0f;
            border: 1.5px solid rgba(212,175,55,0.5);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Cinzel Decorative', serif;
            font-size: 13px;
            color: #d4af37;
            flex-shrink: 0;
            box-shadow: 0 0 10px rgba(212,175,55,0.1);
        }

        /* ── Flash notifications ── */
        .flash-success {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 12px 16px; border-radius: 6px;
            border-left: 3px solid #22c55e;
            background: rgba(26,74,46,0.5);
            color: #86efac; font-size: 14px; margin-bottom: 20px;
            box-shadow: 0 0 12px rgba(34,197,94,0.06);
        }
        .flash-error {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 12px 16px; border-radius: 6px;
            border-left: 3px solid #ef4444;
            background: rgba(127,29,29,0.5);
            color: #fca5a5; font-size: 14px; margin-bottom: 20px;
        }
        .flash-warning {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 12px 16px; border-radius: 6px;
            border-left: 3px solid #d4af37;
            background: rgba(113,63,18,0.5);
            color: #fcd34d; font-size: 14px; margin-bottom: 20px;
        }
        .flash-icon { font-size: 18px; flex-shrink: 0; margin-top: 1px; }

        /* ── Logout button ── */
        .btn-logout {
            width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 8px 12px; border-radius: 6px;
            background: rgba(127,29,29,0.25);
            border: 1px solid rgba(239,68,68,0.2);
            color: rgba(252,165,165,0.7);
            font-size: 13px; cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Inter', sans-serif;
        }
        .btn-logout:hover {
            background: rgba(127,29,29,0.55);
            border-color: rgba(239,68,68,0.4);
            color: #fca5a5;
            box-shadow: 0 0 12px rgba(239,68,68,0.08);
        }

        /* ── Main content corner ornaments ── */
        .mc-corner {
            position: absolute;
            width: 56px; height: 56px;
            pointer-events: none;
            opacity: 0.35;
        }
        .mc-corner-tl { top: 8px; left: 8px; }
        .mc-corner-tr { top: 8px; right: 8px; transform: scaleX(-1); }

        /* ── Page header divider ── */
        .page-divider {
            height: 1px;
            background: linear-gradient(
                to right,
                transparent,
                rgba(212,175,55,0.15) 20%,
                rgba(212,175,55,0.3) 50%,
                rgba(212,175,55,0.15) 80%,
                transparent
            );
            margin-top: 16px;
        }
    </style>
</head>
<body class="bg-slytherin-900 text-parchment font-sans antialiased min-h-screen flex" style="font-family:'Inter',sans-serif; background:#0a1a0f;">

    <div class="stone-texture"></div>

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="w-64 flex-shrink-0 flex flex-col justify-between min-h-screen relative z-10"
           style="background:#0c2214;">

        <div class="sidebar-border"></div>

        {{-- Sidebar ambient glow top --}}
        <div class="absolute top-0 left-0 w-full h-40 pointer-events-none"
             style="background: radial-gradient(ellipse at 50% 0%, rgba(34,197,94,0.07) 0%, transparent 70%);"></div>

        {{-- Sidebar particles --}}
        <div class="s-particle" style="left:20%;bottom:30%;--dur:6s;--delay:0s;"></div>
        <div class="s-particle" style="left:50%;bottom:20%;--dur:8s;--delay:2s;"></div>
        <div class="s-particle" style="left:75%;bottom:40%;--dur:5.5s;--delay:1s;"></div>
        <div class="s-particle" style="left:35%;bottom:55%;--dur:7s;--delay:3s;background:#86efac;"></div>

        <div class="relative">
            {{-- Logo --}}
            <div class="px-5 pt-6 pb-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="relative flex-shrink-0">
                        <div class="absolute inset-0 rounded-full logo-glow"
                             style="background: radial-gradient(circle, rgba(34,197,94,0.3) 0%, transparent 70%); margin:-6px;"></div>
                        <div class="relative w-10 h-10 rounded-full flex items-center justify-center"
                             style="background:#0a1a0f; border:1.5px solid rgba(212,175,55,0.5);
                                    box-shadow: inset 0 0 10px rgba(0,0,0,0.5), 0 0 16px rgba(34,197,94,0.08);">
                            <img src="{{ asset('images/slytherin.png') }}"
                        alt="Slytherin Crest"
                        class="w-[50px] h-[50px] object-contain">
                        </div>
                    </div>
                    <div>
                        <div style="font-family:'Cinzel Decorative',serif; font-size:13px; color:#d4af37; line-height:1.25; letter-spacing:0.03em;">
                            Slytherin
                        </div>
                        <div style="font-family:'IM Fell English',serif; font-style:italic; font-size:11px; color:rgba(134,239,172,0.65); letter-spacing:0.02em;">
                            Restricted Library
                        </div>
                    </div>
                </div>

                {{-- Logo divider ornament --}}
                <svg width="100%" height="10" viewBox="0 0 200 10" fill="none" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="sl1" x1="0" y1="0" x2="80" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#d4af37" stop-opacity="0"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0.45"/>
                        </linearGradient>
                        <linearGradient id="sl2" x1="120" y1="0" x2="200" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#d4af37" stop-opacity="0.45"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <line x1="0"   y1="5" x2="80"  y2="5" stroke="url(#sl1)" stroke-width="0.75"/>
                    <path d="M92 5 L96 2 L100 5 L96 8 Z" fill="rgba(212,175,55,0.4)"/>
                    <circle cx="100" cy="5" r="1.5" fill="#d4af37" opacity="0.7"/>
                    <path d="M104 5 L108 2 L112 5 L108 8 Z" fill="rgba(212,175,55,0.4)"/>
                    <line x1="120" y1="5" x2="200" y2="5" stroke="url(#sl2)" stroke-width="0.75"/>
                </svg>
            </div>

            {{-- Nav --}}
            <nav class="px-3 flex flex-col gap-0.5">
                <p class="px-3 pt-1 pb-2 text-xs tracking-widest uppercase flex items-center"
                   style="color:rgba(212,175,55,0.3); font-size:9.5px; letter-spacing:0.15em;">
                    <span class="nav-rune"></span> Navigasi
                </p>

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-md text-sm
                          {{ request()->routeIs('dashboard') ? 'nav-active' : 'nav-inactive' }}">
                    <i class="ti ti-layout-dashboard text-base"></i>
                    <span>Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background:#d4af37; box-shadow:0 0 6px #d4af37;"></span>
                    @endif
                </a>

                <a href="{{ route('buku.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-md text-sm
                          {{ request()->routeIs('buku.*') ? 'nav-active' : 'nav-inactive' }}">
                    <i class="ti ti-book-2 text-base"></i>
                    <span>Buku</span>
                    @if(request()->routeIs('buku.*'))
                        <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background:#d4af37; box-shadow:0 0 6px #d4af37;"></span>
                    @endif
                </a>

                <a href="{{ route('member.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-md text-sm
                          {{ request()->routeIs('member.*') ? 'nav-active' : 'nav-inactive' }}">
                    <i class="ti ti-users text-base"></i>
                    <span>Member</span>
                    @if(request()->routeIs('member.*'))
                        <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background:#d4af37; box-shadow:0 0 6px #d4af37;"></span>
                    @endif
                </a>

                <a href="{{ route('peminjaman.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-md text-sm
                          {{ request()->routeIs('peminjaman.*') ? 'nav-active' : 'nav-inactive' }}">
                    <i class="ti ti-clipboard-list text-base"></i>
                    <span>Peminjaman</span>
                    @if(request()->routeIs('peminjaman.*'))
                        <span class="ml-auto w-1.5 h-1.5 rounded-full" style="background:#d4af37; box-shadow:0 0 6px #d4af37;"></span>
                    @endif
                </a>
            </nav>
        </div>

        {{-- User + Logout --}}
        <div class="px-4 py-5 relative">
            {{-- Top divider ornament --}}
            <div class="mb-4">
                <svg width="100%" height="10" viewBox="0 0 200 10" fill="none" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="sf1" x1="0" y1="0" x2="80" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#d4af37" stop-opacity="0"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0.3"/>
                        </linearGradient>
                        <linearGradient id="sf2" x1="120" y1="0" x2="200" y2="0" gradientUnits="userSpaceOnUse">
                            <stop offset="0%" stop-color="#d4af37" stop-opacity="0.3"/>
                            <stop offset="100%" stop-color="#d4af37" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <line x1="0"   y1="5" x2="80"  y2="5" stroke="url(#sf1)" stroke-width="0.75"/>
                    <circle cx="100" cy="5" r="1.5" fill="#d4af37" opacity="0.45"/>
                    <line x1="120" y1="5" x2="200" y2="5" stroke="url(#sf2)" stroke-width="0.75"/>
                </svg>
            </div>

            <div class="flex items-center gap-3 mb-3">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium truncate" style="color:#f5f0e8;">
                        {{ auth()->user()->username ?? 'Admin' }}
                    </p>
                    <p class="text-xs truncate" style="color:rgba(192,192,192,0.45);">
                        {{ auth()->user()->email ?? '' }}
                    </p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="ti ti-logout text-base"></i>
                    Keluar dari Perpustakaan
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <main class="flex-1 min-h-screen relative z-10 overflow-x-hidden" style="background:#0a1a0f;">

        {{-- Main content ambient glows --}}
        <div class="absolute top-0 right-0 w-96 h-96 pointer-events-none"
             style="background: radial-gradient(circle, rgba(212,175,55,0.04) 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 pointer-events-none"
             style="background: radial-gradient(circle, rgba(34,197,94,0.04) 0%, transparent 70%);"></div>

        {{-- Corner ornaments --}}
        <svg class="mc-corner mc-corner-tl" viewBox="0 0 56 56" fill="none" aria-hidden="true">
            <path d="M3 53 L3 3 L53 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L16 3"  stroke="rgba(212,175,55,0.55)" stroke-width="1.25"/>
            <path d="M3 3 L3 16" stroke="rgba(212,175,55,0.55)" stroke-width="1.25"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.45"/>
            <circle cx="16" cy="3" r="1" fill="#d4af37" opacity="0.3"/>
            <circle cx="3" cy="16" r="1" fill="#d4af37" opacity="0.3"/>
        </svg>
        <svg class="mc-corner mc-corner-tr" viewBox="0 0 56 56" fill="none" aria-hidden="true">
            <path d="M3 53 L3 3 L53 3" stroke="rgba(212,175,55,0.3)" stroke-width="0.75"/>
            <path d="M3 3 L16 3"  stroke="rgba(212,175,55,0.55)" stroke-width="1.25"/>
            <path d="M3 3 L3 16" stroke="rgba(212,175,55,0.55)" stroke-width="1.25"/>
            <circle cx="3" cy="3" r="2" fill="#d4af37" opacity="0.45"/>
            <circle cx="16" cy="3" r="1" fill="#d4af37" opacity="0.3"/>
            <circle cx="3" cy="16" r="1" fill="#d4af37" opacity="0.3"/>
        </svg>

        {{-- Page header --}}
        <div class="px-8 pt-7 pb-0 relative">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs tracking-widest uppercase mb-1" style="color:rgba(212,175,55,0.45); font-size:10px; letter-spacing:0.15em;">
                        The Slytherin Restricted Library
                    </p>
                </div>
                <div>
                    @yield('page-action')
                </div>
            </div>
            <div class="page-divider mt-4"></div>
        </div>

        <div class="px-8 py-7">

            {{-- Flash Notifications --}}
            @if (session('success'))
                <div class="flash-success">
                    <i class="ti ti-circle-check flash-icon"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-error">
                    <i class="ti ti-alert-circle flash-icon"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="flash-warning">
                    <i class="ti ti-alert-triangle flash-icon"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function konfirmasiHapus(formId, namaItem = 'item ini') {
        Swal.fire({
            title: 'Hapus dari Restricted Section?',
            html: `<span style="color:rgba(245,240,232,0.6); font-size:14px;">${namaItem} akan dihapus secara permanen dari arsip.</span>`,
            icon: 'warning',
            background: '#0c2214',
            color: '#f5f0e8',
            iconColor: '#d4af37',
            showCancelButton: true,
            confirmButtonColor: '#7f1d1d',
            cancelButtonColor: '#1a3a22',
            confirmButtonText: '🗡️ Ya, Hapus',
            cancelButtonText: 'Batalkan',
            reverseButtons: true,
            customClass: {
                popup: 'border border-yellow-900/40',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
    </script>
    @stack('scripts')
</body>
</html>
