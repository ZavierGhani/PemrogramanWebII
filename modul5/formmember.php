<?php
require "Model.php";

$member = null;
$id     = null;

if (isset($_GET["id"])) {
    $id     = $_GET["id"];
    $member = getMemberById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama          = trim($_POST["nama"]);
    $nomor         = trim($_POST["nomor"]);
    $alamat        = trim($_POST["alamat"]);
    $tgl_mendaftar = trim($_POST["tgl_mendaftar"]);
    $tgl_bayar     = trim($_POST["tgl_bayar"]);

    if (empty($nama) || empty($nomor) || empty($alamat) || empty($tgl_mendaftar) || empty($tgl_bayar)) {
        $error = "Semua field wajib diisi!";
    } else {
        if ($id) {
            updateMember($id, $nama, $nomor, $alamat, $tgl_mendaftar, $tgl_bayar);
            header("Location: Member.php?sukses=ubah");
        } else {
            insertMember($nama, $nomor, $alamat, $tgl_mendaftar, $tgl_bayar);
            header("Location: Member.php?sukses=tambah");
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
    <title><?= $member ? "Ubah Anggota" : "Tambah Anggota" ?> — Pustaka</title>
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

        .topbar-left .page-title { font-size: 17px; font-weight: 600; color: var(--text-primary); }
        .topbar-left .page-sub   { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 14px;
            background: transparent;
            color: var(--text-secondary);
            border: 0.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }

        .btn-back:hover { background: var(--crimson-mid); color: var(--crimson); border-color: var(--crimson); }
        .btn-back i { font-size: 15px; }

        /* ── Content ── */
        .content {
            padding: 40px 32px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        /* ── Form card ── */
        .form-card {
            background: var(--card-bg);
            border: 0.5px solid var(--border);
            border-radius: 14px;
            padding: 36px 40px;
            width: 100%;
            max-width: 500px;
        }

        .form-header { margin-bottom: 28px; }

        .form-header .form-icon {
            width: 44px; height: 44px;
            background: var(--crimson-light);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }

        .form-header .form-icon i { font-size: 22px; color: var(--crimson); }

        .form-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .form-header p { font-size: 13px; color: var(--text-secondary); }

        /* ── Error notif ── */
        .error-notif {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--crimson-light);
            color: var(--crimson);
            border: 0.5px solid #F7C1C1;
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .error-notif i { font-size: 16px; flex-shrink: 0; }

        /* ── Form fields ── */
        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 7px;
            letter-spacing: 0.02em;
        }

        .input-wrap { position: relative; }

        .input-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--text-secondary);
            pointer-events: none;
        }

        /* textarea icon sits at top */
        .input-wrap.textarea-wrap i {
            top: 12px;
            transform: none;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px 10px 38px;
            border: 0.5px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
            font-family: var(--font);
            color: var(--text-primary);
            background: var(--page-bg);
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--crimson);
            box-shadow: 0 0 0 3px rgba(163,45,45,0.08);
            background: white;
        }

        .form-divider {
            height: 0.5px;
            background: var(--border);
            margin: 24px 0;
        }

        .btn-submit {
            width: 100%;
            padding: 11px;
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
        <a href="Buku.php" class="nav-item"><i class="ti ti-books"></i> Koleksi buku</a>
        <a href="Member.php" class="nav-item active"><i class="ti ti-users"></i> Anggota</a>
        <a href="Peminjaman.php" class="nav-item"><i class="ti ti-clipboard-list"></i> Peminjaman</a>
    </nav>
    <div class="sidebar-footer">
        <div class="nav-item"><i class="ti ti-user-circle"></i> Admin</div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <div class="page-title"><?= $member ? "Ubah data anggota" : "Tambah anggota baru" ?></div>
            <div class="page-sub">Anggota › <?= $member ? "ubah" : "tambah" ?></div>
        </div>
        <a href="Member.php" class="btn-back">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </header>

    <main class="content">
        <div class="form-card">

            <div class="form-header">
                <div class="form-icon">
                    <i class="ti ti-<?= $member ? "user-edit" : "user-plus" ?>"></i>
                </div>
                <h2><?= $member ? "Ubah Data Anggota" : "Tambah Anggota Baru" ?></h2>
                <p><?= $member ? "Perbarui informasi anggota yang sudah ada." : "Isi detail anggota yang ingin didaftarkan." ?></p>
            </div>

            <?php if (isset($error)) : ?>
            <div class="error-notif">
                <i class="ti ti-alert-circle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="FormMember.php<?= $id ? '?id=' . $id : '' ?>">

                <div class="form-group">
                    <label>Nama Anggota</label>
                    <div class="input-wrap">
                        <i class="ti ti-user"></i>
                        <input type="text" name="nama"
                               value="<?= $member ? htmlspecialchars($member["nama_member"]) : "" ?>"
                               placeholder="Nama lengkap anggota" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nomor Member</label>
                    <div class="input-wrap">
                        <i class="ti ti-id-badge"></i>
                        <input type="text" name="nomor"
                               value="<?= $member ? htmlspecialchars($member["nomor_member"]) : "" ?>"
                               placeholder="Contoh: MBR-001" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <div class="input-wrap textarea-wrap">
                        <i class="ti ti-map-pin"></i>
                        <textarea name="alamat" rows="3"
                                  placeholder="Alamat lengkap anggota" required><?= $member ? htmlspecialchars($member["alamat"]) : "" ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Mendaftar</label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar-plus"></i>
                        <input type="datetime-local" name="tgl_mendaftar"
                               value="<?= $member ? date('Y-m-d\TH:i', strtotime($member["tgl_mendaftar"])) : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Terakhir Bayar</label>
                    <div class="input-wrap">
                        <i class="ti ti-calendar-check"></i>
                        <input type="date" name="tgl_bayar"
                               value="<?= $member ? htmlspecialchars($member["tgl_terkahir_bayar"]) : "" ?>" required>
                    </div>
                </div>

                <div class="form-divider"></div>

                <button type="submit" class="btn-submit">
                    <i class="ti ti-<?= $member ? "device-floppy" : "user-plus" ?>"></i>
                    <?= $member ? "Simpan Perubahan" : "Daftarkan Anggota" ?>
                </button>
            </form>

        </div>
    </main>
</div>

</body>
</html>