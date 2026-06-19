<?php require "Koneksi.php"; require "Model.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pustaka — Sistem Informasi Perpustakaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --crimson:       #A32D2D;
            --crimson-dark:  #791F1F;
            --crimson-light: #FCEBEB;
            --deep:          #2D0A0A;
            --text-bright:   #F5EEEE;
            --text-muted:    rgba(255,255,255,0.35);
            --border-dim:    rgba(255,255,255,0.07);
            --border-mid:    rgba(255,255,255,0.12);
            --font: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        html, body { height: 100%; }

        body {
            font-family: var(--font);
            background: var(--deep);
            color: var(--text-bright);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 40px;
            border-bottom: 0.5px solid var(--border-dim);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background: var(--crimson);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon i { font-size: 16px; color: var(--crimson-light); }

        .logo-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-bright);
        }

        .topbar-date {
            font-size: 12px;
            color: var(--text-muted);
        }

        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 24px 40px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 11px;
            color: var(--crimson-light);
            background: rgba(163, 45, 45, 0.18);
            border: 0.5px solid rgba(163, 45, 45, 0.35);
            padding: 5px 14px;
            border-radius: 20px;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .hero-eyebrow i { font-size: 13px; }

        .hero h1 {
            font-size: clamp(36px, 6vw, 58px);
            font-weight: 700;
            color: var(--text-bright);
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 18px;
        }

        .hero h1 span { color: var(--crimson); }

        .hero-sub {
            font-size: 15px;
            color: var(--text-muted);
            max-width: 400px;
            line-height: 1.7;
            margin-bottom: 52px;
        }

        .nav-cards {
            display: flex;
            gap: 14px;
            width: 100%;
            max-width: 680px;
        }

        .nav-card {
            flex: 1;
            background: rgba(255,255,255,0.04);
            border: 0.5px solid var(--border-mid);
            border-radius: 14px;
            padding: 24px 22px;
            text-decoration: none;
            color: var(--text-bright);
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: background 0.18s, border-color 0.18s, transform 0.18s;
        }

        .nav-card:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(163,45,45,0.5);
            transform: translateY(-3px);
        }

        .nav-card.primary {
            background: var(--crimson);
            border-color: var(--crimson);
        }

        .nav-card.primary:hover {
            background: var(--crimson-dark);
            border-color: var(--crimson-dark);
            transform: translateY(-3px);
        }

        .nav-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-card-icon i { font-size: 20px; }

        .nav-card-label {
            font-size: 16px;
            font-weight: 600;
        }

        .nav-card-desc {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            line-height: 1.55;
            flex: 1;
        }

        .nav-card.primary .nav-card-desc { color: rgba(255,255,255,0.7); }

        .nav-card-arrow {
            font-size: 18px;
            color: rgba(255,255,255,0.25);
            transition: color 0.15s, transform 0.15s;
            display: block;
        }

        .nav-card:hover .nav-card-arrow {
            color: rgba(255,255,255,0.7);
            transform: translateX(4px);
        }

        .stats-strip {
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 0.5px solid var(--border-dim);
            padding: 22px 40px;
        }

        .stat-item {
            text-align: center;
            padding: 0 40px;
        }

        .stat-item + .stat-item {
            border-left: 0.5px solid var(--border-dim);
        }

        .stat-num {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-bright);
            line-height: 1;
        }

        .stat-lbl {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 5px;
            letter-spacing: 0.04em;
        }
    </style>
</head>
<body>

    <header class="topbar">
        <div class="logo">
            <div class="logo-icon"><i class="ti ti-books"></i></div>
            <span class="logo-name">Pustaka</span>
        </div>
        <span class="topbar-date"><?php echo date('l, d F Y'); ?></span>
    </header>

    <main class="hero">
        <div class="hero-eyebrow">
            <i class="ti ti-building-library"></i>
            Sistem Informasi Perpustakaan
        </div>

        <h1>Satu tempat untuk<br>semua <span>koleksi.</span></h1>

        <p class="hero-sub">
            Kelola buku, anggota, dan peminjaman dengan mudah — terorganisir dalam satu sistem yang sederhana.
        </p>

        <div class="nav-cards">
            <a href="Member.php" class="nav-card">
                <div class="nav-card-icon"><i class="ti ti-users"></i></div>
                <div class="nav-card-label">Anggota</div>
                <div class="nav-card-desc">Data dan daftar anggota perpustakaan.</div>
                <i class="ti ti-arrow-right nav-card-arrow"></i>
            </a>

            <a href="Buku.php" class="nav-card primary">
                <div class="nav-card-icon"><i class="ti ti-books"></i></div>
                <div class="nav-card-label">Koleksi buku</div>
                <div class="nav-card-desc">Telusuri dan kelola seluruh katalog.</div>
                <i class="ti ti-arrow-right nav-card-arrow"></i>
            </a>

            <a href="Peminjaman.php" class="nav-card">
                <div class="nav-card-icon"><i class="ti ti-clipboard-list"></i></div>
                <div class="nav-card-label">Peminjaman</div>
                <div class="nav-card-desc">Catat dan pantau transaksi peminjaman.</div>
                <i class="ti ti-arrow-right nav-card-arrow"></i>
            </a>
        </div>
    </main>

    <?php
        $totalBuku   = count(getAllBuku());
        $totalMember = count(getAllMember());
        $totalPinjam = count(getAllPeminjaman());
    ?>
    <footer class="stats-strip">
        <div class="stat-item">
            <div class="stat-num"><?= $totalBuku ?></div>
            <div class="stat-lbl">Koleksi buku</div>
        </div>
        <div class="stat-item">
            <div class="stat-num"><?= $totalMember ?></div>
            <div class="stat-lbl">Anggota terdaftar</div>
        </div>
        <div class="stat-item">
            <div class="stat-num"><?= $totalPinjam ?></div>
            <div class="stat-lbl">Sedang dipinjam</div>
        </div>
    </footer>

</body>
</html>