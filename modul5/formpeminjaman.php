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

    
        if ($id) {
            updatePeminjaman($id, $id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
            header("Location: Peminjaman.php?sukses=ubah");
        } else {
            insertPeminjaman($id_member, $id_buku, $tgl_pinjam, $tgl_kembali);
            header("Location: Peminjaman.php?sukses=tambah");
        }
        exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f0f0;
            min-height: 100vh;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 16px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 6px 16px;
            border: 1px solid white;
            border-radius: 4px;
            font-size: 14px;
        }

        .navbar a:hover {
            background-color: #555;
        }

        .form-container {
            max-width: 450px;
            margin: 60px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #555;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #333;
        }

        .error {
            background-color: #fde8e8;
            color: #e74c3c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Perpustakaan</h2>
        <a href="Peminjaman.php">Kembali</a>
    </div>

    <div class="form-container">
        <h2><?= $pinjam ? "Ubah Data Peminjaman" : "Tambah Data Peminjaman" ?></h2>

        <?php if ($error != "") : ?>
        <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="FormPeminjaman.php<?= $id ? '?id=' . $id : '' ?>">
            <div class="form-group">
                <label>Member:</label>
                <select name="id_member" required>
                    <option value="">-- Pilih Member --</option>
                    <?php foreach ($dataMember as $member) : ?>
                    <option value="<?= $member["id_member"] ?>"
                        <?= ($pinjam && $pinjam["id_member"] == $member["id_member"]) ? "selected" : "" ?>>
                        <?= $member["nama_member"] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Buku:</label>
                <select name="id_buku" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php foreach ($dataBuku as $buku) : ?>
                    <option value="<?= $buku["id_buku"] ?>"
                        <?= ($pinjam && $pinjam["id_buku"] == $buku["id_buku"]) ? "selected" : "" ?>>
                        <?= $buku["judul_buku"] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pinjam:</label>
                <input type="date" name="tgl_pinjam"
                       value="<?= $pinjam ? $pinjam["tgl_pinjam"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Kembali:</label>
                <input type="date" name="tgl_kembali"
                       value="<?= $pinjam ? $pinjam["tgl_kembali"] : "" ?>" required>
            </div>
            <button type="submit" class="btn-submit">
                <?= $pinjam ? "Ubah Data" : "Daftar" ?>
            </button>
        </form>
    </div>
</body>
</html>