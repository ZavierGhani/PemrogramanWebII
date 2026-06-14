<?php
require "Model.php";

$member = null;
$id     = null;

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
    <title>Form Member</title>
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
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
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
        <a href="Member.php">Kembali</a>
    </div>

    <div class="form-container">
        <h2><?= $member ? "Ubah Data Member" : "Tambah Data Member" ?></h2>
        <form method="POST" action="FormMember.php<?= $id ? '?id=' . $id : '' ?>">
            <div class="form-group">
                <label>Nama Member:</label>
                <input type="text" name="nama" 
                       value="<?= $member ? $member["nama_member"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Nomor Member:</label>
                <input type="text" name="nomor" 
                       value="<?= $member ? $member["nomor_member"] : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" rows="3" required><?= $member ? $member["alamat"] : "" ?></textarea>
            </div>
            <div class="form-group">
                <label>Tanggal Mendaftar:</label>
                <input type="datetime-local" name="tgl_mendaftar" 
                       value="<?= $member ? date('Y-m-d\TH:i', strtotime($member["tgl_mendaftar"])) : "" ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Terakhir Bayar:</label>
                <input type="date" name="tgl_bayar" 
                       value="<?= $member ? $member["tgl_terkahir_bayar"] : "" ?>" required>
            </div>
            <button type="submit" class="btn-submit">
                <?= $member ? "Ubah Data" : "Daftar" ?>
            </button>
        </form>
    </div>
</body>
</html>