<?php
require "Model.php";

$pinjam  = null;
$id      = null;
$error   = "";

$dataMember = getAllMember();
$dataBuku   = getAllBuku();

if (isset($_GET["id"])) {
    $id     = $_GET["id"];
    $pinjam = getPeminjamanById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_member   = $_POST["id_member"];
    $id_buku     = $_POST["id_buku"];
    $tgl_pinjam  = $_POST["tgl_pinjam"];
    $tgl_kembali = $_POST["tgl_kembali"];

    if ($tgl_kembali < $tgl_pinjam) {
        $error = "Tanggal kembali tidak boleh kurang dari tanggal pinjam!";
    } else {
        if ($id) {
            updatePeminjaman($id, $id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
            header("Location: Peminjaman.php?sukses=ubah");
        } else {
            insertPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
            header("Location: Peminjaman.php?sukses=tambah");
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pinjam ? "Ubah Peminjaman" : "Tambah Peminjaman" ?> — Pustaka</title>
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

        .logo-mark { display: flex; align-items: center; gap: 10px; }

        .logo-icon {
            width: 32px; height: 32px;
            background: var(--crimson);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
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
            display: flex; align-items: center; gap: 10px;
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

        .topbar-left .page-title { font-size: 17px; font-weight: 600; }
        .topbar-left .page-sub   { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 14px;
            background: transparent;
            color: var(--text-secondary);
            border: 0.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }

        .btn-back:hover { background: var(--crimson-mid); color: var(--crimson); }
        .btn-back i { font-size: 16px; }

        .content { padding: 32px; flex: 1; display: flex; justify-content: center; align-items: flex-start; }

        /* ── Form card ── */
        .form-card {
            background: var(--card-bg);
            border: 0.5px solid var(--border);
            border-radius: 14px;
            width: 100%;
            max-width: 520px;
            overflow: hidden;
        }

        .form-header {
            padding: 28px 32px 24px;
            border-bottom: 0.5px solid var(--border);
            background: var(--crimson-mid);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .form-icon {
            width: 40px; height: 40px;
            background: var(--crimson-light);
            border: 0.5px solid #F7C1C1;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 4px;
        }

        .form-icon i { font-size: 20px; color: var(--crimson); }

        .form-header h2 { font-size: 16px; font-weight: 600; color: var(--text-primary); }
        .form-header p  { font-size: 13px; color: var(--text-secondary); }

        .form-body { padding: 28px 32px; }

        /* ── Error ── */
        .error-notif {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: var(--crimson-light);
            color: var(--crimson);
            border: 0.5px solid #F7C1C1;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 22px;
        }

        .error-notif i { font-size: 16px; flex-shrink: 0; }

        /* ── Form fields ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group { margin-bottom: 18px; }
        .form-group:last-of-type { margin-bottom: 0; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap i {
            position: absolute;
            left: 12px;
            font-size: 16px;
            color: var(--text-secondary);
            pointer-events: none;
        }

        .input-wrap input,
        .input-wrap select {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 0.5px solid var(--border);
            border-radius: 8px;
            font-size: 13.5px;
            color: var(--text-primary);
            background: #FDFAF9;
            font-family: var(--font);
            transition: border-color 0.15s, box-shadow 0.15s;
            appearance: none;
            -webkit-appearance: none;
        }

        .input-wrap select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23888780' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .input-wrap input:focus,
        .input-wrap select:focus {
            outline: none;
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(163,45,45,0.08);
            background: #fff;
        }

        .input-wrap input::placeholder { color: var(--text-caption, #B4B2A9); }

        .form-divider {
            height: 0.5px;
            background: var(--border);
            margin: 24px 0;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--crimson);
            color: var(--crimson-light);
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            font-family: var(--font);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.15s;
        }

        .btn-submit i { font-size: 17px; }
        .btn-submit:hover { background: var(--crimson-dark); }
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
        <a href="Buku.php" class="nav-item"><i class="ti ti-books"></i> Koleksi Buku</a>
        <a href="Member.php" class="nav-item"><i class="ti ti-users"></i> Anggota</a>
        <a href="Peminjaman.php" class="nav-item active"><i class="ti ti-clipboard-list"></i> Peminjaman</a>
    </nav>
    <div class="sidebar-footer">
        <div class="nav-item"><i class="ti ti-user-circle"></i> Admin</div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <div class="page-title"><?= $pinjam ? "Ubah data peminjaman" : "Tambah peminjaman baru" ?></div>
            <div class="page-sub">Peminjaman › <?= $pinjam ? "ubah" : "tambah" ?></div>
        </div>
        <a href="Peminjaman.php" class="btn-back">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </header>

    <main class="content">
        <div class="form-card">

            <div class="form-header">
                <div class="form-icon">
                    <i class="ti ti-<?= $pinjam ? "edit" : "clipboard-plus" ?>"></i>
                </div>
                <h2><?= $pinjam ? "Ubah Data Peminjaman" : "Tambah Data Peminjaman" ?></h2>
                <p><?= $pinjam ? "Perbarui informasi transaksi peminjaman." : "Isi detail peminjaman buku baru." ?></p>
            </div>

            <div class="form-body">

                <?php if ($error != "") : ?>
                <div class="error-notif">
                    <i class="ti ti-alert-circle"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="FormPeminjaman.php<?= $id ? '?id=' . $id : '' ?>">

                    <div class="form-group">
                        <label>Member</label>
                        <div class="input-wrap">
                            <i class="ti ti-user"></i>
                            <select name="id_member" required>
                                <option value="">— Pilih Member —</option>
                                <?php foreach ($dataMember as $member) : ?>
                                <option value="<?= $member["id_member"] ?>"
                                    <?= ($pinjam && $pinjam["id_member"] == $member["id_member"]) ? "selected" : "" ?>>
                                    <?= htmlspecialchars($member["nama_member"]) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Buku</label>
                        <div class="input-wrap">
                            <i class="ti ti-book"></i>
                            <select name="id_buku" required>
                                <option value="">— Pilih Buku —</option>
                                <?php foreach ($dataBuku as $buku) : ?>
                                <option value="<?= $buku["id_buku"] ?>"
                                    <?= ($pinjam && $pinjam["id_buku"] == $buku["id_buku"]) ? "selected" : "" ?>>
                                    <?= htmlspecialchars($buku["judul_buku"]) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Tanggal Pinjam</label>
                            <div class="input-wrap">
                                <i class="ti ti-calendar"></i>
                                <input type="date" name="tgl_pinjam"
                                       value="<?= $pinjam ? $pinjam["tgl_pinjam"] : "" ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Kembali</label>
                            <div class="input-wrap">
                                <i class="ti ti-calendar-due"></i>
                                <input type="date" name="tgl_kembali"
                                       value="<?= $pinjam ? $pinjam["tgl_kembali"] : "" ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-divider"></div>

                    <button type="submit" class="btn-submit">
                        <i class="ti ti-<?= $pinjam ? "device-floppy" : "plus" ?>"></i>
                        <?= $pinjam ? "Simpan Perubahan" : "Tambah Peminjaman" ?>
                    </button>

                </form>

            </div>
        </div>
    </main>
</div>

</body>
</html>