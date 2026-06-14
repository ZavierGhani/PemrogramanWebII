<?php
require "Model.php";

$buku = null;
$id   = null;

if (isset($_GET["id"])) {
    $id   = $_GET["id"];
    $buku = getBukuById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul    = trim($_POST["judul"]);
    $penulis  = trim($_POST["penulis"]);
    $penerbit = trim($_POST["penerbit"]);
    $tahun    = trim($_POST["tahun"]);

    if (empty($judul) || empty($penulis) || empty($penerbit) || empty($tahun)) {
        $error = "Semua field wajib diisi!";
    } else {
        if ($id) {
            updateBuku($id, $judul, $penulis, $penerbit, $tahun);
            header("Location: Buku.php?sukses=ubah");
        } else {
            insertBuku($judul, $penulis, $penerbit, $tahun);
            header("Location: Buku.php?sukses=tambah");
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Buku</title>
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

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #333;
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

               .error {
            background-color: #fde8e8;
            color: #e74c3c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
        }
        .btn-submit:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Perpustakaan</h2>
        <a href="Buku.php">Kembali</a>
    </div>

    <div class="form-container">
        <h2><?= $buku ? "Ubah Data Buku" : "Tambah Data Buku" ?></h2>
        <form method="POST" action="FormBuku.php<?= $id ? '?id=' . $id : '' ?>">
            <div class="form-group">
                <label>Judul Buku:</label>
                <input type="text" name="judul" value="<?= $buku ? $buku["judul_buku"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Penulis:</label>
                <input type="text" name="penulis" value="<?= $buku ? $buku["penulis"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Penerbit:</label>
                <input type="text" name="penerbit" value="<?= $buku ? $buku["penerbit"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Tahun Terbit:</label>
                <input type="number" name="tahun" value="<?= $buku ? $buku["tahun_terbit"] : "" ?>" required>
            </div>
            <button type="submit" class="btn-submit">
                <?= $buku ? "Ubah Data" : "Daftar" ?>
            </button>
        </form>
    </div>
</body>
</html>