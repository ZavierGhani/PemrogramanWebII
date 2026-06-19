<?php
require "Model.php";

if (isset($_GET["hapus"])) {
    $result = deleteBuku($_GET["hapus"]);
    if ($result === "punya_peminjaman") {
        header("Location: Buku.php?error=punya_peminjaman");
    } else {
        header("Location: Buku.php?sukses=hapus");
    }
    exit;
}

$dataBuku = getAllBuku();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku — Pustaka</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --crimson:       #A32D2D;
            --crimson-dark:  #791F1F;
            --crimson-light: #FCEBEB;
            --crimson-mid:   #F5EDEC;
            --deep:          #2D0A0A;
            --page-bg:       #FDFAF9;
            --card-bg:       #FFFFFF;
            --border:        #EDE0DF;
            --text-primary:  #2D0A0A;
            --text-secondary:#888780;
            --text-caption:  #B4B2A9;
            --green-bg:      #EAF3DE;
            --green-text:    #3B6D11;
            --amber-bg:      #FAEEDA;
            --amber-text:    #854F0B;
            --sidebar-text:  rgba(255,255,255,0.5);
            --sidebar-border:rgba(255,255,255,0.08);
            --font: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            font-family: var(--font);
            background: var(--page-bg);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: var(--deep);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .sidebar-logo {
            padding: 24px 18px 20px;
            border-bottom: 0.5px solid var(--sidebar-border);
        }

        .logo-mark {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--crimson);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon i { font-size: 17px; color: var(--crimson-light); }
        .logo-text { font-size: 15px; font-weight: 600; color: #F5EEEE; }
        .logo-sub  { font-size: 10px; color: rgba(255,255,255,0.3); margin-top: 1px; }

        .nav { padding: 14px 10px; flex: 1; }

        .nav-label {
            font-size: 10px;
            color: rgba(255,255,255,0.25);
            letter-spacing: 0.09em;
            text-transform: uppercase;
            padding: 0 8px;
            margin: 16px 0 6px;
        }

        .nav-label:first-child { margin-top: 4px; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            color: var(--sidebar-text);
            font-size: 13.5px;
            text-decoration: none;
            margin-bottom: 2px;
            transition: background 0.15s, color 0.15s;
        }

        .nav-item i { font-size: 17px; flex-shrink: 0; }

        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8); }
        .nav-item.active { background: var(--crimson); color: var(--crimson-light); }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 0.5px solid var(--sidebar-border);
        }

        /* ── Main ── */
        .main { flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        .topbar {
            padding: 18px 32px;
            border-bottom: 0.5px solid var(--border);
            background: var(--page-bg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-left .page-title { font-size: 17px; font-weight: 600; color: var(--text-primary); }
        .topbar-left .page-sub   { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            background: var(--crimson);
            color: var(--crimson-light);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
        }

        .btn-add:hover { background: var(--crimson-dark); }
        .btn-add i { font-size: 16px; }

        .content { padding: 28px 32px; flex: 1; }

        /* ── Notif ── */
        .notif {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
            border: 0.5px solid;
        }

        .notif i { font-size: 17px; flex-shrink: 0; }

        .notif-sukses {
            background: var(--green-bg);
            color: var(--green-text);
            border-color: #C0DD97;
        }

        .notif-error {
            background: var(--crimson-light);
            color: var(--crimson);
            border-color: #F7C1C1;
        }

        /* ── Table card ── */
        .table-card {
            background: var(--card-bg);
            border: 0.5px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--crimson-mid);
            border-bottom: 0.5px solid var(--border);
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--crimson);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        td {
            padding: 13px 16px;
            font-size: 13.5px;
            color: var(--text-primary);
            border-bottom: 0.5px solid var(--border);
        }

        tbody tr:last-child td { border-bottom: none; }

        tbody tr:hover { background: #FFFBFB; }

        td.muted { color: var(--text-secondary); }

        .id-badge {
            display: inline-block;
            background: var(--crimson-mid);
            color: var(--crimson);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 5px;
            font-family: monospace;
        }

        /* ── Action buttons ── */
        .actions { display: flex; gap: 7px; }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            border: 0.5px solid;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-action i { font-size: 14px; }

        .btn-ubah {
            background: var(--amber-bg);
            color: var(--amber-text);
            border-color: #FAC775;
        }

        .btn-ubah:hover { background: #F5DDB0; }

        .btn-hapus {
            background: var(--crimson-light);
            color: var(--crimson);
            border-color: #F7C1C1;
        }

        .btn-hapus:hover { background: #F7C1C1; }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-secondary);
        }

        .empty-state i { font-size: 40px; color: var(--border); margin-bottom: 12px; display: block; }
        .empty-state p { font-size: 14px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-mark">
            <div class="logo-icon"><i class="ti ti-books"></i></div>
            <div>
                <div class="logo-text">Pustaka</div>
                <div class="logo-sub">Sistem Informasi</div>
            </div>
        </div>
    </div>
    <nav class="nav">
        <div class="nav-label">Menu</div>
        <a href="index.php" class="nav-item"><i class="ti ti-layout-dashboard"></i> Dashboard</a>
        <a href="Buku.php" class="nav-item active"><i class="ti ti-books"></i> Koleksi buku</a>
        <a href="Member.php" class="nav-item"><i class="ti ti-users"></i> Anggota</a>
        <a href="Peminjaman.php" class="nav-item"><i class="ti ti-clipboard-list"></i> Peminjaman</a>
    </nav>
    <div class="sidebar-footer">
        <div class="nav-item"><i class="ti ti-user-circle"></i> Admin</div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <div class="page-title">Koleksi buku</div>
            <div class="page-sub"><?= count($dataBuku) ?> judul tersedia</div>
        </div>
        <div class="topbar-right">
            <a href="FormBuku.php" class="btn-add">
                <i class="ti ti-plus"></i> Tambah buku
            </a>
        </div>
    </header>

    <main class="content">

        <?php if (isset($_GET["sukses"])) : ?>
        <div class="notif notif-sukses">
            <i class="ti ti-circle-check"></i>
            <?php
                if ($_GET["sukses"] == "tambah") echo "Data buku berhasil ditambahkan.";
                if ($_GET["sukses"] == "ubah")   echo "Data buku berhasil diubah.";
                if ($_GET["sukses"] == "hapus")  echo "Data buku berhasil dihapus.";
            ?>
        </div>
        <?php endif; ?>

        <?php if (isset($_GET["error"])) : ?>
        <div class="notif notif-error">
            <i class="ti ti-alert-circle"></i>
            <?php if ($_GET["error"] == "punya_peminjaman") : ?>
                Buku tidak bisa dihapus karena masih memiliki data peminjaman aktif.
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun terbit</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dataBuku)) : ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="ti ti-books"></i>
                                <p>Belum ada data buku. <a href="FormBuku.php" style="color:var(--crimson);">Tambah sekarang</a></p>
                            </div>
                        </td>
                    </tr>
                    <?php else : ?>
                    <?php foreach ($dataBuku as $buku) : ?>
                    <tr>
                        <td><span class="id-badge">#<?= $buku["id_buku"] ?></span></td>
                        <td><?= htmlspecialchars($buku["judul_buku"]) ?></td>
                        <td class="muted"><?= htmlspecialchars($buku["penulis"]) ?></td>
                        <td class="muted"><?= htmlspecialchars($buku["penerbit"]) ?></td>
                        <td class="muted"><?= htmlspecialchars($buku["tahun_terbit"]) ?></td>
                        <td>
                            <div class="actions">
                                <a href="FormBuku.php?id=<?= $buku["id_buku"] ?>" class="btn-action btn-ubah">
                                    <i class="ti ti-edit"></i> Ubah
                                </a>
                                <a href="Buku.php?hapus=<?= $buku["id_buku"] ?>"
                                   class="btn-action btn-hapus"
                                   onclick="return confirm('Yakin hapus buku ini?')">
                                    <i class="ti ti-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>
</div>

</body>
</html>