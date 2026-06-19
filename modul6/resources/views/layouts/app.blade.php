<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zavier Putra Nata Ghani')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600&family=Outfit:wght@300;400;500;600&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bg-primary': '#f4f7ff',
                        'bg-secondary': '#ffffff',
                        'accent': '#315399',
                        'accent-dark': '#1e3d7a',
                        'text-primary': '#1a2540',
                        'text-muted': '#6b87c4',
                        'border-subtle': '#dce6f7',
                    },
                    fontFamily: {
                        'display': ['Cormorant Garamond', 'serif'],
                        'body': ['Outfit', 'sans-serif'],
                        'mono': ['Space Mono', 'monospace'],
                    },
                }
            }
        }
    </script>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: #f4f7ff;
            color: #1a2540;
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }

        /* ── Navbar ── */
        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.4s ease;
        }

        #navbar.scrolled {
            padding: 16px 48px;
            background: rgba(244, 247, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #dce6f7;
        }

        .nav-brand {
            font-family: 'Space Mono', monospace;
            font-size: 14px;
            color: #315399;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-link {
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            font-weight: 1000;
            color: #1a2540;
            text-decoration: none;
            position: relative;
            letter-spacing: 0.02em;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #315399;
            transition: width 0.3s ease;
        }

        .nav-link:hover { color: #315399; }
        .nav-link:hover::after { width: 100%; }

        .nav-link.active {
            color: #315399;
        }

        .nav-link.active::after {
            width: 100%;
        }

        /* ── Decorative vertical text ── */
        .vertical-text {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.2em;
            color: #6b87c4;
            text-transform: uppercase;
        }

        /* ── Accent line ── */
        .accent-line {
            width: 60px;
            height: 2px;
            background: #315399;
            display: block;
        }

        /* ── Section label ── */
        .section-label {
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #6b87c4;
        }

        html {
    scroll-behavior: smooth;
}
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar">
        <a href="{{ route('beranda') }}" class="nav-brand">ZPNG — Portfolio</a>
        <div class="nav-links">
            <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('profil') }}" class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
        </div>
    </nav>

    <!-- Page Content -->
    @yield('content')

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-quart',
            once: true,
            offset: 60,
        });

        // Navbar scroll behavior
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>